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
                <form method="post" action="/login">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <div class="form-floating">
                                <input type="text"
                                       class="form-control
                                       <?= Error::has('name') ? 'is-invalid' : '' ?>
                                       <?= (!(Error::has('name')) && FormData::has('name')) ? 'is-valid' : '' ?>"
                                       id="name"
                                       name="name"
                                       placeholder="Username"
                                       value="<?=FormData::get('name')?>">
                                <label for= "email">Username</label>
                            </div>
                        </div>
                        <?php
                        if (Error::has('name')) {
                            ?>
                            <div class="invalid-feedback">
                                <?= Error::getMessage('name') ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <div class="form-floating">
                                <input type="password"
                                       class="form-control
                                       <?= Error::has('password') ? 'is-invalid' : '' ?>
                                       <?= (!(Error::has('password')) && FormData::has('password')) ? 'is-valid' : '' ?>"
                                       id="password"
                                       name="password"
                                       placeholder="Password"
                                       value="<?=FormData::get('password')?>">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <?php
                        if (Error::has('password')) {
                            ?>
                            <div class="invalid-feedback">
                                <?= Error::getMessage('password') ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <p>Don't you have an account yet? <a href="/register" class="link-dark">Register</a>!</p>
                    </div>
                    <button type="submit" class="btn btn-dark w-25">Login</button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>


