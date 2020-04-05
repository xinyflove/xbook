# xbook

> 类似简书的网站

## 软件架构

- Laravel 5.4
- PHP 5.6+
- MySQL

## 安装教程

### 环境要求

- Nginx/Apache/IIS
- MySQL5.5+
- PHP5.6+
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

建议使用环境：Linux + Nginx 1.14 + PHP 7 + MySQL 5.6

### 安装部署

1. 下载源码

从 [https://github.com/xinyflove/xbook](https://github.com/xinyflove/xbook) 下载代码到本地

2. 修改`.env`文件

```
cp .env.dev .env
php artisan key:generate
```

修改 数据库配置、`APP_URL` 配置

3. 执行 composer 命令

```bash
composer install
composer dump-autoload
```

4. 测试数据库配置是否正确

```bash
php artisan migrate:install
```

如果出现`Migration table created successfully.`则配置正确。

5. 执行 `migrate`命令安装表

```bash
php artisan migrate
```

6. 确认文件权限

`storage` 和 `bootstrap/cache` 目录应该允许你的 Web 服务器写入，否则 Laravel 将无法写入。

7. 文件储存配置

`.env` 文件添加 `FILESYSTEM_DRIVER=public` 配置

执行命令 `php artisan storage:link`，`./public/storage/` 目录 链接到 `./storage/app/public/` 目录

8. 启动项目

本地开发

```bash
php artisan serve
```

Web 服务器配置 [传送门](https://learnku.com/docs/laravel/5.4/installation/1216#d67c05)

## 功能介绍

- 文章模块
- 用户注册登录注册模块
- 文章评论模块
- 文章点赞模块
- 个人中心模块
- 文章专题模块
- 管理人员模块
- 审核模块
- 权限模块
- 专题管理模块
- 系统通知模块

## 开发说明

### 生成 controller

```bash
php artisan make:controller Web/TestController
php artisan make:controller Admin/TestController
php artisan make:controller Api/V1/TestController
php artisan make:controller AdminApi/V1/TestController
```

### 创建 Model

```bash
php artisan make:model Models/User
```

### 数据迁移

```bash
php artisan make:migration create_user_table
```

## BUG

1. 开启 debugbar 会导致上传图片后插入富文本错误
2. 使用函数 `str_limit` 如果在截取中含有图片数据，会导致页面出问题
3. 安装时把 AuthServiceProvider.php 文件中的 boot() 方法 中的权限判断先注释掉，安装成功后取消注释