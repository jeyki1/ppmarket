<?php
include "components/core.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user_id = (int)$_SESSION['user']['id'];

if (isset($_POST['checkout'])) {
    $link->query("INSERT INTO orders (user_id, product_id) 
                  SELECT user_id, product_id FROM basket 
                  WHERE user_id=$user_id AND product_id IS NOT NULL");

    $link->query("INSERT INTO orders (user_id, service_id) 
                  SELECT user_id, service_id FROM basket 
                  WHERE user_id=$user_id AND service_id IS NOT NULL");

    if ($link->affected_rows > 0) {
        $link->query("DELETE FROM basket WHERE user_id=$user_id");
    }

    header("Location: account.php?ordered=1");
    exit();
}

$orders = $link->query("
    SELECT orders.id, orders.created_at, products.name, products.audio, products.image, products.price, products.bpm, products.beat_key, NULL as service_name, NULL as service_price
    FROM orders
    JOIN products ON orders.product_id = products.id
    WHERE orders.user_id = $user_id
    UNION ALL
    SELECT orders.id, orders.created_at, NULL, NULL, NULL, NULL, NULL, NULL, services.name, services.price
    FROM orders
    JOIN services ON orders.service_id = services.id
    WHERE orders.user_id = $user_id
    ORDER BY created_at DESC
");

$user = $_SESSION['user'];
include "components/header.php";
?>
<main class="cont">
    <div class="pre-beat-cont">
        <div class="pre-beat-tit">
            <h2>История покупок</h2>
        </div>

        <?php if ($orders && $orders->num_rows > 0): ?>
            <div class="beats-grid">
                <?php while ($order = $orders->fetch_assoc()): ?>
                    <?php if (!empty($order['name'])): ?>
                    <div class="beat-item"
                         <?php if(!empty($order['audio'])): ?>
                        data-src="uploads/audio/<?= htmlspecialchars($order['audio']) ?>"
                         data-name="<?= htmlspecialchars($order['name']) ?>"
                         data-cover="uploads/images/<?= htmlspecialchars($order['image'] ?? 'musictravis.jpg') ?>"
                         <?php endif; ?>
                         style="cursor:pointer;">
                        <div class="beat-cover">
                            <img src="uploads/images/<?= htmlspecialchars($order['image'] ?? 'musictravis.jpg') ?>" alt="Beat">
                            <?php if(!empty($order['audio'])): ?>
                                <div class="play-btn">▶</div>
                            <?php endif; ?>
                        </div>
                        <div class="beat-meta">
                            <h4><?= htmlspecialchars($order['name']) ?></h4>
                            <p>
                                <?= $order['bpm'] ? $order['bpm'].' BPM' : '—' ?>
                                | <?= htmlspecialchars($order['beat_key'] ?? '—') ?>
                            </p>
                            <p style="color:#aaa;font-size:12px;">
                                Куплено: <?= date('d.m.Y', strtotime($order['created_at'])) ?>
                            </p>
                            <p><strong><?= number_format($order['price'], 0) ?> ₽</strong></p>
                            <?php if(!empty($order['audio'])): ?>
                                <a href="uploads/audio/<?= htmlspecialchars($order['audio']) ?>"
                                   download="<?= htmlspecialchars($order['name']) ?>.mp3"
                                   class="but-cat"
                                   style="display:inline-block;margin-top:10px;text-decoration:none;"
                                   onclick="event.stopPropagation();">
                                    Скачать MP3
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php elseif (!empty($order['service_name'])): ?>
                    <div class="beat-item" style="cursor:default;">
                        <div class="beat-cover" style="background:#222;display:flex;align-items:center;justify-content:center;">
                            <span style="font-size:36px;">🎛️</span>
                        </div>
                        <div class="beat-meta">
                            <h4><?= htmlspecialchars($order['service_name']) ?></h4>
                            <p style="color:#aaa;">Услуга</p>
                            <p style="color:#aaa;font-size:12px;">
                                Куплено: <?= date('d.m.Y', strtotime($order['created_at'])) ?>
                            </p>
                            <p><strong><?= number_format($order['service_price'], 0) ?> ₽</strong></p>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div style="text-align:center;padding:60px 0;color:#666;">
                <p style="font-size:18px;margin-bottom:20px;">Вы ещё ничего не купили</p>
                <a href="explore.php" class="but-cat" style="display:inline-block;">Перейти в каталог</a>
            </div>
        <?php endif; ?>
    </div>
</main>
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
<?php include "components/footer.php"; ?>
