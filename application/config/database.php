<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'sqlsrv';
$query_builder = TRUE;

$db['sqlsrv'] = array(
	'dsn'	=> '',
    'hostname' => '192.168.25.13',
    'username' => 'sa',
    'password' => 'ibc24@123',
    
	'database' => 'NEWZ36',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);


$db['savior'] = array(
    'dsn'	=> '',
    'hostname' => '192.168.25.2,4050',
    'username' => 'ibcportal',
    'password' => 'portal@ibc24',
    'database' => 'Savior',
    'dbdriver' => 'sqlsrv',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
