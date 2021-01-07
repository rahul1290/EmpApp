<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$active_group = 'default';
//$active_group = 'staging';
$active_group = 'localhost';
$query_builder = TRUE;


$db['essl'] = array(
    'dsn'	=> '',
//     'hostname' => '192.168.25.2,4050',
//     'username' => 'essl',
//     'password' => 'essl',
    
    
    'hostname' => '192.168.25.13',
    'username' => 'sa',
    'password' => 'ibc24@123',
    
    'database' => 'etimetracklite1',
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

$db['sqlsrv'] = array(
	'dsn'	=> '',
// 	'hostname' => '192.168.25.2,4050',
//     'username' => 'ibcportal',
//     'password' => 'portal@ibc24',
	
    
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

$db['production'] = array(
    'dsn'	=> '',
    'hostname' => '192.168.25.239',
    'username' => 'root',
    'password' => '#SBmmpl12345$',
    'database' => 'emp_portal',
    'dbdriver' => 'mysqli',
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

$db['staging'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.25.239',
	'username' => 'root',
	'password' => '#SBmmpl123$',
	'database' => 'emp_portal_stag',	
	'dbdriver' => 'mysqli',
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

$db['newsflow'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.25.29',
	'username' => 'mplm',
	'password' => '!mplm@1234#',
	'database' => 'Newsflow',
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

$db['localhost'] = array(
    'dsn'	=> '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'emp_portal',
    'dbdriver' => 'mysqli',
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
