<?php


namespace app\controllers;



class CartController extends Controller
{
    protected $defaultAction = 'cart';

    public function actionCart() {
        echo $this->render('cart');
    }


}

