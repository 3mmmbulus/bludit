<?php

/*
 * Maigewan 多站点系统
 * https://www.maigewan.com
 * 为多站点能力所做的改造说明：
 * - 通过统一的站点解析器（site-resolver）根据域名/路径映射到对应的站点目录
 * - 未检测到已安装站点时，引导到安装程序
 * 作者：Diego Najar
 * 许可：Maigewan 为开源软件，遵循 MIT 许可证
*/

// 加载时间起点（用于统计脚本运行耗时）
$loadTime = microtime(true);

// 安全常量（作为框架加载的安全标识）
define('BLUDIT', true);

// 目录分隔符（兼容不同操作系统）
define('DS', DIRECTORY_SEPARATOR);

// PHP 基础路径定义（为初始化流程准备）
define('PATH_ROOT', __DIR__.DS);

// 引入统一站点解析器（根据请求环境解析出对应站点目录）
require_once(PATH_ROOT.'bl-kernel'.DS.'site-resolver.class.php');

// 多站点逻辑：使用统一站点解析器获取当前站点目录
$siteDirectory = MaigewanSiteResolver::getSiteDirectory();

// 检查是否存在已安装的站点；若无则引导至安装
if ($siteDirectory === null) {
    $base = dirname($_SERVER['SCRIPT_NAME']);
    $base = rtrim($base, '/');
    $base = rtrim($base, '\\'); // 兼容 Windows 服务器路径的处理

    // 增强的错误页面
    if (!headers_sent()) {
        http_response_code(503);
        echo '<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Maigewan - 需要安装</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); margin: 0; padding: 0; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .container { background: white; border-radius: 10px; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.2); text-align: center; max-width: 500px; }
        h1 { color: #333; margin-bottom: 20px; }
        p { color: #666; margin-bottom: 30px; }
        .btn { background: #667eea; color: white; padding: 12px 30px; border-radius: 6px; text-decoration: none; display: inline-block; transition: background 0.3s; }
        .btn:hover { background: #5a6fd8; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 欢迎使用 Maigewan</h1>
        <p>系统尚未安装，请点击下方按钮开始安装。</p>
        <a href="'.$base.'/install.php" class="btn">开始安装</a>
    </div>
</body>
</html>';
        exit;
    }

    exit('<a href="./install.php">请先安装 Maigewan 系统。</a>');
}

// 为当前站点设置内容目录常量（各站点隔离存储其 bl-content）
define('SITE_PATH_CONTENT', $siteDirectory . '/bl-content/');

// 引导路径（框架核心引导文件所在目录）
define('PATH_BOOT', PATH_ROOT.'bl-kernel'.DS.'boot'.DS);

// 初始化框架与站点环境
require(PATH_BOOT.'init.php');

// 后台管理区域入口
if ($url->whereAmI()==='admin') {
	require(PATH_BOOT.'admin.php');
}
// 前台站点入口
else {
	require(PATH_BOOT.'site.php');
}
