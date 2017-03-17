<?php

class	Util	{

				public	static	function	encrypt($plainString)	{
								return	md5($plainString	.	$plainString);
				}

				public	static	function	getRealIpAddr()	{
								if	(!empty($_SERVER['HTTP_CLIENT_IP']))	{			//check ip from share internet
												$ip	=	$_SERVER['HTTP_CLIENT_IP'];
								}
								elseif	(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))	{			//to check ip is pass from proxy
												$ip	=	$_SERVER['HTTP_X_FORWARDED_FOR'];
								}
								else	{
												$ip	=	$_SERVER['REMOTE_ADDR'];
								}
								return	$ip;
				}

				public	static	function	getSimpleRequest($requestString)	{
								$options	=	array(
												CURLOPT_RETURNTRANSFER	=>	true,	// return web page
												CURLOPT_HEADER	=>	false,	// don't return headers
												CURLOPT_USERAGENT	=>	'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1',
												CURLOPT_VERBOSE	=>	0,
												CURLOPT_SSL_VERIFYPEER	=>	0,
												CURLOPT_SSL_VERIFYHOST	=>	0,
												CURLOPT_FAILONERROR	=>	0,
												CURLOPT_FOLLOWLOCATION	=>	true,	// follow redirects
												CURLOPT_CONNECTTIMEOUT	=>	120,	// timeout on connect
												CURLOPT_TIMEOUT	=>	120,	// timeout on response
												CURLOPT_MAXREDIRS	=>	10	// stop after 10 redirects
								);
								$ch	=	curl_init($requestString);

								curl_setopt_array($ch,	$options);
								$output	=	curl_exec($ch);

								curl_close($ch);
								$decoded	=	json_decode($output,	true);

								return	$decoded;
				}

}
