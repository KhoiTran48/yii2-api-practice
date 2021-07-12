<?php
namespace frontend\controllers;

use yii\rest\ActiveController;
use frontend\resources\Comment;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;

class CommentController extends ActiveController
{
    public $modelClass = Comment::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        
        return $actions;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];

        return $behaviors;
    }

    public function prepareDataProvider()
    {
        return new ActiveDataProvider([
            'query' => Comment::find()->andWhere(['post_id' => \Yii::$app->request->get('postId')])
        ]);
    }

    public function checkAccess($action, $model = null, $params = [])
    {
        if (in_array($action, ['update', 'delete']) && $model->created_by !== \Yii::$app->user->id) {
            throw new ForbiddenHttpException('You do not have permission to change this record');
        }
    }

}
