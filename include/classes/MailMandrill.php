<?php	
	if($_SERVER['SERVER_NAME']=="localhost")
	{
		$class_path="/ChelseaHeightsKinder/";
	}
	else
	{
		$class_path="/";
		//$class_path="/carrum/";
	}
	include_once $_SERVER['DOCUMENT_ROOT']."{$class_path}include/common.php";
	include_once $_SERVER['DOCUMENT_ROOT']."{$class_path}include/functions.php";
	include_once $_SERVER['DOCUMENT_ROOT']."{$class_path}include/classes/SQL.php";

	include_once $_SERVER['DOCUMENT_ROOT']."{$class_path}include/mandrillapp/vendor/mandrill/mandrill/src/Mandrill.php"; //Not required with Composer
	
	class MailMandrill
	{
		private $connection;
		private $user_id;
		private $email_from;
		private $from_name;
		private $email_to;
		private $email_to_name;
		private $subject;
		private $content;
		private $is_admin_email;
		private $email_title;
		private $fileatt_path;
		private $fileatt_name;
		private $message_id;
		private $signature;
		private $html;
		private $mail_header;
		private $show_unsubscribe_link;
		private $is_mail_sent;
		private $email_signature;
		private $attachments_array;
		
		private $template;
		private $call_to_action_button;
		
		//these are for bulk emails
		private $is_full_header_image;
		private $is_bulk;
		private $bulk_email_campaign_id;
		private $unsubscribe_key;
		
		private $mandrill;
		private $tracking_link;

		public function __construct($array,$connection,$attachments_array="")
		{
			$this->connection = $connection;
			$this->mandrill = new Mandrill(MANDRILL_API_KEY);
	
			$this->call_to_action_button=$array['call_to_action_button'];
			
			$this->is_full_header_image=$array['is_full_header_image'];
			$this->is_bulk=$array['is_bulk'];
			if($this->is_bulk=="")
			{
				$this->is_bulk="no";
			}
			$this->bulk_email_campaign_id=$array['bulk_email_campaign_id'];
			$this->user_id=$array['user_id'];
			
			$this->email_from = trim($array['email_from']);
			$this->from_name=trim($array['from_name']);
			
			$this->email_to = trim($array['email_to']);
			$this->email_title=$array['email_title'];
			$this->subject = trim($array['subject']);
			$this->content = trim($array['content']);
			
			$this->show_unsubscribe_link=$array['show_unsubscribe_link'];
			$this->is_admin_email=$array['is_admin_email'];	
			$this->message_id=$array['message_id'];
			
			$this->fileatt_path=$array['fileatt_path'];
			$this->fileatt_name=$array['fileatt_name'];		
			$this->attachments_array=$attachments_array;
			
			//unique open/unsubscribe key
			if($this->is_bulk=="yes")
			{
				$email_open_key="yes{}".$this->user_id."{}".$this->bulk_email_campaign_id;
			}
			else
			{
				$email_open_key="no{}".$this->message_id;
			}
			$email_open_key=encrypt($email_open_key,EMAIL_OPEN_KEY);
			$email_open_key=strrev($email_open_key);
			$this->tracking_link="<img src='http://www.BigDogg.com.au/email-open.php?key=$email_open_key' width='1' height='1' />";
			
			//Signature
			if($this->is_admin_email)
			{
				$this->signature="
					<p style='font-family:Calibri, Arial;font-size:11pt;line-height:150%;margin-top:45px;margin-bottom:45px;'>
						Team @ BigDogg
					</p>
				";
			}
			else
			{
				$this->signature="
					<p style='font-family:Calibri, Arial;font-size:11pt;line-height:150%;margin-top:45px;margin-bottom:45px;'>
						Thank you<br />
						Steve McConchie
					</p>
				";
			}
		
			//unsubscriber link at the bottom	
			if($this->show_unsubscribe_link)
			{
				$this->show_unsubscribe_link="
					<p style='font-family:Calibri, Arial,Helvetica,sans-serif;color:#797C80'>
		            	*We hope this email is helpful. If you wish to unsubscribe from our correspondence, please <a style='color:#797C80;text-decoration:underline;' href='http://www.BigDogg.com.au/unsubscribe.php?key=$email_open_key'>click here</a>												
		            </p>
				";
			}
			else
			{
				$this->show_unsubscribe_link="";	
			}
			
			if(!isset($array['template']))
			{
				$this->template="BigDogg";
			}
			else
			{
				$this->template=$array['template'];		
			}
		}		
	
		public function __get($attr)
		{
			return $this->$attr;
		}

		public function __set($attr, $val)
		{
			$this->$attr=$val;
		}
		
		public function send()
		{
			if($_SERVER['HTTP_HOST']!="localhost")
			{
				$message = array
				(
				    'subject' => $this->subject,
				    'from_email' => $this->email_from,
					'from_name'=>$this->from_name,
				    'html' => $this->content,
				    'to' => array(array('email' => $this->email_to, 'name' => $this->email_to_name)),
					'headers' => array('From'=>'BigDogg','Reply-To' => $this->email_from)
				);
				
				$template_name = $this->template;
				
				$template_content = array
				(
					array
					(
						'name'=>'email_title',
						'content'=>$this->email_title
					),
				    array
				    (
				        'name' => 'email_content',
				        'content' => $this->content
				   	),
				    array
				    (
				        'name' => 'signature',
				        'content' => $this->signature
				   	),
				   	array
				   	(
				   		'name'=>'unsubscribe_link',
				   		'content'=>$this->show_unsubscribe_link
				   	),
				   	array
				   	(
				   		'name'=>'tracking_link',
				   		'content'=>$this->tracking_link
				   	),
				   	array
				   	(
				   		'name'=>'call_to_action_button',
				   		'content'=>$this->call_to_action_button
				   	)
				);
				
				//<div mc:edit="main"> </div> <div mc:edit="footer"> </div>
			
				$result=$this->mandrill->messages->sendTemplate($template_name, $template_content, $message);
		    	//$result = $mandrill->messages->send($message, $async, $ip_pool);//, $send_at);
	
				print_r_html($result);
				
				if($result[0]['status']=="sent")
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
	}
?>
