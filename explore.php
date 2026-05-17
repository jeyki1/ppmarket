<?php
    include "components/core.php";
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
    $filter_artist = isset($_GET['artist_id']) ? (int)$_GET['artist_id'] : 0;
    $filter_type   = isset($_GET['type_id'])   ? (int)$_GET['type_id']   : 0;

    $order = "products.id DESC";
    if($sort == 'bpm_asc') 
        $order = "products.bpm ASC";
    if($sort == 'bpm_desc')
        $order = "products.bpm DESC";
    if($sort == 'key')
        $order = "products.beat_key ASC";
    if($sort == 'price')
        $order = "products.price ASC";

    $conditions = [];
    if($filter_artist > 0) $conditions[] = "products.artist_id = $filter_artist";
    if($filter_type   > 0) $conditions[] = "products.type_id = $filter_type";
    $where = count($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";

    $query = "SELECT products.*, types.type, artists.artist FROM products
        LEFT JOIN types ON products.type_id = types.id
        LEFT JOIN artists ON products.artist_id = artists.id
        $where
        ORDER BY $order";
    $result = $link->query($query);
    $artists_res = $link->query("SELECT * FROM artists");
    $types_res   = $link->query("SELECT * FROM types ORDER BY type ASC");

    include "components/header.php";
?>
<main class="cont">
    <div class="pre-beat-cont">
        <div class="pre-beat-tit">
            <h2>Каталог битов</h2>
        </div>

        <div style="
        display: flex;
        flex-wrap: wrap; 
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;">
            <span style="color:#aaa;">Сортировка:</span>
            <a href="explore.php?
            <?= $filter_artist ? 'artist_id='.$filter_artist.'&' : '' ?><?= $filter_type ? 'type_id='.$filter_type.'&' : '' ?>sort=bpm_asc"
               style="
               color:<?= $sort=='bpm_asc'?'#fff':'#aaa' ?>;
               text-decoration: none;
               border: 1px solid #555;
               padding: 4px 10px;
               border-radius: 4px;">
               БПМ ↑</a>
            <a href="explore.php?
            <?= $filter_artist ? 'artist_id='.$filter_artist.'&' : '' ?><?= $filter_type ? 'type_id='.$filter_type.'&' : '' ?>sort=bpm_desc"
               style="color:
               <?= $sort=='bpm_desc'?'#fff':'#aaa' ?>;
               text-decoration: none;
               border: 1px solid #555;
               padding: 4px 10px;
               border-radius: 4px;">
               БПМ ↓</a>

        <span style="
            color:#aaa;
            margin-left: 10px;">
            Артист:
        </span>
            <?php while($a = $artists_res->fetch_assoc()): ?>
                <a href="explore.php?artist_id=<?=$a['id']?><?= $filter_type ? '&type_id='.$filter_type : '' ?><?= $sort ? '&sort='.$sort : '' ?>"
                   style="color:<?= $filter_artist==$a['id']?'#fff':'#aaa' ?>;text-decoration:none;border:1px solid #555;padding:4px 10px;border-radius:4px;">
                    <?= htmlspecialchars($a['artist']) ?>
                </a>
                
            <?php endwhile; ?>

        <span style="color:#aaa;margin-left: 10px;">Тип:</span>
            <?php while($tp = $types_res->fetch_assoc()): ?>
                <a href="explore.php?type_id=<?=$tp['id']?><?= $filter_artist ? '&artist_id='.$filter_artist : '' ?><?= $sort ? '&sort='.$sort : '' ?>"
                   style="color:<?= $filter_type==$tp['id']?'#fff':'#aaa' ?>;text-decoration:none;border:1px solid #555;padding:4px 10px;border-radius:4px;">
                    <?= htmlspecialchars($tp['type']) ?>
                </a>
            <?php endwhile; ?>

            <a href="explore.php"
               style="color:
               <?= !$sort&&!$filter_artist&&!$filter_type?'#fff':'#aaa' ?>;
               text-decoration: none;
               border: 1px solid #555;
               padding: 4px 10px;
               border-radius: 4px;">
               Сбросить</a>
        </div>

        <div class="beats-grid">
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="beat-item" <?php if(!empty($row['audio'])): ?>data-src="uploads/audio/<?= htmlspecialchars($row['audio']) ?>" data-name="<?= htmlspecialchars($row['name']) ?>" data-cover="uploads/images/<?= htmlspecialchars($row['image'] ?? 'musictravis.jpg') ?>"<?php endif; ?> style="cursor:pointer;">
                    <div class="beat-cover">
                        <img src="uploads/images/<?= htmlspecialchars($row['image'] ?? 'musictravis.jpg') ?>" alt="Beat">
                        <?php if(!empty($row['audio'])): ?>
                        <div class="play-btn">▶</div>
                        <?php endif; ?>
                    </div>
                    <div class="beat-meta">
                        <h4><?= htmlspecialchars($row['name']) ?></h4>
                        <p>
                            <?= $row['bpm'] ? $row['bpm'].' BPM' : '—' ?>
                            | <?= htmlspecialchars($row['beat_key'] ?? '—') ?>
                        </p>
                        <p style="color:#aaa;">
                            #<?= htmlspecialchars($row['artist'] ?? 'Unknown') ?>
                            #<?= htmlspecialchars($row['type'] ?? 'Unknown') ?>
                        </p>
                        <p><strong><?= number_format($row['price'], 0) ?> ₽</strong></p>
                        <?php if(isset($_SESSION['user'])): ?>
                            <form action="components/add.php" method="POST">
                                <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                                <button type="submit" class="but-cat">Добавить в корзину</button>
                            </form>
                            <?php else: ?>
                            <a href="login.php" class="but-cat" style="
                                display: inline-block;
                                margin-top: 15px;">Войти для заказа</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

<div class="lic-main">
    <div class="license-cont">
        <div class="license-card">
            <h3>МП3 аренда</h3>
            <p class="license-price">2000₽</p>
            <p>Только МП3 версия</p>
            <ul>
                <li>MP3 высокого качества (320 кбит/с)</li>
            </ul>
            <a href="prices.php">
            <button class="but-cat">Детали</button>
            </a>
        </div>
        <div class="license-card">
            <h3>Wav аренда</h3>
            <p class="license-price">3000₽</p>
            <p>MP3 + WAV</p>
            <ul>
                <li>MP3 высокого качества (320 кбит/с) + WAV</li>
            </ul>
            <a href="prices.php">
            <button class="but-cat">Детали</button>
            </a>
        </div>
        <div class="license-card">
            <h3>Трек-аут аренда</h3>
            <p class="license-price">5000₽</p>
            <p>Потрековая версия</p>
            <ul>
                <li>MP3 + WAV + Раздельные дорожки</li>
            </ul>
            <a href="prices.php">
            <button class="but-cat">Детали</button>
            </a>
        </div>
        <div class="license-card">
            <h3>Эксклюзив</h3>
            <p class="license-price">договорная цена</p>
            <p>Профессиональная лицензия</p>
            <ul>
                <li>Полные коммерческие права</li>
            </ul>
            <a href="prices.php">
            <button class="but-cat">Детали</button>
            </a>
        </div>
    </div>
</div>

<div class="form-cont">
    <h2>Связь с нами</h2>
    <form action="components/contact.php" method="post">
        <input type="text" name="name" placeholder="Ваше имя" required>
        <input type="phone" name="phone" placeholder="+7 (999) 999-99-99" required>
        <input type="email" name="email" placeholder="Ваша Почта" required>
        <textarea name="message" placeholder="Сообщение"></textarea>
        <button type="submit">Отправить</button>
    </form>
</div>
</main>
<?php include "components/footer.php"; ?>