<?php

namespace App\Services\Like;

use App\Application\Auth\Auth;
use App\Application\Router\Redirect;
use App\Models\Like;

class LikeService implements LikeServiceInterface
{

    public function store(array $data): void
    {
        $postId = $data['post_id'];
        $userId = Auth::id();

        $allLikes = (new Like())->find('post_id', $postId, true);

        $userLike = null;
        foreach ($allLikes as $like) {
            if ($like->getUserId() === $userId) {
                $userLike = $like;
                break;
            }
        }

        if ($userLike) {
            $userLike->destroy('id', $like->id());
        } else {
            $newLike = new Like();
            $newLike->setPostId($postId);
            $newLike->setUserId($userId);
            $newLike->store();
        }

        Redirect::to('/');
    }
}