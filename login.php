<?php
    include "components/core.php";

if($_POST){
    $users = $link->query("SELECT * FROM `users` 
        WHERE `login` = '{$_POST['login']}'
            AND `password` = '{$_POST['password']}'");
        if($users->num_rows !=0){
            $user = $users->fetch_assoc();
            $_SESSION['user'] = [
                'id' =>$user['id'],
                'role' =>$user['role_id'],
            ];
            header("Location: basket.php");
        }else{
            $error = "Неправильный логин или пароль";
        }
}
include "components/header.php";
?>
<main class="cont">
        <div class="pre-beat-cont">
        <div class="pre-beat-tit">
            <h2>Добро пожаловать</h2>
        </div>
<div class="log-form-cont">
    <p>Вход</p>
    <form action="" method="post">
        <input type="login" id="login" name="login" placeholder="Введите логин" required>
        <input type="password" id="password" name="password" placeholder="Введите пароль" required>
        <div>
        <button type="submit">
            Войти
        </button>
    <a href="singup.php">
        <button type="button">
            Нет учетной записи?
        </button>
    </a>
        </div>
    </a>
    </form>
<p class="comment">
    Создавая учетную запись и/или входя в систему, вы соглашаетесь с условиями использования и политикой конфиденциальности ППМ Маркет.</p>
</div>
</div>
</main>
<?php include "components/footer.php"; ?>