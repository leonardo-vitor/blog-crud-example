<?php

namespace Source\Controllers;

class Error extends Controller
{
    public function show(array $data): void
    {
        $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);

        echo $this->view->render("articles/error", [
            "errcode" => $error
        ]);
    }
}