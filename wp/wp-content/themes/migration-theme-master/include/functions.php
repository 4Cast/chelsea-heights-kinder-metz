<?php
	if($_SERVER['SERVER_NAME']=="localhost")
	{
		$class_path="/ChelseaHeightsKinder/";
	}
	else
	{
		$class_path="";
		$class_path="/";
		//$class_path="/carrum/";
	}

	$class_path="/";	
	include_once $_SERVER['DOCUMENT_ROOT']."{$class_path}include/common.php";

	/*function get_facebook_details($url)
	{
		$json_string = file_get_contents('http://graph.facebook.com/?ids=' . $url);
		$json = json_decode($json_string, true);
		return $json;
	}*/

	function is_array_empty($a)
	{
		foreach($a as $elm)
		{
			if(!empty($elm))
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}

	function print_debug($array)
	{
		if(get_ip()==HOME_IP_ADDRESS)
		{
			print_r_html($array);
		}
	}

	function get_my_current_lat_long()
	{
		$temp=@json_decode(@file_get_contents('http://freegeoip.net/json/'.get_ip()));
		$my_current_location=array();
		$my_current_location[0]=-37.9734452;//$temp['latitude'];
		$my_current_location[1]=145.0649953;//$temp['longitude'];
		return $my_current_location;
	}

	function getLatLong($address)
	{
		$address = str_replace(' ', '+', $address);
		$url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false';

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$geoloc = curl_exec($ch);

		$json = json_decode($geoloc);
		return array($json->results[0]->geometry->location->lat, $json->results[0]->geometry->location->lng);
	}

	function Haversine($start, $finish)
	{
		$theta = $start[1] - $finish[1];
		$distance = (sin(deg2rad($start[0])) * sin(deg2rad($finish[0]))) + (cos(deg2rad($start[0])) * cos(deg2rad($finish[0])) * cos(deg2rad($theta)));
		$distance = acos($distance);
		$distance = rad2deg($distance);
		$distance = $distance * 60 * 1.1515;//miles
		$distance = $distance*1.609344;
		return round($distance, 1);
	}

	function fetch_state($state_id)
	{
		$state="";
		switch($state_id)
		{
			case "1":$state='vic';break;
			case "2":$state='nsw';break;
			case "3":$state='qld';break;
			case "4":$state='sa';break;
			case "5":$state='wa';break;
			case "6":$state='tas';break;
			case "7":$state='nt';break;
			case "8":$state='act';break;
		}
		return strtoupper($state);
	}

	function current_page_URL()//i.e.http://localhost/drk/misc/secure-ajax/
	{
		$pageURL='http';
		if($_SERVER["HTTPS"]=="on")
		{
			$pageURL .= "s";
		}
		$pageURL .= "://";
		/*if($_SERVER["SERVER_PORT"]!="80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}*/
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		return $pageURL;
	}

	function how_many_days($CheckIn,$CheckOut)
	{
		$CheckInX = explode("-", $CheckIn);
		$CheckOutX =  explode("-", $CheckOut);
		$date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[2],$CheckInX[0]);
		$date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[2],$CheckOutX[0]);
		 $interval =($date2 - $date1)/(3600*24);

		// returns numberofdays
		return  intval($interval);
	}

	function dateTimeDiff($date1,$date2)
	{
		$alt_diff = new stdClass();
		$alt_diff->y =  floor(abs($date1->format('U') - $date2->format('U')) / (60*60*24*365));
		$alt_diff->m =  floor((floor(abs($date1->format('U') - $date2->format('U')) / (60*60*24)) - ($alt_diff->y * 365))/30);
		$alt_diff->d =  floor(floor(abs($date1->format('U') - $date2->format('U')) / (60*60*24)) - ($alt_diff->y * 365) - ($alt_diff->m * 30));
		$alt_diff->h =  floor( floor(abs($date1->format('U') - $date2->format('U')) / (60*60)) - ($alt_diff->y * 365*24) - ($alt_diff->m * 30 * 24 )  - ($alt_diff->d * 24) );
		$alt_diff->i = floor( floor(abs($date1->format('U') - $date2->format('U')) / (60)) - ($alt_diff->y * 365*24*60) - ($alt_diff->m * 30 * 24 *60)  - ($alt_diff->d * 24 * 60) -  ($alt_diff->h * 60) );
		$alt_diff->s =  floor( floor(abs($date1->format('U') - $date2->format('U'))) - ($alt_diff->y * 365*24*60*60) - ($alt_diff->m * 30 * 24 *60*60)  - ($alt_diff->d * 24 * 60*60) -  ($alt_diff->h * 60*60) -  ($alt_diff->i * 60) );
		$alt_diff->invert =  (($date1->format('U') - $date2->format('U')) > 0)? 0 : 1 ;

		return $alt_diff;
	}

	function decrypt_ajax_value($post_value)
	{
		$post_value=utf8_encode(rc4(AJAX_ENCRYPTION_KEY,$post_value));
		$post_value=explode("{&&}",$post_value);
		return $post_value;
	}

	function encrypt_decrypt($action, $string)
	{
		$output = false;

		$key = ENCRYPTION_KEY;

		// initialization vector
		$iv = md5(md5($key));

		if( $action == 'encrypt' )
		{
			$output = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' )
		{
			$output = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, $iv);
			$output = rtrim($output, "");
		}
		return $output;
	}

	function current_URL()
	{
		$pageURL = 'http';
		if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80")
		{
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		}
		else
		{
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}

	function find_operating_system($useragent="")
	{
		if($useragent=="")
		{
			$useragent=$_SERVER['HTTP_USER_AGENT'];
		}
		$OSList=array
		(
			// Match user agent string with operating systems
			/*'Windows 3.11' => 'Win16',
			'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
			'Windows 98' => '(Windows 98)|(Win98)',
			'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
			'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
			'Windows Server 2003' => '(Windows NT 5.2)',
			'Windows Vista' => '(Windows NT 6.0)',
			'Windows 7' => '(Windows NT 7.0)',
			'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
			'Windows ME' => 'Windows ME',
			'Open BSD' => 'OpenBSD',
			'Sun OS' => 'SunOS',
			'Linux' => '(Linux)|(X11)',
			'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
			'QNX' => 'QNX',
			'BeOS' => 'BeOS',
			'OS/2' => 'OS/2',
			'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'*/

			'Windows 3.11' => 'Win16',
			'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
			'Windows ME' => '(Windows 98)|(Win 9x 4.90)|(Windows ME)',
			'Windows 98' => '(Windows 98)|(Win98)',
			'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
			'WinXP' => '(Windows NT 5.1)|(Windows XP)',
			'WinServer2003' => '(Windows NT 5.2)',
			'Windows Vista' => '(Windows NT 6.0)',
			'Windows 7' => '(Windows NT 6.1)',
			'Windows 8' => '(Windows NT 6.2)',
			'Windows NT' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
			'Open BSD' => 'OpenBSD',
			'Sun OS' => 'SunOS',
			'Ubuntu' => 'Ubuntu',
			'Android' => 'Android',
			'Linux' => '(Linux)|(X11)',
			'iPhone' => 'iPhone',
			'iPad' => 'iPad',
			'MacOS' => '(Mac_PowerPC)|(Macintosh)',
			'QNX' => 'QNX',
			'BeOS' => 'BeOS',
			'OS2' => 'OS/2',
			'CFNetwork'=>'iPhone',
			'SearchBot' => '(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
		);

		// Loop through the array of user agents and matching operating systems
		foreach($OSList as $CurrOS=>$Match)
		{
			// Find a match
			if(@eregi($Match,$useragent))
			{
				// We found the correct match
				return $CurrOS;
			}
		}

		if(!stristr($useragent,'CFNetwork')===FALSE)
		{
			return 'iPhone';
		}

	}

	function find_device_type($useragent="",$browser_type="")
	{
		/*if($browser_type=="web"||$browser_type=="mobile")
		{
			if($useragent=="")
			{
				$useragent=$_SERVER['HTTP_USER_AGENT'];
			}
		}
		else
		{
			$useragent=$browser_type;//either android or iphone
		}*/
		$useragent=strtolower($useragent);
		if(preg_match("|iphone|",$useragent,$matched))
		{
			$device='iPhone';
		}
		elseif(preg_match("|ipad|",$useragent,$matched))
		{
			$device='iPad';
		}
		elseif(preg_match("|ipod|",$useragent,$matched))
		{
			$device='iPod';
		}
		elseif(preg_match("|android|",$useragent,$matched))
		{
			$device='Android';
		}
		elseif(preg_match("|nokia|",$useragent,$matched))
		{
			$device='Nokia';
		}
		elseif(preg_match("|motorola|",$useragent,$matched))
		{
			$device='Motorola';
		}
		elseif(preg_match("|blackberry|",$useragent,$matched))
		{
			$device='Blackberry';
		}
		elseif(preg_match("|windows phone|",$useragent,$matched)&&preg_match("|iemobile|",$useragent,$matched))
		{
			$device='Windown Phone';
		}
		elseif(preg_match("|macintosh|",$useragent,$matched)&&preg_match("|mac os|",$useragent,$matched))
		{
			$device='Apple Mac';
		}
		else
		{
			$device="PC";
		}
		return $device;
	}

	function generate_invoice_html($invoice_data_array,$image_url="",$type="normal")
	{
		//print_r_html($invoice_data_array);exit;

		if($invoice_data_array['show_logo'])
		{
			if($_SERVER['SERVER_NAME']=="localhost")
			{
				$img_path="/sub/";
				$logo="<p align='center' style='margin:0px;'><img src='{$img_path}images/invoice-header.png' style='width:100%;' /></p>";
			}
			else
			{
				$img_path="/";

				if($image_url=="")
				{
					$image_url=$_SERVER['DOCUMENT_ROOT'];
				}
				$logo="<p align='center' style='margin:0px;'><img src='".$image_url."{$img_path}images/invoice-header.png' style='width:100%;' /></p>";
			}

		}
		else
		{
			$logo="<p style='height:115px;'></p>";
		}

		if($_SERVER['SERVER_NAME']=="localhost")
		{
			$img_path="/sub/";
		}
		else
		{
			$img_path="/";
		}

		if($image_url=="")
		{
			$image_url=$_SERVER['DOCUMENT_ROOT'];
		}

		if($invoice_data_array['show_logo'])
		{
			$logo="<p align='center' style='margin:0px;'><img src='".$image_url."{$img_path}images/invoice-header.png' style='width:100%;' /></p>";
		}
		else
		{
			$logo="<p style='height:115px;'></p>";
		}
		if($type=="normal")
		{
			$font_size="12px;";
		}
		else
		{
			$font_size="11px;";
		}
		$html="
			<style type='text/css' media='print'>
				@page
				{
					size: auto;   /* auto is the initial value */
					margin: 0mm;  /* this affects the margin in the printer settings */
				}
			</style>
			<html style='margin:0px;background-color:#fff;'>
				<body style='margin:0px;padding:15px;background-color:#fff;'>
					$logo
					<table style='margin-bottom:10px;width:100%;'>
						<colgroup>
							<col style='width:45%;'>
							<col style='width:10%;'>
							<col style='width:45%;'>
						</colgroup>
						<tr>
							<td valign='top'>
								<table style='width:100%;'>
									<tr style='background-color:#D9D9D9;'>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;font-weight:bold;'>".BUSINESS_NAME."</td>
									</tr>
									<tr>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:12px;'>
											<p style='font-family:Arial,Helvetica,sans-serif;font-size:12px;'>
												".BUSINESS_NAME."<br />
												ABN ".ABN."
											</p>

											<p style='font-family:Arial,Helvetica,sans-serif;font-size:12px;'>
												".ADDRESS."
											</p>

											<p style='font-family:Arial,Helvetica,sans-serif;font-size:12px;'>
												P : ".PHONE_NUMBER."<br />
												F : ".FAX_NUMBER."<br />
												E : invoices@".WEBSITE_URL."<br />
												W : ".FULL_WEBSITE_URL."
											</p>
										</td>
									</tr>
								</table>
							</td>
							<td></td>
							<td valign='top'>
								<table style='width:100%;'>
									<tr style='background-color:#D9D9D9;'>
										<td colspan='2' style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;font-weight:bold;'>BILL TO</td>
									</tr>
									<tr>
										<td colspan='2' style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>$invoice_data_array[bill_to]</td>
									</tr>
									<tr style='background-color:#D9D9D9;'>
										<td colspan='2' style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;font-weight:bold;'>TAX INVOICE</td>
									</tr>
									<tr>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>Invoice Number</td>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>$invoice_data_array[reference_number]</td>
									</tr>
									<tr>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>Invoice Date</td>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>".date("d-M-Y",strtotime($invoice_data_array['invoice_date']))."</td>
									</tr>
									<tr>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>Invoice Due Date</td>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>".date("d-M-Y",strtotime($invoice_data_array['invoice_due_date']))."</td>
									</tr>
									<tr>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>Order taken by</td>
										<td style='border:1px solid #114269;padding:5px;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>".$invoice_data_array['order_taken_by']."</td>
									</tr>
								</table>
							</td>
						</tr>
					</table>

					<table style='padding:5px;width:100%;'>
						<colgroup>
							<col width='85%'>
							<col width='15%'>
						</colgroup>

						<tr style='background-color:#D9D9D9;'>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;font-weight:bold;'>Description</td>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;font-weight:bold;text-align:right;'>Amount</td>
						</tr>
					";
					$total=0;
					$total_vat=0;
					foreach($invoice_data_array['description'] as $description)
					{
						$vat_amount=$description['net_amount']*GST_PERCENTAGE;

						$html.="
							<tr>
								<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>$description[title]</td>
								<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;text-align:right;'>$".number_format($description['net_amount'],2)."</td>
							</tr>
						";
						if($description['type']=="debit")
						{
							$total=$total+$description['net_amount'];
							$total_vat=$total_vat+$vat_amount;
						}
						else if($description['type']=="credit")
						{
							$total=$total-$description['net_amount'];
						}
					}

					$html.="
						<tr>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;font-weight:bold;text-align:right;'>TOTAL</td>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;text-align:right;'>$".number_format($total,2)."</td>
						</tr>
					";
					$total=round($total,2);

					$html.="
						<tr>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:bold;text-align:right;color:red;'>INVOICE TOTAL</td>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:bold;text-align:right;color:red;'>$".number_format($total,2)."</td>
						</tr>
					";

					/*$html.="
						<tr>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:bold;text-align:right;color:#2CA03C;' colspan='2'>Amount Paid to date</td>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:bold;text-align:right;color:#2CA03C;'>$".number_format($invoice_data_array['amount_paid_to_date'],2)."</td>
						</tr>
					";*/
					//print_r_html($invoice_data_array);exit;

					$amount_due=$total-$invoice_data_array['amount_paid_to_date'];

					$html.="
						<tr>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:bold;text-align:right;color:red;'>AMOUNT DUE</td>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:14px;font-weight:bold;text-align:right;color:red;'>$".number_format($amount_due,2)."</td>
						</tr>
					";

					$html.="
						$invoice_paid_due_amount
					</table>

					<p style='margin:5px;font-family:Arial,Helvetica,sans-serif;font-size:11px;'>All pricing is displayed and charged in Australian Dollars (AUD).</p>

					<table style='padding:5px;width:500px;'>
						<tr style='background-color:#D9D9D9;'>
							<td style='padding:5px;border:1px solid #114269;font-family:Arial,Helvetica,sans-serif;font-size:$font_size;font-weight:bold;'>PAYMENTS</td>
						</tr>
						<tr>
							<td style='padding:5px;border:1px solid #114269;'>
								<p style='font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>
									<strong>Payment option 1:</strong> Online Credit Card / Debit Card Payments<br />
									<a href='http://www.".WEBSITE_URL."/invoice/$invoice_data_array[invoice_id]'>Click here to pay online via PayPal</a><sup>TM</sup><br />

									<span style='font-size:10px;color:red;'>* A credit card processing fee of 2% of the total amount will apply to all online credit/debit card payments</span>

								<p style='font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>
									<strong>Payment option 2:</strong> Cheque or Direct Deposit / EFT<br />

									All accounts payable to <strong>".BANK_ACCOUNT_NAME."</strong>, Payable by cheque or direct deposit / EFT to
								</p>
								<p style='font-family:Arial,Helvetica,sans-serif;font-size:$font_size;'>
									<strong>Bank Name :</strong> ".BANK_NAME."<br />
									<strong>Account Name :</strong> ".BANK_ACCOUNT_NAME."<br />
									<strong>BSB number :</strong> ".BSB_NUMBER."<br />
									<strong>Account number :</strong> ".ACCOUNT_NUMBER."
									<br />
									Remittance advice can be posted to <strong>".BANK_ACCOUNT_NAME."</strong>
								</p>
							</td>
						</tr>
					</table>
				</body>
			</html>
		";
		//echo $html;exit;
		if($invoice_data_array['is_pay_invoice'])
		{
			//echo $amount_due;exit;
			return $amount_due;
		}
		else
		{
			//echo $html;exit;
			return $html;
		}
	}

	function is_from_apple_device()
	{
		return preg_match("/ipad|iphone|ipod/", strtolower($_SERVER['HTTP_USER_AGENT']));
	}

	function remove_element_by_value($arr, $val)
	{
		$return=array();
		foreach($arr as $k => $v)
		{
			if(is_array($v))
			{
				$return[$k]=remove_element_by_value($v, $val); //recursion
				continue;
			}
			if($v == $val)
			{
				continue;
			}
			$return[$k]=$v;
		}
		return $return;
	}

	function in_multiarray($needle, $haystack, $strict=false)
	{
		foreach ($haystack as $item)
		{
			if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_multiarray($needle, $item, $strict)))
			{
				return true;
			}
		}

		return false;
	}
	function objectToArray($d)
	{
		if (is_object($d))
		{
			// Gets the properties of the given object
			// with get_object_vars function
			$d=get_object_vars($d);
		}

		if (is_array($d))
		{
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else
		{
			// Return array
			return $d;
		}
	}

	function get_created_date($start)
	{
		/*
		$timespan=strtotime(gmdate("Y-m-d H:i:s"))-strtotime($date);
		//$timespan=strtotime($date);

		// check timespan
		if ($timespan/604800 >= 1)
		{
			// weeks
			$time=intval($timespan/604800)." week".(intval($timespan/604800)>1?"s":"")." ago";
		}
		elseif ($timespan/86400 >= 1)
		{
			//days
			$time=intval($timespan/86400)." day".(intval($timespan/86400)>1?"s":"")." ago";
		}
		elseif ($timespan/3600 >= 1)
		{
			//hours
		   $time=intval($timespan/3600)." hour".(intval($timespan/3600)>1?"s":"")." ago";
		}
		elseif ($timespan/60 >= 1)
		{
			//minutes
			$time=intval($timespan/60)." minute".(intval($timespan/60)>1?"s":"")." ago";
		}
		elseif ($timespan >= 30)
		{
			//days
			$time=intval($timespan/1)." seconds ago";
		}
		elseif ($timespan >= 15)
		{
			//days
			$time="just moments ago";
		}
		else
		{
			$time="just moments ago";
		}
		*/
		date_default_timezone_set("Australia/Melbourne");
		$now=date("Y-m-d H:i:s");

		//$timespan=strtotime(gmdate("Y-m-d H:i:s")) - strtotime($start);
		$timespan=strtotime($now) - strtotime($start);
		if ($timespan / 604800 >= 1)
		{
			$time=intval($timespan / 604800) . " week" . (intval($timespan / 604800) > 1 ? "s" : "") . " ago";
		}
		elseif ($timespan / 86400 >= 1)
		{
			$time=intval($timespan / 86400);
			if($time>1)
			{
				$time="$time days ago";
			}
			else
			{
				$time="yesterday";
			}
			//$time=intval($timespan / 86400) . " day" . (intval($timespan / 86400) > 1 ? "s" : "") . " ago";
		}
		elseif ($timespan / 3600 >= 1)
		{
			$time=intval($timespan / 3600) . " hour" . (intval($timespan / 3600) > 1 ? "s" : "") . " ago";
		}
		elseif ($timespan / 60 >= 1)
		{
			$time=intval($timespan / 60) . " minute" . (intval($timespan / 60) > 1 ? "s" : "") . " ago";
		}
		elseif ($timespan >= 30)
		{
			$time=intval($timespan / 1) . " seconds ago";
		}
		elseif ($timespan >= 15)
		{
			$time="Just moments ago";
		}
		else
		{
			$time="Just now";
		}

		return $time;
	}

	function get_due_date($start)
	{
		date_default_timezone_set("Australia/Melbourne");
		$now=date("Y-m-d H:i:s");

		$timespan=strtotime($start)-strtotime($now);
		if ($timespan / 604800 >= 1)
		{
			$time="in ".intval($timespan / 604800) . " week" . (intval($timespan / 604800) > 1 ? "s" : "");
		}
		elseif ($timespan / 86400 >= 1)
		{
			$time=intval($timespan / 86400);
			if($time>1)
			{
				$time="in $time days";
			}
			else
			{
				$time="tomorrow";
			}
			//$time=intval($timespan / 86400) . " day" . (intval($timespan / 86400) > 1 ? "s" : "") . " ago";
		}
		elseif ($timespan / 3600 >= 1)
		{
			$time=" in " .intval($timespan / 3600)." hour".(intval($timespan / 3600) > 1 ? "s" : "");
		}
		elseif ($timespan / 60 >= 1)
		{
			$time=" in ".intval($timespan / 60) . " minute". (intval($timespan / 60) > 1 ? "s" : "");
		}
		elseif ($timespan >= 30)
		{
			$time="in ".intval($timespan / 1) . " seconds ";
		}
		elseif ($timespan >= 15)
		{
			$time="Today";
		}
		else
		{
			$time="Today";
		}

		return $time;
	}

	// Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }

    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }

    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();

    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Set default diff to 0
      $diffs[$interval] = 0;
      // Create temp time from time1 and interval
      $ttime = strtotime("+1 " . $interval, $time1);
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
	$time1 = $ttime;
	$diffs[$interval]++;
	// Create new temp time from time1 and interval
	$ttime = strtotime("+1 " . $interval, $time1);
      }
    }

    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
	break;
      }
      // Add value and interval
      // if value is bigger than 0
      if ($value > 0) {
	// Add s if value is not 1
	if ($value != 1) {
	  $interval .= "s";
	}
	// Add value and interval to times array
	$times[] = $value . " " . $interval;
	$count++;
      }
    }

    // Return string with times
    return implode(", ", $times);
  }


	function arrayToObject($d)
	{
		if (is_array($d))
		{
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return (object) array_map(__FUNCTION__, $d);
		}
		else
		{
			// Return object
			return $d;
		}
	}

	function format_price($price)
	{
		$price=number_format($price,0,'.',',');
		$price=$price."/=";
		return $price;
	}

	function watermarkImage ($SourceFile, $WaterMarkText, $DestinationFile)
	{
		//echo $DestinationFile;exit;
		list($width, $height) = getimagesize($SourceFile);
		$image_p = imagecreatetruecolor($width, $height);
		$image = imagecreatefromjpeg($SourceFile);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width, $height);
		//$black = imagecolorallocate($image_p, 43,178,23);
		$black = imagecolorallocate($image_p, 255,255,255);
		$font = 'arial.ttf';
		$font_size = 9;
		imagettftext($image_p, $font_size, 0, 10, 20, $black, $font, $WaterMarkText);
		if ($DestinationFile<>'')
		{
			imagejpeg ($image_p, $DestinationFile, 100);
		}
		else
		{
			header('Content-Type: image/jpeg');
			imagejpeg($image_p, null, 100);
		};
		imagedestroy($image);
		imagedestroy($image_p);
	}

	function filter_words($text,$connection)
	{
		$sql="SELECT * FROM ask_word_filter";
		$result=mysql_query($sql,$connection);
		while($row=mysql_fetch_array($result))
		{
			$text=str_ireplace($row[swear_word],$row[replacement],$text);
		}
		return $text;
	}

	/*function is_mobile()
	{
		$regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
		$regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
		$regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
		$regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
		$regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
		$regex_match.=")/i";

		if($_SERVER['REMOTE_ADDR'] == "203.45.98.42"||$_SERVER['REMOTE_ADDR'] == "27.32.136.14")
			return true;
		else
			return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
	}*/

	function generate_csv($filename,$res,$connection)
	{
		/*	HOW TO INVOKE

			$filename="csv/test.csv";
			$sql="SELECT * FROM campaign_statuses";

			$res=mysql_query($sql,$connection);

			// fetch a row and write the column names out to the file
			generate_csv($filename,$res,$connection);
		*/
		$fp=fopen($filename,"w");
		$row=mysql_fetch_assoc($res);
		$line="";
		$comma="";
		foreach($row as $name=>$value)
		{
			$line.=$comma.'"'.str_replace('"','""',$name).'"';
			$comma=",";
		}
		$line.="\n";
		fputs($fp,$line);

		// remove the result pointer back to the start
		mysql_data_seek($res,0);

		// and loop through the actual data
		while($row=mysql_fetch_assoc($res))
		{
			$line="";
			$comma="";
			foreach($row as $value)
			{
				$line.=$comma.'"'.str_replace('"','""',$value).'"';
				$comma=",";
			}
			$line.="\n";
			fputs($fp,$line);
		}

		fclose($fp);

		if($filename&&preg_match("/\.csv$/i",$filename)&&file_exists($filename))
		{
			header('Content-Description:File Transfer');
			header("Content-Type:text/csv");
			header("Content-Transfer-Encoding:binary");
			header("Content-Length:".filesize($filename));
			header("Content-Disposition:attachment;filename=".basename($filename));
			header('Expires:0');
			header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
			header('Pragma:public');
			ob_clean();
			flush();
			readfile($filename);
			exit;
		}
	}

	function get_ip()
	{
		/*if(!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
		{
			$ip=$_SERVER['HTTP_CLIENT_IP'];
		}
		elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
		{
			$ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else
		{
			$ip=$_SERVER['REMOTE_ADDR'];
		}
		return $ip;*/
		$ipaddress='';

		if ($_SERVER['HTTP_CLIENT_IP'])
		{
			$ipaddress=$_SERVER['HTTP_CLIENT_IP'];
		}
		else if($_SERVER['HTTP_X_FORWARDED_FOR'])
		{
			$ipaddress=$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else if($_SERVER['HTTP_X_FORWARDED'])
		{
			$ipaddress=$_SERVER['HTTP_X_FORWARDED'];
		}
		else if($_SERVER['HTTP_FORWARDED_FOR'])
		{
			$ipaddress=$_SERVER['HTTP_FORWARDED_FOR'];
		}
		else if($_SERVER['HTTP_FORWARDED'])
		{
			$ipaddress=$_SERVER['HTTP_FORWARDED'];
		}
		else if($_SERVER['REMOTE_ADDR'])
		{
			$ipaddress=$_SERVER['REMOTE_ADDR'];
		}
		else
		{
			$ipaddress='UNKNOWN';
		}
		return $ipaddress;
	}

	function remove_browser_specific_styles($description)
	{
		return preg_replace("/<!\-\-\[if[\S\s]*?<!\-\-\[endif\] \-\->/", "", $description);
	}

	function generate_mp3_player($song_title,$song_slug,$artiste_slug)
	{
		echo "<p><embed height='20' width='400' flashvars='file=http://www.kadamandiya.com.au/sinhala-mp3-songs/$artiste_slug/$song_slug.mp3&title=$song_title&linktarget=http://www.kadamandiya.com.au' allowfullscreen='true' allowscriptaccess='always' quality='high' name='mpl' class='margin_top_10' style='undefined' src='http://www.kadamandiya.com.au/include/player.swf' type='application/x-shockwave-flash' /></p>";
	}

	function generate_fb_like_send_html($page_url)
	{
		return "<div class='fb-like margin_left_10' data-href='http://www.kadamandiya.com.au$page_url' data-send='true' data-width='450' data-show-faces='false' data-font='arial'></div>";
	}

	function generate_fb_send_html($page_url)
	{
		return "<div class='fb-send margin_left_10' data-href='http://www.kadamandiya.com.au$page_url' data-font='arial'></div>";
	}

	function generate_fb_comment_html($page_url)
	{
		return "<div class='fb-comments margin_left_10' data-href='http://www.kadamandiya.com.au$page_url' data-num-posts='2' data-width='650'></div>";
	}

	function getmicrotime()
	{
		list($usec,$sec)=explode(" ",microtime());
		return((float)$usec+(float)$sec);
	}

	function sanitize_string($string,$connection)
	{
		$string=trim($string);
		$string=strip_tags($string);
		$string=stripslashes($string);
		$string=mysql_real_escape_string($string,$connection);
		return $string;
	}

	function sanitize_phone_number($phone_number)
	{
		//$=preg_replace('/[^\d]/','',$phone_number);
		$phone_number=remove_white_space($phone_number);
		$phone_number=str_ireplace("(","",$phone_number);
		$phone_number=str_ireplace(")","",$phone_number);
		$phone_number=str_ireplace("-","",$phone_number);

		return $phone_number;
	}

	function validate_phone_number($phone_number,$state="")
	{
		//$number=preg_replace('/[^\d]/', '', $number);
		//return preg_match('/^(0(2|3|4|7|8))?\d{8}$/',$number)|| preg_match('/^1(3|8)00\d{6}$/',$number)|| preg_match('/^13\d{4}$/',$number);
		$phone_number=remove_white_space($phone_number);
		$phone_number=str_ireplace("(","",$phone_number);
		$phone_number=str_ireplace(")","",$phone_number);
		$phone_number=str_ireplace("-","",$phone_number);

		if(!is_numeric($phone_number))
		{
			$proceed=false;
			//echo "NaN";exit;
		}
		elseif
		(
			(!stristr($phone_number,'1300')===FALSE)||
			(!stristr($phone_number,'13')===FALSE)||
			(!stristr($phone_number,'1800')===FALSE)||
			(!stristr($phone_number,'1900')===FALSE)||
			(!stristr($phone_number,'04')===FALSE)
		)
		{
			$proceed=true;
			//echo "fine - premium number";exit;
		}
		else
		{
			if($state=="")
			{
				if
				(
					(!stristr($phone_number,'02')===FALSE)||
					(!stristr($phone_number,'03')===FALSE)||
					(!stristr($phone_number,'07')===FALSE)||
					(!stristr($phone_number,'08')===FALSE)
				)
				{
					$proceed=true;
					//echo "fine - land line";exit;
				}
				else
				{
					$proceed=false;
					//echo "no state, wrong #";exit;
				}
			}
			else
			{
				//echo "state given<hr />";
				if($state=="nsw"&&stristr($phone_number,'02')===FALSE)
				{
					$proceed=false;
					//echo "NSW invalid";exit;
				}
				elseif($state=="act"&&stristr($phone_number,'02')===FALSE)
				{
					$proceed=false;
					//echo "ACT invalid";exit;
				}
				elseif($state=="vic"&&stristr($phone_number,'03')===FALSE)
				{
					$proceed=false;
					//echo "VIC invalid";exit;
				}
				elseif($state=="tas"&&stristr($phone_number,'03')===FALSE)
				{
					$proceed=false;
					//echo "TAS invalid";exit;
				}
				elseif($state=="qld"&&stristr($phone_number,'07')===FALSE)
				{
					$proceed=false;
					//echo "QLD invalid";exit;
				}
				elseif($state=="nt"&&stristr($phone_number,'08')===FALSE)
				{
					$proceed=false;
					//echo "NT invalid";exit;
				}
				elseif($state=="wa"&&stristr($phone_number,'08')===FALSE)
				{
					$proceed=false;
					//echo "WA invalid";exit;
				}
				elseif($state=="sa"&&stristr($phone_number,'08')===FALSE)
				{
					$proceed=false;
					//echo "SA invalid";exit;
				}
				else
				{
					$proceed=true;
				}
			}
		}
		return $proceed;
	}

	function validate_postcode($postcode,$state)
	{
		$postcodelist=array
		(
			'nsw'=>array
			(
				array(1000,1999),
				array(2000,2599),
				array(2620,2898),
				array(2921,2999)
			),
			'act'=>array
			(
				array(200,299),
				array(2600,2619),
				array(2900,2920)
			),
			'vic'=>array
			(
				array(3000,3999),
				array(8000,8999)
			),
			'qld'=>array
			(
				array(4000,4999),
				array(9000,9999)
			),
			'sa'=>array
			(
				array(5000,5799),
				array(5800,5999)
			),
			'wa'=>array
			(
				array(6000,6797),
				array(6800,6999)
			),
			'tas'=>array
			(
				array(7000,7799),
				array(7800,7999)
			),
			'nt'=>array
			(
				array(800,899),
				array(900,999)
			)
		);

		$state=strtolower($state);
		if($state!="0"&&$state!="")
		{
			foreach($postcodelist[$state] as $limit)
			{
				if($postcode>=$limit[0]&&$postcode<=$limit[1])
				{
					$proceed=true;
				}
			}
		}
		else
		{
			$proceed=false;
		}
		return $proceed;
	}

	function convert_date_to_db_format($date)//$date=29-04-2011
	{
		$date=explode("-",$date);
		$date=$date[2]."-".$date[1]."-".$date[0];
		return $date;
	}

	function convert_date_to_au_format($date)//$date=2011-04-29
	{
		$date=explode("-",$date);
		$date=$date[2]."-".$date[1]."-".$date[0];
		return $date;
	}

	function create_pdf_invoice
	(
		$invoice_number,
		$invoice_details,
		$customer_details,
		$add_gst=false
	)
	{
		$pdf=new FPDF('P', 'mm', 'A4');
		$pdf->AddPage();
		$pdf->Image('images/invoice_template.png',0,0,210);

		//REFRENCE NUMBER
		$pdf->SetFont('Arial','',13);
		$pdf->SetXY(150,55);
		$pdf->Cell(0, 0, $invoice_number, 0, 1, 'L');

		//DATE
		$pdf->SetFont('Arial','',13);
		$pdf->SetXY(150,61);
		$pdf->Cell(0, 0, date("d-M-Y"), 0, 1, 'L');

		//BILL TO
		$pdf->SetFont('Arial','',13);
		$pdf->SetXY(27,106);
		$pdf->Cell(0, 0, $customer_details['name'].",", 0, 1, 'L');
		$pdf->SetXY(27,111);
		$pdf->Cell(0, 0, $customer_details['company'].",", 0, 1, 'L');
		$pdf->SetXY(27,116);
		$pdf->Cell(0, 0, $customer_details['address'].",", 0, 1, 'L');
		$pdf->SetXY(27,121);
		$pdf->Cell(0, 0, $customer_details['suburb'].", ".$customer_details['state']." ".$customer_details['postcode'].".", 0, 1, 'L');
		$pdf->SetXY(27,126);
		$pdf->Cell(0, 0, "Ph:- ".$customer_details['phone'].".", 0, 1, 'L');
		$pdf->SetXY(27,131);
		$pdf->Cell(0, 0, "e:- ".$customer_details['email'].".", 0, 1, 'L');

		//PRODUCT/DESCRIPTION
		$pdf->SetXY(26,160);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0, 0,$invoice_details['short_description'], 0, 1, 'L');

		//AMOUNT
		$pdf->SetXY(150,160);
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(0, 0, "$".$invoice_details['amount'], 0, 1, 'L');

		//TOTAL AMOUNT
		$pdf->SetXY(150,177);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0, 0, "$".$invoice_details['amount'], 0, 1, 'L');

		//AMOUNT DUE
		$pdf->SetXY(150,194);
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(0, 0, "$".$invoice_details['amount'], 0, 1, 'L');

		//Quote reference number
		$pdf->SetXY(65,242);
		$pdf->SetFont('Arial','B',12);
		$pdf->SetTextColor(255,0,0);
		$pdf->Cell(0, 0,"Invoice Number ".$invoice_number, 0, 1, 'L');

		$pdf->Close();
		@unlink("invoices/inv" . $invoice_number . ".pdf");
		$pdf->Output("invoices/inv" . $invoice_number . ".pdf");
		usleep(10000);
	}

	function get_email_signature($unsubscribe_key="",$is_sales=false)
	{
		$email_message="<p style='font-family:Calibri, Arial;font-size:12pt;margin-bottom:12px;'>
			Kind regards,<br />Shammika<br /><br />
			Shammika Munugoda<br />
			Managing Director<br />
			Kadamandiya - Your one stop shop for everything Sri Lankan<br />
			P : +61 3 9092 1650<br />
			M : +61 433 327 783<br />
			F : +61 3 9942 8883<br />
			Skype : kadamandiya<br />
			<a href='mailto:shammika@kadamandiya.com.au' style='color:#7B0326;text-decoration:none;'>shammika@kadamandiya.com.au</a><br />
			<a href='http://www.Kadamandiya.com.au' style='color:#7B0326;text-decoration:none;'>www.Kadamandiya.com.au</a><br />
			<a href='http://www.kadamandiya.com.au/track/kadamandiya-iphone-app'>Download 'Kadamandiya' the iPhone app</a><br />
			<a href='http://itunes.apple.com/au/app/kadamandiya/id483092967?mt=8'><img height='150' src='http://www.kadamandiya.com.au/images/download-kadamandiya-iphone-app.png' style='border:none;' /></a>
		</p>
		<p style='font-family:Calibri, Arial;margin-bottom:12px;font-size:13px;color:gray'>We hope this email is helpful. If you wish to unsubscribe from our correspondence, please ";
		if($unsubscribe_key=="")
		{
			$email_message.="<a href='mailto:unsubscribe@kadamandiya.com.au'>click here</a>";
		}
		else
		{
			$email_message.="<a href='http://www.kadamandiya.com.au/unsubscribe_me.php?key=$unsubscribe_key'>click here</a>";
		}
		$email_message.="</p>";
		if($is_sales)
		{
			$email_message.="<p style='margin-bottom:12px;font-size:14px;color:blue'>Notice: This is a promotional mail strictly on the guidelines of CAN-SPAM act of 2003. We have clearly mentioned the source mail-id of this mail, also clearly mentioned the subject lines and they are in no way misleading in any form. We have found your mail address through our own efforts on the web search and not through any illegal way. If you find this mail unsolicited, please click on the above link to unsubscribe.</p>";
		}
		return $email_message;
	}

	function strip_symbols($text)
	{
		$plus='\+\x{FE62}\x{FF0B}\x{208A}\x{207A}';
		$minus='\x{2012}\x{208B}\x{207B}';

		$units='\\x{00B0}\x{2103}\x{2109}\\x{23CD}';
		$units .= '\\x{32CC}-\\x{32CE}';
		$units .= '\\x{3300}-\\x{3357}';
		$units .= '\\x{3371}-\\x{33DF}';
		$units .= '\\x{33FF}';

		$ideo='\\x{2E80}-\\x{2EF3}';
		$ideo .= '\\x{2F00}-\\x{2FD5}';
		$ideo .= '\\x{2FF0}-\\x{2FFB}';
		$ideo .= '\\x{3037}-\\x{303F}';
		$ideo .= '\\x{3190}-\\x{319F}';
		$ideo .= '\\x{31C0}-\\x{31CF}';
		$ideo .= '\\x{32C0}-\\x{32CB}';
		$ideo .= '\\x{3358}-\\x{3370}';
		$ideo .= '\\x{33E0}-\\x{33FE}';
		$ideo .= '\\x{A490}-\\x{A4C6}';

		return preg_replace(array(// Remove modifier and private use symbols.
		'/[\p{Sk}\p{Co}]/u', // Remove mathematics symbols except + -=~ and fraction slash
		//'/\p{Sm}(?<![' . $plus . $minus . '=~\x{2044}])/u',
		// Remove + - if space before, no number or currency after
		'/((?<= )|^)[' . $plus . $minus . ']+((?![\p{N}\p{Sc}])|$)/u', // Remove=if space before
		'/((?<= )|^)=+/u', // Remove + -=~ if space after
		'/[' . $plus . $minus . '=~]+((?= )|$)/u', // Remove other symbols except units and ideograph parts
		'/\p{So}(?<![' . $units . $ideo . '])/u', // Remove consecutive white space
		'/ +/', ), ' ', $text);
	}

	function extract_email_address($text)
	{
		preg_match_all("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})/i", $text,$matched_email_addresses);
		$matched_email_addresses=$matched_email_addresses[0];
		$matched_email_addresses=array_unique($matched_email_addresses);
		return $matched_email_addresses;
	}

	function find_browser_version()
	{
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		$browser="";
		if(preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched))
		{
			$browser_version=$matched[1];
			$browser='IE';
		}
		elseif(preg_match('|Opera ([0-9].[0-9]{1,2})|',$useragent,$matched))
		{
			$browser_version=$matched[1];
			$browser='Opera';
		}
		elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched))
		{
				$browser_version=$matched[1];
				$browser='Firefox';
		}
		elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched))
		{
				$browser_version=$matched[1];
				$browser='Safari';
		}
		else
		{
			$browser_version=0;
			$browser= 'other';
		}

		$browser_array['browser']=$browser;
		$browser_array['browser_version']=$browser_version;
		return $browser_array;
	}

	function remove_white_space($string)
	{
		$string=str_ireplace(" ","",$string);
		$string=preg_replace("/^\W*/", "", $string);
		$string=preg_replace("/\W*$/", "", $string);
		return $string;
	}

	function remove_nbsp($string)
	{
		return preg_replace("/&#?[a-z0-9]{2,8};/i","",$string);
	}

	function check_email_address($email)
	{
		/*
        //First, we check that there's one @ symbol, and that the lengths are right
        if(!ereg("^[^@]{1,64}@[^@]{1,255}$", $email))
        {
			//Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
			return false;
        }
        // Split it into sections to make life easier
		$email_array=explode("@", $email);
        $local_array=explode(".", $email_array[0]);
        for ($i=0; $i < sizeof($local_array); $i++)
        {
			if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i]))
			{
				return false;
			}
        }
        if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1]))
        {
			//Check if domain is IP. If not, it should be valid domain name
			$domain_array=explode(".", $email_array[1]);
			if(sizeof($domain_array) < 2)
			{
				return false; // Not enough parts to domain
			}
			for ($i=0; $i < sizeof($domain_array); $i++)
			{
				if(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i]))
				{
					return false;
				}
			}
		}
        return true;
        */
		return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $email);
	}

	function is_error($session_error,$error_codes)
	{
		$is_error=false;
		if(is_array($error_codes))
		{
			foreach($error_codes as $error)
			{
				if(!stristr($session_error,$error)===FALSE)
				{
					$is_error=true;
					break;
				}
			}
		}
		else
		{
			if(!stristr($session_error,$error_codes)===FALSE)
			{
				$is_error=true;
			}
		}
		if($is_error)
		{
			return "error-border";
		}
		else
		{
			return "";
		}
	}

	/*function simplify_string($string)
	{
		return $string;
	}*/

	function is_android()
	{
		$regex_match="/(nokia|android|motorola)/i";
		return preg_match($regex_match,strtolower($_SERVER['HTTP_USER_AGENT']));
	}

	function is_mobile()
	{
		$regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
		$regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
		$regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^snctionam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
		$regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
		$regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
		$regex_match.=")/i";
		return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
	}

	function read_description_node($url,$xpath)
	{
		global $news_array;
		$dom=create_xpath($url);

		$content=$dom->evaluate($xpath);
		$content_dom=new DOMDocument();
		$div_node=$content_dom->importNode($content->item(0), true);
		$content_dom->appendChild($div_node);
		$div_xpath=new DOMXPath($content_dom);
		$div_html=$content_dom->saveHTML();
		return $div_html;
	}

	function create_html_curl($url, $ssl=false)
	{
		$target_url=$url;
		$userAgent='Googlebot/2.1 (http://www.googlebot.com/bot.html)';

		// make the cURL request to $target_url
		$poop_ch=curl_init();
		curl_setopt($poop_ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($poop_ch, CURLOPT_URL,$target_url);
		curl_setopt($poop_ch, CURLOPT_FAILONERROR, true);
		curl_setopt($poop_ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($poop_ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($poop_ch, CURLOPT_RETURNTRANSFER,true);
		if($ssl)
		{
			curl_setopt($poop_ch, CURLOPT_SSL_VERIFYPEER,false);
		}
		curl_setopt($poop_ch, CURLOPT_TIMEOUT, 500);
		$poop_html= curl_exec($poop_ch);
		return $poop_html;
	}

	function create_xpath($url, $ssl=false)
	{
		$target_url=$url;
		$userAgent='Googlebot/2.1 (http://www.googlebot.com/bot.html)';
		$userAgent='Firefox (WindowsXP) � Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6';

		/*$userAgent='MSN Live � msnbot-Products/1.0 (+http://search.msn.com/msnbot.htm)';
		$userAgent='Google � Googlebot/2.1 ( http://www.googlebot.com/bot.html)';
		$userAgent='Google Image � Googlebot-Image/1.0 ( http://www.googlebot.com/bot.html)';

		$userAgent='MSN Live � msnbot-Products/1.0 (+http://search.msn.com/msnbot.htm)';
		$userAgent='Yahoo � Mozilla/5.0 (compatible; Yahoo! Slurp; http://help.yahoo.com/help/us/ysearch/slurp)';
		$userAgent='ask';

		$userAgent='Firefox (WindowsXP) � Mozilla/5.0 (Windows; U; Windows NT 5.1; en-GB; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6';
		$userAgent='IE 7 � Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30)';
		$userAgent='IE 6 � Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
		$userAgent='Safari � Mozilla/5.0 (Macintosh; U; Intel Mac OS X; en) AppleWebKit/522.11 (KHTML, like Gecko) Safari/3.0.2';
		$userAgent='Opera � Opera/9.00 (Windows NT 5.1; U; en)';
		*/

		// make the cURL request to $target_url
		$poop_ch=curl_init();
		curl_setopt($poop_ch, CURLOPT_USERAGENT, $userAgent);
		curl_setopt($poop_ch, CURLOPT_URL,$target_url);
		curl_setopt($poop_ch, CURLOPT_FAILONERROR, true);
		curl_setopt($poop_ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($poop_ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($poop_ch, CURLOPT_RETURNTRANSFER,true);
		if($ssl)
		{
			curl_setopt($poop_ch, CURLOPT_SSL_VERIFYPEER,false);
		}
		curl_setopt($poop_ch, CURLOPT_TIMEOUT, 500);
		$poop_html= curl_exec($poop_ch);
		if(!$poop_html)
		{
			echo "<br />cURL error number:" .curl_errno($ch);
			echo "<br />cURL error:" . curl_error($ch);
			return false;
		}
		$poop=new DOMDocument();
		//echo $poop_html;exit;
		@$poop->loadHTML($poop_html);
		$xpath=new DOMXPath($poop);

		return $xpath;
	}
	//calcuate the difference between two dates and return the result
	function calculate_date_difference($endDate,$beginDate)
	{
		$dateDiff=$endDate - $beginDate;
		$fullDays=floor($dateDiff/(60*60*24));
		$fullHours=floor(($dateDiff-($fullDays*60*60*24))/(60*60));
		$fullMinutes=floor(($dateDiff-($fullDays*60*60*24)-($fullHours*60*60))/60);

		$date_difference=array();
		$date_difference['days']=$fullDays;
		$date_difference['hourse']=$fullHours;
		$date_difference['minutes']=$fullMinutes;
		return $date_difference;
	}

	//return the current active PHP file name
	function getPHPFileName()
	{
		$file=$_SERVER["SCRIPT_NAME"];
		$break=Explode('/', $file);
		$pfile=$break[count($break) - 1];
		return $pfile;
	}

	function format_time($time)
	{
		return date("g:i a",strtotime($time));
	}

	//formats a given phone number, eg:-input=>0395965009 will return (03) 9596 6008
	function format_phone_number($phone_number)
	{
		if(substr($phone_number,0,1)=="0"&&substr($phone_number,1,1)!="4")//starts with 03,02,07....
		{
			//$phone_number="(".substr($phone_number,0,2).") " .substr($phone_number,2,4)." ".substr($phone_number,6);
			$phone_number="(".substr($phone_number,0,2).") " .substr($phone_number,2,4)." ".substr($phone_number,6);
		}
		elseif(substr($phone_number,0,2)=="04")//mobile numbers
		{
			$phone_number=substr($phone_number,0,4)." ".substr($phone_number,4,3)." ".substr($phone_number,7,3);
		}
		else//eg:-1300 XXX XXX
		{
			$phone_number=substr($phone_number,0,4)." ".substr($phone_number,4,3)." ".substr($phone_number,7,3);
		}

		if(strlen($phone_number)==4)
		{
			$phone_number="";
		}
		return $phone_number;
	}

	function get_state_name($state)
	{
		$state=strtolower($state);
		$state_name="";
		switch($state)
		{
			case "vic":$state_name="Victoria";break;
			case "nsw":$state_name="New South Wales";break;
			case "act":$state_name="Australian Capitol Territory";break;
			case "sa":$state_name="South Australia";break;
			case "wa":$state_name="Western Australia";break;
			case "nt":$state_name="Nothern Territory";break;
			case "tas":$state_name="Tasmania";break;
			case "qld":$state_name="Queensland";break;
		}
		return $state_name;
	}

	function format_URL($url)
	{
		if(substr($url,0,3)=="www")
		{
			return "http://".$url;
		}
		else
		{
			return $url;
		}
	}

	function format_URL_display_text($url)
	{
		if(substr($url,0,7)=="http://")
		{
			return substr($url,7);
		}
		else
		{
			return $url;
		}
	}

	function print_r_html ($arr)
	{
        ?><pre><?php
        print_r($arr);
        ?></pre><?php
	}

	function read_folder_contents($folder_name,$exclude_file="")
	{
		$counter=0;
		$file_names=array();

		if(!file_exists($folder_name))
		{
			@mkdir($folder_name);
		}

		if($handle=@opendir($folder_name))
		{
			while(false!==($file=readdir($handle)))
			{
				if
				(
					($file!=".")&&
					($file!="..")&&
					($file!="thumbs")&&
					($file!="thumbs.db")&&
					($file!="new")&&
					($file!=$exclude_file)
				)
				{
					$file_name=explode(".",$file);
					if($file_name[1]!="db")//thumbs.db
					{
						$file_names[$counter]=$file;
						$counter++;
					}
				}
			}
		}
		return $file_names;
	}

	function highlight_search_keyword($search_keyword,$text)
	{
		$search_keyword=trim($search_keyword);
		if($search_keyword != "" && trim($text) != "" && $search_keyword !="keywords - your discipline")
		{
			$text=preg_replace("|($search_keyword)|Ui" , "<span class=\"highlighted_search_keyword\">$1</span>" , $text );
		}
		return $text;
	}

	function textLimit($string, $length, $replacer='...')
	{
		if(strlen($string) > $length)
		return (preg_match('/^(.*)\W.*$/', substr($string, 0, $length+1), $matches) ? $matches[1] : substr($string, 0, $length)) . $replacer;

		return $string;
	}

	function chengeDateToDBFormat($date)
	{
		$date=trim($date);
		$date=substr($date,6,4)."-".substr($date,3,2)."-".substr($date,0,2);
		return $date;
	}

	function chengeDateFormat($date)
	{
		$date=trim($date);
		$date=substr($date,8,2)."-".substr($date,5,2)."-".substr($date,0,4);
		return $date;
	}

	function detect_browser_version()
	{
		//find browser version
		$useragent=$_SERVER['HTTP_USER_AGENT'];
		$browser=array();

		if(preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched))
		{
			$browser['version']=$matched[1];
			$browser['browser']='IE';
		}
		elseif(preg_match('|Opera ([0-9].[0-9]{1,2})|',$useragent,$matched))
		{
			$browser['version']=$matched[1];
			$browser['browser']='Opera';
		}
		elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched))
		{
			$browser['version']=$matched[1];
	        $browser['browser']='Firefox';
		}
		elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched))
		{
			$browser['version']=$matched[1];
	        $browser['browser']='Safari';//Google Chrome gets picked up as Safari
		}
		elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched))
		{
			$browser['version']=$matched[1];
	        $browser['browser']='Safari';//Google Chrome gets picked up as Safari
		}
		else
		{
			$browser['version']=0;
			$browser['browser']='other';
		}
		return $browser;
	}

	function find_web_browser_version($useragent)
	{
		//find browser version
		$array="DEFAULT";
		//echo $useragent;
		if(preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched))
		{
			$browser_version=$matched[1];
			$browser='IE';
		}
		elseif(!stristr($useragent,'Opera/')===FALSE)
		{
			$browser_version=explode("Version/",$useragent);
			$browser_version=$browser_version[1];
			$browser='Opera';
		}
		elseif(preg_match('|Opera ([0-9].[0-9]{1,2})|',$useragent,$matched))
		{
			$browser_version=$matched[1];
			$browser='Opera';
		}
		elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched))
		{
			$browser_version=$matched[1];
			if(preg_match('|Seamonkey/([0-9\.]+)|',$useragent,$matched))
			{
				$browser='Seamonkey';
			}
			else
			{
				$browser='Firefox';
			}
		}
		elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched))
		{
			$browser_version=$matched[1];

			if(preg_match('|Chromium/([0-9\.]+)|',$useragent,$matched))
			{
				$browser='Chromium';
			}
			elseif(preg_match('|Maxthon/([0-9\.]+)|',$useragent,$matched))
			{
				$browser='Maxthon';
			}
			else
			{
				$browser='Chrome';
			}
		}
		elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched))
		{
			$browser_version=$matched[1];

			if(preg_match('|Maxthon/([0-9\.]+)|',$useragent,$matched))
			{
				$browser='Maxthon';
			}
			else if(preg_match('|Chromium/([0-9\.]+)|',$useragent,$matched))
			{
				$browser='Chromium';
			}
			else if(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched))
			{
				$browser='Chrome';
			}
			else
			{
				$browser='Safari';//Google Chrome gets picked up as Safari
			}
		}
		else
		{
			$browser_version=0;
			$browser='Internet Explorer';
		}
		if(!stristr($useragent,'CFNetwork')===FALSE)
		{
			$browser_version=4;
			$browser='iPhone - Mobile Safari';
		}
		elseif(!stristr($useragent,'Android')===FALSE)
		{
			$browser_version=4;
			$browser='Android Specific';
		}

		$browser_array['browser']=$browser;
		$browser_array['browser_version']=$browser_version;
		return $browser_array;
	}

	function generate_random_password()
	{
		////////GENERATE a random password///////////
        list($usec,$sec)=explode(' ',microtime());
        srand((float)$sec+((float)$usec*100000));

        $validchars[1]="0123456789abcdfghjkmnpqrstvwxyz";
        $validchars[2]="0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

        $password="";
        $counter=0;
        $length=6;//6 characters for the password
        $level=rand(1,2);
        $usercreate=array();

        while($counter<$length)
        {
        	$actChar=substr($validchars[$level],rand(0,strlen($validchars[$level])-1),1);
           // All character must be different
           if(!strstr($password,$actChar))
           {
           	$password.=$actChar;
               $counter++;
           }
        }
        $generatedpassword=$password;
        return $generatedpassword;
	}

	function encrypt_password($password,$key,$salt)
	{
		$password=strrev(encrypt($password,$key));
		//echo $password."<hr />";
		$password=strrev(md5(strrev($password)));
		//echo $password."<hr />";
		$password=strrev(sha1(strrev($password)));
		//echo $password."<hr />";
		$password=str_split($password,10);
		//echo $password."<hr />";
		$password=$password[3].$password[0].$password[2].$password[1];
		//echo $password."<hr />";
		$salt=crypt($password,$salt);// Blowfish
		//echo $salt."<hr />";
		$password=sha1($password.$salt);
		//echo $password."<hr />";
		$password=substr($password,21,20).substr($password,0,20);
		//echo $password."<hr />";
		return $password;
	}

	function hasTags($str)
	{
		return !(strcmp( $str, strip_tags($str ) ) == 0);
	}

	function encrypt($string,$key)
	{
		$result='';
		for($i=0; $i<strlen($string); $i++)
		{
			$char=substr($string, $i, 1);
			$keychar=substr($key, ($i % strlen($key))-1, 1);
			$char=chr(ord($char)+ord($keychar));
			$result.=$char;
		}
		return base64_encode(strrev($result));
	}

	function decrypt($string,$key)
	{
		$result='';
		$string=strrev(base64_decode($string));

		for($i=0; $i<strlen($string); $i++)
		{
			$char=substr($string, $i, 1);
			$keychar=substr($key, ($i % strlen($key))-1, 1);
			$char=chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}

	function fix_email_addresses($string)
	{
		// Fix those email addresses that are within href, but without having mailto
		if(preg_match_all("/href=([\"']?)([_a-z\d\+\-\.]+@[a-z\d\+\-\.]+)[\"']?/i", $string, $matches, PREG_SET_ORDER))
		{
			foreach($matches as $match)
			{
				$quote=$match[1];
				$email_link=$match[2];
				$email_link=str_ireplace("+", "\+", $email_link);
				$email_link=str_ireplace("-", "\-", $email_link);
				$email_link=str_ireplace(".", "\.", $email_link);

				if(!preg_match("/^mailto:\s*/i", $email_link))
				{
					$string=preg_replace("/href=[\"']?($email_link)/i", "href={$quote}mailto:$1", $string, 1);
				}
			}
		}
		return $string;
	}

	function fix_http_links($string)
	{
		if(preg_match_all("/href=([\"']?)([^@]*?)[\"' >]/i", $string, $matches, PREG_SET_ORDER))
		{
			foreach($matches as $match)
			{
				$quote=$match[1];
				$link=$match[2];
				$escaped_link=str_ireplace("+", "\+", $link);
				$escaped_link=str_ireplace("-", "\-", $escaped_link);
				$escaped_link=str_ireplace(".", "\.", $escaped_link);
				$escaped_link=str_ireplace("/", "\/", $escaped_link);
				$escaped_link=str_ireplace("?", "\?", $escaped_link);

				if(!preg_match("/^https?:\/\//i", $link))
				{
								$string=preg_replace("/href=[\"']?($escaped_link)/i", "href={$quote}http://$1", $string, 1);
				}
			}
		}
		return $string;
	}


	function removeFormat($string)
	{
		$allowable="<p><a><table><tbody><tr><td><object><param><embed><img><blockquote>";
		//$allowable="<p><a><table><tbody><tr><td><embed><img><ul><ol><li><br><blockquote>";
		$string=strip_tags($string, $allowable);

		return $string;
	}

	// Truncate unclosed tags
	function close_tag($content)
	{
		// If a tag is not closed
		$last_a=strripos($content, "<a");
		if($last_a!==false){
			if(stripos($content, "</a>", $last_a)===false)
			{
				$content=substr($content, 0, $last_a);
			}
		}

		// If table tag is not closed
		$last_table=strripos($content, "<table");
		if($last_table!==false){
			if(stripos($content, "</table>", $last_table)===false)
			{
				$content=substr($content, 0, $last_table);
			}
		}

		// If img tag is not closed
		$last_img=strripos($content, "<img");
		if($last_img!==false){
			if(stripos($content, ">", $last_img)===false)
			{
				$content=substr($content, 0, $last_img);
			}
		}

		// If embed tag is not closed
		$last_embed=strripos($content, "<embed");
		if($last_embed!==false){
			if(stripos($content, "</embed>", $last_embed)===false)
			{
				$content=substr($content, 0, $last_embed);
			}
		}

		// If object tag is not closed
		$last_object=strripos($content, "<object");
		if($last_object!==false){
			if(stripos($content, "</object>", $last_object)===false)
			{
				$content=substr($content, 0, $last_object);
			}
		}

		return $content;
	}

	function simplify_string($string)
	{
		$string=str_replace("\r\n"," ",$string);
		$string=str_replace("\r"," ",$string);
		$string=str_replace("\n"," ",$string);
		$string=str_replace("\t"," ",$string);
		$string=iconv("UTF-8","ISO-8859-1//IGNORE", $string);
		$string=str_replace("&nbsp;","",$string);
		$string=preg_replace("/\s{2,}/"," ",$string);
		$string=stripslashes(trim($string));
		return $string;
	}

	function fixString($string)
	{
		$string=str_replace("â", "'", $string);
		$string=str_replace('â', "-", $string);
		$string=str_replace('â', '"', $string);
		$string=str_replace("&Aring;", "a", $string);
		$string=str_replace("&ndash;", "-", $string);
		$string=str_replace("&Acirc;?", "'", $string);
		$string=str_replace("&acirc;??", "'", $string);
		$string=str_replace("&acirc;", "'", $string);
		$string=str_replace("&acirc;", "", $string);
		$string=str_replace("&middot;", "", $string);
		$string=str_replace("’", "'", $string);
		$string=str_replace("&#8211;", "-", $string);
		$string=str_replace("……", "", $string);
		$string=str_replace("•", "", $string);
		$string=str_replace("–", "-", $string);
		$string=str_replace('�"', "-", $string);
		$string=str_replace("‘", "'", $string);
		$string=str_replace("�", "-", $string);
		$string=str_replace("�", "-", $string);
		$string=str_replace("�", "u", $string);
		$string=str_replace("�", "", $string);
		$string=str_replace("�", "", $string);
		$string=str_replace("�", '"', $string);
		$string=str_replace("�", '"', $string);
		$string=str_replace("â��", "'", $string);
		$string=str_replace('â��', '-', $string);
		$string=str_replace("â��", '"', $string);
		$string=str_replace("“", '"', $string);
		$string=str_replace('â�"', '-', $string);
		$string=str_replace("”", '"', $string);
		$string=str_replace("Ä�", 'a', $string);
		$string=str_replace("ā", 'a', $string);
		$string=str_replace('�"', '-', $string);
		$string=str_replace('â��', '...', $string);
		$string=str_replace("é", "e", $string);
		$string=str_replace('Ã�', 'e', $string);
		$string=str_replace('Â', '', $string);
		$string=str_replace("�", "", $string);
		$string=str_replace(' & ', ' &amp; ', $string);
		$string=str_replace('&nbsp;', ' ', $string);
		$string=str_replace('&Atilde;', '', $string);
		$string=str_replace('&copy;', '', $string);
		$string=str_replace('�', '', $string);
		$string=str_replace("’", "'", $string);
		$string=str_replace("“", "\"", $string);
		$string=str_replace("â", "'", $string);
		$string=str_replace("”", "\"", $string);
		$string=str_replace("�", "", $string);
		$string=str_replace("–", "", $string);
		$string=str_replace("‘", "'", $string);
		$string=str_ireplace("â��", "'", $string);
		$string=preg_replace("/'&#128;&#147;/", "-", $string);
		$string=preg_replace("/\xC2/", "", $string);
		$string=preg_replace("/’/", "'", $string);
		$string=preg_replace("/“/", "\"", $string);
		$string=preg_replace("/â/", "-", $string);

		$string=str_ireplace("–"," - ",$string);
		$string=str_ireplace("—"," - ",$string);
		$string=str_ireplace("“",'"',$string);
		$string=str_ireplace("”",'"',$string);
		return $string;
	}

	function clean_string($string)
	{
		return preg_replace("/’/", "'", $string);
	}

	function create_slug($string)
	{
		$string=strtolower($string);
		$string=str_replace(' - ','-',$string);
		$string=str_replace('_','-',$string);
		$string=str_replace(' / ','-',$string);
		$string=str_replace('/ ','-',$string);
		$string=str_replace(' /','-',$string);
		$string=str_replace('/','-',$string);
		$string=str_replace(' ','-',$string);
		$string=str_replace(')','',$string);
		$string=str_replace('(','',$string);
		$string=str_replace('"','',$string);
		$string=str_replace('�','',$string);
		$string=str_replace('�','',$string);
		$string=str_replace('��','',$string);
		$string=str_replace('\n','',$string);

		$string=str_replace('�','',$string);
		$string=str_replace('�','',$string);

		$string=str_replace('!','',$string);
		$string=str_replace('#','',$string);
		$string=str_replace('%','',$string);
		$string=str_replace('^','',$string);
		$string=str_replace('*','',$string);
		$string=str_replace('+','',$string);
		$string=str_replace('=','',$string);
		$string=str_replace('`','',$string);
		$string=str_replace('~','',$string);

		$string=str_replace('{','',$string);
		$string=str_replace('}','',$string);
		$string=str_replace('|','',$string);
		$string=str_replace("\\",'',$string);

		$string=str_replace('<','',$string);
		$string=str_replace('>','',$string);
		$string=str_replace('?','',$string);
		$string=str_replace('/','',$string);

		$string=str_replace('&','and',$string);
		$string=str_replace('@','at',$string);
		$string=str_replace('$','',$string);
		$string=str_replace("'","",$string);
		$string=str_replace(',','',$string);
		$string=str_replace(':','',$string);
		$string=str_replace(';','',$string);
		$string=str_replace('%','',$string);
		$string=str_replace('[','',$string);
		$string=str_replace(']','',$string);
		$string=str_replace('?','',$string);
		$string=str_replace('A�a�','acai',$string);
		$string=str_replace('â�','',$string);
		$string=str_replace('’',"'",$string);
		$string=str_replace('�','',$string);
		$string=str_replace('.','-',$string);
		$string=str_replace('/','-',$string);
		$string=str_replace('A�a�','acai',$string);
		$string=str_replace('%C3%A2%E2%82%AC%E2%80%9C','',$string);
		$string=str_replace('–','',$string);
		$string=str_replace('�','',$string);
		$string=str_replace("�","",$string);
		$string=str_replace("�","",$string);
		$string=preg_replace("/â/", "-", $string);
		$string=preg_replace('/\s/', '-', $string);

		return $string;
	}

	function arrayToString($array)
	{
		$string=implode(", ",$array);
		return $string;
	}

	function calculateDateDifference($date1=null,$date2=null)
	{
		$dateDiff=abs(strtotime($date1)-strtotime($date2));
		$fullDays=floor($dateDiff/(60*60*24));
		return $fullDays;
	}

	/*********************************************/
	/* Fonction: ImageCreateFromBMP              */
	/* Author:   DHKold                          */
	/* Contact:  admin@dhkold.com                */
	/* Date:     The 15th of June 2005           */
	/* Version:  2.0B                            */
	/*********************************************/

	function ImageCreateFromBMP($filename)
	{
		//Ouverture du fichier en mode binaire
		if (! $f1=fopen($filename,"rb")) return FALSE;

		//1 : Chargement des ent?tes FICHIER
		$FILE=unpack("vfile_type/Vfile_size/Vreserved/Vbitmap_offset", fread($f1,14));
		if ($FILE['file_type'] != 19778) return FALSE;

		//2 : Chargement des ent?tes BMP
		$BMP=unpack('Vheader_size/Vwidth/Vheight/vplanes/vbits_per_pixel'.
					 '/Vcompression/Vsize_bitmap/Vhoriz_resolution'.
					 '/Vvert_resolution/Vcolors_used/Vcolors_important', fread($f1,40));
		$BMP['colors']=pow(2,$BMP['bits_per_pixel']);
		if ($BMP['size_bitmap'] == 0) $BMP['size_bitmap']=$FILE['file_size'] - $FILE['bitmap_offset'];
		$BMP['bytes_per_pixel']=$BMP['bits_per_pixel']/8;
		$BMP['bytes_per_pixel2']=ceil($BMP['bytes_per_pixel']);
		$BMP['decal']=($BMP['width']*$BMP['bytes_per_pixel']/4);
		$BMP['decal'] -= floor($BMP['width']*$BMP['bytes_per_pixel']/4);
		$BMP['decal']=4-(4*$BMP['decal']);
		if ($BMP['decal'] == 4) $BMP['decal']=0;

		//3 : Chargement des couleurs de la palette
		$PALETTE=array();
		if ($BMP['colors'] < 16777216)
		{
		$PALETTE=unpack('V'.$BMP['colors'], fread($f1,$BMP['colors']*4));
		}

		//4 : Cr?ation de l'image
		$IMG=fread($f1,$BMP['size_bitmap']);
		$VIDE=chr(0);

		$res=imagecreatetruecolor($BMP['width'],$BMP['height']);
		$P=0;
		$Y=$BMP['height']-1;
		while ($Y >= 0)
		{
		$X=0;
		while ($X < $BMP['width'])
		{
		 if ($BMP['bits_per_pixel'] == 24)
			$COLOR=unpack("V",substr($IMG,$P,3).$VIDE);
		 elseif ($BMP['bits_per_pixel'] == 16)
		 {
			$COLOR=unpack("n",substr($IMG,$P,2));
			$COLOR[1]=$PALETTE[$COLOR[1]+1];
		 }
		 elseif ($BMP['bits_per_pixel'] == 8)
		 {
			$COLOR=unpack("n",$VIDE.substr($IMG,$P,1));
			$COLOR[1]=$PALETTE[$COLOR[1]+1];
		 }
		 elseif ($BMP['bits_per_pixel'] == 4)
		 {
			$COLOR=unpack("n",$VIDE.substr($IMG,floor($P),1));
			if (($P*2)%2 == 0) $COLOR[1]=($COLOR[1] >> 4) ; else $COLOR[1]=($COLOR[1] & 0x0F);
			$COLOR[1]=$PALETTE[$COLOR[1]+1];
		 }
		 elseif ($BMP['bits_per_pixel'] == 1)
		 {
			$COLOR=unpack("n",$VIDE.substr($IMG,floor($P),1));
			if     (($P*8)%8 == 0) $COLOR[1]= $COLOR[1]        >>7;
			elseif (($P*8)%8 == 1) $COLOR[1]=($COLOR[1] & 0x40)>>6;
			elseif (($P*8)%8 == 2) $COLOR[1]=($COLOR[1] & 0x20)>>5;
			elseif (($P*8)%8 == 3) $COLOR[1]=($COLOR[1] & 0x10)>>4;
			elseif (($P*8)%8 == 4) $COLOR[1]=($COLOR[1] & 0x8)>>3;
			elseif (($P*8)%8 == 5) $COLOR[1]=($COLOR[1] & 0x4)>>2;
			elseif (($P*8)%8 == 6) $COLOR[1]=($COLOR[1] & 0x2)>>1;
			elseif (($P*8)%8 == 7) $COLOR[1]=($COLOR[1] & 0x1);
			$COLOR[1]=$PALETTE[$COLOR[1]+1];
		 }
		 else
			return FALSE;
		 imagesetpixel($res,$X,$Y,$COLOR[1]);
		 $X++;
		 $P += $BMP['bytes_per_pixel'];
		}
		$Y--;
		$P+=$BMP['decal'];
		}

		//Fermeture du fichier
		fclose($f1);

		return $res;
	}

	function convert_to_GIF($filename)
	{
		$size=getimagesize($filename);
		$mime_type=$size['mime'];
		switch($mime_type)
		{
			case "image/gif":
				$img=@imagecreatefromgif($filename);
				break;
			case "image/jpeg":
				$img=@imagecreatefromjpeg($filename);
				break;
			case "image/pjpeg":
				$img=@imagecreatefromjpeg($filename);
				break;
			case "image/bmp":
				$img=@ImageCreateFromBMP($filename);
				//$img=@imagecreatefromwbmp($filename);
				break;
			case "image/png":
				$img=@imagecreatefrompng($filename);
				break;
		}
		//echo $mime_type."<hr />";
		return imagegif($img, $filename);
	}
	function convert_to_JPEG($filename)
	{
		$size=getimagesize($filename);
		$mime_type=$size['mime'];
		switch($mime_type)
		{
			case "image/gif":
				$img=@imagecreatefromgif($filename);
				break;
			case "image/jpeg":
				$img=@imagecreatefromjpeg($filename);
				break;
			case "image/pjpeg":
				$img=@imagecreatefromjpeg($filename);
				break;
			case "image/bmp":
				$img=@ImageCreateFromBMP($filename);
				//$img=@imagecreatefromwbmp($filename);
				break;
			case "image/png":
				$img=@imagecreatefrompng($filename);
				break;
		}
		//echo $mime_type."<hr />";
		return imagejpeg($img, $filename);
	}

	function encode_string($string)
	{
		$string=htmlspecialchars_decode(stripslashes(trim($string)));
		$string=htmlspecialchars($string, ENT_COMPAT, "", false);
		return $string;
	}

	function read_google_map($address)
	{
		$address=str_ireplace(" ","+",$address);
		/*
		$f=fopen("http://maps.googleapis.com/maps/api/geocode/xml?address=$address&sensor=true","r");
		$xml="";

		while($data=fread($f,12288))
		{
			$xml.=$data;
		}

		$file_name="google.xml";
		$xml_file_handler=fopen($file_name,'w') or die("can't open file");
		fwrite($xml_file_handler,$xml);
		fclose($xml_file_handler);
		fclose($f);*/

		$doc=new DOMDocument();
		//$doc->load('google.xml');
		$doc->load("http://maps.googleapis.com/maps/api/geocode/xml?address=$address&sensor=true");
		$jobs=$doc->getElementsByTagName("location");

		$lng="";
		$lat="";

		$lat_long=array();

		foreach($jobs as $job)
		{
			$lng=$job->getElementsByTagName("lng");
			$lng=$lng->item(0)->nodeValue;
			$lat_long['long']=$lng;

			$lat=$job->getElementsByTagName("lat");
			$lat=$lat->item(0)->nodeValue;
			$lat_long['lat']=$lat;
		}
		return $lat_long;
	}

	function is_bot()
	{
		$spiders=array
		(
			".com",
			"abot",
			"bot.html",
			"dbot",
			"ebot",
			"hbot",
			"kbot",
			"lbot",
			"mbot",
			"nbot",
			"obot",
			"pbot",
			"rbot",
			"sbot",
			"tbot",
			"vbot",
			"ybot",
			"zbot",
			"bot.",
			"bot/",
			"_bot",
			".bot",
			"/bot",
			"-bot",
			":bot",
			"(bot",
			"crawl",
			"slurp",
			"spider",
			"seek",
			"accoona",
			"acoon",
			"adressendeutschland",
			"ah-ha.com",
			"ahoy",
			"altavista",
			"ananzi",
			"anthill",
			"appie",
			"arachnophilia",
			"arale",
			"araneo",
			"aranha",
			"architext",
			"aretha",
			"arks",
			"asterias",
			"atlocal",
			"atn",
			"atomz",
			"augurfind",
			"backrub",
			"bannana_bot",
			"baypup",
			"bdfetch",
			"big brother",
			"biglotron",
			"bjaaland",
			"blackwidow",
			"blaiz",
			"blog",
			"blo.",
			"bloodhound",
			"boitho",
			"booch",
			"bradley",
			"butterfly",
			"calif",
			"cassandra",
			"ccubee",
			"cfetch",
			"charlotte",
			"churl",
			"cienciaficcion",
			"cmc",
			"collective",
			"comagent",
			"combine",
			"computingsite",
			"csci",
			"curl",
			"cusco",
			"daumoa",
			"deepindex",
			"delorie",
			"depspid",
			"deweb",
			"die blinde kuh",
			"digger",
			"ditto",
			"dmoz",
			"docomo",
			"download express",
			"dtaagent",
			"dwcp",
			"ebiness",
			"ebingbong",
			"e-collector",
			"ejupiter",
			"emacs-w3 search engine",
			"esther",
			"evliya celebi",
			"ezresult",
			"falcon",
			"felix ide",
			"ferret",
			"fetchrover",
			"fido",
			"findlinks",
			"fireball",
			"fish search",
			"fouineur",
			"funnelweb",
			"gazz",
			"gcreep",
			"genieknows",
			"getterroboplus",
			"geturl",
			"glx",
			"goforit",
			"golem",
			"googlebot",
			"Googlebot",
			"grabber",
			"grapnel",
			"gralon",
			"griffon",
			"gromit",
			"grub",
			"gulliver",
			"hamahakki",
			"harvest",
			"havindex",
			"helix",
			"heritrix",
			"hku www octopus",
			"homerweb",
			"htdig",
			"html index",
			"html_analyzer",
			"htmlgobble",
			"hubater",
			"hyper-decontextualizer",
			"ia_archiver",
			"ibm_planetwide",
			"ichiro",
			"iconsurf",
			"iltrovatore",
			"image.kapsi.net",
			"imagelock",
			"incywincy",
			"indexer",
			"infobee",
			"informant",
			"ingrid",
			"inktomisearch.com",
			"inspector web",
			"intelliagent",
			"internet shinchakubin",
			"ip3000",
			"iron33",
			"israeli-search",
			"ivia",
			"jack",
			"jakarta",
			"javabee",
			"jetbot",
			"jumpstation",
			"JS-Kit",
			"katipo",
			"kdd-explorer",
			"kilroy",
			"knowledge",
			"kototoi",
			"kretrieve",
			"labelgrabber",
			"lachesis",
			"larbin",
			"legs",
			"libwww",
			"linkalarm",
			"link validator",
			"linkscan",
			"lockon",
			"lwp",
			"lycos",
			"magpie",
			"mantraagent",
			"mapoftheinternet",
			"marvin/",
			"mattie",
			"mediafox",
			"mediapartners",
			"mercator",
			"merzscope",
			"microsoft url control",
			"minirank",
			"miva",
			"mj12",
			"mnogosearch",
			"moget",
			"monster",
			"moose",
			"motor",
			"multitext",
			"muncher",
			"muscatferret",
			"mwd.search",
			"myweb",
			"najdi",
			"nameprotect",
			"nationaldirectory",
			"nazilla",
			"ncsa beta",
			"nec-meshexplorer",
			"nederland.zoek",
			"netcarta webmap engine",
			"netmechanic",
			"netresearchserver",
			"netscoop",
			"newscan-online",
			"nhse",
			"NING",
			"nokia6682/",
			"nomad",
			"noyona",
			"nutch",
			"nzexplorer",
			"objectssearch",
			"occam",
			"omni",
			"open text",
			"openfind",
			"openintelligencedata",
			"orb search",
			"osis-project",
			"pack rat",
			"pageboy",
			"pagebull",
			"page_verifier",
			"panscient",
			"parasite",
			"partnersite",
			"patric",
			"pear.",
			"pegasus",
			"peregrinator",
			"pgp key agent",
			"phantom",
			"phpdig",
			"picosearch",
			"piltdownman",
			"pimptrain",
			"pinpoint",
			"pioneer",
			"piranha",
			"plumtreewebaccessor",
			"pogodak",
			"poirot",
			"pompos",
			"poppelsdorf",
			"poppi",
			"popular iconoclast",
			"psycheclone",
			"publisher",
			"python",
			"rambler",
			"raven search",
			"roach",
			"road runner",
			"roadhouse",
			"robbie",
			"robofox",
			"robozilla",
			"rules",
			"salty",
			"sbider",
			"scooter",
			"scoutjet",
			"scrubby",
			"search.",
			"searchprocess",
			"semanticdiscovery",
			"senrigan",
			"sg-scout",
			"shai'hulud",
			"shark",
			"shopwiki",
			"sidewinder",
			"sift",
			"silk",
			"simmany",
			"site searcher",
			"site valet",
			"sitetech-rover",
			"skymob.com",
			"sleek",
			"smartwit",
			"sna-",
			"snappy",
			"snooper",
			"sohu",
			"speedfind",
			"sphere",
			"sphider",
			"spinner",
			"spyder",
			"steeler/",
			"suke",
			"suntek",
			"supersnooper",
			"surfnomore",
			"sven",
			"sygol",
			"szukacz",
			"tach black widow",
			"tarantula",
			"templeton",
			"/teoma",
			"t-h-u-n-d-e-r-s-t-o-n-e",
			"theophrastus",
			"titan",
			"titin",
			"tkwww",
			"toutatis",
			"t-rex",
			"tutorgig",
			"twiceler",
			"twisted",
			"UnwindFetchor",
			"ucsd",
			"udmsearch",
			"url check",
			"updated",
			"vagabondo",
			"valkyrie",
			"verticrawl",
			"victoria",
			"vision-search",
			"volcano",
			"voyager/",
			"voyager-hc",
			"w3c_validator",
			"w3m2",
			"w3mir",
			"walker",
			"wallpaper",
			"wanderer",
			"wauuu",
			"wavefire",
			"web core",
			"web hopper",
			"web wombat",
			"webbandit",
			"webcatcher",
			"webcopy",
			"webfoot",
			"weblayers",
			"weblinker",
			"weblog monitor",
			"webmirror",
			"webmonkey",
			"webquest",
			"webreaper",
			"websitepulse",
			"websnarf",
			"webstolperer",
			"webvac",
			"webwalk",
			"webwatch",
			"webwombat",
			"webzinger",
			"wget",
			"whizbang",
			"whowhere",
			"wild ferret",
			"worldlight",
			"wwwc",
			"wwwster",
			"xenu",
			"xget",
			"xift",
			"xirq",
			"yandex",
			"yanga",
			"yeti",
			"yodao",
			"zao/",
			"zippp",
			"facebookexternalhit",
			"zyborg",
			"...."
		);

		foreach($spiders as $spider)
		{
			if(stripos($_SERVER['HTTP_USER_AGENT'],$spider)!==false)
			{
				return true;
			}
		}
		return false;
	}
?>
