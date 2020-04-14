<?php
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $_SESSION['session_setup'] ) ) { $session_setup = $_SESSION['session_setup'] ; } else { HEADER( "location: index.php" ) ; exit ; }
	include_once( "../API/Util_Dir.php" ) ;
	if ( !Util_DIR_CheckDir( "..", $session_setup['login'] ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	$DOCUMENT_ROOT = realpath( preg_replace( "/http:/", "", $DOCUMENT_ROOT ) ) ;
	include_once("../web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("../lang_packs/$LANG_PACK.php") ;
	include_once("../web/VERSION_KEEP.php") ;
	include_once("../system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	$section = 1;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)
?>
<?php
	// initialize
	$action = "" ;
	$deptid = 0 ;
	$now = time() ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $_SERVER['HTTP_USER_AGENT'] ) )
	{
		$text_width = "30" ;
		$textbox_width = "80" ;
	}
	else
	{
		$text_width = "15" ;
		$textbox_width = "40" ;
	}

	// get variables
	if ( isset( $_POST['action'] ) ) { $action = $_POST['action'] ; }
	if ( isset( $_GET['action'] ) ) { $action = $_GET['action'] ; }
	if ( isset( $_GET['deptid'] ) ) { $deptid = $_GET['deptid'] ; }

	$nav_line = '<a href="options.php" class="nav">:: Home</a>' ;
	if ( $action )
		$nav_line = '<a href="code.php" class="nav">:: Previous</a>' ;

	// conditions
?>
<?php include_once("./header.php"); ?>
<script language="JavaScript">
<!--
	function gen_text_code()
	{
		if ( document.form_text.link_text.value == "" )
			alert( "Please provide a text." ) ;
		else
		{
			window.open( "code_text.php?deptid=<?php echo $deptid ?>&text="+escape( document.form_text.link_text.value ), "text_code", "scrollbars=yes,menubar=no,resizable=1,location=no,width=450,height=250" ) ;
		}
	}
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td height="350" valign="top"> <a name="code"><p></a><span class="title">Interface: Generate 
	  HTML </span><br>
	  Generate your Support HTML Code to place your website.</p>
<?php
	if ( $action == "generate" ):
	$BASE_URL_STRIP = $BASE_URL ;
	//$BASE_URL_STRIP = preg_replace( "/http:/", "", $BASE_URL ) ;
?>
	<b>WEBSITE HTML CODE.</b>  Simply copy the below code into your webpages.  
	<ul>
		<li> Please keep the code EXACTLY the way it shows. Make sure your HTML editing program does not break up the long lines.
		<li> <span class="hilight"><b>NOTE:</b></span> Place the code INSIDE the &lt;body&gt; tags.  Failure to do so may cause errors.
	</ul>
	<form>
	<textarea cols="<?php echo $textbox_width ?>" rows="8" wrap="virtual" onFocus="this.select(); return true;">
<script language="JavaScript" src="<?php echo $BASE_URL_STRIP ?>/js/status_image.php?base_url=<?php echo $BASE_URL_STRIP ?>&l=<?php echo $session_setup['login'] ?>&x=<?php echo $session_setup['aspID'] ?>&deptid=<?php echo $deptid ?>&"><a href="http://www.phplivesupport.com"></a></script>
</textarea>
	</form>
	The above code will produce the below status icon and link.<br>

<script language="JavaScript" src="<?php echo $BASE_URL_STRIP ?>/js/status_image.php?base_url=<?php echo $BASE_URL_STRIP ?>&l=<?php echo $session_setup['login'] ?>&x=<?php echo $session_setup['aspID'] ?>&deptid=<?php echo $deptid ?>&"><a href="http://www.phplivesupport.com"></a></script>

	<p>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="hdash">&nbsp;</td>
	  </tr>
	</table>
	<form name="form_text">
	<b>TEXT ONLY LINK HTML CODE GENERATOR</b>
	<span class="medium"><li> <b>OR</b> type in a text below to produce HTML code that is <b>TEXT ONLY</b> with no graphic image.
	<br><input type="text" name="link_text" size="<?php echo $text_width ?>" maxlength="255" onKeyPress="return noquotes(event)"> <input type="button" OnClick="gen_text_code()" value="Generate Code" class="mainButton">
	</form>
	<p>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="hdash">&nbsp;</td>
	  </tr>
	</table>
	<form>
	<b>EMAIL SIGNATURE HTML CODE</b>
	<br>
	<span class="hilight">* Do not use this code for your website.  Use the above <a href="#code">WEBSITE HTML CODE</a>. </span>
	<span class="medium"><li> Below code can be used for your outgoing email messages (email signature).<p>

	<textarea cols="<?php echo $textbox_width ?>" rows="5" wrap="virtual" onFocus="this.select(); return true;"><a href="<?php echo $BASE_URL ?>/request_email.php?l=<?php echo $session_setup['login'] ?>&x=<?php echo $session_setup['aspID'] ?>&deptid=<?php echo $deptid ?>" target="new"><img src="<?php echo $BASE_URL ?>/image.php?l=<?php echo $session_setup['login'] ?>&x=<?php echo $session_setup['aspID'] ?>&deptid=<?php echo $deptid ?>&refer=Email+Signature" border=0 alt="Click for Live Support!"></a></textarea>
	</form>



<?php
	else:
	$departments = AdminUsers_get_AllDepartments( $dbh, $session_setup['aspID'], 1 ) ;
	$totalusers = AdminUsers_get_TotalUsers( $dbh, $session_setup['aspID'] ) ;
?>
	<ul>
		<?php if ( count( $departments ) <= 0 ): ?>
		<span class="hilight">Before you can generate HTML code to put on your website, please <a href="<?php echo $BASE_URL ?>/setup/adddept.php">Create a Support Department</a>.</span>


		<?php elseif ( $totalusers <= 0 ): ?>
		<span class="hilight">Before you can generate HTML code to put on your website, please <a href="<?php echo $BASE_URL ?>/setup/adduser.php">Create an Operator</a>.</span>



		<?php else: ?>
		<ul>
			<?php
				$ok = 0 ;
				$output_string = "" ;
				for ( $c = 0; $c < count( $departments ); ++$c )
				{
					$department = $departments[$c] ;
					$dept_name = stripslashes( $department['name'] ) ;
					$totaluserdeptlist = AdminUsers_get_TotalUsersDeptList( $dbh, $session_setup['aspID'], $department['deptID'] ) ;
					if ( $totaluserdeptlist )
					{
						$ok = 1 ;
						if ( $department['visible'] )
							$output_string .= "<li> <a href=\"code.php?action=generate&deptid=$department[deptID]&\">$dept_name</a>\n" ;
						else
							$output_string .= "<li> $dept_name (<span class=\"hilight\">Hidden Department - code not available</span>)\n" ;
					}
					else
					{
						$output_string .= "<li> $dept_name (<span class=\"hilight\">Warning:</span> <a href=\"adduser.php\">assign operators</a>)\n" ;
					}
				}

				if ( !$ok )
					print "<span class=\"hilight\">You have not assigned an operator to a department.  Before you can generate the HTML code, please <a href=\"$BASE_URL/setup/adduser.php\">assign an operator to a department</a>.</span>" ;
				else
					print "<li> <a href=\"$BASE_URL/setup/code.php?action=generate&deptid=0\"><strong>Generate HTML to display ALL departments.</strong></a> <p><ul>Generate HTML for ONLY the specified department below. $output_string</ul>" ;
			?>
		  </ul>
		  <?php endif ; ?>
	</ul>
	
  <?php endif ;?>
  </td>
	<td style="background-image: url(../images/g_manage_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
</table>
<?php include_once( "./footer.php" ) ; ?>