<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php /*= $head; */?>

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
    <div class="bg-tapete">
        <div class="p-4 mb-3">
            <div class="container py-5">
                <div class="row justify-content-center py-3 mb-5 align-items-center d-print-none">
                    <div class="col-12 col-md-5 col-lg-3 text-center">
                        <a href="<?= $router->route("web.home") ?>">
                            <img src="<?= shared("assets/images/logo-semecti-sem-brasao-borda.png", true) ?>"
                                 alt="Secretaria Municipal de Educação, Ciência, Tecnologia e Inovação" class="mw-100">
                        </a>
                    </div>

                    <div class="col-12 col-md-5 col-lg-3 text-center">
                        <a href="https://www.itaquaquecetuba.sp.gov.br">
                            <img src="<?= shared("assets/images/logo-cultura-3.png", true) ?>"
                                 alt="Secretaria Municipal de Cultura" class="mw-100">
                        </a>
                    </div>

                    <div class="col-12 col-md-5 col-lg-4 text-center">
                        <a href="https://www.itaquaquecetuba.sp.gov.br">
                            <img src="<?= shared("assets/images/logotipo-prefeitura-itaquaquecetuba_v3-borda.png", true) ?>"
                                 alt="Prefeitura de Itaquaquecetuba" class="mw-100">
                        </a>
                    </div>
                </div>

                <h1 class="display-4 fw-bold text-white text-center text-shadow">
                    <?= site("name") ?>
                </h1>

                <h2 class="fs-1 fst-italic text-white text-center text-shadow">
                    Tema "Fraternidade e fome" e o lema "Dai-lhes vós de comer"(Mt 14, 16)
                </h2>
            </div>
        </div>
    </div>

    <div class="container">
        <?= $v->section("content") ?>
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
<?= $v->section("scripts"); ?>
</body>
</html>