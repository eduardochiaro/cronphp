<?php

$config['system_name'] = 'CronPHP'; 

//autoload modules 
$config['autoload'] = array('database');

//log module
$config['log']['active'] = TRUE;
$config['log']['name'] = '%Y-%m-%d-cp'; // use http://php.net/manual/en/function.strftime.php
$config['log']['level'] = 'ALL'; //ALL, ERROR, INFO

//possible multiple loading of dbs
$config['database']['cronphp']['driver'] = 'PDO';
$config['database']['cronphp']['database'] = 'cronphp';
$config['database']['cronphp']['host'] = 'localhost';
$config['database']['cronphp']['username'] = 'root';
$config['database']['cronphp']['password'] = '';
$config['database']['cronphp']['autoload'] = TRUE;

$config['database']['test']['driver'] = 'PDO';
$config['database']['test']['database'] = 'steamlife';
$config['database']['test']['host'] = 'localhost';
$config['database']['test']['username'] = 'root';
$config['database']['test']['password'] = '';
$config['database']['test']['autoload'] = TRUE;