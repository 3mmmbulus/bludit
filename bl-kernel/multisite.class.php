<?php

/*
 * Multi-Site Management Functions
 * Helper functions for managing multi-site configurations
 */

if (!defined('BLUDIT')) {
    die('Direct access not allowed');
}

class MultiSite {
    
    /**
     * Get current site information based on HTTP_HOST
     */
    public static function getCurrentSite() {
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        // Remove port if present
        $host = preg_replace('/:\d+$/', '', $host);
        
        $siteDir = PATH_ROOT . 'sites' . DS . $host;
        $defaultSiteDir = PATH_ROOT . 'sites' . DS . '_default';
        
        // Check if site-specific directory exists
        if (is_dir($siteDir) && file_exists($siteDir . DS . 'site.json')) {
            return array(
                'host' => $host,
                'siteDir' => $siteDir,
                'contentDir' => $siteDir . DS . 'bl-content',
                'configFile' => $siteDir . DS . 'site.json',
                'isDefault' => false
            );
        }
        
        // Fall back to default site
        if (is_dir($defaultSiteDir) && file_exists($defaultSiteDir . DS . 'site.json')) {
            return array(
                'host' => '_default',
                'siteDir' => $defaultSiteDir,
                'contentDir' => $defaultSiteDir . DS . 'bl-content',
                'configFile' => $defaultSiteDir . DS . 'site.json',
                'isDefault' => true
            );
        }
        
        return null;
    }
    
    /**
     * Load site configuration from site.json
     */
    public static function loadSiteConfig($configFile) {
        if (file_exists($configFile)) {
            $config = json_decode(file_get_contents($configFile), true);
            return $config ? $config : array();
        }
        return array();
    }
    
    /**
     * Save site configuration to site.json
     */
    public static function saveSiteConfig($configFile, $config) {
        return file_put_contents($configFile, json_encode($config, JSON_PRETTY_PRINT), LOCK_EX) !== false;
    }
    
    /**
     * List all available sites
     */
    public static function listSites() {
        $sites = array();
        $sitesDir = PATH_ROOT . 'sites';
        
        if (is_dir($sitesDir)) {
            $directories = scandir($sitesDir);
            foreach ($directories as $dir) {
                if ($dir !== '.' && $dir !== '..' && is_dir($sitesDir . DS . $dir)) {
                    $configFile = $sitesDir . DS . $dir . DS . 'site.json';
                    if (file_exists($configFile)) {
                        $config = self::loadSiteConfig($configFile);
                        $sites[$dir] = array(
                            'host' => $dir,
                            'config' => $config,
                            'isDefault' => $dir === '_default'
                        );
                    }
                }
            }
        }
        
        return $sites;
    }
    
    /**
     * Create a new site
     */
    public static function createSite($host, $config = array()) {
        $siteDir = PATH_ROOT . 'sites' . DS . $host;
        $contentDir = $siteDir . DS . 'bl-content';
        
        // Create directories
        if (!is_dir($siteDir)) {
            if (!mkdir($siteDir, DIR_PERMISSIONS, true)) {
                return false;
            }
        }
        
        if (!is_dir($contentDir)) {
            if (!mkdir($contentDir, DIR_PERMISSIONS, true)) {
                return false;
            }
        }
        
        // Create subdirectories
        $subdirs = array('databases', 'pages', 'uploads', 'tmp', 'workspaces');
        foreach ($subdirs as $subdir) {
            $path = $contentDir . DS . $subdir;
            if (!is_dir($path)) {
                mkdir($path, DIR_PERMISSIONS, true);
            }
        }
        
        // Create plugin databases directory
        $pluginDbDir = $contentDir . DS . 'databases' . DS . 'plugins';
        if (!is_dir($pluginDbDir)) {
            mkdir($pluginDbDir, DIR_PERMISSIONS, true);
        }
        
        // Create upload subdirectories
        $uploadSubdirs = array('pages', 'profiles', 'thumbnails');
        foreach ($uploadSubdirs as $subdir) {
            $path = $contentDir . DS . 'uploads' . DS . $subdir;
            if (!is_dir($path)) {
                mkdir($path, DIR_PERMISSIONS, true);
            }
        }
        
        // Default configuration
        $defaultConfig = array(
            'title' => 'New Site',
            'slogan' => 'A new Bludit site',
            'description' => 'Description for ' . $host,
            'language' => 'en',
            'timezone' => 'UTC',
            'theme' => 'alternative',
            'adminTheme' => 'booty',
            'domain' => 'http://' . $host,
            'host' => $host,
            'enabledPlugins' => array(),
            'settings' => array(
                'itemsPerPage' => 6,
                'orderBy' => 'date'
            )
        );
        
        // Merge with provided config
        $finalConfig = array_merge($defaultConfig, $config);
        
        // Save configuration
        $configFile = $siteDir . DS . 'site.json';
        return self::saveSiteConfig($configFile, $finalConfig);
    }
}