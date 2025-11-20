<?php
session_start();

// Default language is English
$DEFAULT_LANG = 'en';

// Supported languages
$SUPPORTED_LANGUAGES = ['en', 'ja'];

// Function to get the translation
function t($key) {
    global $lang;
    return isset($lang[$key]) ? $lang[$key] : $key;
}

// Get language from session or default
$current_lang = isset($_SESSION['lang']) ? $_SESSION['lang'] : $DEFAULT_LANG;

// Check for language change via GET parameter
if (isset($_GET['lang'])) {
    $new_lang = $_GET['lang'];
    if (in_array($new_lang, $SUPPORTED_LANGUAGES)) {
        $current_lang = $new_lang;
        $_SESSION['lang'] = $current_lang;
    }
}

// Include the language file
$lang_file = 'languages/' . $current_lang . '.php';
if (file_exists($lang_file)) {
    include($lang_file);
} else {
    // Fallback to default language if file not found
    include('languages/' . $DEFAULT_LANG . '.php');
}
?>