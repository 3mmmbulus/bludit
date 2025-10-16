# Bludit 多站点模式使用说明

## 概述

本项目已成功将 Bludit CMS 改造为单实例多站点模式，支持一个 Bludit 实例同时运行多个独立的网站。

## 目录结构

```
/www/wwwroot/wiiwedding.com/
├─ bl-kernel/                     # 核心代码（单实例共享）
├─ bl-plugins/                    # 插件目录（单实例共享）  
├─ bl-themes/                     # 主题目录（单实例共享）
├─ bl-languages/                  # 语言包（单实例共享）
├─ index.php                      # 主入口：基于 HTTP_HOST 路由到对应站点
├─ install.php                    # 安装脚本：支持多站点初始化
├─ .htaccess                      # URL重写规则：保护敏感目录，允许静态资源访问
├─ bl-content/                    # 原内容目录（仅作占位，已清空）
│  └─ .keep                       # 占位文件
└─ sites/                         # ★多站点目录
   ├─ wiiwedding.com/             # 主站点（基于域名命名）
   │  ├─ bl-content/              # 站点独立内容目录
   │  │  ├─ databases/            # 数据库文件
   │  │  ├─ pages/                # 页面内容
   │  │  ├─ uploads/              # 上传文件
   │  │  ├─ workspaces/           # 工作目录
   │  │  └─ tmp/                  # 临时文件
   │  └─ site.json                # 站点配置文件
   ├─ _default/                   # 默认站点（兜底）
   │  ├─ bl-content/              # 默认站点内容
   │  └─ site.json                # 默认站点配置
   └─ <other-domain>/             # 其他站点（按需添加）
      ├─ bl-content/
      └─ site.json
```

## 核心修改

### 1. 主入口 (`index.php`)
- 添加了基于 `HTTP_HOST` 的智能站点路由逻辑
- **支持子域名自动匹配**：`www.example.com`、`m.example.com`、`api.example.com` 等都会自动路由到 `sites/example.com/`
- 动态设置 `SITE_PATH_CONTENT` 常量指向对应站点的 `bl-content` 目录
- 多层匹配策略：精确匹配 → 主域名匹配 → 模糊匹配 → 默认站点

### 2. 智能域名匹配策略
系统采用四层匹配策略确保最佳的站点路由：

1. **精确匹配**：直接匹配完整域名
   - `jyatpw.com` → `sites/jyatpw.com/`

2. **主域名匹配**：自动处理子域名
   - `www.jyatpw.com` → `sites/jyatpw.com/`
   - `m.jyatpw.com` → `sites/jyatpw.com/`
   - `api.jyatpw.com` → `sites/jyatpw.com/`

3. **模糊匹配**：处理复杂域名情况
   - 自动提取主域名进行匹配

4. **默认回退**：未匹配时使用默认站点
   - `unknown-domain.com` → `sites/_default/`

### 2. 核心初始化 (`bl-kernel/boot/init.php`)
- 支持动态 `PATH_CONTENT` 路径设置
- 更新 HTML 路径常量以支持多站点静态资源访问
- 添加 `MultiSite` 管理类的包含

### 3. 安装脚本 (`install.php`)
- 修改为基于当前域名创建对应的站点目录
- 自动生成 `site.json` 配置文件
- 支持多站点目录结构的初始化

### 4. URL 重写规则 (`.htaccess`)
- 保护所有站点的敏感目录（`databases`, `workspaces`, `pages`, `tmp`）
- 允许访问各站点的 `uploads` 目录中的静态资源
- 禁止直接访问 `sites` 目录（除了上传文件）

### 5. 多站点管理类 (`bl-kernel/multisite.class.php`)
- 提供站点检测、配置加载/保存、站点列表等功能
- 支持动态创建新站点
- 管理站点配置文件

## 使用方法

### 子域名支持

**自动子域名路由**：系统会自动将子域名路由到对应的主域名站点

```
配置的站点: sites/example.com/

支持的访问方式:
✓ example.com          → sites/example.com/
✓ www.example.com      → sites/example.com/
✓ m.example.com        → sites/example.com/
✓ api.example.com      → sites/example.com/
✓ admin.example.com    → sites/example.com/
✓ blog.example.com     → sites/example.com/
```

**实际案例**：
```
配置的站点: 
- sites/jyatpw.com/
- sites/wiiwedding.com/

访问效果:
jyatpw.com           → sites/jyatpw.com/     ✓
www.jyatpw.com       → sites/jyatpw.com/     ✓
m.jyatpw.com         → sites/jyatpw.com/     ✓

wiiwedding.com       → sites/wiiwedding.com/ ✓
www.wiiwedding.com   → sites/wiiwedding.com/ ✓
m.wiiwedding.com     → sites/wiiwedding.com/ ✓

unknown-domain.com   → sites/_default/       ✓
```

### 新建站点

1. **通过域名访问未配置的站点**：
   - 将新域名解析到服务器
   - 首次访问时系统会引导到安装页面
   - 按照安装向导完成站点初始化

2. **手动创建站点**：
   ```php
   // 使用 MultiSite 类创建新站点
   $config = array(
       'title' => '新站点标题',
       'language' => 'zh_CN',
       'theme' => 'blogx'
   );
   MultiSite::createSite('example.com', $config);
   ```

### 站点配置

每个站点的 `site.json` 文件包含独立配置：

```json
{
    "title": "站点标题",
    "slogan": "站点标语",
    "description": "站点描述",
    "language": "zh_CN",
    "timezone": "Asia/Shanghai",
    "theme": "blogx",
    "adminTheme": "booty",
    "domain": "https://wiiwedding.com",
    "enabledPlugins": {
        "about": true,
        "navigation": true,
        "rss": true
    },
    "settings": {
        "itemsPerPage": 6,
        "orderBy": "date"
    }
}
```

### 静态资源访问

各站点的上传文件可通过以下 URL 访问：
```
https://yourdomain.com/sites/yourdomain.com/bl-content/uploads/pages/image.jpg
```

## 管理界面

每个站点都有独立的管理界面，通过 `/admin` 路径访问：
```
https://wiiwedding.com/admin     # 主站管理
https://example.com/admin        # 其他站点管理
```

## 优势

1. **资源共享**：核心代码、插件、主题在所有站点间共享
2. **独立内容**：每个站点的内容、配置、用户完全独立
3. **灵活配置**：每个站点可使用不同的主题、语言、插件
4. **简化维护**：统一的代码库，便于升级和维护
5. **性能优化**：减少磁盘占用，提高运行效率

## 注意事项

1. **备份重要**：在进行站点迁移或配置修改前，请先备份相关数据
2. **权限设置**：确保 `sites/` 目录及其子目录有正确的写入权限
3. **域名配置**：确保域名正确解析到服务器，且 Web 服务器配置支持多域名
4. **插件兼容**：部分插件可能需要调整以支持多站点模式

## 故障排除

如果遇到问题，请检查：

1. **目录权限**：`sites/` 目录是否可写
2. **配置文件**：`site.json` 是否存在且格式正确
3. **htaccess**：URL 重写规则是否生效
4. **PHP 错误**：查看 PHP 错误日志获取详细信息

---

此多站点模式已在 `/www/wwwroot/wiiwedding.com` 成功部署，现有内容已迁移至 `sites/wiiwedding.com/` 目录。