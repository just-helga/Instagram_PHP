<?php

namespace App\Services\Post;

use App\Application\Auth\Auth;
use App\Application\Messages\Alert;
use App\Application\Router\Redirect;
use App\Application\Upload\Upload;
use App\Models\Post;

class PostService implements PostServiceInterface
{

    public function store(array $image, ?string $description): void
    {
        if ($image = Upload::file($image, 'images')) {
            $post = new Post();
            $post->setImage($image);
            $post->setDescription($description);
            $post->setUserId(Auth::id());
            $post->store();
        } else {
            Alert::storeMessage('Error uploading the file');
            Redirect::to('/publish');
        }
    }

    public function destroy(int $id): void
    {
        (new Post())->destroy('id', $id);
    }
}