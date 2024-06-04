<?php $this->layout("articles/_theme"); ?>

<div class="row justify-content-center py-3">
    <div class="col-12 col-md-6">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold text-center"><?= $errcode ?></h1>
                <p class="col-md-8 fs-4">Desculpe, mas não foi possível processar sua requisição.</p>
                <hr class="my-4">
                <p>Verifique sua conexão com internet e tente novamente.</p>
                <a class="btn btn-primary btn-lg" href="<?= $router->route("web.home") ?>" role="button">Voltar</a>
            </div>
        </div>
    </div>
</div>