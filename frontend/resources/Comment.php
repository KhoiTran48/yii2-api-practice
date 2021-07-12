<?php

namespace frontend\resources;

use frontend\resources\Post;

class Comment extends \common\models\Comment
{
    public function fields()
    {
        return ['title', 'body'];
    }

    public function extraFields()
    {
        return ['created_at', 'post'];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery|PostQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }
}
