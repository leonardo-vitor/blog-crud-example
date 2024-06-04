<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-print-css/css/bootstrap-print.min.css"
          media="print">
    <link rel="stylesheet" href="<?= shared("assets/css/styles.css"); ?>">
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<div class="ajax_response"><?= flash(); ?></div>


<div class="min-vh-100">
    <div class="p-5 mb-4 bg-body-tertiary rounded-3">
        <div class="container py-3">
            <h1 class="display-5 fw-bold"><?= app('name') ?></h1>
            <p class="col-md-8 fs-4"><?= app('desc') ?></p>
            <a href="<?= $router->route('articles.index') ?>" class="btn btn-primary">
                Artigos cadastrados
            </a>
            <a href="<?= $router->route('articles.create') ?>" class="btn btn-secondary">
                Adicionar artigo
            </a>
        </div>
    </div>

    <div class="container">
        <?= $this->section("content") ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"
        integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"
        integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ"
        crossorigin="anonymous"></script>
<script src="<?= shared("assets/js/jquery.min.js"); ?>"></script>
<!--<script src="--><?php //= shared("assets/js/jquery-ui.js"); ?><!--"></script>-->
<script src="<?= shared("assets/js/jquery-form.js"); ?>"></script>
<script src="<?= shared("assets/js/scripts.js"); ?>"></script>
<?= $this->section("scripts"); ?>
</body>
</html>