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
<html lang="<?= Config::get('app.lang') ?>" xmlns="http://www.w3.org/1999/html">
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
                <form method="post" action="/register">
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <div class="form-floating">
                                <input type="text"
                                       class="form-control
                                       <?= Error::has('email') ? 'is-invalid' : '' ?>
                                       <?= (!(Error::has('email')) && FormData::has('email')) ? 'is-valid' : '' ?>"
                                       id="email"
                                       name="email"
                                       placeholder="E-mail"
                                       value="<?=FormData::get('email')?>">
                                <label for= "email">E-mail</label>
                            </div>
                        </div>
                        <?php
                        if (Error::has('email')) {
                            ?>
                            <div class="invalid-feedback">
                                <?= Error::getMessage('email') ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-person"></i>
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
                                <label for="name">Username</label>
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
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-unlock"></i>
                            </span>
                            <div class="form-floating">
                                <input type="password"
                                       class="form-control
                                       <?= (Error::has('password_confirmation') || Error::has('password', 'confirm')) ? 'is-invalid' : '' ?>
                                       <?= (!Error::has('password_confirmation') && !Error::has('password', 'confirm') && FormData::has('password_confirmation')) ? 'is-valid' : '' ?>"
                                       id="password_confirmation"
                                       name="password_confirmation"
                                       placeholder="Password confirmation"
                                       value="<?=FormData::get('password_confirmation')?>">
                                <label for="password_confirmation">Password confirmation</label>
                            </div>
                        </div>
                        <?php
                        if (Error::has('password_confirmation')) {?>
                            <div class="invalid-feedback">
                                <?= Error::getMessage('password_confirmation') ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <p>Do you already have an account? <a href="/login" class="link-dark">Login</a>!</p>
                    </div>
                    <button type="submit" class="btn btn-dark w-25">Register</button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>
</html>