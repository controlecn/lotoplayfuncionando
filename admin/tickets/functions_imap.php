<?
/*
function prepareHTML($message) {

	$message = str_replace("\n", "<br />", $message);
	$message = "<p class=\"email_text\">$message</p>";
	return $message;

}
*/
function sendTicketEmail ($account_id, $to, $subject, $message) {

	$mail = new PHPMailer();
	$mail->CharSet = "UTF-8";

	$mail->IsSMTP();
	$mail->Host = GetRow("SELECT server FROM tickets_accounts WHERE id = $account_id");
	$mail->Port = GetRow("SELECT port FROM tickets_accounts WHERE id = $account_id");
	$mail->SMTPAuth = true;
	$mail->Username = GetRow("SELECT username FROM tickets_accounts WHERE id = $account_id");
	$mail->Password = GetRow("SELECT password FROM tickets_accounts WHERE id = $account_id");

	$mail->From = GetRow("SELECT from_email FROM tickets_accounts WHERE id = $account_id");
	$mail->FromName = GetRow("SELECT from_name FROM tickets_accounts WHERE id = $account_id");
	$mail->AddAddress($to);

	$mail->WordWrap = 50;
	$mail->IsHTML(true);

	$mail->Subject = $subject;
	
	$email_header = join("", file("../../templates/pt_br/email_support_header.txt"));
	$email_footer = join("", file("../../templates/pt_br/email_support_footer.txt"));
	
	$email_header = str_replace("%%URL%%", $config["static_url"], $email_header);
	
	$html_message = $email_header . prepareHTML($message) . $email_footer;

	$mail->Body    = $html_message;
	$mail->AltBody = $message;

	$mail->Send();

}

function getAttachText($content_id) {

	global $mysql_link;
	
	if (GetRow("SELECT COUNT(id) FROM tickets_attachments WHERE content_id = $content_id")!=0) {
		
		$attachArray = array();
		
		$result = mysql_query("SELECT id, filename FROM tickets_attachments WHERE content_id = $content_id", $mysql_link);

		if ($result) {

			while ($row = mysql_fetch_array($result)) {

				$id = $row["id"];
				$filename = $row["filename"];
				
				array_push($attachArray, "<a href=\"get_attach.php?id=$id\" class=\"link\" target=\"_blank\">$filename</a>");

			}

		mysql_free_result($result);

		}
		
		$attachText = "<b>ARQUIVOS:</b> " . join(",", $attachArray);
		
		
	} else {
		$attachText = "";
	}
	
	return $attachText;
}

function prepareContent($htmlcontent) {

	$htmlcontent = str_replace("<html>", "", $htmlcontent);
	$htmlcontent = str_replace("</html>", "", $htmlcontent);
	$htmlcontent = str_replace("<head>", "", $htmlcontent);
	$htmlcontent = str_replace("</head>", "", $htmlcontent);
	$htmlcontent = str_replace("</body>", "", $htmlcontent);
	
	return $htmlcontent;

}

function get_attach_type($filename) {

	$strFileType = strrev(substr(strrev($filename),0,4));
	
   	$ContentType = "application/octet-stream";
   
   	if ($strFileType == ".asf") 
   		$ContentType = "video/x-ms-asf";
   	if ($strFileType == ".avi")
   		$ContentType = "video/avi";
   	if ($strFileType == ".doc")
   		$ContentType = "application/msword";
   	if ($strFileType == ".zip")
   		$ContentType = "application/zip";
   	if ($strFileType == ".xls")
   		$ContentType = "application/vnd.ms-excel";
   	if ($strFileType == ".gif")
   		$ContentType = "image/gif";
   	if ($strFileType == ".jpg" || $strFileType == "jpeg")
   		$ContentType = "image/jpeg";
   	if ($strFileType == ".wav")
   		$ContentType = "audio/wav";
   	if ($strFileType == ".mp3")
   		$ContentType = "audio/mpeg3";
   	if ($strFileType == ".mpg" || $strFileType == "mpeg")
   		$ContentType = "video/mpeg";
   	if ($strFileType == ".rtf")
   		$ContentType = "application/rtf";
   	if ($strFileType == ".htm" || $strFileType == "html")
   		$ContentType = "text/html";
   	if ($strFileType == ".xml") 
   		$ContentType = "text/xml";
   	if ($strFileType == ".xsl") 
   		$ContentType = "text/xsl";
   	if ($strFileType == ".css") 
   		$ContentType = "text/css";
   	if ($strFileType == ".php") 
   		$ContentType = "text/php";
   	if ($strFileType == ".asp") 
   		$ContentType = "text/asp";
   	if ($strFileType == ".pdf")
   		$ContentType = "application/pdf";

	return $ContentType;


}

function get_mime_type(&$structure) {
	$primary_mime_type = array("TEXT", "MULTIPART","MESSAGE", "APPLICATION", "AUDIO","IMAGE", "VIDEO", "OTHER");
	
	if($structure->subtype) {
		return $primary_mime_type[(int) $structure->type] . '/' .$structure->subtype;
	}
		
	return "TEXT/PLAIN";
}

function get_part($stream, $msg_number, $mime_type, $structure = false,$part_number    = false) {
   
	if(!$structure) {
		$structure = imap_fetchstructure($stream, $msg_number);
	}
	
	if($structure) {
		if($mime_type == get_mime_type($structure)) {
			if(!$part_number) {
				$part_number = "1";
   			}
   			$text = imap_fetchbody($stream, $msg_number, $part_number);
   			if($structure->encoding == 3) {
   				return imap_base64($text);
   			} else if($structure->encoding == 4) {
   				return imap_qprint($text);
   			} else {
   			return $text;
   		}
   	}
   
		if($structure->type == 1) /* multipart */ {
   		while(list($index, $sub_structure) = each($structure->parts)) {
   			if($part_number) {
   				$prefix = $part_number . '.';
   			} else {
				$prefix = "";
			}
   			$data = get_part($stream, $msg_number, $mime_type, $sub_structure,$prefix .    ($index + 1));
   			if($data) {
   				return $data;
   			}
   		}
   		} 
   	} 
   	return false;
}
   
function transformHTML($str) {
	if ((strpos($str,"<HTML") < 0) || (strpos($str,"<html")    < 0)) {
  		$makeHeader = "<html><head><meta http-equiv=\"Content-Type\"    content=\"text/html; charset=utf-8\"></head>\n";
   	if ((strpos($str,"<BODY") < 0) || (strpos($str,"<body")    < 0)) {
   		$makeBody = "\n<body>\n";
   		$str = $makeHeader . $makeBody . $str ."\n</body></html>";
   	} else {
   		$str = $makeHeader . $str ."\n</html>";
   	}
   } else {
   	$str = "<meta http-equiv=\"Content-Type\" content=\"text/html;    charset=utf-8\">\n". $str;
   }
   	return $str;
}

function check_extension($filename) {

	$result = 0;

	$banned_extensions = array("ADE","ADP","BAS","BAT","CHM","CMD","COM","CPL","CRT","DLL","EXE","HLP","HTA","INF","INS","ISP","JS","JSE","LNK","MDB","MDE","MSC","MSI","MSP","MST","OCX","PCD","PIF","REG","SCR","SCT","SHB","SHS","SYS","URL","VB","VBE","VBS","WSC","WSF","WSH");
	
	for ($a=0; $a<count($banned_extensions); $a++) {
	
		$look_for = ".".strtolower($banned_extensions[$a]);
	
		if (substr_count(strtolower($filename), $look_for)!=0) {
			$result = 1;
		}
		
	}
	
	return $result;

}

function getEmails($id) {

	global $mysql_link;

	$sql = "SELECT * FROM tickets_accounts WHERE id = $id";

	$result = mysql_query($sql, $mysql_link);

	if ($result) {

		$row = mysql_fetch_array($result);
		
		$server = $row["server"];
		$port = $row["port"];
		$username = $row["username"];
		$password = $row["password"];
		$from_email = $row["from_email"];
		$from_name = $row["from_name"];

		mysql_free_result($result);

	}

	$mbox = imap_open("{".$server.":143/novalidate-cert}INBOX", $username, $password);

	$mail_qt = imap_num_msg($mbox);

	if ($mail_qt!=0) {
	
		for($i=1; $i<=$mail_qt; $i++) {
		
			$message_header = imap_headerinfo($mbox, $i);

			$message_id = ltrim($message_header->Msgno);
			$message_subject = addslashes(imap_utf8($message_header->subject));
			$message_from = addslashes($message_header->reply_to[0]->mailbox."@".$message_header->reply_to[0]->host);
			
			$user_id = 0;
			
			if (GetRow("SELECT COUNT(id) FROM users WHERE email = '$message_from'")!=0) {
				$user_id = GetRow("SELECT id FROM users WHERE email = '$message_from'");
			}

			$dataTxt = get_part($mbox, $message_id, "TEXT/PLAIN");
			$dataHtml = get_part($mbox, $message_id, "TEXT/HTML");
   
			if ($dataHtml != "") {
				$msgBody = transformHTML($dataHtml);
				$mailformat = "html";
			} else {
				$msgBody = ereg_replace("\n","<br>",$dataTxt);
				$msgBody = preg_replace("/([^\w\/])(www\.[a-z0-9\-]+\.[a-z0-9\-]+)/i","$1http://$2",    $msgBody);
				$msgBody = preg_replace("/([\w]+:\/\/[\w-?&;#~=\.\/\@]+[\w\/])/i","<A    TARGET=\"_blank\" HREF=\"$1\">$1</A>", $msgBody);
				$msgBody = preg_replace("/([\w-?&;#~=\.\/]+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,3}|[0-9]{1,3})(\]?))/i","<A    HREF=\"mailto:$1\">$1</A>",$msgBody);
				$mailformat = "text";
			}

			if ($mailformat == "text") {
				$message_body = "<html><head><title>Messagebody</title></head><body    bgcolor=\"white\">$msgBody</body></html>";
			} else {
				$message_body = $msgBody;
			}
			
			$message_body = strip_tags($message_body, "<p><br><hr><b><font><i><u>");
			$message_body = addslashes($message_body);
			$created = 0;
			
			if (GetRow("SELECT COUNT(id) FROM tickets WHERE userid = '$user_id' AND email = '$message_from' AND status = '1'")==0) {
				$ticket_id = SqlQuery("INSERT INTO tickets (account_id, subject, status, userid, email, ticket_type, ticket_date) VALUES ('$id', '$message_subject', '1', '$user_id', '$message_from', '1', NOW())");
				$created = 1;
			} else {
				$ticket_id = GetRow("SELECT id FROM tickets WHERE userid = '$user_id' AND email = '$message_from' AND status = '1'");
			}
			
			$content_id = SqlQuery("INSERT INTO tickets_contents (ticket_id, content_time, content_type, contents) VALUES ('$ticket_id', NOW(), '1', '".utf8_encode($message_body)."')");

			$struct = imap_fetchstructure($mbox,$message_id);
			$contentParts = count($struct->parts);

			if ($contentParts >= 2) {
				
				$att = array();
			   
				for ($a=2;$a<=$contentParts;$a++) {
					$structure = imap_bodystruct($mbox,$message_id,$a);
					
					if ($structure->ifdisposition!=0) {

						$filename = $structure->dparameters[0]->value;
						$content_type = get_attach_type($filename);
						
						if (check_extension($filename)==0) {
						
							if (substr($content_type,0,4) == "text") {
								$data = addslashes(imap_qprint(imap_fetchbody($mbox, $message_id, $a)));
							} else {
								$data = addslashes(imap_base64(imap_fetchbody($mbox, $message_id, $a)));
							}
						
							SqlQuery("INSERT INTO tickets_attachments (content_id, filename, content_type, filedata) VALUES ('$content_id', '$filename', '$content_type', '$data')");

						}

					}
					
				}
				

					
			}
			/*
			$subject = GetRow("SELECT nome FROM tickets_emails WHERE id = 1");
			$email_content = GetRow("SELECT email FROM tickets_emails WHERE id = 1");
			
			if ($created==1) {
				sendTicketEmail($id, $message_from, $subject, $email_content);
			}
			*/
			imap_delete($mbox, $message_id);
			
		}
	
	}
	
	imap_expunge($mbox);
	imap_close($mbox);

}

function checkMail() {

	global $mysql_link;

	$result = mysql_query("SELECT id FROM tickets_accounts ORDER BY id DESC", $mysql_link);

	if ($result) {

		while ($row = mysql_fetch_array($result)) {
			$id = $row["id"];
			getEmails($id);
		}

	mysql_free_result($result);

	}

}
	
?>