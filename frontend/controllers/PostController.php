<?php
namespace frontend\controllers;

use frontend\resources\Post;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;
use yii\filters\auth\HttpBearerAuth;

class PostController extends ActiveController
{
    public $modelClass = Post::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];

        return $behaviors;
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['update', 'delete']) && $model->created_by !== \Yii::$app->user->id) {
            throw new ForbiddenHttpException('You do not have permission to change this record');
        }
    }

}
