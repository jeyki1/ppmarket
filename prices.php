<?php
    include "components/core.php";
    
    include "components/header.php";
?>
<main class="cont">
        <div class="pre-beat-cont">
            <div class="pre-beat-tit">
                <h2>Prices</h2>
            </div>
<div class="lic-main">
    <div class="license-cont">
        <div class="license-card">
                <h3>МП3 аренда</h3>
                <p class="license-price">2000₽</p>
                <p>Только МП3 версия</p>
                <p>
                    <ul>
                        <li>
                            MP3 высокого качества (320 кбит/с)
                        </li>
                        <li>
                            До 10 000 прослушиваний
                        </li>
                        <li>
                            Коммерческое использование
                        </li>
                    </ul>
                </p>
            <a href="basket.php">
            <button class="but-cat">Купить</button>
            </a>
            </div>

            <div class="license-card">
                <h3>Wav аренда</h3>
                <p class="license-price">3000₽</p>
                <p>МП3 + WAV версии</p>
                <p>
                    <ul>
                        <li>
                            MP3 высокого качества (320 кбит/с) + WAV
                        </li>
                        <li>
                            До 100 000 прослушиваний
                        </li>
                        <li>
                            Коммерческое использование
                        </li>
                    </ul>
                </p>
            <a href="basket.php">
            <button class="but-cat">Купить</button>
            </a>
            </div>
            <div class="license-card">
                <h3>Трек-аут аренда</h3>
                <p class="license-price">5000₽</p>
                <p>Потрековая версия</p>
                <p>
                    <ul>
                        <li>
                            MP3 + WAV + Раздельные дорожки
                        </li>
                        <li>
                            До 200 000 прослушиваний
                        </li>
                        <li>
                            Коммерческое использование
                        </li>
                    </ul>
                </p>
            <a href="basket.php">
            <button class="but-cat">Купить</button>
            </a>
            </div>
            <div class="license-card">
                <h3>Эксклюзив</h3>
                <p class="license-price">договорная цена</p>
                <p>Профессиональная лицензия</p>
                <p>
                    <ul>
                        <li>
                            Полные коммерческие права
                        </li>
                        <li>
                            Издательская доля 50/50
                        </li>
                        <li>
                            Данный бит удаляется из каталога
                        </li>
                    </ul>
                </p>
            <a href="basket.php">
            <button class="but-cat">Купить</button>
            </a>
            </div>
        </div>

        </div>
    <div class="main-cont">
            <div class="main-cont-publ"></div>
            <div class="cont main-cont-content">
            <p class="header-p">
                Для чего нужны издательские права?
            </p>
            <h1>Музыка приносит деньги с двух сторон:</h1>
            <p>
                звукозапись (так называемый Мастер) и сама композиция. Паблишинг гарантирует, что вы получите роялти за публичное исполнение, механическое воспроизведение и синхронизацию, связанные с авторской частью вашей работы
            </p>
        </div>
            <p>
            </p>
        </div>
    </div>
</div>
<div class="form-cont">
    <h2>Связь с нами</h2>
        <form action="components/contact.php" method="post">
            <input type="text" name="name" placeholder="Ваше имя" required>
            <input type="phone" id="phone" name="phone" placeholder="+7 (999) 999-99-99" required>
            <input type="email" name="email" placeholder="Ваша Почта" required>
            <textarea name="message" id="message" placeholder="Сообщение"></textarea>
            <button type="submit">Отправить</button>
        </form>
    </div>
</main>
<?php 
    include "components/footer.php"; 
?>