<?
	error_reporting(0) ;
	if ( !file_exists( "../../web/conf-init.php" ) )
	{
		HEADER( "location: ../index.php" ) ;
		exit ;
	}
	// patch check for correct version patch.  this patch is for version 1.6
	$PATCH_VERSION = "1.9.8" ;
	$previous_version = "1.9.7.2" ;
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
	if ( preg_match( "/(MSIE)|(Gecko)/", $_SERVER['HTTP_USER_AGENT'] ) )
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

			$query = "ALTER TABLE chat_admin ADD rate_sum INT(10) UNSIGNED NOT NULL, ADD rate_total INT(10) UNSIGNED NOT NULL, ADD `rate_ave` TINYINT(2) NOT NULL" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chat_admin ADD rateme TINYINT(1) NOT NULL AFTER signal" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chatsessions DROP INDEX userID" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chatsessionlist DROP INDEX userID" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chatrequests DROP INDEX fromID" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chatrequests DROP INDEX toID" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chatrequests ADD surveyID INT(10) UNSIGNED NOT NULL AFTER sessionID" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chatrequestlogs DROP INDEX display_resolution" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chatrequestlogs DROP INDEX browser_os" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chatrequestlogs ADD surveyID INT(10) UNSIGNED NOT NULL AFTER deptID" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "ALTER TABLE chatfootprintsunique ADD surveyID INT(10) UNSIGNED NOT NULL" ;
			database_mysql_query( $dbh, $query ) ;

			// add new tables
			$query = "CREATE TABLE chat_adminrate (
				userID int(10) unsigned NOT NULL default '0',
				sessionID int(10) unsigned NOT NULL default '0',
				rating int(10) unsigned NOT NULL default '0',
				deptID int(10) unsigned NOT NULL default '0',
				created int(10) unsigned NOT NULL default '0',
				aspID int(10) unsigned NOT NULL default '0',
				PRIMARY KEY  (sessionID),
				KEY userID (userID),
				KEY deptID (deptID)
			)" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "CREATE TABLE chatsurveylogs (
				aspID int(10) unsigned NOT NULL default '0',
				surveyID int(10) unsigned NOT NULL default '0',
				rejected tinyint(1) NOT NULL default '0',
				s_c1 int(10) unsigned NOT NULL default '0',
				s_c2 int(10) unsigned NOT NULL default '0',
				s_c3 int(10) unsigned NOT NULL default '0',
				s_c4 int(10) unsigned NOT NULL default '0',
				s_c5 int(10) unsigned NOT NULL default '0',
				created int(10) unsigned NOT NULL default '0',
				ip varchar(20) NOT NULL default '',
				q_open text NOT NULL,
				PRIMARY KEY  (ip,aspID,surveyID)
			)" ;
			database_mysql_query( $dbh, $query ) ;
			$query = "CREATE TABLE chatsurveys (
				surveyID int(10) unsigned NOT NULL auto_increment,
				aspID int(10) unsigned NOT NULL default '0',
				deptID int(10) unsigned NOT NULL default '0',
				isactive tinyint(1) unsigned NOT NULL default '0',
				created int(10) NOT NULL default '0',
				s_totaltaken int(10) unsigned NOT NULL default '0',
				s_c1 int(10) unsigned NOT NULL default '0',
				s_c2 int(10) unsigned NOT NULL default '0',
				s_c3 int(10) unsigned NOT NULL default '0',
				s_c4 int(10) unsigned NOT NULL default '0',
				s_c5 int(10) unsigned NOT NULL default '0',
				name varchar(60) NOT NULL default '',
				survey_data text NOT NULL,
				PRIMARY KEY  (surveyID),
				UNIQUE KEY name (name),
				KEY aspID (aspID),
				KEY deptID (deptID)
			)" ;
			database_mysql_query( $dbh, $query ) ;

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

			HEADER( "location: index.php?version=$PATCH_VERSION" ) ;
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