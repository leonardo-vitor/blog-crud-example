<?php

namespace Source\Controllers;

class Articles extends Controller
{

    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function index(): void
    {
        echo 'aqui';
        die;

        echo $this->view->render("articles/index", [

        ]);
    }

}