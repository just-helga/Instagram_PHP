<?php

use App\Application\Messages\Alert;
use App\Application\Messages\FormData;

use App\Application\Views\View;
use App\Application\Config\Config;
use App\Application\Messages\Error;

Error::clear();
FormData::clear();
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
                <div class="alert alert-<?=Alert::getType()?> mb-3" role="alert">
                    <i class="bi bi-<?= Alert::getType() === 'danger' ? 'exclamation-circle' : 'check-circle' ?> text-<?=Alert::getType(true)?>"></i>
                    <?= Alert::getMessage(true) ?>
                </div>
                <?php
            }
            ?>
            <div class="card p-3">
                <form method="post" action="/publish_save" enctype="multipart/form-data">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-download"></i>
                            </span>
                            <input type="file"
                                   class="form-control
                                   <?= Error::has('image') ? 'is-invalid' : '' ?>
                                   <?= (!(Error::has('image')) && FormData::has('image')) ? 'is-valid' : '' ?>"
                                   id="image"
                                   name="image"
                                   placeholder="Image">
                        </div>
                        <?php
                        if (Error::has('image')) {
                            ?>
                            <div class="invalid-feedback">
                                <?= Error::getMessage('image') ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-text-indent-left"></i>
                            </span>
                            <div class="form-floating">
                                <textarea
                                          class="form-control
                                          <?= Error::has('description') ? 'is-invalid' : '' ?>
                                          <?= (!(Error::has('description')) && FormData::has('description')) ? 'is-valid' : '' ?>"
                                          id="description"
                                          name="description"
                                          value="<?=FormData::get('description')?>"></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                        <?php
                        if (Error::has('description')) {
                            ?>
                            <div class="invalid-feedback">
                                <?= Error::getMessage('description') ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-dark w-25">Publish</button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>


