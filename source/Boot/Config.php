<?php

$dotEnv = Dotenv\Dotenv::createUnsafeImmutable(dirname(__DIR__, 2));
$dotEnv->load();

/** Fuso Horário **/
date_default_timezone_set("America/Sao_Paulo");
setlocale(LC_ALL, array("pt_BR", "pt_BR.utf-8", "portuguese"));

/** Configurações base do site **/
define("APP_DATA", [
    "name" => "Blog",
    "desc" => "Blog - Crie, edite e exclua seus artigos de forma simples e rápida",
    "domain" => $_ENV['URL_DOMAIN'],
    "test" => $_ENV['URL_LOCAL'],
    "locale" => "pt_BR"
]);

/**
 * Configurações de Database
 */
define("DATA_LAYER_CONFIG", [
    "driver" => $_ENV['DB_DRIVER'],
    "host" => $_ENV['DB_HOST'],
    "port" => $_ENV['DB_PORT'],
    "dbname" => $_ENV['DB_NAME'],
    "username" => $_ENV['DB_USER'],
    "passwd" => $_ENV['DB_PASS'],
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);