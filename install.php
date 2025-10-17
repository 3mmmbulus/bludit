<?php

/*
 * Bludit
 * https://www.bludit.com
 * Author Diego Najar
 * Bludit is opensource software licensed under the MIT license.
*/

// Check PHP version
if (version_compare(phpversion(), '5.6', '<')) {
	$errorText = 'Current PHP version ' . phpversion() . ', you need > 5.6.';
	error_log('[ERROR] ' . $errorText, 0);
	exit($errorText);
}

// Check PHP modules
$modulesRequired = array('mbstring', 'json', 'gd', 'dom');
$modulesRequiredExit = false;
$modulesRequiredMissing = '';
foreach ($modulesRequired as $module) {
	if (!extension_loaded($module)) {
		$errorText = 'PHP module <b>' . $module . '</b> is not installed.';
		error_log('[ERROR] ' . $errorText, 0);

		$modulesRequiredExit = true;
		$modulesRequiredMissing .= $errorText . PHP_EOL;
	}
}
if ($modulesRequiredExit) {
	echo 'PHP modules missing:';
	echo $modulesRequiredMissing;
	echo '';
	echo '<a href="https://www.maigewan.com/getting-started/requirements">请阅读 Maigewan 要求</a>.';
	exit(0);
}

// Security constant
define('BLUDIT', true);

// Directory separator
define('DS', DIRECTORY_SEPARATOR);

// Include the unified site resolver
require_once(__DIR__ . '/bl-kernel/site-resolver.class.php');

// Multi-site support: Use unified site resolver
$siteInfo = MaigewanSiteResolver::getSiteInfo();

// PHP paths
define('PATH_ROOT',		__DIR__ . DS);
define('PATH_SITES',		PATH_ROOT . 'sites' . DS);
define('PATH_SITE',		$siteInfo['siteDir'] . DS);
define('PATH_CONTENT',		$siteInfo['contentDir'] . DS);
define('PATH_KERNEL',		PATH_ROOT . 'bl-kernel' . DS);
define('PATH_LANGUAGES',	PATH_ROOT . 'bl-languages' . DS);
define('PATH_UPLOADS',		PATH_CONTENT . 'uploads' . DS);
define('PATH_TMP',		PATH_CONTENT . 'tmp' . DS);
define('PATH_PAGES',		PATH_CONTENT . 'pages' . DS);
define('PATH_WORKSPACES',	PATH_CONTENT . 'workspaces' . DS);
define('PATH_DATABASES',	PATH_CONTENT . 'databases' . DS);
define('PATH_PLUGINS_DATABASES', PATH_CONTENT . 'databases' . DS . 'plugins' . DS);
define('PATH_UPLOADS_PROFILES',	PATH_UPLOADS . 'profiles' . DS);
define('PATH_UPLOADS_THUMBNAILS', PATH_UPLOADS . 'thumbnails' . DS);
define('PATH_UPLOADS_PAGES',	PATH_UPLOADS . 'pages' . DS);
define('PATH_HELPERS',		PATH_KERNEL . 'helpers' . DS);
define('PATH_ABSTRACT',		PATH_KERNEL . 'abstract' . DS);

// Protecting against Symlink attacks
define('CHECK_SYMBOLIC_LINKS', TRUE);

// Filename for pages
define('FILENAME', 'index.txt');

// Domain and protocol
define('DOMAIN', $_SERVER['HTTP_HOST']);

if (!empty($_SERVER['HTTPS'])) {
	define('PROTOCOL', 'https://');
} else {
	define('PROTOCOL', 'http://');
}

// Base URL
// Change the base URL or leave it empty if you want to Bludit try to detect the base URL.
$base = '';

if (!empty($_SERVER['DOCUMENT_ROOT']) && !empty($_SERVER['SCRIPT_NAME']) && empty($base)) {
	$base = str_replace($_SERVER['DOCUMENT_ROOT'], '', $_SERVER['SCRIPT_NAME']);
	$base = dirname($base);
} elseif (empty($base)) {
	$base = empty($_SERVER['SCRIPT_NAME']) ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
	$base = dirname($base);
}

if (strpos($_SERVER['REQUEST_URI'], $base) !== 0) {
	$base = '/';
} elseif ($base != DS) {
	$base = trim($base, '/');
	$base = '/' . $base . '/';
} else {
	// Workaround for Windows Web Servers
	$base = '/';
}

define('HTML_PATH_ROOT', $base);

// Log separator
define('LOG_SEP', ' | ');

// JSON
if (!defined('JSON_PRETTY_PRINT')) {
	define('JSON_PRETTY_PRINT', 128);
}

// Database format date
define('DB_DATE_FORMAT', 'Y-m-d H:i:s');

// Charset, default UTF-8.
define('CHARSET', 'UTF-8');

// Default language file
define('DEFAULT_LANGUAGE_FILE', 'en.json');

// Set internal character encoding
mb_internal_encoding(CHARSET);

// Set HTTP output character encoding
mb_http_output(CHARSET);

// Directory permissions
define('DIR_PERMISSIONS', 0755);

// --- PHP Classes ---
include(PATH_ABSTRACT . 'dbjson.class.php');
include(PATH_HELPERS . 'sanitize.class.php');
include(PATH_HELPERS . 'valid.class.php');
include(PATH_HELPERS . 'text.class.php');
include(PATH_HELPERS . 'log.class.php');
include(PATH_HELPERS . 'date.class.php');
include(PATH_KERNEL . 'language.class.php');

// --- LANGUAGE and LOCALE ---
// Try to detect the language from browser or headers
$languageFromHTTP = 'en';
$localeFromHTTP = 'en_US';

if (isset($_GET['language'])) {
	$languageFromHTTP = Sanitize::html($_GET['language']);
} else {
	// Try to detect the language browser
	$languageFromHTTP = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

	// Try to detect the locale
	if (function_exists('locale_accept_from_http')) {
		$localeFromHTTP = locale_accept_from_http($_SERVER['HTTP_ACCEPT_LANGUAGE']);
	}
}

$finalLanguage = 'en';
$languageFiles = getLanguageList();
foreach ($languageFiles as $fname => $native) {
	if (($languageFromHTTP == $fname) || ($localeFromHTTP == $fname)) {
		$finalLanguage = $fname;
	}
}

$L = $language = new Language($finalLanguage);

// Set locale
setlocale(LC_ALL, $localeFromHTTP);

// --- TIMEZONE ---

// Check if timezone is defined in php.ini
$iniDate = ini_get('date.timezone');
if (empty($iniDate)) {
	// Timezone not defined in php.ini, then set UTC as default.
	date_default_timezone_set('UTC');
}

// ============================================================================
// FUNCTIONS
// ============================================================================

// Returns an array with all languages
function getLanguageList()
{
	$files = glob(PATH_LANGUAGES . '*.json');
	$tmp = array();
	foreach ($files as $file) {
		$t = new dbJSON($file, false);
		$native = $t->db['language-data']['native'];
		$locale = basename($file, '.json');
		$tmp[$locale] = $native;
	}

	return $tmp;
}

// 检查是否已安装 Maigewan
function alreadyInstalled()
{
	// Check if site database exists for current domain
	return file_exists(PATH_DATABASES . 'site.php');
}

// Check write permissions and .htaccess file
function checkSystem()
{
	$output = array();

	// Try to create .htaccess
	$htaccessContent = 'AddDefaultCharset UTF-8

<IfModule mod_rewrite.c>

# Enable rewrite rules
RewriteEngine on

# Base directory
RewriteBase ' . HTML_PATH_ROOT . '

# Deny direct access to the next directories
RewriteRule ^bl-content/(databases|workspaces|pages|tmp)/.*$ - [R=404,L]

# All URL process by index.php
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*) index.php [PT,L]

</IfModule>';

	if (!file_put_contents(PATH_ROOT . '.htaccess', $htaccessContent)) {
		if (!empty($_SERVER['SERVER_SOFTWARE'])) {
			$webserver = Text::lowercase($_SERVER['SERVER_SOFTWARE']);
			if (Text::stringContains($webserver, 'apache') || Text::stringContains($webserver, 'litespeed')) {
				$errorText = 'Missing file, upload the file .htaccess';
				error_log('[ERROR] ' . $errorText, 0);
				array_push($output, $errorText);
			}
		}
	}

	// Check mod_rewrite module
	if (function_exists('apache_get_modules')) {
		if (!in_array('mod_rewrite', apache_get_modules())) {
			$errorText = 'Module mod_rewrite is not installed or loaded.';
			error_log('[ERROR] ' . $errorText, 0);
			array_push($output, $errorText);
		}
	}

	// Try to create the sites directory structure
	@mkdir(PATH_SITES, DIR_PERMISSIONS, true);
	@mkdir(PATH_SITE, DIR_PERMISSIONS, true);
	@mkdir(PATH_CONTENT, DIR_PERMISSIONS, true);

	// Check if the directory content is writeable.
	if (!is_writable(PATH_CONTENT)) {
		$errorText = 'Writing test failure, check site directory "' . PATH_CONTENT . '" permissions.';
		error_log('[ERROR] ' . $errorText, 0);
		array_push($output, $errorText);
	}

	return $output;
}

// 安装 Maigewan
function install($adminPassword, $timezone)
{
	global $L;

	if (!date_default_timezone_set($timezone)) {
		date_default_timezone_set('UTC');
	}

	$currentDate = Date::current(DB_DATE_FORMAT);

	// ============================================================================
	// Create directories
	// ============================================================================

	// Directories for initial pages
	$pagesToInstall = array('example-page-1-slug', 'example-page-2-slug', 'example-page-3-slug', 'example-page-4-slug');
	foreach ($pagesToInstall as $page) {
		if (!mkdir(PATH_PAGES . $L->get($page), DIR_PERMISSIONS, true)) {
			$errorText = 'Error when trying to created the directory=>' . PATH_PAGES . $L->get($page);
			error_log('[ERROR] ' . $errorText, 0);
		}
	}

	// Directories for initial plugins
	$pluginsToInstall = array('tinymce', 'about', 'visits-stats', 'robots', 'canonical', 'alternative');
	foreach ($pluginsToInstall as $plugin) {
		if (!mkdir(PATH_PLUGINS_DATABASES . $plugin, DIR_PERMISSIONS, true)) {
			$errorText = 'Error when trying to created the directory=>' . PATH_PLUGINS_DATABASES . $plugin;
			error_log('[ERROR] ' . $errorText, 0);
		}
	}

	// Directories for upload files
	if (!mkdir(PATH_UPLOADS_PROFILES, DIR_PERMISSIONS, true)) {
		$errorText = 'Error when trying to created the directory=>' . PATH_UPLOADS_PROFILES;
		error_log('[ERROR] ' . $errorText, 0);
	}

	if (!mkdir(PATH_UPLOADS_THUMBNAILS, DIR_PERMISSIONS, true)) {
		$errorText = 'Error when trying to created the directory=>' . PATH_UPLOADS_THUMBNAILS;
		error_log('[ERROR] ' . $errorText, 0);
	}

	if (!mkdir(PATH_TMP, DIR_PERMISSIONS, true)) {
		$errorText = 'Error when trying to created the directory=>' . PATH_TMP;
		error_log('[ERROR] ' . $errorText, 0);
	}

	if (!mkdir(PATH_WORKSPACES, DIR_PERMISSIONS, true)) {
		$errorText = 'Error when trying to created the directory=>' . PATH_WORKSPACES;
		error_log('[ERROR] ' . $errorText, 0);
	}

	if (!mkdir(PATH_UPLOADS_PAGES, DIR_PERMISSIONS, true)) {
		$errorText = 'Error when trying to created the directory=>' . PATH_UPLOADS_PAGES;
		error_log('[ERROR] ' . $errorText, 0);
	}

	// ============================================================================
	// Create files
	// ============================================================================

	$dataHead = "<?php defined('BLUDIT') or die('Maigewan CMS.'); ?>" . PHP_EOL;

	$data = array();
	$slugs = array();
	$nextDate = $currentDate;
	foreach ($pagesToInstall as $page) {

		$slug = $page;
		$title = Text::replace('slug', 'title', $slug);
		$content = Text::replace('slug', 'content', $slug);
		$nextDate = Date::offset($nextDate, DB_DATE_FORMAT, '-1 minute');

		$data[$L->get($slug)] = array(
			'title' => $L->get($title),
			'description' => '',
			'username' => 'admin',
			'tags' => array(),
			'type' => (($slug == 'example-page-4-slug') ? 'static' : 'published'),
			'date' => $nextDate,
			'dateModified' => '',
			'allowComments' => true,
			'position' => 1,
			'coverImage' => '',
			'md5file' => '',
			'category' => 'general',
			'uuid' => md5(uniqid()),
			'parent' => '',
			'template' => '',
			'noindex' => false,
			'nofollow' => false,
			'noarchive' => false
		);

		array_push($slugs, $slug);

		file_put_contents(PATH_PAGES . $L->get($slug) . DS . FILENAME, $L->get($content), LOCK_EX);
	}
	file_put_contents(PATH_DATABASES . 'pages.php', $dataHead . json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);

	// File site.php

	// 如果 Maigewan 未安装在文件夹内, the URL doesn't need finish with /
	// Example (root): https://domain.com
	// Example (inside a folder): https://domain.com/folder/
	if (HTML_PATH_ROOT == '/') {
		$siteUrl = PROTOCOL . DOMAIN;
	} else {
		$siteUrl = PROTOCOL . DOMAIN . HTML_PATH_ROOT;
	}
	$data = array(
		'title' => 'MAIGEWAN',
		'slogan' => $L->get('welcome-to-bludit'),
		'description' => $L->get('congratulations-you-have-successfully-installed-your-bludit'),
		'footer' => 'Copyright © ' . Date::current('Y'),
		'itemsPerPage' => 6,
		'language' => $L->currentLanguage(),
		'locale' => $L->locale(),
		'timezone' => $timezone,
		'theme' => 'alternative',
		'adminTheme' => 'booty',
		'homepage' => '',
		'pageNotFound' => '',
		'uriPage' => '/',
		'uriTag' => '/tag/',
		'uriCategory' => '/category/',
		'uriBlog' => '',
		'url' => $siteUrl,
		'emailFrom' => 'no-reply@' . DOMAIN,
		'orderBy' => 'date',
		'currentBuild' => '0',
		'twitter' => 'https://twitter.com/maigewan',
		'facebook' => 'https://www.facebook.com/maigewan',
		'codepen' => '',
		'github' => 'https://github.com/maigewan',
		'instagram' => '',
		'gitlab' => '',
		'linkedin' => '',
		'xing' => '',
		'telegram' => '',
		'dateFormat' => 'F j, Y',
		'extremeFriendly' => true,
		'autosaveInterval' => 2,
		'titleFormatHomepage' => '{{site-slogan}} | {{site-title}}',
		'titleFormatPages' => '{{page-title}} | {{site-title}}',
		'titleFormatCategory' => '{{category-name}} | {{site-title}}',
		'titleFormatTag' => '{{tag-name}} | {{site-title}}',
		'imageRestrict' => true,
		'imageRelativeToAbsolute' => false
	);
	file_put_contents(PATH_DATABASES . 'site.php', $dataHead . json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);

	// File users.php
	$salt = uniqid();
	$passwordHash = sha1($adminPassword . $salt);
	$tokenAuth = md5(uniqid() . time() . DOMAIN);

	$data = array(
		'admin' => array(
			'nickname' => 'Admin',
			'firstName' => $L->get('Administrator'),
			'lastName' => '',
			'role' => 'admin',
			'password' => $passwordHash,
			'salt' => $salt,
			'email' => '',
			'registered' => $currentDate,
			'tokenRemember' => '',
			'tokenAuth' => $tokenAuth,
			'tokenAuthTTL' => '2009-03-15 14:00',
			'twitter' => '',
			'facebook' => '',
			'instagram' => '',
			'codepen' => '',
			'linkedin' => '',
			'xing' => '',
			'telegram' => '',
			'github' => '',
			'gitlab' => ''
		)
	);
	file_put_contents(PATH_DATABASES . 'users.php', $dataHead . json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);

	// File syslog.php
	$data = array(
		array(
			'date' => $currentDate,
			'dictionaryKey' => 'welcome-to-bludit',
			'notes' => '',
			'idExecution' => uniqid(),
			'method' => 'POST',
			'username' => 'admin'
		)
	);
	file_put_contents(PATH_DATABASES . 'syslog.php', $dataHead . json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);

	// File security.php
	$data = array(
		'minutesBlocked' => 5,
		'numberFailuresAllowed' => 10,
		'blackList' => array()
	);
	file_put_contents(PATH_DATABASES . 'security.php', $dataHead . json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);

	// File categories.php
	$data = array(
		'general' => array('name' => 'General', 'description' => '', 'template' => '', 'list' => $slugs),
		'music' => array('name' => 'Music', 'description' => '', 'template' => '', 'list' => array()),
		'videos' => array('name' => 'Videos', 'description' => '', 'template' => '', 'list' => array())
	);
	file_put_contents(PATH_DATABASES . 'categories.php', $dataHead . json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);

	// File tags.php
	$data = array();
	file_put_contents(PATH_DATABASES . 'tags.php', $dataHead . json_encode($data, JSON_PRETTY_PRINT), LOCK_EX);

	// File plugins/about/db.php
	file_put_contents(
		PATH_PLUGINS_DATABASES . 'about' . DS . 'db.php',
		$dataHead . json_encode(
			array(
				'position' => 1,
				'label' => $L->get('About'),
				'text' => $L->get('this-is-a-brief-description-of-yourself-our-your-site')
			),
			JSON_PRETTY_PRINT
		),
		LOCK_EX
	);

	// File plugins/visits-stats/db.php
	file_put_contents(
		PATH_PLUGINS_DATABASES . 'visits-stats' . DS . 'db.php',
		$dataHead . json_encode(
			array(
				'numberOfDays' => 7,
				'label' => $L->get('Visits'),
				'excludeAdmins' => false,
				'position' => 1
			),
			JSON_PRETTY_PRINT
		),
		LOCK_EX
	);
	mkdir(PATH_WORKSPACES . 'visits-stats', DIR_PERMISSIONS, true);

	// File plugins/tinymce/db.php
	file_put_contents(
		PATH_PLUGINS_DATABASES . 'tinymce' . DS . 'db.php',
		$dataHead . json_encode(
			array(
				'position' => 1,
				'toolbar1' => 'formatselect bold italic forecolor backcolor removeformat | bullist numlist table | blockquote alignleft aligncenter alignright | link unlink pagebreak image code',
				'toolbar2' => '',
				'plugins' => 'code autolink image link pagebreak advlist lists textpattern table'
			),
			JSON_PRETTY_PRINT
		),
		LOCK_EX
	);

	// File plugins/canonical/db.php
	file_put_contents(
		PATH_PLUGINS_DATABASES . 'canonical' . DS . 'db.php',
		$dataHead . json_encode(
			array(
				'position' => 1
			),
			JSON_PRETTY_PRINT
		),
		LOCK_EX
	);

	// File plugins/alternative/db.php
	file_put_contents(
		PATH_PLUGINS_DATABASES . 'alternative' . DS . 'db.php',
		$dataHead . json_encode(
			array(
				'googleFonts' => false,
				'showPostInformation' => false,
				'dateFormat' => 'relative',
				'position' => 1
			),
			JSON_PRETTY_PRINT
		),
		LOCK_EX
	);

	// File plugins/robots/db.php
	file_put_contents(
		PATH_PLUGINS_DATABASES . 'robots' . DS . 'db.php',
		$dataHead . json_encode(
			array(
				'position' => 1,
				'robotstxt' => 'User-agent: *' . PHP_EOL . 'Allow: /'
			),
			JSON_PRETTY_PRINT
		),
		LOCK_EX
	);

	// Create site.json configuration file for multi-site support
	global $siteInfo;
	
	// 如果 Maigewan 未安装在文件夹内, the URL doesn't need finish with /
	// Example (root): https://domain.com
	// Example (inside a folder): https://domain.com/folder/
	if (HTML_PATH_ROOT == '/') {
		$siteUrl = PROTOCOL . DOMAIN;
	} else {
		$siteUrl = PROTOCOL . DOMAIN . HTML_PATH_ROOT;
	}
	
	$siteConfig = array(
		'title' => 'MAIGEWAN',
		'slogan' => $L->get('welcome-to-bludit'),
		'description' => $L->get('congratulations-you-have-successfully-installed-your-bludit'),
		'language' => $L->currentLanguage(),
		'timezone' => $timezone,
		'theme' => 'alternative',
		'adminTheme' => 'booty',
		'domain' => $siteUrl,
		'host' => $siteInfo['host'],
		'enabledPlugins' => array(
			'about' => true,
			'alternative' => true
		),
		'settings' => array(
			'itemsPerPage' => 6,
			'orderBy' => 'date'
		)
	);
	
	file_put_contents(PATH_SITE . 'site.json', json_encode($siteConfig, JSON_PRETTY_PRINT), LOCK_EX);

	return true;
}

function redirect($url)
{
	if (!headers_sent()) {
		header("Location:" . $url, TRUE, 302);
		exit;
	}

	exit('<meta http-equiv="refresh" content="0; url="' . $url . '">');
}

// ============================================================================
// MAIN
// ============================================================================

if (alreadyInstalled()) {
	// 创建美观的已安装提示页面
	$siteName = 'Maigewan 站点';
	$siteSlogan = '强大的多站点内容管理系统';
	$siteUrl = HTML_PATH_ROOT;
	
	// 尝试读取站点信息
	if (file_exists(PATH_DATABASES . 'site.php')) {
		$siteContent = file_get_contents(PATH_DATABASES . 'site.php');
		// 移除 PHP 标签，获取 JSON 数据
		$jsonStart = strpos($siteContent, '{');
		if ($jsonStart !== false) {
			$jsonData = substr($siteContent, $jsonStart);
			$siteData = json_decode($jsonData, true);
			if ($siteData && isset($siteData['title'])) {
				$siteName = $siteData['title'];
				if (isset($siteData['slogan'])) {
					$siteSlogan = $siteData['slogan'];
				}
			}
		}
	}
	
	// 获取当前域名信息
	$currentDomain = $_SERVER['HTTP_HOST'] ?? 'localhost';
	$adminUrl = $siteUrl . 'admin';
	$currentTime = date('Y-m-d H:i');
	
	// 输出美观的已安装页面
	$output = '<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Maigewan 已安装</title>
	<style>
		* { margin: 0; padding: 0; box-sizing: border-box; }
		body { 
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
			background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			color: #333;
		}
		.container {
			background: white;
			border-radius: 12px;
			padding: 40px;
			box-shadow: 0 20px 60px rgba(0,0,0,0.1);
			text-align: center;
			max-width: 520px;
			width: 90%;
		}
		.logo {
			font-size: 2.5em;
			margin-bottom: 10px;
		}
		h1 {
			color: #2c3e50;
			margin-bottom: 15px;
			font-size: 1.8em;
			font-weight: 600;
		}
		.status {
			background: #d4edda;
			color: #155724;
			padding: 12px 20px;
			border-radius: 6px;
			margin: 20px 0;
			border: 1px solid #c3e6cb;
		}
		.site-info {
			background: #f8f9fa;
			padding: 25px;
			border-radius: 8px;
			margin: 25px 0;
			text-align: left;
		}
		.site-name {
			font-size: 1.3em;
			font-weight: 600;
			color: #495057;
			margin-bottom: 8px;
		}
		.site-slogan {
			color: #6c757d;
			font-size: 0.95em;
			margin-bottom: 15px;
			font-style: italic;
		}
		.site-details {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 12px;
			font-size: 0.9em;
		}
		.detail-item {
			display: flex;
			justify-content: space-between;
			padding: 8px 0;
			border-bottom: 1px solid #e9ecef;
		}
		.detail-label {
			color: #6c757d;
			font-weight: 500;
		}
		.detail-value {
			color: #495057;
			font-weight: 600;
		}
		.actions {
			display: flex;
			gap: 15px;
			justify-content: center;
			flex-wrap: wrap;
			margin-top: 30px;
		}
		.btn {
			background: #667eea;
			color: white;
			padding: 12px 24px;
			border-radius: 6px;
			text-decoration: none;
			font-weight: 500;
			transition: all 0.3s ease;
			border: none;
			cursor: pointer;
		}
		.btn:hover {
			background: #5a6fd8;
			transform: translateY(-2px);
		}
		.btn-secondary {
			background: #6c757d;
		}
		.btn-secondary:hover {
			background: #5a6268;
		}
		.footer {
			margin-top: 30px;
			color: #6c757d;
			font-size: 0.85em;
		}
		.version-info {
			background: #e9ecef;
			color: #495057;
			padding: 8px 12px;
			border-radius: 4px;
			font-size: 0.8em;
			margin-top: 15px;
			display: inline-block;
		}
		@media (max-width: 480px) {
			.container { padding: 30px 20px; }
			.actions { flex-direction: column; }
			.btn { width: 100%; }
			.site-details { grid-template-columns: 1fr; }
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="logo">🚀</div>
		<h1>Maigewan 运行正常</h1>
		
		<div class="status">
			✅ 系统已安装并正常运行
		</div>
		
		<div class="site-info">
			<div class="site-name">' . htmlspecialchars($siteName) . '</div>
			<div class="site-slogan">' . htmlspecialchars($siteSlogan) . '</div>
			
			<div class="site-details">
				<div class="detail-item">
					<span class="detail-label">域名</span>
					<span class="detail-value">' . htmlspecialchars($currentDomain) . '</span>
				</div>
				<div class="detail-item">
					<span class="detail-label">检查时间</span>
					<span class="detail-value">' . $currentTime . '</span>
				</div>
			</div>
		</div>
		
		<div class="actions">
			<a href="' . $siteUrl . '" class="btn">🏠 访问网站</a>
			<a href="' . $adminUrl . '" class="btn btn-secondary">⚙️ 管理后台</a>
		</div>
		
		<div class="footer">
			<p>由 <strong>Maigewan CMS</strong> 驱动 | <a href="https://www.maigewan.com" target="_blank" style="color: #667eea; text-decoration: none;">官方网站</a></p>
			<div class="version-info">多站点版本 v3.16.2</div>
		</div>
	</div>
</body>
</html>';
	
	exit($output);
}

// Install a demo, just call the install.php?demo=true
if (isset($_GET['demo'])) {
	install('demo123', 'UTC');
	redirect(HTML_PATH_ROOT);
}

// Install by POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (Text::length($_POST['password']) < 6) {
		$errorText = $L->g('password-must-be-at-least-6-characters-long');
		error_log('[ERROR] ' . $errorText, 0);
	} else {
		install($_POST['password'], $_POST['timezone']);
		redirect(HTML_PATH_ROOT);
	}
}

?>
<!DOCTYPE html>
<html>

<head>
	<title><?php echo $L->get('Bludit Installer') ?></title>
	<meta charset="<?php echo CHARSET ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="robots" content="noindex,nofollow">

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="bl-kernel/img/favicon.png?version=<?php echo time() ?>">

	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="bl-kernel/css/bootstrap.min.css?version=<?php echo time() ?>">
	<link rel="stylesheet" type="text/css" href="bl-kernel/admin/themes/booty/css/bludit.css?version=<?php echo time() ?>">

	<!-- Javascript -->
	<script charset="utf-8" src="bl-kernel/js/jquery.min.js?version=<?php echo time() ?>"></script>
	<script charset="utf-8" src="bl-kernel/js/bootstrap.bundle.min.js?version=<?php echo time() ?>"></script>
	<script charset="utf-8" src="bl-kernel/js/jstz.min.js?version=<?php echo time() ?>"></script>
</head>

<body class="login">
	<div class="container">
		<div class="row justify-content-md-center pt-5">
			<div class="col-md-4 pt-5">
				<h1 class="text-center mb-5 mt-5 font-weight-normal text-uppercase" style="color: #555;"><?php echo $L->get('Bludit Installer') ?></h1>
				<?php
				$system = checkSystem();
				if (!empty($system)) {
					foreach ($system as $error) {
						echo '
					<table class="table">
						<tbody>
							<tr>
								<th>' . $error . '</th>
							</tr>
						</tbody>
					</table>
					';
					}
				} elseif (isset($_GET['language'])) {
				?>
					<p><?php echo $L->get('choose-a-password-for-the-user-admin') ?></p>

					<?php if (!empty($errorText)) : ?>
						<div class="alert alert-danger"><?php echo $errorText ?></div>
					<?php endif ?>

					<form id="jsformInstaller" method="post" action="" autocomplete="off">
						<input type="hidden" name="timezone" id="jstimezone" value="UTC">

						<div class="form-group">
							<input type="text" dir="auto" value="admin" class="form-control form-control-lg" id="jsusername" name="username" placeholder="Username" disabled>
						</div>

						<div class="form-group mb-0">
							<input type="password" class="form-control form-control-lg" id="jspassword" name="password" placeholder="<?php $L->p('Password') ?>">
						</div>

						<div class="form-check mt-2">
							<input role="button" class="form-check-input" type="checkbox" value="" id="jsshowPassword">
							<label class="form-check-label" for="jsshowPassword"><?php $L->p('Show password') ?></label>
						</div>

						<div class="form-group mt-4">
							<button type="submit" class="btn btn-primary btn-lg mr-2 w-100" name="install"><?php $L->p('Install') ?></button>
						</div>
					</form>
				<?php
				} else {
				?>
					<form id="jsformLanguage" method="get" action="" autocomplete="off">
						<label for="jslanguage"><?php echo $L->get('Choose your language') ?></label>
						<select id="jslanguage" name="language" class="form-control form-control-lg">
							<?php
							$htmlOptions = getLanguageList();
							foreach ($htmlOptions as $fname => $native) {
								echo '<option value="' . $fname . '"' . (($finalLanguage === $fname) ? ' selected="selected"' : '') . '>' . $native . '</option>';
							}
							?>
						</select>

						<div class="form-group mt-4">
							<button type="submit" class="btn btn-primary btn-lg mr-2 w-100"><?php $L->p('Next') ?></button>
						</div>
					</form>
				<?php
				}
				?>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function() {
			// Timezone
			var timezone = jstz.determine();
			$("#jstimezone").val(timezone.name());

			// Show password
			$("#jsshowPassword").on("click", function() {
				var input = document.getElementById("jspassword");

				if (!$(this).is(':checked')) {
					input.setAttribute("type", "password");
				} else {
					input.setAttribute("type", "text");
				}
			});

		});
	</script>

</body>

</html>
