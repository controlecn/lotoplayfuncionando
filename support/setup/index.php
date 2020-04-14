<?php
	//error_reporting(0);
	//include_once("../API/Util_Error.php") ;

	// initialize
	if ( preg_match( "/unix/i", $_SERVER['SERVER_SOFTWARE'] ) )
		$server = "unix" ;
	else
		$server = "windows" ;
	
	$PHPLIVE_VERSION = "3.2.2" ;
	$success = 0 ;
	$error = "" ;

	// put php version check module here
	// check_version() ;

	// if system if configured, then let's go to the menu options
	if ( file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: login.php" ) ;
		exit ;
	}

	// open the language pack if passed
	if ( isset( $_POST['language'] ) && $_POST['language'] )
		include_once( "../lang_packs/$_POST[language].php" ) ;

	function print_error( $error )
	{
		print "
			<html>
				<head><title>ERROR</title></head>
				<body text=#38385E link=#026AFE vlink=#026AFE alink=#026AFE leftmargin=0 topmargin=0 marginwidth=0 marginheight=0>
					<br>
					<table cellspacing=0 cellpadding=5 border=0 width=100%>
					<tr>
						<td>
						<big><b>SETUP ERROR</b></big><p>
						<b><font color=#CE0C01>$error</font></b>
						<hr>
						<font size=1 face=arial>Support! Installation</font>
						</td>
					</tr>
					</table>
				</body>
			</html>
		" ;
	}

	// do initial checks to make sure setup can run
	if ( !is_dir( session_save_path() ) )
	{
		print_error(  "'session.save_path' directory not set!  Please set your session.save_path in your php.ini file (it is usally set to /tmp for UNIX, C:\Temp for windows). Restart your webserver.  After you have done this, reload this page and try again." ) ;
		exit ;
	}
	if ( file_exists( "../web" ) )
	{
		if ( !is_writable( "../web" ) )
		{
			print_error(  "Please give the '<i>web</i>' directory READ/WRITE permission by the browser. (<code>chmod o+rw web</code>).  The '<i>web</i>' directory is located in your root PHP Live! install location.  After you have done this, reload this page and try again." ) ;
			exit ;
		}
		else
		{
			if ( is_dir( "../web/chatsessions" ) != true )
				mkdir( "../web/chatsessions", 0777 ) ;
			if ( is_dir( "../web/chatrequests" ) != true )
				mkdir( "../web/chatrequests", 0777 ) ;
			if ( is_dir( "../web/chatpolling" ) != true )
				mkdir( "../web/chatpolling", 0777 ) ;

			if ( !file_exists( "../web/chatsessions" ) )
			{
				print_error( "Setup was unable to create the needed directories.  Please check your php.ini to make sure the mkdir() function is not disabled or make sure that a web/ directory exists inside your phplive/ directory.  After you have done this, reload this page and try again." ) ;
				exit ;
			}
		}
	}
	else
	{
		print_error(  "Please create a '<i>web</i>' directory in your root PHP Live! install location.  Make it READ/WRITE permission by the browser. (<code>chmod o+rw web</code>).  After you have done this, reload this page and try again." ) ;
		exit ;
	}

	//
	// connect to DB and check to see if any users exist - show error if need above
	//

	srand((double)microtime());
	$rand = mt_rand(0,1000) ;

	// functions
	function checkVersion( $version )
	{
		if ( phpversion() >= $version )
			return true ;
		return false ;
	}

	function dump_db( $db_name, $db_host, $db_login, $db_password )
	{
		$mysql_error = "" ;

		$connection = mysql_pconnect( $db_host, $db_login, $db_password ) ;
		if ( !mysql_select_db( $db_name ) )
			return "<p>Error: Could not locate database[ $db_name ]<p>" ;

		$fp = fopen ("../super/phplive.txt", "r") ;
		while (!feof ($fp))
		{
			$query = "" ;
			$error = "" ;
			$buffer = fgets($fp, 1000);

			if ( preg_match( "/(DROP TABLE)/", $buffer ) )
			{
				$query = substr( $buffer, 0, strlen( $buffer ) - 2 ) ;
				$query = stripslashes( $query ) ;
				$result = mysql_query( $query, $connection ) ;
				$mysql_error .=  mysql_error() ;
			}
			
			if ( preg_match( "/(CREATE TABLE)/", $buffer ) )
			{
				$query .= $buffer ;
				if ( !preg_match( "/\) ENGINE=MyISAM DEFAULT CHARSET=utf8/", $buffer ) )
				{
					while ( $buffer = fgets( $fp, 500 ) )
					{
						if ( preg_match( "/\) ENGINE=MyISAM DEFAULT CHARSET=utf8/", $buffer ) ){ break 1 ; }
						$query .= $buffer ;
					}
					if ( !preg_match( "/\) ENGINE=MyISAM DEFAULT CHARSET=utf8/", $query ) )
						$query = "$query);" ;
				}
				$query = stripslashes( $query ) ;
				$result = mysql_query( $query, $connection ) ;
				$mysql_error .=  mysql_error() ;
			}

			if ( preg_match( "/(INSERT INTO)/", $buffer ) )
			{
				$query = substr( $buffer, 0, strlen( $buffer ) - 2 ) ;
				$query = stripslashes( $query ) ;
				$result = mysql_query( $query, $connection ) ;
				$mysql_error .=  mysql_error() ;
			}
		}
		fclose( $fp ) ;
		mysql_close( $connection ) ;

		if ( $mysql_error )
			$error = "<p>Error: Following database error(s) were generated: <br>$mysql_error<p><a href=\"http://www.phplivesupport.com/documentation/viewarticle.php?aid=35\" target=\"new\">Verifying your MySQL Information Help</a><p>" ;

		return $error ;
	}

	// initialize and get vars
	$action = $override = "" ;
	if ( isset( $_POST['action'] ) ) { $action = $_POST['action'] ; }
	if ( isset( $_POST['override'] ) ) { $override = $_POST['override'] ; }

	// conditions
	
	if ( $action == "update db" )
	{
		$db_host = $_POST['db_host'] ;
		$db_login = $_POST['db_login'] ;
		$db_password = $_POST['db_password'] ;
		$db_name = $_POST['db_name'] ;

		$connection = mysql_connect( $db_host, $db_login, $db_password ) ;
		mysql_select_db( $db_name ) ;
		$sth = mysql_query( "SHOW TABLES", $connection ) ;
		$error = mysql_error() ;
		if ( $error )
		{
			$action = "update company" ;
			$error = "<p>Error: Database produced the following error(s).  Please correct and submit.<br>-- $error --<p><a href=\"http://www.phplivesupport.com/documentation/viewarticle.php?aid=35\" target=\"new\">Verifying your MySQL Information Help Docs</a><p>" ;
		}
		else
		{
			$error = dump_db( $db_name, $db_host, $db_login, $db_password ) ;
			if ( !$error )
			{
				if ( !$error )
				{
					$document_root = stripslashes( $_POST['document_root'] ) ;
					$site_name = addslashes( $_POST['site_name'] ) ;
					$conf_string = "0LEFT_ARROW0?php
						\$ASP_KEY = '' ;
						\$NO_PCONNECT = '$_POST[no_pconnect]' ;
						\$DATABASETYPE = '$_POST[db_type]' ;
						\$DATABASE = '$db_name' ;
						\$SQLHOST = '$db_host' ;
						\$SQLLOGIN = '$db_login' ;
						\$SQLPASS = '$db_password' ;
						\$DOCUMENT_ROOT = '$_POST[document_root]' ;
						\$BASE_URL = '$_POST[base_url]' ;
						\$SITE_NAME = '$site_name' ;
						\$LOGO_ASP = 'phplive_logo.gif' ;
						\$LANG_PACK = '$_POST[language]' ;?0RIGHT_ARROW0" ;

					// create and put configuration data
					$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
					$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
					$fp = fopen ("../web/conf-init.php", "wb+") ;
					fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
					fclose( $fp ) ;

					if ( ( is_dir( "../web/$_POST[login]" ) != true ) && isset( $_POST['login'] ) )
						mkdir( "../web/$_POST[login]", 0777 ) ;

					if ( file_exists( "../admin/traffic/admin_puller.php" ) )
						$initiate = 1 ;
					else
						$initiate = 0 ;
					$COMPANY_NAME = addslashes( $_POST['company'] ) ;
					$conf_string = "0LEFT_ARROW0?php
						\$LOGO = '' ;
						\$COMPANY_NAME = '$COMPANY_NAME' ;
						\$SUPPORT_LOGO_ONLINE = 'phplive_support_online.gif' ;
						\$SUPPORT_LOGO_OFFLINE = 'phplive_support_offline.gif' ;
						\$SUPPORT_LOGO_AWAY = '' ;
						\$VISITOR_FOOTPRINT = '1' ;
						\$THEME = 'default' ;
						\$POLL_TIME = '45' ;
						\$INITIATE = '$initiate' ;
						\$INITIATE_IMAGE = '' ;
						\$IPNOTRACK = '' ;
						\$LANG_PACK = '$_POST[language]'; ?0RIGHT_ARROW0" ;

					$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
					$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
					$fp = fopen ("../web/$_POST[login]/$_POST[login]-conf-init.php", "wb+") ;
					fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
					fclose( $fp ) ;

					// let's create an index file for the user so
					// the path is more nice...
					// (/phplive/<user>/ instead of /phplive/index.php?l=<user>)
					$index_string = "0LEFT_ARROW0?php \$path = explode( \"/\", \$_SERVER['PHP_SELF'] ) ; \$total = count( \$path ) ; \$login = \$path[\$total-2] ; \$winapp = isset( \$_GET['winapp'] ) ? \$_GET['winapp'] : \"\" ; HEADER( \"location: ../../index.php?l=\$login&winapp=\$winapp\" ) ; exit ; ?0RIGHT_ARROW0" ;
					$index_string = preg_replace( "/0LEFT_ARROW0/", "<", $index_string ) ;
					$index_string = preg_replace( "/0RIGHT_ARROW0/", ">", $index_string ) ;
					$fp = fopen ("../web/$_POST[login]/index.php", "wb+") ;
					fwrite( $fp, $index_string, strlen( $index_string ) ) ;
					fclose( $fp ) ;

					// now let's create an index.php page in the web/ directory for
					// extra security
					$index_string = "&nbsp;" ;
					$fp = fopen ("../web/index.php", "wb+") ;
					fwrite( $fp, $index_string, strlen( $index_string ) ) ;
					fclose( $fp ) ;

					/*********** insert new data ***************/
					$now = time() ;
					$connection = mysql_connect( $db_host, $db_login, $db_password ) ;
					mysql_select_db( $db_name ) ;
					$trans_email = "Hello %%username%%,

Below is the complete transcript of your chat session:

===
%%transcript%%
===

Thank you

" ;
					$query = "INSERT INTO chat_asp VALUES (0, '$_POST[login]', '$_POST[password]', '$_POST[company]', '$_POST[contact_name]', '$_POST[contact_email]', '15', '100', '1', '$now', 0, 1, 1, 0, 0, '(optional) If you would like to receive a copy of this chat session transcript, please input your email address below and Submit.', '$trans_email')" ;
					mysql_query( $query, $connection ) ;
					/********************************************/

					// create and put version file
					$version_string = "0LEFT_ARROW0?php \$PHPLIVE_VERSION = \"$PHPLIVE_VERSION\" ; ?0RIGHT_ARROW0" ;
					$version_string = preg_replace( "/0LEFT_ARROW0/", "<", $version_string ) ;
					$version_string = preg_replace( "/0RIGHT_ARROW0/", ">", $version_string ) ;
					$fp = fopen ("../web/VERSION_KEEP.php", "wb+") ;
					fwrite( $fp, $version_string, strlen( $version_string ) ) ;
					fclose( $fp ) ;

					$url = $_POST['base_url'] ;
					$os = $_SERVER['SERVER_SOFTWARE'] ;
					$os = urlencode( $os ) ;
					//$fp = fopen ("http://www.osicodes.com/stats/patch.php?v=$PHPLIVE_VERSION&url=$url&os=$os&users=INSTALL&ops=0", "r") ;
					//fclose( $fp ) ;

					copy( "../files/nodelete.php", "../web/$_POST[login]/nodelete.php" ) ;

					HEADER( "location: ../super" ) ;
					exit ;
				}
			}
			else
			{
				$action = "update company" ;
				$error = "<p>Error: Database produced the following error(s).  Please correct and submit.<br>-- $error --<p><a href=\"http://www.phplivesupport.com/documentation/viewarticle.php?aid=35\" target=\"new\">Verifying your MySQL Information Help Docs</a><p>" ;
			}
		}
	}
	else if ( $action == "update document root" )
	{
		$document_root = $_POST['document_root'] ;
		$str_len = strlen( $document_root ) ;
		$last = $document_root[$str_len-1] ;
		if ( ( $last == "/" ) || ( $last == "\\" ) )
			$document_root = substr( $document_root, 0, $str_len - 1 ) ;

		if ( !file_exists( "$document_root/super/phplive.txt" ) )
		{
			$action = "update site name" ;
			$temp_root = stripslashes( $document_root ) ;
			$error = "Error: $temp_root - This is NOT the correct unpacked path of PHP <i>Live!</i>.  Please correct and submit." ;
		}
	}
	else if ( $action == "update base url" )
	{
		$document_root = $_POST['document_root'] ;
		$base_url = $_POST['base_url'] ;
		$str_len = strlen( $base_url ) ;
		$last = $base_url[$str_len-1] ;
		if ( ( $last == "/" ) || ( $last == "\\" ) )
			$base_url = substr( $base_url, 0, $str_len - 1 ) ;

		if ( !fopen( "$base_url/docs/ChangeLog.txt", "r") )
		{
			$action = "update document root" ;
			$error = "Error: $base_url - This is NOT the correct unpacked path of PHP <i>Live!</i>.  Please correct and submit." ;
		}
		if ( !fopen( "$base_url/super/phplive.txt", "r") && !$error )
		{
			$action = "update document root" ;
			$error = "Error: $base_url - During installation, please remove the HTTP password protection to your <a href=\"$base_url/super/info.php\" target=\"new\">super/</a> area OR make sure the fopen() function is enabled in your php.ini file (requires webserver restart after update).  Please correct and submit." ;
		}
	}
	else
	{
		if ( !checkVersion( "4.0.6" ) && !$override )
		{
			print "<font color=\"#FF0000\">Your current PHP version ".phpversion()." is not compatible with PHP <i>Live!</i> Support v".$PHPLIVE_VERSION.".  Please upgrade your PHP to 4.0.6 or greater.  We recommend you install the latest PHP version from <a href=\"http://www.php.net/downloads.php\" target=\"new\">PHP.net</a>.  Please contact your server admin to upgrade your current PHP build.</font>" ;
			exit ;
		}
	}
?>
<?php include_once( "../super/header.php" ) ?>
<script language="JavaScript">
<!--

	var url = location.toString() ;
	url = replace( url, "setup/index.php", "" ) ;

	function do_db_update()
	{
		if ( ( document.form.db_name.value == "" ) || ( document.form.db_host.value == "" )
			|| ( document.form.db_login.value == "" ) || ( document.form.db_password.value == "" ) )
			alert( "All fields must be supplied." )
		else
			document.form.submit() ;
	}

	function do_user_update()
	{
		if ( ( document.form.company.value == "" ) || ( document.form.login.value == "" )
			|| ( document.form.password.value == "" ) || ( document.form.contact_name.value == "" )
			|| ( document.form.contact_email.value == "" ) )
			alert( "All fields MUST be filled." ) ;
		else if ( document.form.company.value.indexOf("'") != -1 )
			alert( "Company name cannot have a single quote (')." ) ;
		else
			document.form.submit() ;
	}
//-->
</script>

<font color="#FF0000"><?php echo $error ?></font><br>
<form method="POST" action="index.php" name="form">


		<?php if ( $action == "update document root" ): ?>
		<input type="hidden" name="action" value="update base url">
		<input type="hidden" name="language" value="<?php echo $_POST['language'] ?>">
		<input type="hidden" name="site_name" value="<?php echo $_POST['site_name'] ?>">
		<input type="hidden" name="document_root" value="<?php echo stripslashes( $document_root ) ?>">
		<span class="title">Set your Base URL.</span>
		<br>
		<span class="basetxt">This is the complete URL path of the PHP <i>Live!</i> system.<p>

		Example:<br>
		<font color="#660000">http://phplive.mycompany.com<br>
		http://www.mycompany.com/phplive</font>
		<br>
		<table cellpadding=5 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Base URL</td><td><span class="basetxt"> <input type="text" name="base_url" size=30 maxlength=120></td><td> <input type="submit" class="mainButton" value="Submit" border=0></td>
		</tr>
		</table>
		<script language="JavaScript"> document.form.base_url.value = url ; </script>






		<?php elseif ( $action == "update base url" ): ?>
		<input type="hidden" name="action" value="update company">
		<input type="hidden" name="language" value="<?php echo $_POST['language'] ?>">
		<input type="hidden" name="site_name" value="<?php echo $_POST['site_name'] ?>">
		<input type="hidden" name="document_root" value="<?php echo stripslashes( $_POST['document_root'] ) ?>">
		<input type="hidden" name="base_url" value="<?php echo stripslashes( $base_url ) ?>">
		<span class="title">Your Company Information.</span>
		<br>
		<br>
		Please provide your default company profile information.
		<br>
		<font color="#FF0000">(do not include single quote (') in your company name!)</font>
		<p>
		<table cellpadding=1 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Company</td>
			<td><span class="basetxt"><font size=2 face="arial"> <input type="text" name="company" size="<?php echo $text_width ?>" maxlength="50" onKeyPress="return nospecials(event)"></td>
		</tr>
		<tr>
			<td><span class="basetxt">Setup Login</td>
			<td><font size=2 face="arial"> <input type="text" name="login" size="<?php echo $text_width ?>" maxlength="15" onKeyPress="return nospecials(event)"></td>
			<td><span class="basetxt">Password</td>
			<td><span class="basetxt"><font size=2 face="arial"> <input type="text" name="password" size="<?php echo $text_width ?>" maxlength="15"></td>
		</tr>
		<tr>
			<td><span class="basetxt">Contact Name</td>
			<td><span class="basetxt"><font size=2 face="arial"> <input type="text" name="contact_name" size="<?php echo $text_width ?>" maxlength="50"></td>
			<td><span class="basetxt">Contact Email</td>
			<td><span class="basetxt"><font size=2 face="arial"> <input type="text" name="contact_email" size="<?php echo $text_width ?>" maxlength="150"></td>
		</tr>
		<tr>
			<td colspan=4>&nbsp;</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="button" OnClick="do_user_update()" class="mainButton" value="Submit"></td>
		</tr>
		</table>







		
		<?php elseif ( $action == "update company" ): ?>
		<input type="hidden" name="action" value="update db">
		<input type="hidden" name="language" value="<?php echo $_POST['language'] ?>">
		<input type="hidden" name="site_name" value="<?php echo $_POST['site_name'] ?>">
		<input type="hidden" name="document_root" value="<?php echo stripslashes( $_POST['document_root'] ) ?>">
		<input type="hidden" name="base_url" value="<?php echo stripslashes( $_POST['base_url'] ) ?>">
		<input type="hidden" name="company" value="<?php echo $_POST['company'] ?>">
		<input type="hidden" name="login" value="<?php echo $_POST['login'] ?>">
		<input type="hidden" name="password" value="<?php echo $_POST['password'] ?>">
		<input type="hidden" name="contact_name" value="<?php echo $_POST['contact_name'] ?>">
		<input type="hidden" name="contact_email" value="<?php echo $_POST['contact_email'] ?>">
		<span class="title">Configure Database.</span>
		<br>
		<br>
		<font color="#660000">
		<big><b>Before you proceed, create an empty database for your PHP Live! system.  After you have done so, provide the database information below. (NOTE: Don't forget to restart or reload your MySQL so the new access level for this user is set.)</big></b>
		</font>
		<p>
		
		<input type="hidden" value="1" name="no_pconnect">
		<p>
		<table cellpadding=2 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Database Type</td>
			<td><span class="basetxt"> <select name="db_type"><option value='mysql'>MySQL</select></td>
		</tr>
		<tr>
			<td><span class="basetxt">DB Name</td>
			<td><span class="basetxt"> <input type="text" name="db_name" size=15 maxlength="200"></td>
		</tr>
		<tr>
			<td colspan=2><font size=1 face="arial">DB Host is usually set to reidobingo-net.umbler.net.</td>
		</tr>
		<tr>
			<td><span class="basetxt">DB Host</td>
			<td><span class="basetxt"> <input type="text" name="db_host" size=15 maxlength="200" value="reidobingo-net.umbler.net"></td>
		</tr>
		<tr>
			<td><span class="basetxt">DB Login</td>
			<td><span class="basetxt"> <input type="text" name="db_login" size=15 maxlength="200"></td>
		</tr>
		<tr>
			<td><span class="basetxt">DB Password</td>
			<td><span class="basetxt"> <input type="text" name="db_password" size=15 maxlength="200"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="button" OnClick="do_db_update()" class="mainButton" value="Submit"></td>
		</tr>
		</table>












		<?php 
			elseif( $action == "update site name" ):
			$path_translated = ( isset( $_SERVER['PATH_TRANSLATED'] ) ) ? $_SERVER['PATH_TRANSLATED'] : $_SERVER['SCRIPT_FILENAME'] ;
			$temp_root = preg_replace( "/setup(.*?).php/i", "", $path_translated ) ;
		?>
		<input type="hidden" name="action" value="update document root">
		<input type="hidden" name="site_name" value="<?php echo $_POST['site_name'] ?>">
		<input type="hidden" name="language" value="<?php echo $_POST['language'] ?>">
		<span class="title">Set your Document Root.</span>
		<br>
		<span class="basetxt">This is the complete installed path (unpacked dir) of PHP <i>Live!</i>.<p>

		Example:<br>
		<font color="#660000">UNIX: /home/user/phplive<br>
		Windows: C:\Apache\htdocs\phplive</font>
		<br>
		<table cellpadding=5 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Document Root</td><td><span class="basetxt"> <input type="text" name="document_root" size=30 maxlength=120 value="<?php echo $temp_root ?>"></td><td> <input type="submit" class="mainButton" value="Submit" border=0></td>
		</tr>
		</table>





		<?php else: ?>
		<input type="hidden" name="action" value="update site name">
		<span class="title">Your Site Name.</span>
		<br>
		<table cellpadding=5 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Site Name</td><td><span class="basetxt"> <input type="text" name="site_name" size=15 maxlength=35 value="PHP Live!"></td>
		</tr>
		<tr>
			<td><span class="basetxt">Language</td>
			<td><span class="basetxt">
			<select name="language">
			<?php
				if ( !isset( $LANG_PACK ) )
					$LANG_PACK = "English" ;
				if ( $dir = @opendir( "../lang_packs" ) )
				{
					while( $file = readdir( $dir ) )
					{
						if ( ( $file = preg_replace( "/\.php/", "", $file ) ) && !preg_match( "/(.bak)|(CVS)/", $file ) && preg_match( "/[0-9a-z]/i", $file ) )
						{
							$selected = "" ;
							if ( $file == $LANG_PACK )
								$selected = "selected" ;
							print "<option value=\"$file\" $selected>$file" ;
						}
					} 
					closedir($dir) ;
				}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td><input type="submit" class="mainButton" value="Submit"></td>
		</tr>
		</table>





		<?php endif ; ?>
	</form>
	</td></tr></table>
	</td>
  </tr>
  <tr> 
	<td height="20" align="right" class="bgFooter" style="height:20px"><img src="../images/bg_corner_footer.gif" alt="" width="94" height="20"></td>
  </tr>
  <tr> 
	<td height="20" align="center" class="bgCopyright" style="height:20px">&copy; LotoPlay.com</td>
  </tr>
</table>
</body>
</html>
