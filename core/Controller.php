<?php
class Controller
{
    public function render($view, $model = NULL)
    {
        if ((new Model())->checkAuth())
        {
            $model['login'] = true;
        }
        else
        {
            $model['login'] = false;
        }
        $controllerName = strtolower(substr(get_class($this), 0, strpos(get_class($this), 'Controller')));
        $renderViewPath = 'views/' . $controllerName . '/' . $view . '.php';
        $model['active-'.$controllerName.'-'.$view] = 'active';
        (new View) -> generatePage($renderViewPath, (object)$model);
    }
    public function redirect($url)
    {
        header('Location: '.$url);
    }
}
