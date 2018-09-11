<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Eletronic\Page;
use \Eletronic\PageAdmin;

$app = new Slim;

$app->config('debug', true);

//rota para site
$app->get('/', function()
{
    $page = new Page();

    $page->setTpl("index");

});

//rota para admin
$app->get('/admin', function()
{
    $page = new PageAdmin();

    $page->setTpl("index");

});

$app->run();

 ?>