<?php
return array(
    'MODULE_ALLOW_LIST' => array('Home'),
    'DEFAULT_MODULE' => 'Home',

    /**
     * 数据库链接
     */
    'DB_TYPE'=>'mysql',
    'DB_HOST'=>'127.0.0.1', //主机地址
    'DB_NAME'=>'vote', //数据库名
    'DB_USER'=>'root',      //用户名
    'DB_PWD'=>'root',       //用户密码
    'DB_PORT'=>3306,        //端口
    'DB_PREFIX'=>'',        //表前缀，没有则不填
    'DB_FIELDS_CACHE'=>false,

    //未知
    'TMPL_TEMPLATE_SUFFIX'=>'.html',
    'TMPL_CACHE_ON'=>false,
    'URL_CASE_INSENSITIVE'=>true,
    'URL_DISPATCH_ON'=>true,
    'URL_MODEL'=>1,
    'URL_PATHINFO_DEPR'=>'/',
    'TMPL_FILE_DEPR'=>'/',
    'URL_ROUTER_ON'=>false,
    'UPLOAD_PATH'=>'Public/upload/',
    'TMPL_VAR_IDENTIFY'=>'array',
    'TMPL_PARSE_STRING'=> array(
        '__ROOT__' => '',
        '__PUBLIC__'=>'/Public',
        '__UPLOAD__'=>'/Public/upload/',
    ),
);