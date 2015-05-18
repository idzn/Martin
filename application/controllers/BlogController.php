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
        App::paginator()->setOriginalUrl(App::runtime()->uri);
        App::paginator()->setLimit(3);
        App::paginator()->setPage((isset($_GET['page'])) ? $_GET['page'] : 1);
        App::paginator()->setCount($this->modelArticles->getCount());
        $data = $this->modelArticles->getAll(App::paginator()->getLimit() * (App::paginator()->getPage() - 1), App::paginator()->getLimit());

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