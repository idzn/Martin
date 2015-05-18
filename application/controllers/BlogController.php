<?php

namespace application\controllers;

use application\custom\App;
use application\custom\Controller;
use application\models\ArticlesModel;
use Martin\exceptions\HttpError;

class BlogController extends Controller
{
    public $modelArticles;

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'martin';
        $this->modelArticles = new ArticlesModel();
    }

    public function action_index()
    {
        App::pager()->setOriginalUrl(App::runtime()->uri);
        App::pager()->setLimit(3);
        App::pager()->setPage((isset($_GET['page'])) ? $_GET['page'] : 1);
        App::pager()->setCount($this->modelArticles->getCount());
        $data = $this->modelArticles->getAll(App::pager()->getLimit() * (App::pager()->getPage() - 1), App::pager()->getLimit());

        if (empty($data)) throw new HttpError('404');
        App::runtime()->pageTitle = 'Блог';
        return $this->render('blog/index', ['data' => $data]);
    }

    public function action_show($id)
    {
        $data = $this->modelArticles->getOne($id);
        if (empty($data)) throw new HttpError('404');
        App::runtime()->pageTitle = $data['title'] . ' | Блог';
        return $this->render('blog/show', ['data' => $data]);
    }
}