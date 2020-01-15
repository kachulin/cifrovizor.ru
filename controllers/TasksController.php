<?php
class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = new Tasks;
        $tasksList = $tasks->getTasksByPage();
        $pagesNum = $tasks->getPagesNum();
        $page = $tasks->getCurrentPage();
        $addTaskStatus = $tasks->getAddTaskStatus();
        $logoutStatus = $tasks->getLogoutStatus();
        $sortAttr = $tasks->getSortAttr();
        $authStatus = $tasks->checkAuth();
        $model = ['title' => 'Список задач', 'auth' => $authStatus, 'tasks' => $tasksList, 'pages' => $pagesNum, 'page' => $page, 'sortby' => $sortAttr, 'addTaskStatus' => $addTaskStatus, 'logoutStatus' => $logoutStatus];
        $this -> render('index', $model);
    }

    public function actionCreate()
    {
        $model['title'] = 'Создание задачи';
        $tasks = new Tasks;
        $post = $tasks->requestPost();
        if ($post)
        {
            if ($tasks->addTask())
            {
                $page = $tasks->getPagesNum();
                $this->redirect('/tasks?addTaskStatus=success&page=' . $page);
            }
            else
            {
                $model = ['statusAddTask' => 'error'];
            }
        }
        $this -> render('create', $model);
    }

    public function actionEdit()
    {
        $model['title'] = 'Редактирование задачи';
        $tasks = new Tasks;
        if ($tasks->checkAuth())
        {
            if ($tasks->requestPost())
            {
                $tasks->updateTask();
                $this->redirect('/tasks');
            }
            else
            {
                $task = $tasks->getTaskById();
                $model['task'] = $task;
                $this -> render('edit', $model);
            }
        }
        else
        {
            $this->redirect('/login');
        }
    }
}