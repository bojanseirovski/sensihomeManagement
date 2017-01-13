<?php

function	runQuery($con,	$query,	$args,	$returnResult	=	false)	{
				$return	=	null;

				$stmt	=	$con->prepare($query);
				if	(isset($args))	{
								$stmt->execute($args);
				}
				else	{
								$stmt->execute();
				}
				if	($returnResult)	{
								$return	=	$stmt->fetchAll(\PDO::FETCH_ASSOC);
				}

				return	$return;
}

function	getSimpleRequest($requestString)	{
				$options	=	array(CURLOPT_RETURNTRANSFER	=>	true,	// return web page
								CURLOPT_HEADER	=>	false,	// don't return headers
								CURLOPT_USERAGENT	=>	'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1',
								CURLOPT_VERBOSE	=>	0,
								CURLOPT_SSL_VERIFYPEER	=>	0,
								CURLOPT_SSL_VERIFYHOST	=>	0,
								CURLOPT_FAILONERROR	=>	0,
								CURLOPT_FOLLOWLOCATION	=>	true,	// follow redirects
								CURLOPT_ENCODING	=>	"",	// handle compressed
								CURLOPT_USERAGENT	=>	"test",	// who am i
								CURLOPT_AUTOREFERER	=>	true,	// set referer on redirect
								CURLOPT_CONNECTTIMEOUT	=>	120,	// timeout on connect
								CURLOPT_TIMEOUT	=>	120,	// timeout on response
								CURLOPT_MAXREDIRS	=>	10);	// stop after 10 redirects
				$ch	=	curl_init($requestString);
				curl_setopt_array($ch,	$options);
				$output	=	curl_exec($ch);
				curl_close($ch);
				$decoded = json_decode($output,true);
				return	$output;
}
