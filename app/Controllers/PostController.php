<?php

namespace App\Controllers;

use App\Application\Messages\Alert;
use App\Application\Messages\Error;
use App\Application\Messages\FormData;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Services\Post\PostService;

class PostController
{
    private PostService $service;

    public function __construct()
    {
        $this->service = new PostService();
    }

    public function store(Request $request)
    {
        $request->validation([
            'image' => ['required'],
        ], [
            'image.required' => 'Attach an image',
        ]);

        if (!$request->validationStatus()) {
            Alert::storeMessage('Check the correctness of the filled in fields', 'danger');
            FormData::store($request->getData('posts'));
            Redirect::to('/publish');
            die();
        }

        $this->service->store(
            $request->file('image'),
            $request->post('description')
        );

        Alert::storeMessage('The post has been successfully published', 'success');
        Redirect::to('/profile');
    }

    public function destroy(Request $request)
    {
        $this->service->destroy($request->post('id'));
        Alert::storeMessage('The post was successfully deleted', 'success');
        Redirect::to('/profile');
    }
}