<?php
	if($_SERVER['SERVER_NAME']=="localhost")
	{
		$class_path="/";
	}
	else
	{
		$class_path="/";
		//$class_path="/carrum/";
	}
	include_once $_SERVER['DOCUMENT_ROOT']."{$class_path}include/common.php";
	class Mail
	{
		private $connection;
		private $email_id;
		private $advertiser_id;
		private $email_from;
		private $email_to;
		private $subject;
		private $content;
		private $fileatt_path;
		private $fileatt_name;
		private $html;
		private $mail_header;
		private $show_unsubscribe_link;
		private $is_mail_sent;
		private $corresponding_message_id;

		public function __construct($message_id,$email_details_array,$connection,$attachments_array="")
		{
			$this->corresponding_message_id=$message_id;
			$this->connection = $connection;
			$this->email_from = $email_details_array['email_from'];
			$this->email_to = $email_details_array['email_to'];
			$this->subject = $email_details_array['subject'];
			$this->content = $email_details_array['content'];
			$this->show_unsubscribe_link=$email_details_array['show_unsubscribe_link'];

			/* Construct the email */
			$now = time();

			$mail_header .= "From: ".ucfirst(WEBSITE_URL)." <$this->email_from>" . PHP_EOL;
			$mail_header .= "Reply-To: " . $this->email_from . PHP_EOL;
			$mail_header .= "Return-Path: " . $this->email_from . PHP_EOL;	// these two to set reply address
			$mail_header .= "Message-ID: <" . $now . "TheSystem@" . $_SERVER['SERVER_NAME'] . ">" . PHP_EOL;
			$mail_header .= "X-Mailer: PHP v" . phpversion() . PHP_EOL;	// These two to help avoid spam-filters
			# Boundry for marking the split & Multitype Headers
			$semi_rand = md5($now);
			$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
			$mail_header .= "MIME-Version: 1.0" . PHP_EOL;

			if($attachments_array[0]=="")
			{
				$mail_header .= "Content-Type: multipart/alternative;" . PHP_EOL . "     boundary=\"" . $mime_boundary . "\"";
			}
			else
			{
				$mail_header .= "Content-Type: multipart/mixed;" . PHP_EOL . "     boundary=\"" . $mime_boundary . "\"";
			}

			$this->mail_header = $mail_header;

			# HTML Version
			$html_header = "--" . $mime_boundary . PHP_EOL;
			$html_header .= "Content-Type: text/html; charset=UTF-8" . PHP_EOL;
			$html_header .= "Content-Transfer-Encoding: 7bit";
			$html_header .= PHP_EOL . PHP_EOL;

			$html_body=$this->compile_content($this->content);

			# Attachment
			$attachment="";
			if($attachments_array[0]!="")
			{
				//$fileatt_type = mime_content_type($attachments_array[$i]['path']);
				//$fileatt_type  = "image/jpeg";
				$fileatt_type  = "application/pdf";

				for($i=0;$i<count($attachments_array);$i++)
				{
					$f = fopen($attachments_array[$i]['path'],"r");
					$data = fread($f, filesize($attachments_array[$i]['path']));
					$data = chunk_split(base64_encode($data));

					$attachment .= PHP_EOL . PHP_EOL;
					$attachment .= "--" . $mime_boundary . PHP_EOL;
					$attachment .= "Content-Type: {$fileatt_type};" . PHP_EOL . " name=\"{$attachments_array[$i]['filename']}\"" . PHP_EOL;
					$attachment .= "Content-Disposition: attachment;" . PHP_EOL . " filename=\"{$attachments_array[$i]['filename']}\"" . PHP_EOL;
					$attachment .= "Content-Transfer-Encoding: base64" . PHP_EOL . PHP_EOL;
					$attachment .= $data;
				}
			}
			else
			{
				$attachment = "";
			}

			# Finished
			$html_footer = PHP_EOL . PHP_EOL;
			$html_footer .= "--" . $mime_boundary . "--" . PHP_EOL . PHP_EOL;

			$this->html = $html_header . $html_body . $attachment . $html_footer;
		}

		public function __get($attr)
		{
			return $this->$attr;
		}

		public function __set($attr, $val)
		{
			$this->$attr=$val;
		}

		public function compile_content($is_admin_email)
		{
			if($this->show_unsubscribe_link)
			{
				$unsubscribe_from_emails="
					<tr>
						<td height='140' align='left' style='font-family:Calibri, Arial;font-size:11px;color:#bebebe'>
				            <p align='left'>
				            	*We hope this email is helpful. If you wish to unsubscribe from our correspondence, please <a style='color:#bebebe;text-decoration:underline' href='http://www.".WEBSITE_URL."/unsubscribe/$key'>click here</a><br />
				            </p>
						</td>
					</tr>
				";
			}
			else
			{
				$unsubscribe_from_emails="";
			}

			$email_open_key=$this->corresponding_message_id;
			$email_open_key=encrypt_decrypt("encrypt",$email_open_key);
			$email_open_key=strrev($email_open_key);

			if($is_admin_email||$this->advertiser_id==1)
			{
				$email_signature="
					<p style='color:#333333;font-family:Calibri,Arial,Helvetica,sans-serif;font-size:11pt;line-height:150%;margin-top:45px;margin-bottom:45px;text-align:left;'>
						Support team<br />
                        ".WEBSITE_SLOGAN."<br />
                        P : ".CONTACT_NUMBER."<br />
                        F : ".FAX_NUMBER."<br />
                        A : ".ADDRESS."<br />
                        <a href='mailto:".CONTACT_EMAIL."' style='font-weight:bold;color:#6CA437;text-decoration:none;'>".CONTACT_EMAIL."</a><br />
                        <a href='http://www.".WEBSITE_URL."' style='color:#6CA437;font-weight:bold;text-decoration:none;'>www.".WEBSITE_URL."</a>
					</p>
				";
			}
			else
			{

			}

			$email_content="
				<html>
					<body style='margin:0px;background-color:#ECECEC;'>
						<table cellpadding='0' cellspacing='0' border='0' bgcolor='gray' style='margin:0;margin-top:30px;padding:0;width:100%;line-height:100%;background-color:#ECECEC;'>
							<tr>
								<td align='center' valign='top'>
									<table width='700' cellpadding='0' cellspacing='0' border='0'>
										<tr bgcolor='#FFFFFF'>
											<td align='center' valign='top' bgcolor='#000000' style='font-family:Arial,Helvetica,sans-serif;font-size:10px;color:#bebebe;padding:7px 0;'>
												<a href='http://www.".WEBSITE_URL."' style='color:#bebebe;text-decoration:none;'>".WEBSITE_SLOGAN."</a>
											</td>
										</tr>

										<tr bgcolor='#FFFFFF'>
											<td align='center'>
												<table width='660' cellpadding='0' cellspacing='0' border='0'>
													<tr>
														<td valign='middle' width='660' style='color:#333333;padding-top:40px;line-height:150%;font-family:Arial,Helvetica,sans-serif;font-size:14px;'>
															$this->content
														</td>
													</tr>

												</table>
											</td>
										</tr>

										$unsubscribe_from_emails
									</table>
								</td>
							</tr>
						</table>
					</body>
				</html>
			";
			return $email_content;
		}

		public function send($is_admin_email=true)
		{
			if(mail($this->email_to, $this->subject, $this->html, $this->mail_header))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function is_mail_sent()
		{
			if($this->is_mail_sent)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
?>
