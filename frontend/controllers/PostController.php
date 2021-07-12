<?php
namespace frontend\controllers;

use frontend\resources\Post;
use yii\rest\ActiveController;

class PostController extends ActiveController
{
    public $modelClass = Post::class;
}
