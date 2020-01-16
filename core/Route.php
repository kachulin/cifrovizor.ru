<?php
class Route
{
    static function start()
    {
        $controllerName = $modelName = 'tasks';
        $actionName = 'index';
        if (strpos($_SERVER['REQUEST_URI'], '?'))
        {
            $routes = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));
        }
        else
        {
            $routes = $_SERVER['REQUEST_URI'];
        }

        $routes = explode('/', $routes);

        if (!empty($routes[1]))
        {
            $controllerName = $modelName = $routes[1];
        }

        if (!empty($routes[2]))
        {
            $actionName = $routes[2];
        }

        $actionName = 'action'.ucfirst($actionName);

        $modelPath = "models/".ucfirst($modelName).'.php';
        if(file_exists($modelPath))
        {
            include $modelPath;
        }
        $controllerName = ucfirst(strtolower($controllerName)).'Controller';
        $controllerPath = "controllers/".$controllerName.'.php';
        if(file_exists($controllerPath))
        {
            include $controllerPath;
            $controller = new $controllerName;
            $action = $actionName;

            if(method_exists($controller, $action))
            {
                $controller -> $action();
            }
            else
            {
                Route::ErrorPage404();
            }
        }
        else
        {
            Route::ErrorPage404();
        }
    }

    function ErrorPage404()
    {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:'.$host.'error404.php');
    }
}
