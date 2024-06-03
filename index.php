<?php

ob_start();

require_once __DIR__ . "/vendor/autoload.php";

$router = new \CoffeeCode\Router\Router(url());
$router->namespace("Source\Controllers");

/*
* Web
*/
$router->group(null);
$router->get("/", "Articles:home", "articles.index");

/*
 * Error
 */
$router->namespace("Source\Controllers");
$router->group("ops");
$router->get("/{errcode}", "Web:error", "web.error");

/*
 * Process
 */
$router->dispatch();

if ($router->error()) {
    $router->redirect("web.error", ["errcode" => $router->error()]);
}

ob_end_flush();