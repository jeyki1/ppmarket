<?php
    include "components/core.php";
    
if($_POST){
    $users = $link->query("SELECT * FROM `users` 
        WHERE `login` = '{$_POST['login']}'");
    if($users->num_rows == 0){
        $link->query("INSERT INTO `users`(`fullname`, `email`, `login`, `password`)
        VALUES (
            '{$_POST['fullname']}',
            '{$_POST['email']}',
            '{$_POST['login']}',
            '{$_POST['password']}'
        )");
    }else{
        $error = "This user already exists!";
    }
    header("Location: login.php");
}

include "components/header.php";
?>
<main class="cont">
        <div class="pre-beat-cont">
        <div class="pre-beat-tit">
            <h2>Добро пожаловать</h2>
        </div>
<div class="log-form-cont">
    <p>Регистрация</p>
    <form action="" method="post">
        <input type="text" id="fullname" name="fullname" placeholder="ФИО" required>
        <input type="email" id="email" name="email" placeholder="Почта" required>
        <input type="text" id="login" name="login" placeholder="Логин" required>
        <input type="password" id="password" name="password" placeholder="Пароль" required>
        <div>
        <button type="submit">
            Зарегистрироваться
        </button>
    <a href="login.php">
        <button type="button">
            Уже есть учетная запись?
        </button>
    </a>
    </div>
    </a>
    </form>
<p class="comment">
    Создавая учетную запись и/или входя в систему, вы соглашаетесь с условиями использования и политикой конфиденциальности ППМ Маркет.</p>
</p>
</div>
</div>
</main>
<?php include "components/footer.php"; ?>