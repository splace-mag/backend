<?php

$useragent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match("/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine
|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|
panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus
|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i",$useragent))

{
	header( 'Location: /2/splace' );
//header( 'Location: /2/splace' );
} else {
header( 'Location: /desktop/index.html' );
}

?>