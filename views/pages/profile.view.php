<?php

use App\Application\Auth\Auth;
use App\Application\Messages\Alert;
use App\Application\Views\View;
use App\Application\Config\Config;
use App\Models\Post;

$user = Auth::user();
$post = new Post();
$posts = $post->find('user_id', $user->id(), true);
?>
<!doctype html>
<html lang="<?= Config::get('app.lang') ?>">
<head>
    <?php View::component('head'); ?>
    <title><?= Config::get('app.name') . ' - ' . $title ?> </title>
</head>
<body>
<?= View::component('nav') ?>
<main class="main">
    <div class="row justify-content-center">
        <div class="col-12 mb-3">
            <h3 class="mb-3"><?= $title?></h3>
            <?php
            if (Alert::getMessage()) {
                ?>
                <div class="alert alert-<?=Alert::getType(true)?> mb-3" role="alert">
                    <?= Alert::getMessage(true) ?>
                </div>
                <?php
            }
            ?>
            <div class="card p-3 mb-3 profile">
                <div class="row">
                    <div class="col-6 profile__img">
                        <?php
                        if (!$user->getAvatar()) {
                        ?>
                            <img src="/assets/images/avatar.jpg" class="img-thumbnail" alt="Profile Photo">
                        <?php
                        } else {
                        ?>
                            <img src="<?= $user->getAvatar() ?>" class="img-thumbnail" alt="<?= $user->getName() ?>">
                        <?php
                        }
                        ?>
                        <button type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#downloadAvatar"
                                class="profile__popup img-thumbnail">
                            <i class="bi bi-download"></i>
                        </button>
                        <!-- Модальное окно -->
                        <div class="modal fade" id="downloadAvatar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload an avatar</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="downloadForm" method="post" action="/download" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="bi bi-download"></i>
                                                    </span>
                                                    <input type="file"
                                                           class="form-control"
                                                           id="image"
                                                           name="image"
                                                           placeholder="Image">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" form="downloadForm" class="btn btn-dark w-25">Download</button>
                                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Закрыть</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column justify-content-between h-100">
                            <div>
                                <div class="d-flex justify-content-between">
                                    <h6><?= $user->getName() ?></h6>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text"><?= $user->getEmail() ?></p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <u class="card-text">Registration date:</u>
                                    <p class="card-text"><?= $user->getCreatedAt() ?></p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-outline-success profile__btn" href="/publish">New post</a>
                                <form action="/logout" method="post">
                                    <button class="btn btn-outline-danger profile__btn" type="submit">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-3 g-1">
                <?php
                foreach ($posts as $post) {
                ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?= $post->getImage() ?>" class="card-img-top post__img" alt="Image of the post">
                            <div class="card-body">
                                <p class="card-text"><?= $post->getDescription() ?></p>
                            </div>
                            <div class="card-footer d-flex flex-column justify-content-between align-items-center">
                                <div class="row w-100 justify-content-between">
                                    <form action="/delete" method="post">
                                        <input type="hidden" name="id" value="<?= $post->id() ?>">
                                        <button type="submit" class="btn btn-outline-danger col-12">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</main>
</body>
</html>


