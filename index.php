<?php

ob_start();

require_once __DIR__ . "/vendor/autoload.php";

$router = new \CoffeeCode\Router\Router(url());
$router->namespace("Source\Controllers");

/*
* Web
*/
$router->group(null);
$router->get("/", "Articles:index", "articles.index");
$router->post("/", "Articles:index", "articles.index");
$router->get("/{search}/{page}", "Articles:index", "articles.index");
$router->get("/novo", "Articles:create", "articles.create");
$router->post("/salvar", "Articles:store", "articles.store");
$router->get("/visualizar/{uri}", "Articles:show", "articles.show");
$router->get("/editar/{uri}", "Articles:edit", "articles.edit");
$router->post("/editar/{uri}/atualizar", "Articles:update", "articles.update");
$router->post("/excluir/{uri}", "Articles:destroy", "articles.destroy");

/*
 * Error
 */
$router->namespace("Source\Controllers");
$router->group("ops");
$router->get("/{errcode}", "Error:show", "error.show");

/*
 * Process
 */
$router->dispatch();

if ($router->error()) {
    $router->redirect("error.show", ["errcode" => $router->error()]);
}

ob_end_flush();