<?php $this->layout("articles/_theme"); ?>

<div class="row justify-content-center pb-5">
    <div class="col-12 col-md-10 col-lg-8">
        <h1>Editar artigo: <?= $article->title ?></h1>
        <hr>

        <form action="<?= $router->route("articles.update", ['uri' => $article->uri]) ?>" class="row send-ajax" method="post">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" maxlength="255" required value="<?= $article->title ?>">
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="author" class="form-label">Autor</label>
                    <input type="text" class="form-control" id="author" name="author" maxlength="255" required value="<?= $article->author ?>">
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="content" class="form-label">Artigo</label>
                    <textarea id="content" name="content"><?= htmlspecialchars_decode($article->content) ?></textarea>
                </div>
            </div>

            <div class="col">
                <button class="btn btn-primary" type="submit">Salvar</button>
                <a href="<?= $router->route('articles.index') ?>" class="btn btn-link">Voltar</a>
            </div>
        </form>

        <div class="form_callback mt-3"></div>
    </div>
</div>

<?php $this->start('scripts'); ?>
<script src="https://cdn.tiny.cloud/1/whsbj7c7sjxfz1z6o8w6sw47bzgd6mgrjurxpy8vx6rre9en/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '#content',
        menubar: false
    });
</script>
<?php $this->end(); ?>
