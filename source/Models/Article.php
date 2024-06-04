<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Article extends DataLayer
{
    public function __construct()
    {
        parent::__construct("articles", ["title", "uri", "content", "author"]);
    }

    /**
     * @return bool
     */
    public function save(): bool
    {
        if (!$this->validateUri() || !parent::save()) {
            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function validateUri(): bool
    {
        if (empty($this->uri)) {
            $this->fail = new \Exception("Informe uma URI para prosseguir");
            return false;
        }

        $articleByUri = null;
        if (!$this->id) {
            $articleByUri = $this->find("uri = :u", "u={$this->uri}")->count();
        } else {
            $articleByUri = $this->find("uri = :u AND id != :id ", "u={$this->uri}&id={$this->id}")->count();
        }

        if ($articleByUri) {
            $this->fail = new \Exception("Já existe um artigo com esse URI");
            return false;
        }

        return true;
    }
}