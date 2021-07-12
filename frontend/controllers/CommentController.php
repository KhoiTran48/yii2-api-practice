<?php
namespace frontend\controllers;

use yii\rest\ActiveController;
use frontend\resources\Comment;
use yii\data\ActiveDataProvider;

class CommentController extends ActiveController
{
    public $modelClass = Comment::class;

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        
        return $actions;
    }

    public function prepareDataProvider()
    {
        return new ActiveDataProvider([
            'query' => Comment::find()->andWhere(['post_id' => \Yii::$app->request->get('postId')])
        ]);
    }

}
