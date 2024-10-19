<?php

use App\Application\Auth\Auth;
use App\Application\Views\View;
use App\Application\Config\Config;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;

$posts = (new Post())->all();
$likes = (new Like())->all();
if (Auth::check()) {
    $userId = Auth::id();
} else {
    $userId = null;
}
?>
<!doctype html>
<html lang="<?= Config::get('app.lang') ?>">
<head>
    <?php View::component('head'); ?>
    <title><?= Config::get('app.name') ?> </title>
</head>
<body>
<?= View::component('nav') ?>
<main class="main">
    <div class="row justify-content-center">
        <?php
        foreach ($posts as $post) {
            $postId = $post->id();
            $allLikes = array_filter($likes, function($like) use ($postId) {
                return $like->getPostId() === $postId;
            });
            $countLikes = count($allLikes);
            $like = array_filter($allLikes, function($like) use ($userId) {
                return $like->getUserId() === $userId;
            });
            $exists = !empty($like);

            $user = ((new User())->find('id', $post->getUserId()));
            ?>
            <div class="col-12 mb-3">
                <div class="card <?= $exists ? 'like' : '' ?>">
                    <div class="card-header">
                        <div class="card-user">
                            <img src="<?= $user->getAvatar() ?? '/assets/images/avatar.jpg' ?>" class="card-avatar">
                            <span class="card-username"><?= $user->getName() ?></span>
                        </div>
                        <form action="/like" method="post">
                            <input type="hidden" name="post_id" value="<?= $post->id() ?>">
                            <button type="submit" class="card-link">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-heart-fill"></i>
                                <span><?= $countLikes ?></span>
                            </button>
                        </form>
                    </div>
                    <img src="<?= $post->getImage() ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"><?= $post->getDescription() ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</main>
</body>
</html>