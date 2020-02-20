# xbook
类似简书网的网站

进度 17-1

测试数据库配置是否正确

```bash
php artisan migrate:install
```

如果出现`Migration table created successfully.`则配置正确。

**文件储存配置**

`.env` 文件添加 `FILESYSTEM_DRIVER=public` 配置

执行命令 `php artisan storage:link`，`./public/storage/` 目录 链接到 `./storage/app/public/` 目录



adminLTE主题下载

```
composer require "almasaeed2010/adminlte=~2.0"
```

复制 `vendor/almasaeed2010/adminlte` 文件夹到 `public` 目录下


> 6-9 文章路由控制的实现
  6-10 个人设置页面上传头像功能实现
  15-1 权限管理模块基本介绍
  18-1 性能优化章节介绍
  18-2 使用Laravel自带的优化命令优化
  18-3 使用debugbar进行问题定位
  18-5 使用DB_listen进行慢sql的查询