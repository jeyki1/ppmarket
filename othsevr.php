<?php
    include "components/core.php";
    $services = $link->query("SELECT * FROM services ORDER BY id ASC");
    include "components/header.php";
?>
<main class="cont">
    <div class="pre-beat-cont">
        <div class="pre-beat-tit">
            <h2>Другие услуги</h2>
        </div>

        <div class="services-grid">
            <?php while($svc = $services->fetch_assoc()): ?>
                <div class="service-item">
                    <?php if(!empty($svc['image'])): ?>
                    <div class="service-cover">
                        <img src="uploads/images/<?= htmlspecialchars($svc['image']) ?>" alt="<?= htmlspecialchars($svc['name']) ?>">
                    </div>
                    <?php endif; ?>
                    <div class="service-meta">
                        <h3><?= htmlspecialchars($svc['name']) ?></h3>
                        <p class="service-price"><?= number_format($svc['price'], 0, '.', ' ') ?> ₽</p>
                        <p class="service-desc"><?= nl2br(htmlspecialchars($svc['description'])) ?></p>
                        <?php if(isset($_SESSION['user'])): ?>
                            <form action="components/add_serv.php" method="POST" style="margin-top:15px;">
                                <input type="hidden" name="service_id" value="<?= $svc['id'] ?>">
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
