<?php

/*
 * Maigewan Multi-Site Domain Resolution
 * Unified domain resolution logic for multi-site support
 */

if (!defined('BLUDIT')) {
    die('Direct access not allowed');
}

class MaigewanSiteResolver {
    
    /**
     * Get site directory based on HTTP_HOST
     * @return string|null Site directory path or null if no site found
     */
    public static function getSiteDirectory() {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        // Remove port if present
        $host = preg_replace('/:\d+$/', '', $host);
        
        // List all existing site directories
        $sitesPath = PATH_ROOT . 'sites';
        $availableSites = array();
        
        if (is_dir($sitesPath)) {
            $directories = scandir($sitesPath);
            foreach ($directories as $dir) {
                if ($dir !== '.' && $dir !== '..' && $dir !== '_default' && is_dir($sitesPath . DS . $dir)) {
                    $siteConfigPath = $sitesPath . DS . $dir . DS . 'bl-content' . DS . 'databases' . DS . 'site.php';
                    if (file_exists($siteConfigPath)) {
                        $availableSites[] = $dir;
                    }
                }
            }
        }
        
        // First try: exact match with current host
        $exactSiteDir = $sitesPath . DS . $host;
        if (is_dir($exactSiteDir) && file_exists($exactSiteDir . DS . 'bl-content' . DS . 'databases' . DS . 'site.php')) {
            return $exactSiteDir;
        }
        
        // Second try: match main domain (handle subdomains)
        $mainDomain = self::getMainDomain($host);
        if ($mainDomain !== $host) {
            $mainSiteDir = $sitesPath . DS . $mainDomain;
            if (is_dir($mainSiteDir) && file_exists($mainSiteDir . DS . 'bl-content' . DS . 'databases' . DS . 'site.php')) {
                return $mainSiteDir;
            }
        }
        
        // Third try: fuzzy matching for similar domains
        foreach ($availableSites as $siteDomain) {
            $siteMainDomain = self::getMainDomain($siteDomain);
            $hostMainDomain = self::getMainDomain($host);
            
            if ($siteMainDomain === $hostMainDomain) {
                $siteDir = $sitesPath . DS . $siteDomain;
                return $siteDir;
            }
        }
        
        // Fall back to default site
        $defaultSiteDir = $sitesPath . DS . '_default';
        if (is_dir($defaultSiteDir) && file_exists($defaultSiteDir . DS . 'bl-content' . DS . 'databases' . DS . 'site.php')) {
            return $defaultSiteDir;
        }
        
        // Neither exists, needs installation
        return null;
    }
    
    /**
     * Extract main domain from subdomain
     * @param string $hostname The hostname to process
     * @return string Main domain
     */
    public static function getMainDomain($hostname) {
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
    
    /**
     * Get available sites
     * @return array List of available site directories
     */
    public static function getAvailableSites() {
        $sitesPath = PATH_ROOT . 'sites';
        $availableSites = array();
        
        if (is_dir($sitesPath)) {
            $directories = scandir($sitesPath);
            foreach ($directories as $dir) {
                if ($dir !== '.' && $dir !== '..' && $dir !== '_default' && is_dir($sitesPath . DS . $dir)) {
                    $siteConfigPath = $sitesPath . DS . $dir . DS . 'bl-content' . DS . 'databases' . DS . 'site.php';
                    if (file_exists($siteConfigPath)) {
                        $availableSites[] = $dir;
                    }
                }
            }
        }
        
        return $availableSites;
    }
    
    /**
     * Get site information array (for install.php compatibility)
     */
    public static function getSiteInfo() {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        $host = preg_replace('/:\d+$/', '', $host);
        $mainDomain = self::getMainDomain($host);
        $siteDir = __DIR__ . '/../sites/' . $mainDomain;
        
        return array(
            'host' => $host,
            'mainDomain' => $mainDomain,
            'siteDir' => $siteDir,
            'contentDir' => $siteDir . '/bl-content'
        );
    }
}