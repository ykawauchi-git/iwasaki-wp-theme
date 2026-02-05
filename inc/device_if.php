<?php
/**
 * Device-Specific Conditional Logic
 * 
 * Provides helper functions to detect the user's device based on the User-Agent string.
 */

/**
 * Detects if the device is a mobile phone (excluding tablets in most cases).
 * Historically used for switching between Mobile and PC/Tablet layouts.
 * 
 * @return bool True if mobile, false otherwise.
 */
function is_mobile()
{
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
    $pattern = '/' . implode('|', $useragents) . '/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

/**
 * Specifically identifies smartphones.
 * Covers a wide range of mobile browsers including Windows Phone and Firefox Mobile.
 * 
 * @return bool True if smartphone, false otherwise.
 */
function wp_is_phone()
{
    $ua = $_SERVER['HTTP_USER_AGENT'];
    if (
        strpos($ua, 'iPhone') 							// iPhone
        || strpos($ua, 'iPod') 								// iPod touch
        || (strpos($ua, 'Android') && strpos($ua, 'Mobile'))	// Android smartphone
        || (strpos($ua, 'Windows') && strpos($ua, 'Mobile')) // Windows Phone
        || (strpos($ua, 'firefox') && strpos($ua, 'Mobile')) // Firefox Mobile
        || strpos($ua, 'Opera Mini')						// Opera Mini
        || strpos($ua, 'Opera Mobi')						// Opera Mobile
        || strpos($ua, 'webmate') 							// Other mobile
        || strpos($ua, 'incognito') 						// Other mobile
    ) {
        return true;
    } else {
        return false;
    }
}

/**
 * Specifically identifies tablets.
 * 
 * @return bool True if tablet, false otherwise.
 */
function wp_is_tablet()
{
    $uat = $_SERVER['HTTP_USER_AGENT'];
    if (
        strpos($uat, 'iPad') // iPad
        || strpos($uat, 'iPad Pro') // iPad Pro
        || (strpos($uat, 'Android') && strpos($uat, 'Mobile') === false) // Android tablet
        || strpos($uat, 'windows touch') // Windows touch devices
        || strpos($uat, 'Kindle') // Kindle
        || strpos($uat, 'Silk') // Amazon Silk
        || strpos($uat, 'firefox tablet') // Firefox tablet
        || strpos($uat, 'WebOS') // Palm WebOS
    ) {
        return true;
    } else {
        return false;
    }
}