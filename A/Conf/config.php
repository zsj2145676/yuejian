<?php
return array(
	//'配置项'=>'配置值'
	'DB_TYPE'=>'mysql',
	'DB_HOST'=>'127.0.0.1',
	'DB_NAME'=>'yuejian',
	'DB_USER'=>'root',
	'DB_PWD'=>'',
	'DB_PORT'=>3306,
	'DB_PREFIX'=>'yue_',
	'ERROR_PAGE'=>'/Public/error.html',
        'URL_MODEL' => 0,
        'OUTPUT_ENCODE'=>false,
	'SESSION_EXPIRE'=>'1',
	'USER_AUTH_KEY'=>'uid',
	'USER_INFO'=>'user',
	'USER_GROUP_INVALID'=>0,
	'USER_GROUP_ADMIN'=>1,
	'USER_GROUP_GUEST'=>2,
	'USER_GROUP_SELLER'=>3,
        'TMPL_PARSE_STRING'  =>array(
            '__IMG__' => '/yuejian/Public/images',
            '__CSS__' => '/yuejian/Public/styles',
            '__JS__' => '/yuejian/Public/scripts',
            '__UPLOAD__' => '/yuejian/Uploads',
        )
);
?>
