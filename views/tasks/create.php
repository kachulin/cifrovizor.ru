<div class="row h-100 w-80 justify-content-center align-items-center">
    <div class="col-6 h4" style="margin-bottom: 20px;">
        Создание
    </div>
</div>
<div class="row h-100 w-80 justify-content-center align-items-center">
    <div class="form-group col-6">
        <form class="needs-validation" novalidate action="" method="post">
            <div class="form-group">
                <label for="userName">Имя</label>
                <input type="text" class="form-control" name="userName" id="userName" placeholder="Введите имя" required>
                <div class="invalid-feedback">
                    Имя пользователя не введено
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Введите email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                <div id="email-error" class="invalid-feedback">
                    Email не введен
                </div>
            </div>
            <div class="form-group">
                <label for="taskText">Задача</label>
                <textarea class="form-control" name="taskText" id="taskText" rows="3" required></textarea>
                <div class="invalid-feedback">
                    Текст задачи не введен
                </div>
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
                        var email = $("#email").val();
                        if(email.length > 1 ) {
                            form.classList.add('was-validated');
                            $("#email-error").text("Некорректный email");
                        }
                        else{
                            $("#email-error").text("email не введен");
                        }
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
    //$.validator.methods.email = function( value, element ) {
    //    return this.optional( element ) || /[a-z]+@[a-z]+\.[a-z]{2,}/.test( value );
    //}
</script>
