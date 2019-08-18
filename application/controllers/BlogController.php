<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12.04.2019
 * Time: 19:35
 */

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;

class BlogController extends Controller
{
    public function __construct($route)
    {
        parent::__construct($route);
    }

    public function indexAction()
    {
        $pagination = new Pagination($this->route, $this->model->postsCount());
        $vars = [
            'pagination' => $pagination->get(),
            'list' => $this->model->postsList($this->route),
        ];
        $this->view->render('Блог', $vars);
    }
}