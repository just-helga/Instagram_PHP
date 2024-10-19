<?php

namespace App\Models;

use App\Application\Database\Model;

class Like extends Model
{
    protected string $table = 'likes';
    protected array $fields = ['user_id', 'post_id'];

    protected int $user_id;
    protected int $post_id;

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getPostId()
    {
        return $this->post_id;
    }
}