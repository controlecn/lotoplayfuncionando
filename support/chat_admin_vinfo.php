<?php
	session_start() ;
	$session_chat = $_SESSION['session_chat'] ;
	$sid = ( isset( $_GET['sid'] ) ) ? $_GET['sid'] : "" ;
	$action = ( isset( $_GET['action'] ) ) ? $_GET['action'] : "" ;
	$requestid = ( isset( $_GET['requestid'] ) ) ? $_GET['requestid'] : "" ;

	if ( !file_exists( "web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php" ) || !file_exists( "web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;
	$DOCUMENT_ROOT = realpath( preg_replace( "/http:/", "", $DOCUMENT_ROOT ) ) ;
	include_once("./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Util.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Logs/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Refer/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;

	// initialize
	$rating_hash = Array() ;
	$rating_hash[4] = "Excellent" ;
	$rating_hash[3] = "Very Good" ;
	$rating_hash[2] = "Good" ;
	$rating_hash[1] = "Needs Improvement" ;
	$rating_hash[0] = "&nbsp;" ;

	$m = date( "m",mktime() ) ;
	$y = date( "Y",mktime() ) ;
	$d = date( "j",mktime() ) ;

	// the timespan to get the stats
	$begin = mktime( 0,0,0,$m,$d,$y ) ;
	$end = mktime( 23,59,59,$m,$d,$y ) ;
	$requestinfo = ServiceChat_get_ChatRequestInfo( $dbh, $requestid ) ;
	$admin = AdminUsers_get_UserInfo( $dbh, $session_chat[$sid]['admin_id'], $session_chat[$sid]['aspID'] ) ;

	// conditions
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Chat [admin view info]</title>

<link href="themes/<?php echo ( $_SESSION['session_chat'][$sid]['isadmin'] && $_SESSION['session_chat'][$sid]['theme'] ) ? $_SESSION['session_chat'][$sid]['theme'] : $THEME ?>/style.css" rel="stylesheet" type="text/css" />

</head>
<body class="operatorbody">

<?php if ( $_SESSION['session_chat'][$sid]['chatfile_get'] == "" ): ?>
<big><b>Este sessão expirou.</b></big>



<?php
	elseif ( ( $action == "compras" )):
?>
<iframe src ="http://reidobingo-net.umbler.net/admin_mais_complicado/payments/transfers_buy2.php" width="95%" height="180" frameborder="0"></iframe>


<?php
	elseif ( $action == "transcripts" ):
	include_once("$DOCUMENT_ROOT/API/Transcripts/get.php") ;
	$transcripts = ServiceTranscripts_get_TranscriptsByIP( $dbh, $requestinfo['ip_address'], $session_chat[$sid]['aspID'] ) ;
?>
<table cellspacing="1">
	<thead>
		<tr>
		<th colspan="5">Conversas do usuário: <?php echo $requestinfo['ip_address'] ?></th>
		</tr>
	</thead>
	<tbody class="subhead">
		<tr>
			<th>Data / Hora</td>
			<th>Duração</td>
		</tr>
	</tbody>
	<tbody>
	<?php
		for ( $c = 0; $c < count( $transcripts );++$c )
		{
			$transcript = $transcripts[$c] ;

			$rating = ( isset( $transcript['rating'] ) ) ? $transcript['rating'] : 0 ;
			$rating = $rating_hash[$rating] ;

			$duration = $transcript['created'] - $transcript['chat_session'] ;
			if ( $duration <= 0 ) { $duration = 1 ; }
			if ( $duration > 60 )
				$duration = round( $duration/60 ) . " min" ;
			else
				$duration = $duration . " sec" ;

			$class = "class=\"row1\"" ;
			if ( $c % 2 )
				$class = "class=\"row2\"" ;

			$date = date( "d/m/Y H:i", ( $transcript['created'] + $TIMEZONE ) ) ;
			$size = Util_Format_Bytes( strlen( strip_tags( $transcript['plain'] ) ) ) ;
			print "<tr $class><td>&raquo; <a href=\"javascript:void(0)\" OnClick=\"window.open('admin/view_transcript.php?x=".$session_chat[$sid]['aspID']."&l=".$session_chat[$sid]['asp_login']."&chat_session=$transcript[chat_session]&sid=$sid&requestid=$requestid&action=view&theme_admin=".$session_chat[$sid]['theme']."', '$transcript[created]', 'status=no,scrollbars=no,menubar=no,toolbar=no,resizable=yes,location=no,width=450,height=360')\">$date</a></td><td>$duration</td></tr>\n" ;
		}
	?>
	</tbody>
</table>






<?php elseif ( $action == "creditos" ): ?>
<iframe src ="http://reidobingo-net.umbler.net/admin_mais_complicado/chat/creditos.php?username=<?php echo strip_tags($requestinfo['from_screen_name']) ?>&email=<?php echo strip_tags($requestinfo['email']) ?>" width="95%" height="180" frameborder="0"></iframe>
<?php elseif ( $action == "saques" ): ?>
<iframe src ="http://reidobingo-net.umbler.net/admin_mais_complicado/payments/payout2.php" width="95%" height="180" frameborder="0"></iframe>
<?php elseif ( $action == "alerts" ): ?>
<iframe src ="http://reidobingo-net.umbler.net/admin_mais_complicado/chat/alerts.php?username=<?php echo strip_tags($requestinfo['from_screen_name']) ?>&email=<?php echo strip_tags($requestinfo['email']) ?>" width="95%" height="180" frameborder="0"></iframe>
<?php elseif ( $action == "comments" ): ?>
<iframe src ="http://reidobingo-net.umbler.net/admin_mais_complicado/chat/comments.php?username=<?php echo strip_tags($requestinfo['from_screen_name']) ?>&email=<?php echo strip_tags($requestinfo['email']) ?>" width="95%" height="180" frameborder="0"></iframe>
<?php else: ?>
<iframe src ="http://reidobingo-net.umbler.net/admin_mais_complicado/chat/userinfo.php?username=<?php echo strip_tags($requestinfo['from_screen_name']) ?>&email=<?php echo strip_tags($requestinfo['email']) ?>" width="95%" height="180" frameborder="0"></iframe>
<?php endif ; ?>
</body>
</html>
<?php
//	mysql_close( $dbh['con'] ) ;
?>