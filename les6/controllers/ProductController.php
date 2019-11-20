<?php


namespace app\controllers;


use app\models\Product;

class ProductController extends Controller
{
    protected $defaultAction = 'index';

    public function actionIndex() {
        echo $this->render('index');
    }

    public function actionCatalog() {
        $catalog = Product::getAll();
        echo $this->render('catalog', ['catalog' => $catalog]);
    }

    public function actionItem() {
        $product = Product::getOne($this->actionId);
        echo $this->render('item', ['product' => $product]);
    }


}

