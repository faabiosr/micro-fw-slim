<?php
define('BASE_PATH',realpath(dirname(__FILE__) . '/../') . DIRECTORY_SEPARATOR);
define('APP_PATH',BASE_PATH . 'app' . DIRECTORY_SEPARATOR);

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(BASE_PATH . 'vendors'),
    realpath(APP_PATH),
    get_include_path(),
)));

require 'Slim/Slim.php';
require 'idiorm.php';

$app = new Slim(array(
    'templates.path'    => APP_PATH . 'views' . DIRECTORY_SEPARATOR,
    'log.path'          => APP_PATH . 'logs' . DIRECTORY_SEPARATOR
));

$app->setName('Contacts');

$app->configureMode('development', function() use ($app){
    $app->config(array(
        'log.enable'    => false,
        'debug'         => true
    ));  
    
    ORM::configure('sqlite:' . APP_PATH.'db'.DIRECTORY_SEPARATOR.'microfwslim.sqlite');
});

$app->configureMode('production', function() use ($app){
    $app->config(array(
        'log.enable'    => true,
        'debug'         => false
    )); 
    
    ORM::configure('sqlite:');
});


$controller_dir = opendir(APP_PATH . 'controllers' . DIRECTORY_SEPARATOR);

while($controller = readdir($controller_dir))
{
    if($controller != '.' && $controller != '..')
        require APP_PATH . 'controllers' . DIRECTORY_SEPARATOR . $controller;
}

$app->get('/',function() use ($app){
    $app->redirect('/contact');
});

$app->run();

