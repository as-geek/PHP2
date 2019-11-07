<?php


namespace app\controllers;



abstract class Controller
{
    protected $action = '';
    protected $defaultAction = '';
    protected $actionId = '';
    protected $layout = 'main';
    protected $useLayout = true;

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
                'menu' => $this->renderTemplate('menu'),
                'content' => $this->renderTemplate($template, $params)
            ]);
        } else {
            return $this->renderTemplate($template, $params = []);
        }
    }

    public function renderTemplate($template, $params = []) {   //Собирает части страниц по отдельности
        ob_start();
        extract($params);
        $templateName = TEMPLATES_DIR . $template . ".php";
        if (file_exists($templateName)) {
            include $templateName;
        }
        return ob_get_clean();
    }
}