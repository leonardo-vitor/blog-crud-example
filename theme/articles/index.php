<?php $this->layout("articles/_theme"); ?>

<?php if ($articles): ?>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Criado dia</th>
                <th>Ultima atualização</th>
                <th>#</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($articles as $article): ?>
                <tr>
                    <td><?= $article->title ?></td>
                    <td><?= $article->author ?></td>
                    <td><?= date_fmt($article->created_at) ?></td>
                    <td><?= date_fmt($article->updated_at) ?></td>
                    <td>#</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class="alert alert-info" role="alert">
        Nenhum artigo cadastrado. <a href="<?= $router->route('articles.create') ?>">Cadastrar artigo</a>.
    </div>
<?php endif; ?>
