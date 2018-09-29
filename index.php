<?php 

//setando sessoes
session_start();

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Sucata\Page;
use \Sucata\PageAdmin;
use\Sucata\Model\Usuario;

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
    Usuario::verificaLogin();
    
    $page = new PageAdmin();

    $page->setTpl("index");
});

//rota para login
$app->get('/admin/login', function()
{
    $page = new PageAdmin([
        "header"=>false,
        "footer"=>false
    ]);

    $page->setTpl("login");

});

//rota para usuario
$app->post('/admin/login', function()
{
    Usuario::login($_POST);
    header("location: /admin");
    exit;
});

$app->get("/admin/sair", function()
{
    Usuario::sair();

    header("Location: /admin/login");
    exit;
});

$app->run();

 ?>