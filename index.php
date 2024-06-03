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