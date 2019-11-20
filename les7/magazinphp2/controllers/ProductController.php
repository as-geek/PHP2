<?php


namespace app\controllers;


use app\models\repositories\ProductRepository;

class ProductController extends Controller
{
    protected $defaultAction = 'index';

    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog() {
        $catalog = (new ProductRepository())->getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
    }

    public function actionItem() {
        $product = (new ProductRepository())->getOne($this->actionId);
        echo $this->render('item', ['product' => $product]);
    }
}

