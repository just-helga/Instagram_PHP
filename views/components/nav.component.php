<?php

use App\Application\Auth\Auth;
use App\Application\Config\Config;
?>

<ul class="nav nav-tabs mt-3 justify-content-between">
    <li class="nav-item">
        <a class="nav-link active text-uppercase" aria-current="page" href="/"><?= Config::get('app.name')?></a>
    </li>
    <?php
    if (Auth::check()) {
    ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= (Auth::user())->getName() ?></a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="/logout" method="post">
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                </li>
            </ul>
        </li>
    <?php
    } else {
    ?>
        <li class="nav-item">
            <a class="nav-link" href="/login" aria-expanded="page">Login</a>
        </li>
    <?php
    }
    ?>
</ul>