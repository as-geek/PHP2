<?php


namespace app\controllers;



use app\models\entities\Cart;
use \app\models\repositories\CartRepository;

class CartController extends Controller
{
    protected $defaultAction = 'cart';

    public function actionCart() {
        $cart = (new CartRepository())->getCart(session_id());
        echo $this->render('cart', ['products' => $cart]);
    }

    public function actionAddToCart() {
        $id = $this->request->getParams()['id'];

        $cart = new Cart(session_id(), $id);
        (new CartRepository())->save($cart);

        header('Content-Type: application/json');
        echo json_encode(['response' => 'ok', 'count' => (new CartRepository())->getCountWhere('session_id', session_id())]);
        die();
    }

    public function actionDelete() {
        $id = $this->request->getParams()['id'];
        $session = session_id();
        $cart = (new CartRepository())->getOne($id);
        if ($session == $cart->session_id) {
            (new CartRepository())->delete($cart);
        }

        echo json_encode(['response' => 'ok', 'count' => (new CartRepository())->getCountWhere('session_id', session_id())]);
        die();
    }
}


