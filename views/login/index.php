<div class="row h-100 w-80 justify-content-center align-items-center">
    <div class="col-6 h4" style="margin-bottom: 20px;">
        Авторизация
    </div>
</div>
<div class="row h-100 w-80 justify-content-center align-items-center">
    <div class="form-group col-6">
        <div class="alert alert-danger" role="alert" style="margin-bottom: 30px; display: <?= $model->wrongLoginPass ? 'block' : 'none' ?>;">
            Неверное имя пользователя и(или) неверный пароль
        </div>
        <form class="needs-validation" novalidate action="" method="post">
            <div class="form-group">
                <label for="userName">Имя пользователя</label>
                <input type="text" class="form-control" name="userName" id="userName" placeholder="Введите имя" required>
                <div class="invalid-feedback">
                    Имя пользователя не введено
                </div>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль" required>
                <div class="invalid-feedback">
                    Пароль не введен
                </div>
            </div>
            <div class="form-group">
                <button type="submit" name="submit" value="login" class="btn btn-primary">Войти</button>
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