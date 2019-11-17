<?php


namespace app\controllers;



use app\engine\Request;
use app\models\Cart;

class CartController extends Controller
{
    protected $defaultAction = 'cart';

    public function actionCart() {
        $cart = Cart::getCart(session_id());
        echo $this->render('cart', ['products' => $cart]);
    }

    public function actionAddToCart() {
        $id = $this->request->getParams()['id'];
        (new Cart(session_id(), $id))->save();


        header('Content-Type: application/json');
        echo json_encode(['response' => 'ok', 'count' => Cart::getCountWhere('session_id', session_id())]);
        die();
    }

    public function actionDelete() {
        $id = $this->request->getParams()['id'];
        $session = session_id();
        $cart = Cart::getOne($id);
        if ($session == $cart->session_id) {
            $cart->delete();
        }

        echo json_encode(['response' => 'ok', 'count' => Cart::getCountWhere('session_id', session_id())]);
        die();
    }
}


