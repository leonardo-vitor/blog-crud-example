<?php


namespace Source\Controllers;

use CoffeeCode\Router\Router;
use League\Plates\Engine;

/**
 * Class Controller
 * @package Source\Controllers
 */
abstract class Controller
{
    /** @var Router */
    protected $router;

    /** @var Engine */
    protected $view;

    /**
     * Controller constructor.
     * @param $router
     */
    public function __construct($router)
    {
        $this->router = $router;
        $this->view = (new Engine(dirname(__DIR__, 2) . "/theme", "php"));
        $this->view->addData(["router" => $this->router]);
    }
}