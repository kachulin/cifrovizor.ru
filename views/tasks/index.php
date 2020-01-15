<?php if ($model->addTaskStatus == 'success'){ ?>
<div class="row h-100 w-80 justify-content-center align-items-center">
    <div class="col-10 alert alert-success" role="alert" style="margin-bottom: 20px;">
        Новая задача успешно добавлена!
    </div>
</div>
<?php } ?>
<?php if ($model->logoutStatus == 'true'){ ?>
    <div class="row h-100 w-80 justify-content-center align-items-center">
        <div class="col-10 alert alert-danger" role="alert" style="margin-bottom: 20px;">
            Вы вышли из учетной записи!
        </div>
    </div>
<?php } ?>
<div class="row h-100 w-80 justify-content-center align-items-center">
    <div class="col-10 h4" style="margin-bottom: 20px;">
        Список задач
    </div>
</div>
<div class="row h-100 justify-content-center align-items-center">
    <table class="table col-10">
        <thead>
        <tr>
            <th><a href="#" orderby="id" sortby="{ sortby }">№</a></th>
            <th><a href="#" orderby="user_name" sortby="{ sortby }">Имя</a></th>
            <th><a href="#" orderby="email" sortby="{ sortby }">Эл.почта</a></th>
            <th><a href="#" orderby="task_text" sortby="{ sortby }">Задача</a></th>
            <th><a href="#" orderby="status" sortby="{ sortby }">Статус</a></th>
            <?php if ($model->auth) { echo '<th>Действие</th>'; } ?>
        </tr>
        </thead>
        <tbody>
        <?php
        if (count($model->tasks))
        {
            foreach ($model->tasks as $task)
            {
            ?>
                <tr>
                    <th scope="row"><?= $task->id ?></th>
                    <td><?= $task->user_name ?></td>
                    <td><?= $task->email ?></td>
                    <td><?= $task->task_text ?></td>
                    <td><?= $task->statusText ?><?php if ($task->edit_admin){echo '<br><span class="small bg-warning">Отредактировано администратором</span>';} ?></td>
                    <?php if ($model->auth) { echo '<td><a href="/tasks/edit?id=' . $task->id . '" orderby="status" sortby="{ sortby }">Редактировать</a></td>'; } ?>
                </tr>
            <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>
                Записей нет
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<div class="row h-100 justify-content-center align-items-center">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php for($p = 1; $p < $model->pages + 1; $p++) { ?>
            <li class="page-item" style="margin: 2px;"><button type="submit" name="page" value="<?= $p ?>" <?= $model->page == $p ? 'class="btn-sm btn-secondary" disabled' : 'class="btn-sm btn-primary" ' ?>><?= $p ?></button></li>
            <?php } ?>
        </ul>
    </nav>
</div>
<script>
    $(document).ready(function ()
    {
        var urlVars = getUrlVars();
        if (urlVars['page']) { page = urlVars['page']; }
        else { page = 1; }
        if (urlVars['orderby']) { orderby = urlVars['orderby']; }
        else { orderby = 'id'; }
        if (urlVars['sortby']) { sortby = urlVars['sortby']; }
        else { sortby = 'asc'; }
        console.log(sortby);
    });
    $('a[orderby]').on('click', function(){
        sortby = 'asc';
        if (orderby == $(this).attr('orderby')) {
            if ($(this).attr('sortby') == 'asc') {
                sortby = 'desc';
            }
        }
        document.location.href = '?page=' + page + '&orderby=' + $(this).attr('orderby') + '&sortby=' + sortby;
    });
    $('button[name="page"]').on('click', function(){
        document.location.href = '?page=' + $(this).val() + '&orderby=' + orderby + '&sortby=' + sortby;
    });
    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
</script>
