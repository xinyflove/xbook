# xbook
类似简书网的网站

进度 13-1

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