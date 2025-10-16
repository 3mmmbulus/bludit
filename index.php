<?php

/*
 * Bludit Multi-Site
 * https://www.bludit.com
 * Modified for multi-site support
 * Author Diego Najar
 * Bludit is opensource software licensed under the MIT license.
*/

// Multi-site logic: Determine site directory based on HTTP_HOST
function getSiteDirectory() {
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
    // Remove port if present
    $host = preg_replace('/:\d+$/', '', $host);
    
    $siteDir = __DIR__ . '/sites/' . $host;
    $defaultSiteDir = __DIR__ . '/sites/_default';
    
    // Check if site-specific directory exists
    if (is_dir($siteDir) && file_exists($siteDir . '/bl-content/databases/site.php')) {
        return $siteDir;
    }
    
    // Fall back to default site
    if (is_dir($defaultSiteDir) && file_exists($defaultSiteDir . '/bl-content/databases/site.php')) {
        return $defaultSiteDir;
    }
    
    // Neither exists, needs installation
    return null;
}

$siteDirectory = getSiteDirectory();

// Check if any site is installed
if ($siteDirectory === null) {
    $base = dirname($_SERVER['SCRIPT_NAME']);
    $base = rtrim($base, '/');
    $base = rtrim($base, '\\'); // Workaround for Windows Servers
    header('Location:'.$base.'/install.php');
    exit('<a href="./install.php">Install Bludit first.</a>');
}

// Set the site-specific content path
define('SITE_PATH_CONTENT', $siteDirectory . '/bl-content/');

// Load time init
$loadTime = microtime(true);

// Security constant
define('BLUDIT', true);

// Directory separator
define('DS', DIRECTORY_SEPARATOR);

// PHP paths for init
define('PATH_ROOT', __DIR__.DS);
define('PATH_BOOT', PATH_ROOT.'bl-kernel'.DS.'boot'.DS);

// Init
require(PATH_BOOT.'init.php');

// Admin area
if ($url->whereAmI()==='admin') {
	require(PATH_BOOT.'admin.php');
}
// Site
else {
	require(PATH_BOOT.'site.php');
}
