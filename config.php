<?php

// Choose your translate file name located in translation/filename.json
// You can add your own translation.
$Website_Translate = 'en';

// If you store your website on a subfolder domain,
// Leave empty if using the domain as normal.
// Example: cs2.lielxd.com/cs2/ | then we need here cs2 ↓
$Website_Subfolder = '';

// Place here your domain if steam authorize not working properly,
// if its working good then leave it empty.
$Website_Domain = '';

// Enable this if you want categories else it will display all weapons.
$Website_UseCategories = true;

// You can choose your own theme color
// false/empty - will use the default color.
// any html acceptable color - will display that color.
// true - this will make get a random color.
$Website_MainColor = true;

// Select which settings you want in the menu.
$Website_Settings = [
    'language' => true,  // user can select his own language.
    'theme' => true      // user can change his own color theme.
];

// Write here your steam api key, get one from here: https://steamcommunity.com/dev/apikey.
$SteamAPI_KEY = '';

// Write here your database login details.
$DatabaseInfo = [
    'hostname' => '127.0.0.1',
    'database' => 'cs2',
    'username' => 'root',
    'password' => '',
    'port' => '3306'
];

// -----------------
// Don't touch here.
// -----------------
if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}

$dirPath = $_SERVER['DOCUMENT_ROOT'].'/'.$Website_Subfolder;
if($Website_Settings['language'] && isset($_COOKIE['cs2weaponpaints_lielxd_language']) && file_exists($dirPath."/translation/".$_COOKIE['cs2weaponpaints_lielxd_language'].".json")) {
    $translations = json_decode(file_get_contents($dirPath."/translation/".$_COOKIE['cs2weaponpaints_lielxd_language'].".json"));
}else if(file_exists($dirPath."/translation/$Website_Translate.json")) {
    $translations = json_decode(file_get_contents($dirPath."/translation/$Website_Translate.json"));
}else if(file_exists($dirPath."/translation/en.json")) {
    $translations = json_decode(file_get_contents($dirPath."/translation/en.json"));
}else {
    echo "No translations have found<br>contact support.";
    die;
}

$bodyStyle = "";
if($translations->invert_direction) {
    $bodyStyle .= "direction:rtl;";
}
if($Website_Settings['theme'] && isset($_COOKIE['cs2weaponpaints_lielxd_theme'])) {
    $Website_MainColor = $_COOKIE['cs2weaponpaints_lielxd_theme'];
    $bodyStyle .= "--main-color: $Website_MainColor;";
}else if($Website_MainColor === true) {
    $Website_MainColor = rand(111111, 999999);
    $bodyStyle .= "--main-color: #$Website_MainColor;";
}else {
    if(isset($Website_MainColor) && !empty($Website_MainColor)) {
        $bodyStyle .= "--main-color: $Website_MainColor;";
    }
}
if(!empty($bodyStyle)) {
    $bodyStyle = "style='$bodyStyle'";
}

?>