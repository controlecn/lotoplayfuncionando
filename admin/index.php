<?

include('include_functions.php');

if (!$_COOKIE["session_admin"]) {
	$session_id = md5(generate_password(30));
	SqlQuery("INSERT INTO sessions_admin (created, sessionkey, username) VALUES (NOW(), '$session_id', '$logged_user')");
	setcookie("session_admin", $session_id, time()+86400);
}

?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Clone LotoPlay</title>
</head>

<frameset cols="981,*" frameborder="no" border="0" framespacing="0">
    <frameset rows="87,*" frameborder="no" border="0" framespacing="0">
      <frameset cols="*" frameborder="no" border="0" framespacing="0">
      <frame src="top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
      </frameset>
    	<frameset cols="*" frameborder="no" border="0" framespacing="0">
      <frameset cols="188,*" frameborder="no" border="0" framespacing="0">
        <frame src="left_payments.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
        <frame src="payments/transfers_buy.php" name="mainFrame" id="mainFrame" title="mainFrame" />
      </frameset>
    	</frameset>
    </frameset>
    <frame src="right.php" name="rightFrame" scrolling="No" noresize="noresize" id="rightFrame" title="rightFrame" />
</frameset>
<noframes><body>
</body>
</noframes></html>