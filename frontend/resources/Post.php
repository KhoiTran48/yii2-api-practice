<?php

namespace frontend\resources;

use frontend\resources\Comment;

class Post extends \common\models\Post
{
    public function fields()
    {
        return ['id', 'title', 'body'];
    }

    public function extraFields()
    {
        return ['created_at', 'comments', 'createdBy'];
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CommentQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }
}
