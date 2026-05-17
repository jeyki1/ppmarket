<?php
    include "components/core.php";
    include "components/header.php";
?>
<div class="main-cont">
    <div class="about-cont-end"></div>
    <div class="cont main-cont-content">
        <p class="header-p">О PPM Market</p>
        <h1>Больше 10 лет в игре</h1>
        <h1 style="font-size: 3rem; margin-bottom: 20px;">Наш звук – твой успех</h1>
        <p>
            PPM Market — это больше, чем просто магазин битов. Мы — коллектив продюсеров, звукорежиссеров и саунд-дизайнеров из Омска, стремящийся расширить границы современного музыкального производства.
            Более 10 лет мы помогаем сотням артистов найти свой уникальный звук.
        </p>
        <div>
            <a href="explore.php"><button class="but-cat">Перейти в каталог</button></a>
            <a href="othsevr.php"><button class="but-oth">Прочие услуги</button></a>
        </div>
    </div>
</div>

<main class="cont">
    <div class="port-grid">
        <div class="cont main-about-content">
            <p class="header-p">Портфолио</p>
            <h1>и главные работы</h1>
        </div>
        
    </div>

    <div class="port-grid">
        <div class="port-item">
            <img src="images/ogbaby.jpg" alt="">
            <div class="port-caption">
                <h4>Og Buda — Бейбитрон 3</h4>
                <p>спродюсировано Джейки</p>
            </div>
        </div>

        <div class="port-item">
            <img src="images/ogsmack.jpg" alt="">
            <div class="port-caption">
                <h4>Og Buda — Смак</h4>
                <p>спродюсировано Джейки и Роузлордом</p>
            </div>
        </div>

        <div class="port-item">
            <img src="images/pbm.jpg" alt="">
            <div class="port-caption">
                <h4>Plaqueboymax — clear2 (невыпущено)</h4>
                <p>спродюсировано Джейки и Р3версми</p>
            </div>
        </div>

        <div class="port-item">
            <img src="images/lazerdim.jpg" alt="">
            <div class="port-caption">
                <h4>Lazer Dim 700 — Esqusit (невыпущено)</h4>
                <p>спродюсировано Джейки</p>
            </div>
        </div>

        <div class="port-item">
            <img src="images/nwayvrossii.jpg" alt="">
            <div class="port-caption">
                <h4>4n Way - В России</h4>
                <p>спродюсировано Джейки</p>
            </div>
        </div>

            <div class="port-item">
            <img src="images/bakhat.jpeg" alt="">
            <div class="port-caption">
                <h4>Bakhat - Наушники / Колонки</h4>
                <p>спродюсировано Джейки</p>
            </div>
        </div>

                <div class="port-item">
            <img src="images/vladwashere.jpeg" alt="">
            <div class="port-caption">
                <h4>Zelly Ocho - JUST BODY</h4>
                <p>спродюсировано Джейки</p>
            </div>
        </div>

            <div class="port-item">
            <img src="images/rioleyva.jpeg" alt="">
            <div class="port-caption">
                <h4>Rio Leyva - Snippet (невыпущено)</h4>
                <p>спродюсировано Джейки</p>
            </div>
        </div>

            <div class="port-item">
            <img src="images/molodoikaluga.jpeg" alt="">
            <div class="port-caption">
                <h4>Молодой Калуга - Еще</h4>
                <p>спродюсировано Джейки</p>
            </div>
        </div>

            <div class="port-item">
            <img src="images/toxis.jpg" alt="">
            <div class="port-caption">
                <h4>Toxi$ - Реклама Самоката</h4>
                <p>спродюсировано Джейки</p>
            </div>
        </div>

        
    </div>

    <div class="cont" style="margin-top: 32px; margin-bottom: 40px;">
        <p style="color:#aaa; max-width:640px;">
            Мы не просто создаём звук — мы превращаем идеи в готовые продукты. Нужен готовый бит или блестящий микс? Мы это сделаем.
        </p>
    </div>

    <div class="form-cont">
        <h2>Связь с нами</h2>
        <form action="components/contact.php" method="post">
            <input type="text"  name="name"    placeholder="Ваше имя" required>
            <input type="tel"   name="phone"   placeholder="+7 (999) 999-99-99" required>
            <input type="email" name="email"   placeholder="Ваша Почта" required>
            <textarea name="message" placeholder="Сообщение"></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>
</main>

<?php include "components/footer.php"; ?>