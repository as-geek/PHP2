<?php


namespace app\controllers;


use app\engine\Request;
use app\interfaces\IRenderer;
use app\models\repositories\{CartRepository, UsersRepository};

abstract class Controller implements IRenderer
{
    protected $action = '';
    protected $defaultAction = '';
    protected $actionId = '';
    protected $layout = 'main';
    protected $useLayout = true;
    protected $renderer;
    protected $request;

    public function __construct(IRenderer $renderer)
    {
        $this->renderer = $renderer;
        $this->request = new Request();
    }

    public function runAction($action = null, $id = null) {
        if (!is_null($id)) {
            $this->actionId = $id;
        }
        $this->action = $action ?: $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            echo "Ошибка: нет такого action";
        }
    }

    public function render($template, $params = []) {   //Собирает общую страницу
        if ($this->useLayout) {
            return $this->renderTemplate("layouts/{$this->layout}", [
                'menu' => $this->renderTemplate('menu', [
                    'count' =>(new CartRepository())->getCountWhere('session_id', session_id())
                ]),
                'content' => $this->renderTemplate($template, $params),
                'auth' => (new UsersRepository())->isAuth(),
                'username' => (new UsersRepository())->getName()
            ]);
        } else {
            return $this->renderTemplate($template, $params = []);
        }
    }

    public function renderTemplate($template, $params = []) {   //Собирает части страниц по отдельности
       return $this->renderer->renderTemplate($template, $params);
    }
}