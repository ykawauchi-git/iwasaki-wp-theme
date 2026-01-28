<?php
/****************************************
		 デバイスの条件分岐
*****************************************/

/*スマホ・PC＆タブレット表示切り替え　is_mobile() */
function is_mobile() {
    $useragents = array(
        'iPhone',          // iPhone
        'iPod',            // iPod touch
        '^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
        'dream',           // Pre 1.5 Android
        'CUPCAKE',         // 1.5+ Android
        'blackberry9500',  // Storm
        'blackberry9530',  // Storm
        'blackberry9520',  // Storm v2
        'blackberry9550',  // Storm v2
        'blackberry9800',  // Torch
        'webOS',           // Palm Pre Experimental
        'incognito',       // Other iPhone browser
        'webmate'          // Other iPhone browser
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

//スマートフォンの判別
function wp_is_phone() {
	$ua = $_SERVER['HTTP_USER_AGENT'];
	if (   strpos($ua, 'iPhone') 							// iPhone
		|| strpos($ua, 'iPod') 								// iPod touch
		||(strpos($ua, 'Android') && strpos($ua, 'Mobile'))	// Android搭載スマホ
		||(strpos($ua, 'Windows') && strpos($ua, 'Mobile')) // Windows Phone
		||(strpos($ua, 'firefox') && strpos($ua, 'Mobile')) // firefox製ブラウザ
		|| strpos($ua, 'Opera Mini')						// Androidで人気のブラウザ
		|| strpos($ua, 'Opera Mobi')						// Androidで人気のブラウザ
		|| strpos($ua, 'webmate') 							// その他の Other iPhone browser
		|| strpos($uat,'incognito') 						// その他の iPhone browser
	) {
		return true;
	} else {
		return false;
	}
}
//タブレットの判別
function wp_is_tablet() {
	$uat = $_SERVER['HTTP_USER_AGENT'];
	if ( strpos($uat, 'iPad') // iPad
		|| strpos($uat, 'iPad Pro') // iPad Pro
		||(strpos($uat, 'Android') && strpos($uat, 'Mobile')=== false ) // Android搭載タブレット
		|| strpos($uat, 'windows touch') //windows touch
		|| strpos($uat, 'Kindle') // Kindle
		|| strpos($uat, 'Silk') // Kindle に付属の Amazon 製ブラウザ
		|| strpos($uat, 'firefox tablet') //firefox tablet
		|| strpos($uat, 'WebOS') // Palm
	) {
		return true;
	} else {
		return false;
	}
}
