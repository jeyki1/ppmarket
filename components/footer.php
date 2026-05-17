<main class="cont">
<footer>
    <div class="foot-cont">
        <h2 class="foot-title">PPM Market</h2>
        <div class="foot-nav">
            <nav>
            <a href="index.php">Главная</a>
            <a href="explore.php">Каталог</a>
            <a href="about.php">О компании</a>
            <a href="prices.php">Цены</a>
            <?php if(!isset($_SESSION['user'])){ ?>
                <a href="login.php">Войти</a>
            <?php }else{ ?>
                <a href="basket.php">Корзина</a>
                <a href="account.php">Кабинет</a>
                <?php if($_SESSION['user']['role'] == 2){ ?>
                    <a href="admin.php">Админ-панель</a>
                <?php } ?>
                <a href="./logout.php">Выход</a>
            <?php } ?>
            </nav>
        </div>
        <p>© Все права защищены</p>
    </div>
</footer>
</main>

<div id="ppm-player" style="display:none;">
    <div class="player-left">
        <button id="player-play" onclick="playerToggle()">▶</button>
    </div>
    <div class="player-center">
        <div id="player-title">—</div>
        <div class="player-progress-wrap" onclick="playerSeek(event)">
            <div class="player-progress-bar">
                <div id="player-progress-fill"></div>
            </div>
        </div>
        <div class="player-times">
            <span id="player-cur">0:00</span>
            <span id="player-dur">0:00</span>
        </div>
    </div>
    <div class="player-right">
        <input type="range" id="player-vol" min="0" max="1" step="0.05" value="0.8" oninput="playerVol(this.value)">
    </div>
</div>
<audio id="ppm-audio"></audio>
<script src="https://jquery.com"></script>
<script src="./scripts/main.js"></script>
</body>
</html>
