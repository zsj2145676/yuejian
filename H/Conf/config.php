<?php
 //include ('../../Common/errorcode.php');
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
	'USER_AUTH_KEY'=>'uid',
        'URL_MODEL'=> 0,
        'OUTPUT_ENCODE'=>false,
        'TMPL_PARSE_STRING'  =>array(
            '__IMG__' => '/yuejian/Public/images',
            '__CSS__' => '/yuejian/Public/styles',
            '__JS__' => '/yuejian/Public/scripts',
            '__UPLOAD__' => '/yuejian/Uploads',
        )
);
?>
