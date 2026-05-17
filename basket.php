<?php
    include "components/core.php";

    if(!isset($_SESSION['user'])){
        header("Location: login.php");
        exit();
    }

    $user_id = (int)$_SESSION['user']['id'];

    if(isset($_POST['remove'])){
        $basket_id = (int)$_POST['basket_id'];
        $link->query("DELETE FROM basket WHERE id = $basket_id AND user_id = $user_id");
        header("Location: basket.php");
        exit();
    }

    $basket_beats = $link->query("SELECT basket.id as basket_id, products.*, types.type 
        FROM basket 
        JOIN products ON basket.product_id = products.id 
        LEFT JOIN types ON products.type_id = types.id
        WHERE basket.user_id = $user_id AND basket.product_id IS NOT NULL");

    $basket_services = $link->query("SELECT basket.id as basket_id, services.* 
        FROM basket 
        JOIN services ON basket.service_id = services.id
        WHERE basket.user_id = $user_id AND basket.service_id IS NOT NULL");

    $total = 0;
    $beats_arr = [];
    $services_arr = [];

    while($item = $basket_beats->fetch_assoc()){ $total += $item['price']; $beats_arr[] = $item; }
    while($item = $basket_services->fetch_assoc()){ $total += $item['price']; $services_arr[] = $item; }

    $all_count = count($beats_arr) + count($services_arr);
    include "components/header.php";
?>
<main class="cont">
    <div class="pre-beat-cont">
        <div class="pre-beat-tit">
            <h2>Ваша корзина</h2>
            <?php if($all_count > 0): ?>
                <span style="color:#a0a0a0;"><?= $all_count ?> позиц<?= $all_count==1?'ия':($all_count<5?'ии':'ий') ?></span>
            <?php endif; ?>
        </div>

        <?php if($all_count > 0): ?>
            <?php if(count($beats_arr) > 0): ?>
                <h3 style="margin-bottom:20px;color:#aaa;font-weight:normal;">Биты</h3>
                <div class="beats-grid">
                    <?php foreach($beats_arr as $item): ?>
                        <div class="beat-item" <?php if(!empty($item['audio'])): ?>data-src="uploads/audio/<?= htmlspecialchars($item['audio']) ?>" data-name="<?= htmlspecialchars($item['name']) ?>" data-cover="uploads/images/<?= htmlspecialchars($item['image'] ?? 'musictravis.jpg') ?>"<?php endif; ?> style="cursor:pointer;">
                            <div class="beat-cover">
                                <img src="uploads/images/<?= htmlspecialchars($item['image'] ?? 'musictravis.jpg') ?>" alt="Beat">
                                <?php if(!empty($item['audio'])): ?>
                                    <div class="play-btn">▶</div>
                                <?php endif; ?>
                            </div>
                            <div class="beat-meta">
                                <h4><?= htmlspecialchars($item['name']) ?></h4>
                                <p><?= $item['bpm'] ? $item['bpm'].' BPM' : '—' ?> | <?= htmlspecialchars($item['beat_key'] ?? '—') ?></p>
                                <p style="color:#aaa;">#<?= htmlspecialchars($item['type'] ?? 'Unknown') ?></p>
                                <p><strong><?= number_format($item['price'], 0) ?> ₽</strong></p>
                                <form method="POST" style="margin-top:10px;">
                                    <input type="hidden" name="basket_id" value="<?= $item['basket_id'] ?>">
                                    <button type="submit" name="remove" class="but-oth">Удалить</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if(count($services_arr) > 0): ?>
                <h3 style="margin:40px 0 20px;color:#aaa;font-weight:normal;">Услуги</h3>
                <div class="services-grid">
                    <?php foreach($services_arr as $item): ?>
                        <div class="service-item">
                            <?php if(!empty($item['image'])): ?>
                            <div class="service-cover">
                                <img src="uploads/images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                            </div>
                            <?php endif; ?>
                            <div class="service-meta">
                                <h3><?= htmlspecialchars($item['name']) ?></h3>
                                <p class="service-price"><?= number_format($item['price'], 0, '.', ' ') ?> ₽</p>
                                <form method="POST" style="margin-top:15px;">
                                    <input type="hidden" name="basket_id" value="<?= $item['basket_id'] ?>">
                                    <button type="submit" name="remove" class="but-oth">Удалить</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="basket-total">
                <div class="basket-total-inner">
                    <span>Итого:</span>
                    <strong><?= number_format($total, 0, '.', ' ') ?> ₽</strong>
                </div>
                <form method="POST" action="account.php">
                    <button type="submit" name="checkout" class="but-cat" style="padding:12px 30px;font-size:16px;">Оформить</button>
                </form>
            </div>
        <?php else: ?>
            <div style="text-align:center;padding:80px 0;color:#666;">
                <p style="
                font-size:18px;
                margin-bottom:20px;">Ваша корзина пуста</p>
                <a href="explore.php" class="but-cat" style="
                display:inline-block;
                margin-right:10px;">Каталог битов</a>
                <a href="othsevr.php" class="but-cat" style="
                display:inline-block;
                margin-right:10px;">Другие услуги</a>
                <a href="account.php" class="but-cat" style="
                display:inline-block;">История покупок</a>
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
