<?php $this->layout("articles/_theme"); ?>

<div class="row justify-content-center pb-5">
    <div class="col-12 col-md-10 col-lg-8">
        <h1><?= $article->title ?></h1>
        <hr class="my-1">
        <h2 class="h6 mb-5"><?= $article->author ?> | <?= date_fmt($article->created_at) ?></h2>

        <?= htmlspecialchars_decode($article->content) ?>
    </div>
</div>
