<?php

namespace application\models;

use application\core\Model;

class Blog extends Model
{
    public function postsCount()
{
    return $this->db->column('SELECT COUNT(posts_id) FROM posts');
}

    public function postsList($route)
    {
        $max = 8;
        $params = [
            'max' => $max,
            'start' => ((($route['page'] ?? 1) - 1) * $max),
        ];
        $query = 'SELECT posts_id, posts_title, posts_long_title, posts_description, 
                  posts_text, posts_image, posts_accounts_id, posts_create_time, posts_update_time, 
                  accounts_FIO, 
                  (SELECT count(likes_accounts_id) FROM likes
                  WHERE likes_posts_id = posts_id) as likes
                  FROM posts p
                  LEFT JOIN accounts a on p.posts_accounts_id = a.accounts_id 
                  ORDER BY posts_id DESC LIMIT :start, :max';
        $result = $this->db->row($query, $params);

        return $result;
    }
}