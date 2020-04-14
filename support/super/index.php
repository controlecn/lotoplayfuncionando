<?php
	session_start() ;
	if ( !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: ../setup/index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php") ;
	$DOCUMENT_ROOT = realpath( preg_replace( "/http:/", "", $DOCUMENT_ROOT ) ) ;
	include_once("../system.php") ;
	include_once("../lang_packs/$LANG_PACK.php") ;
	include_once("../web/VERSION_KEEP.php" ) ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/API/Form.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/get.php") ;
?>
<?php

	// initialize
	$success = 0 ;
?>
<?php
	// functions
?>
<?php
	// conditions
?>
<?php include_once( "./header.php" ) ; ?>
<span class="title">Congratulations!  System is successfully setup!</span><p>
This is the super admin area.  You can update your company information and customize your company logo here.
<p>
[ <a href="profile.php">Your Site Profile</a> ]
[ <a href="customize.php">Customize Logo</a> ]
[ <a href="dbinfo.php">Database Info</a> ]

<?php
	if ( file_exists( "asp.php" ) && $ASP_KEY )
		print "		<big><b>[ <a href=\"asp.php\">ASP Service Suite</a> ]</b></big>" ;
?>
<p>
<font color="#FF0000"><b>PASSWORD PROTECT THIS (super/) DIRECTORY!</b></font>  PHP Live! does not use a password system for this area in the event you forget the password and be locked out of your system.  If password protected at the server end, you can always disable it to gain access.  For documentation and help please consult the <a href="http://www.phplivesupport.com/documentation/viewarticle.php?aid=33" target="new">PHP Live! User Manual</a>.
<br>
<hr>
<span class="title">Your Site Setup Area:</span>
<p>
To customize your site online/offline icons, manage departments and users, view logs, and other setup tasks, please go to the below setup area and login with your site login and password (from above profile).
<p>
<big><b><a href="<?php echo $BASE_URL ?>/setup/index.php"><?php echo $BASE_URL ?>/setup/</a></b></big>
<hr>

<?php include_once( "./footer.php" ) ; ?>