<nav class="navbar navbar-expand-lg navbar-light" style="margin-bottom:50px; background-color: #e3f2fd;">
    <a class="navbar-brand" href="#"><strong>BeeTask</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link { active-tasks-index }" href="/tasks">Список задач<span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link { active-tasks-create }" href="/tasks/create">Добавить задачу</a>
            <a class="nav-item nav-link { active-login-index } btn btn-primary text-white" href="<?= $model->login ? '/login/logout' : '/login' ?>">
                <?= $model->login ? 'Выйти' : 'Войти' ?></a>
        </div>
    </div>
</nav>
