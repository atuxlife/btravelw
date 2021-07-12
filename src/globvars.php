<?php
	// Directorios del sitio
	define('SITE_BASE','http://'.$_SERVER["SERVER_NAME"]).'/btravelw';
	define('URL_BASE','http://'.$_SERVER["SERVER_NAME"].'/btravelw/');
	define('DOC_ROOT', $_SERVER['DOCUMENT_ROOT'].'/btravelw/');
	// Nombres de la aplicación, empresa y sitio
	define('SITE_NAM', 'Reporte de Humedad');
	define('APP_NAME', 'Browser Travel');
	define('EMP_NAME', 'Browser Travel');
	define('YEARCOPY', '2021');
	define('METH_CYH','AES-256-CBC');
	define('SALT_FIL', 'ff96a8a3e0');
	define('SECRET_IV','840621');
	// Configuración del Google reCaptcha
	define('SITE_KEY','6LefAUYaAAAAAEB6432JRsOELL32vu5bCOVeef3M');
	define('SECRET_KEY','6LefAUYaAAAAAMQFLENpSuOID-6KXeeEHRhdgV5X');
	// Configuración de correo
	//define('HST_MAIL','mail.marvel-censo.co');
	define('HST_MAIL','smtp-mail.outlook.com');
	//define('PRT_MAIL','465');
	define('PRT_MAIL','587');
	//define('USR_MAIL','noreply@marvel-censo.co');
	define('USR_MAIL','censo_cultura@barranquilla.gov.co');
	//define('PWD_MAIL','AZ92adx$!');
	define('PWD_MAIL','CartografiaDAC2019');
	// Base de datos MySQL
	define('TYP_DBAS','mysql');
	define('HST_DBAS','localhost');
	define('HST_PORT','3306');
	define('USR_DBAS','root');
	define('PSW_DBAS','AZ92adx$!');
	define('DBA_DBAS','weather');
	define('CHAR_SET','utf8mb4');
	define('BD_PREFI','wea_');
	define('WHIT_TGS',array('<b>','<p>','<br>'));
?>