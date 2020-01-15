<?php
class Tasks extends Model
{
    public function getAllTasks()
    {
        return $this->db()->selectAll('tasks');
    }

    public function getTasksByPage()
    {
        $sortby = $this->getSortAttr();
        if (isset($_GET['orderby']))
        {
            $orderBy = $_GET['orderby'];
        }
        else
        {
            $orderBy = 'id';
        }
        $page = $this->getCurrentPage();
        $limitStart = ($page-1) * 3;
        $result = $this->db()->conn()->query("SELECT * FROM `tasks` WHERE 1 ORDER BY `$orderBy` $sortby LIMIT $limitStart,3");
        while ($row = mysqli_fetch_assoc($result))
        {
            $row['statusText'] = $this->getStatusText($row['status']);
            $rows[] = (object)$row;
        }
        return $rows;
    }

    public function getTaskById()
    {
        if (isset($_GET['id']))
        {
            $id = intval($_GET['id']);
            $result = $this->db()->conn()->query("SELECT * FROM `tasks` WHERE `id` = $id");
            if (mysqli_num_rows($result))
            {
                $row = mysqli_fetch_assoc($result);
                $row['statusText'] = $this->getStatusText($row['status']);
                return (object)$row;
            }
        }
        return false;
    }

    public function getStatusText($status)
    {
        switch ($status)
        {
            case 1: $statusText = 'Создана';
                break;
            case 2: $statusText = 'В работе';
                break;
            case 3: $statusText = 'Выполнена';
        }
        return $statusText;
    }

    public function getPagesNum()
    {
        $pagesNum = floor ((count ($this->db()->selectAll('tasks'))-1)/3) + 1;
        return $pagesNum;
    }

    public function getCurrentPage()
    {
        if (isset($_GET['page']) && is_numeric($_GET['page']) && ($_GET['page'] != ''))
        {
            return $_GET['page'];
        }
        else
        {
            return 1;
        }
    }

    public function getAddTaskStatus()
    {
        if (isset($_GET['addTaskStatus']))
        {
            return $_GET['addTaskStatus'];
        }
        else
        {
            return false;
        }
    }
    public function getLogoutStatus()
    {
        if (isset($_GET['logout']))
        {
            return $_GET['logout'];
        }
        else
        {
            return false;
        }
    }

    public function getSortAttr()
    {
        if (isset($_GET['sortby']) && ($_GET['sortby']=='asc' || $_GET['sortby']=='desc'))
        {
            $sortby = $_GET['sortby'];
        }
        else
        {
            $sortby = 'asc';
        }
        return $sortby;
    }

    public function addTask()
    {
        $db = $this->db()->conn();
        $userName = mysqli_real_escape_string($db, $_POST['userName']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $taskText = htmlspecialchars((mysqli_real_escape_string($db, $_POST['taskText'])));
        if ($userName && $email && $taskText)
        {
            $db->query("INSERT INTO `tasks` (`user_name`,`email`,`task_text`,`status`) VALUES ('$userName','$email','$taskText', 1)");
            return true;
        }
        else
        {
            return false;
        }
    }
    public function updateTask()
    {
        $db = $this->db()->conn();
        $id = intval($_POST['taskId']);
        $result = $this->db()->conn()->query("SELECT * FROM `tasks` WHERE `id` = $id");
        if (mysqli_num_rows($result))
        {
            $row = mysqli_fetch_assoc($result);
            $taskTextOld = $row['task_text'];
        }
        $taskStatus = intval($_POST['taskStatus']);
        $db->query("UPDATE `tasks` SET `status` = $taskStatus WHERE `id` = $id");

        $taskTextNew = htmlspecialchars((mysqli_real_escape_string($db, $_POST['taskText'])));
        if ($taskTextOld !== $taskTextNew)
        {
            $db->query("UPDATE `tasks` SET `task_text` = '$taskTextNew' WHERE `id` = $id");
            $db->query("UPDATE `tasks` SET `edit_admin` = 1 WHERE `id` = $id");
        }
    }

    public function requestPost()
    {
        if (count($_POST))
        {
            return (object)$_POST;
        }
        return false;
    }
}