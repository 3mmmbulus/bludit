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
    
    // Function to extract main domain from subdomain
    function getMainDomain($hostname) {
        // Remove www. prefix if present
        if (strpos($hostname, 'www.') === 0) {
            $hostname = substr($hostname, 4);
        }
        
        // For other subdomains (m., api., etc.), extract the main domain
        $parts = explode('.', $hostname);
        if (count($parts) >= 2) {
            // For domains like m.example.com, return example.com
            // For domains like example.com, return example.com
            if (count($parts) > 2) {
                // This might be a subdomain, try to get the main domain
                $mainDomain = implode('.', array_slice($parts, -2));
                return $mainDomain;
            }
        }
        
        return $hostname;
    }
    
    // List all existing site directories
    $sitesPath = __DIR__ . '/sites';
    $availableSites = array();
    
    if (is_dir($sitesPath)) {
        $directories = scandir($sitesPath);
        foreach ($directories as $dir) {
            if ($dir !== '.' && $dir !== '..' && $dir !== '_default' && is_dir($sitesPath . '/' . $dir)) {
                $siteConfigPath = $sitesPath . '/' . $dir . '/bl-content/databases/site.php';
                if (file_exists($siteConfigPath)) {
                    $availableSites[] = $dir;
                }
            }
        }
    }
    
    // First try: exact match with current host
    $exactSiteDir = $sitesPath . '/' . $host;
    if (is_dir($exactSiteDir) && file_exists($exactSiteDir . '/bl-content/databases/site.php')) {
        return $exactSiteDir;
    }
    
    // Second try: match main domain (handle subdomains)
    $mainDomain = getMainDomain($host);
    if ($mainDomain !== $host) {
        $mainSiteDir = $sitesPath . '/' . $mainDomain;
        if (is_dir($mainSiteDir) && file_exists($mainSiteDir . '/bl-content/databases/site.php')) {
            return $mainSiteDir;
        }
    }
    
    // Third try: fuzzy matching for similar domains
    foreach ($availableSites as $siteDomain) {
        $siteMainDomain = getMainDomain($siteDomain);
        $hostMainDomain = getMainDomain($host);
        
        if ($siteMainDomain === $hostMainDomain) {
            $siteDir = $sitesPath . '/' . $siteDomain;
            return $siteDir;
        }
    }
    
    // Fall back to default site
    $defaultSiteDir = $sitesPath . '/_default';
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
