<div class="row h-100 w-80 justify-content-center align-items-center">
    <div class="col-6 h4" style="margin-bottom: 20px;">
        Редактирование
    </div>
</div>
<div class="row h-100 w-80 justify-content-center align-items-center">
    <div class="form-group col-6">
        <form class="needs-validation" novalidate action="" method="post">
            <div class="form-group">
                <label for="id">Номер</label>
                <input type="text" class="form-control" name="id" id="id" placeholder="<?= $model->task->id ?>" disabled>
            </div>
            <div class="form-group">
                <label for="userName">Имя</label>
                <input type="text" class="form-control" name="userName" id="userName" placeholder="<?= $model->task->user_name ?>" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="<?= $model->task->email ?>" disabled>
            </div>
            <div class="form-group">
                <label for="taskText">Задача</label>
                <textarea class="form-control" name="taskText" id="taskText" rows="3" ><?= $model->task->task_text ?></textarea>
            </div>
            <div class="form-group">
                <select class="custom-select" name="taskStatus">
                    <option <?=  $model->task->status == 1 ? 'selected' : '' ?> value="1">Создана</option>
                    <option <?=  $model->task->status == 2 ? 'selected' : '' ?> value="2">В работе</option>
                    <option <?=  $model->task->status == 3 ? 'selected' : '' ?> value="3">Выполнена</option>
                </select>
            </div>
            <div class="form-group">
                <input type="hidden" name="taskId" id="taskId" value="<?= $model->task->id ?>">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" value="save" class="btn btn-primary">Сохранить</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>