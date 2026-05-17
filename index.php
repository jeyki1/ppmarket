<?php
    include "components/core.php";

    $beats = $link->query("SELECT products.*, types.type, artists.artist 
          FROM products 
          LEFT JOIN types ON products.type_id = types.id
          LEFT JOIN artists ON products.artist_id = artists.id
          ORDER BY products.id DESC LIMIT 4");
    include "components/header.php"; 
?>
<div class="main-cont">
        <div class="main-cont-end"></div>
        <div class="cont main-cont-content">
                <p class="header-p">Наше сообщество</p>
                <h1>предлагает вам</h1>
                <p>Команду продюсеров, сэмплеров и звукоинженеров, которые уже 7 лет развивают свой бренд и доносят свое звучание до широких масс.</p>
            <div>
                <a href="explore.php">
                <button class="but-cat">
                    Перейти в каталог
                </button>
                </a>
                <a href="othsevr.php">
                <button class="but-oth">
                    Другие услуги
                </button>
                </a>
            </div>
        </div>
    </div>
    <main class="cont">
        <div class="pre-beat-cont">
<div class="pre-beat-cont">
    <div class="pre-beat-tit">
        <h2>Свежие биты</h2>
    </div>

    <div class="beats-grid">
        <?php if($beats && $beats->num_rows > 0): ?>
            <?php while($beat = $beats->fetch_assoc()): ?>
                <div class="beat-item" <?php if(!empty($beat['audio'])): ?>data-src="uploads/audio/<?= htmlspecialchars($beat['audio']) ?>" data-name="<?= htmlspecialchars($beat['name']) ?>"<?php endif; ?> style="cursor:pointer;">
                    <div class="beat-cover">
                        <img src="uploads/images/<?= htmlspecialchars($beat['image'] ?? 'musictravis.jpg') ?>" alt="Beat">
                        <?php if(!empty($beat['audio'])): ?>
                            <div class="play-btn">▶</div>
                        <?php endif; ?>
                    </div>
                    <div class="beat-meta">
                        <h4><?= htmlspecialchars($beat['name']) ?></h4>
                        <p>
                            <?= $beat['bpm'] ? $beat['bpm'].' BPM' : '—' ?> 
                            | <?= htmlspecialchars($beat['beat_key'] ?? '—') ?>
                        </p>
                        <p style="color:#aaa;">
                            #<?= htmlspecialchars($beat['artist'] ?? 'Unknown') ?> 
                            #<?= htmlspecialchars($beat['type'] ?? 'Unknown') ?>
                        </p>
                        <p><strong><?= number_format($beat['price'], 0) ?> ₽</strong></p>
                        
                        <?php if(isset($_SESSION['user'])): ?>
                            <form action="components/add.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $beat['id'] ?>">
                                <button type="submit" class="but-cat">В корзину</button>
                            </form>
                        <?php endif; ?>
                    </div>
                    
                </div>
                
            <?php endwhile; ?>
        <?php else: ?>
            <p style="color:#666;">Биты еще не добавлены.</p>
        <?php endif; ?>

    </div>

</div>

    <div class="add-cont">
        <div class="add-cont-end"></div>
        <div class="cont add-cont-content">
            <p style="
                margin-bottom:10px;">Узнайте больше о команде.</p>
            <div class="add-cont-btns">
                <div class="card-art">
                    <div class="card-cover">
                        <img src="images/artistavy.jpg" alt="Atrist">
                    </div>
                    <div class="card-meta">
                        <h4>Avylock</h4>
                        <p>известный как Вячеслав Парфенов</p>
                    <p class="comment">
                        (родился 10 сентября 2005 года) — российский битмейкер родом из Омска.
                    </p>
                    </div>
                </div>

                <div class="card-art">
                    <div class="card-cover">
                        <img src="images/artistillm4tic.jpg" alt="Atrist">
                    </div>
                    <div class="card-meta">
                        <h4>Illm4tic</h4>
                        <p>известный как Илья Алачев</p>
                    <p class="comment">
                    (родился 4 апреля, 2008) российский битмейкер, звукоинженер и артист из Омска.
                    </p>
                    </div>
                </div>

                <div class="card-art">
                    <div class="card-cover">
                        <img src="images/artistdeele.jpg" alt="Atrist">
                    </div>
                    <div class="card-meta">
                        <h4>Deeleone</h4>
                        <p>известный как Андрей Репенко</p>
                    <p class="comment">
                        (родился 20 апреля, 2006) российский битмейкер, лупмейкенр из Омска.
                    </p>
                    </div>
                </div>

                <div class="card-art">
                    <div class="card-cover">
                        <img src="images/artistjeyki.jpg" alt="Atrist">
                    </div>
                    <div class="card-meta">
                        <h4>Jeyki</h4>
                        <p>известный как Евгений Иванов</p>
                    <p class="comment">
                        (родился 3 июля, 2006) российский битмейкер, лупмейкенр из Омска.
                    </p>
                    </div>
                </div>

                <div class="card-art">
                    <div class="card-cover">
                        <img src="images/artistrose.jpg" alt="Atrist">
                    </div>
                    <div class="card-meta">
                        <h4>Roselorde</h4>
                        <p>известный как Павел Варакин</p>
                    <p class="comment">
                    (родился 27 июня, 2004) российский битмейкер, лупмейкенр из Омска.
                    </p>
                    </div>
                </div>
                <div class="card-art">
                    <div class="card-cover">
                        <img src="images/artistr3versme.jpg" alt="Atrist">
                    </div>
                    <div class="card-meta">
                        <h4>R3versme</h4>
                        <p>известный как Александр Малышкин</p>
                    <p class="comment">
                        (родился 28 июня, 2007) российский битмейкер, лупмейкенр из Тюмени.
                    </div>
                </div>
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