<?php


return [
//数据库相关配置	
    'db_host' => '127.0.0.1',                            //数据库地址
    'db_user' => 'root',                                    //数据库账户
    'db_pwd' => '',                                        //数据库密码
    'db_name' => 'test',                            //数据库名
    'db_table_prefix' => '',                                    //数据库前缀
    'db_charset' => 'utf8',                                //数据库字符集

    'default_module' => 'home',                                    //默认模块
    'default_controller' => 'Index',                                //默认控制器
    'default_action' => 'index',                                //默认方法

    'url_type' => 2,                                    // RUL模式：【1：普通模式，采用传统的 url 参数模式】【2：PATHINFO 模式，也是默认模式】

    'cache_path' => RUNTIME_PATH . 'cache' . DS,            //缓存存放路径
    'cache_prefix' => 'cache_',                            //缓存文件前缀
    'cache_type' => 'file',                                //缓存类型（只实现 file 类型）
    'compile_path' => RUNTIME_PATH . 'compile' . DS,        //编译文件存放路径

    'view_path' => APP_PATH . APP_NAME . DS . 'view' . DS,    // 模板路径
    'view_suffix' => '.php',                                    // 模板后缀

    'auto_cache' => false,                                    //开启自动缓存
    'cache_time' => 30,                                        //缓存更新时间（ 单位分钟 ）
    'url_html_suffix' => 'html',                                // URL伪静态后缀

]

?>