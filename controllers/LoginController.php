<?php
class LoginController extends Controller
{
    public function actionIndex()
    {
        $model['title'] = 'Авторизация';
        $login = new Login();
        $model['wrongLoginPass'] = false;
        if ($login->requestPost())
        {
            if ($login->login() === false)
            {
                $model['wrongLoginPass'] = true;
            }
        }
        $this -> render('index', $model);
    }

    public function actionLogout()
    {
        (new Login)->logout();
        header('Location: /tasks?logout=true');
    }
}