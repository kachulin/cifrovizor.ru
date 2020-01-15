<?php
class View
{
    public function generatePage($viewPath, $model)
    {
        ob_start();
        include 'views/layouts/header.php';
        $header = ob_get_clean();
        ob_start();
        include $viewPath;
        $content = ob_get_clean();
        foreach ($model as $key => $value)
        {
            if (gettype($value) != 'object' && gettype($value) != 'array')
            {
                $content = str_replace('{ ' . $key . ' }', $value, $content);
                $header = str_replace('{ ' . $key . ' }', $value, $header);
            }
        }
        require_once 'views/layouts/main.php';
    }
}