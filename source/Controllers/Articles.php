<?php

namespace Source\Controllers;

use CoffeeCode\Paginator\Paginator;
use Source\Models\Article;

class Articles extends Controller
{

    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * @param array $data
     * @return void
     */
    public function index(array $data): void
    {
        $articles = (new Article())->find();

        $pager = new Paginator(url("/p/"));
        $pager->pager($articles->count(), 6, (!empty($data["page"]) ? $data["page"] : 1));

        echo $this->view->render("articles/index", [
            "articles" => $articles->limit($pager->limit())->offset($pager->offset())->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    /**
     * @return void
     */
    public function create(): void
    {
        echo $this->view->render("articles/create");
    }

    /**
     * @param array $data
     * @return void
     */
    public function store(array $data): void
    {
        if (empty($data['title']) || empty($data['content']) || empty($data['author'])) {
            $json["notify"] = ["message" => message("Todos os campos são de preenchimento obrigatório", "warning")];
            echo json_encode($json);
            return;
        }

        $content = str_textarea($data['content']);
        $data = filter_var_array($data, FILTER_SANITIZE_SPECIAL_CHARS);

        $article = new Article();
        $article->title = $data['title'];
        $article->uri = str_slug($data['title']);
        $article->content = $content;
        $article->author = $data['author'];

        if (!$article->save()) {
            $json["message"] = message($article->fail()->getMessage(), "warning");
            echo json_encode($json);
            return;
        }

        message("O artigo {$article->title}, foi salvo com sucesso", "success", true);
        echo json_encode(["redirect" => $this->router->route("articles.index")]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function show(array $data): void
    {
        $article = (new Article())->find('uri = :uri', "uri={$data['uri']}")->fetch();

        if (!$article) {
            message("Não foi possível encontrar o artigo selecionado", "warning", true);
            $this->router->redirect("articles.index");
            return;
        }

        echo $this->view->render("articles/show", [
            "article" => $article
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function edit(array $data): void
    {
        $article = (new Article())->find('uri = :uri', "uri={$data['uri']}")->fetch();

        if (!$article) {
            message("Não foi possível encontrar o artigo selecionado", "warning", true);
            $this->router->redirect("articles.index");
            return;
        }

        echo $this->view->render("articles/edit", [
            "article" => $article
        ]);
    }

    /**
     * @param array $data
     * @return void
     */
    public function update(array $data): void
    {
        if (empty($data['title']) || empty($data['content']) || empty($data['author'])) {
            $json["notify"] = ["message" => message("Todos os campos são de preenchimento obrigatório", "warning")];
            echo json_encode($json);
            return;
        }

        $content = str_textarea($data['content']);
        $data = filter_var_array($data, FILTER_SANITIZE_SPECIAL_CHARS);

        $article = (new Article())->find('uri = :uri', "uri={$data['uri']}")->fetch();

        if (!$article) {
            message("Não foi possível encontrar o artigo selecionado", "warning", true);
            $this->router->redirect("articles.index");
            return;
        }

        $article->title = $data['title'];
        $article->uri = str_slug($data['title']);
        $article->content = $content;
        $article->author = $data['author'];

        if (!$article->save()) {
            $json["message"] = message($article->fail()->getMessage(), "warning");
            echo json_encode($json);
            return;
        }

        message("O artigo {$article->title}, foi alterado com sucesso", "success", true);
        echo json_encode(["redirect" => $this->router->route("articles.index")]);
    }
}