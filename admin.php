<?php
include "components/core.php";

if (isset($_POST['add'])) {
    $name = $link->real_escape_string($_POST['name']);
    $price = (float)$_POST['price'];
    $bpm = (int)$_POST['bpm'];
    $beat_key = $link->real_escape_string($_POST['beat_key']);
    $artist_id = (int)$_POST['artist_id'];
    $type_id = (int)$_POST['type_id'];
    $image = '';
    $audio = '';

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $image);
    }
    if (!empty($_FILES['audio']['name'])) {
        $audio = $_FILES['audio']['name'];
        move_uploaded_file($_FILES['audio']['tmp_name'], "uploads/audio/" . $audio);
    }

    $link->query("INSERT INTO products (name, price, bpm, beat_key, image, audio, artist_id, type_id)
                  VALUES ('$name', '$price', '$bpm', '$beat_key', '$image', '$audio', '$artist_id', '$type_id')");
    header("Location: admin.php");
    exit();
}

if (isset($_POST['update'])) {
    $id = (int)$_POST['id'];
    $name = $link->real_escape_string($_POST['name']);
    $price = (float)$_POST['price'];
    $bpm = (int)$_POST['bpm'];
    $beat_key = $link->real_escape_string($_POST['beat_key']);
    $artist_id = (int)$_POST['artist_id'];
    $type_id = (int)$_POST['type_id'];

    $cur = $link->query("SELECT image, audio FROM products WHERE id=$id")->fetch_assoc();
    $image = $cur['image'];
    $audio = $cur['audio'];

    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/images/" . $image);
    }
    if (!empty($_FILES['audio']['name'])) {
        $audio = $_FILES['audio']['name'];
        move_uploaded_file($_FILES['audio']['tmp_name'], "uploads/audio/" . $audio);
    }

    $link->query("UPDATE products
                  SET name='$name', price='$price', bpm='$bpm', beat_key='$beat_key',
                      image='$image', audio='$audio', artist_id='$artist_id', type_id='$type_id'
                  WHERE id=$id");
    header("Location: admin.php");
    exit();
}

if (isset($_POST['delete'])) {
    $id = (int)$_POST['id'];
    $link->query("DELETE FROM products WHERE id=$id");
    header("Location: admin.php");
    exit();
}

if (isset($_POST['add_serv'])) {
    $name = $link->real_escape_string($_POST['svc_name']);
    $price = (float)$_POST['svc_price'];
    $desc = $link->real_escape_string($_POST['svc_desc']);
    $image = '';

    if (!empty($_FILES['svc_image']['name'])) {
        $image = $_FILES['svc_image']['name'];
        move_uploaded_file($_FILES['svc_image']['tmp_name'], "uploads/images/" . $image);
    }

    $link->query("INSERT INTO services (name, price, description, image)
        VALUES ('$name', '$price', '$desc', '$image')");
    header("Location: admin.php");
    exit();
}

if (isset($_POST['update_service'])) {
    $id = (int)$_POST['svc_id'];
    $name = $link->real_escape_string($_POST['svc_name']);
    $price = (float)$_POST['svc_price'];
    $desc = $link->real_escape_string($_POST['svc_desc']);

    $cur = $link->query("SELECT image FROM services WHERE id=$id")->fetch_assoc();
    $image = $cur['image'];

    if (!empty($_FILES['svc_image']['name'])) {
        $image = $_FILES['svc_image']['name'];
        move_uploaded_file($_FILES['svc_image']['tmp_name'], "uploads/images/" . $image);
    }

    $link->query("UPDATE services
                  SET name='$name', price='$price', description='$desc', image='$image'
                  WHERE id=$id");
    header("Location: admin.php");
    exit();
}

if (isset($_POST['delete_service'])) {
    $id = (int)$_POST['svc_id'];
    $link->query("DELETE FROM services WHERE id=$id");
    header("Location: admin.php");
    exit();
}

$products = $link->query("SELECT products.*, artists.artist, types.type
                                FROM products
                                LEFT JOIN artists ON products.artist_id = artists.id
                                LEFT JOIN types   ON products.type_id   = types.id");
$artists_list = $link->query("SELECT * FROM artists")->fetch_all(MYSQLI_ASSOC);
$types_list = $link->query("SELECT * FROM types")->fetch_all(MYSQLI_ASSOC);
$contacts = $link->query("SELECT * FROM contact");
$services_list = $link->query("SELECT * FROM services ORDER BY id ASC");

include "components/header.php";
?>

<main>
    <div class="pre-beat-cont">
        <div class="pre-beat-tit">
            <h2>Админ-панель</h2>
        </div>

        <div class="cont add-cont-content">
            <h3>Добавить новый бит</h3>
            <div class="form-group">
                <form method="POST" enctype="multipart/form-data">
                    <input type="text"   name="name"      placeholder="Название" required>
                    <input type="number" name="price"     step="0.01" min="2000" placeholder="Цена (₽)" required>
                    <input type="number" name="bpm"       placeholder="БПМ">
                    <input type="text"   name="beat_key"  placeholder="Тональность">

                    <select name="artist_id">
                        <option value="0">— Артист —</option>
                        <?php foreach ($artists_list as $a): ?>
                            <option value="<?= $a['id'] ?>"><?= $a['artist'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <select name="type_id">
                        <option value="0">— Стиль —</option>
                        <?php foreach ($types_list as $t): ?>
                            <option value="<?= $t['id'] ?>"><?= $t['type'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label>Обложка: <input type="file" name="image" accept="image/*"></label>
                    <label>Аудио:   <input type="file" name="audio" accept="audio/*"></label>

                    <button class="but-oth" type="submit" name="add">Добавить бит</button>
                </form>
            </div>
        </div>

        <div class="cont add-cont-content">
            <h3>Управление битами</h3>
            <?php while ($prod = $products->fetch_assoc()): ?>
            <div class="form-group">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $prod['id'] ?>">
                    <input type="text"   name="name"      value="<?= htmlspecialchars($prod['name']) ?>" required>
                    <input type="number" name="price"     step="0.01" value="<?= $prod['price'] ?>">
                    <input type="number" name="bpm"       value="<?= $prod['bpm'] ?>">
                    <input type="text"   name="beat_key"  value="<?= htmlspecialchars($prod['beat_key']) ?>">

                    <select name="artist_id">
                        <option value="0">—</option>
                        <?php foreach ($artists_list as $a): ?>
                            <option value="<?= $a['id'] ?>" <?= $a['id'] == $prod['artist_id'] ? 'selected' : '' ?>>
                                <?= $a['artist'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <select name="type_id">
                        <option value="0">—</option>
                        <?php foreach ($types_list as $t): ?>
                            <option value="<?= $t['id'] ?>" <?= $t['id'] == $prod['type_id'] ? 'selected' : '' ?>>
                                <?= $t['type'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <div class="card-cover">
                        <?php if (!empty($prod['image'])): ?>
                            <img src="uploads/images/<?= $prod['image'] ?>">
                        <?php endif; ?>
                        <label>Обложка: <input type="file" name="image" accept="image/*"></label>
                    </div>

                    <div>
                        <?php if (!empty($prod['audio'])): ?>
                            <audio controls><source src="uploads/audio/<?= $prod['audio'] ?>"></audio>
                        <?php endif; ?>
                        <label>Аудио: <input type="file" name="audio" accept="audio/*"></label>
                    </div>

                    <div>
                        <button class="but-oth" name="update">Сохранить</button>
                        <button class="but-oth" name="delete" onclick="return confirm('Удалить бит?')">Удалить</button>
                    </div>
                </form>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="license-card">
            <h3>Добавить услугу</h3>
            <div class="form-group">
                <form method="POST" enctype="multipart/form-data">
                    <input type="text"   name="svc_name"  placeholder="Название услуги" required>
                    <input type="number" name="svc_price" step="1" placeholder="Цена (₽)" required>
                    <textarea name="svc_desc" placeholder="Описание услуги" rows="5"></textarea>
                    <label>Фото услуги: <input type="file" name="svc_image" accept="image/*"></label>
                    <button class="but-oth" type="submit" name="add_serv">Добавить услугу</button>
                </form>
            </div>
        </div>

        <div class="cont add-cont-content">
            <h3>Управление услугами</h3>
            <?php while ($svc = $services_list->fetch_assoc()): ?>
            <div class="form-group">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="svc_id"    value="<?= $svc['id'] ?>">
                    <input type="text"   name="svc_name"  value="<?= htmlspecialchars($svc['name']) ?>" required>
                    <input type="number" name="svc_price" step="1" value="<?= $svc['price'] ?>" required>
                    <textarea name="svc_desc" rows="4"><?= htmlspecialchars($svc['description']) ?></textarea>

                    <div class="card-cover">
                        <?php if (!empty($svc['image'])): ?>
                            <img src="uploads/images/<?= htmlspecialchars($svc['image']) ?>">
                        <?php endif; ?>
                        <label>Фото услуги: <input type="file" name="svc_image" accept="image/*"></label>
                    </div>

                    <div>
                        <button class="but-oth" name="update_service">Сохранить</button>
                        <button class="but-oth" name="delete_service" onclick="return confirm('Удалить услугу?')">Удалить</button>
                    </div>
                </form>
            </div>
            <?php endwhile; ?>
        </div>

        <div class="cont add-cont-content">
            <h3>Сообщения пользователей</h3>
            <div class="form-group">
                <?php while ($msg = $contacts->fetch_assoc()): ?>
                <div class="form-group">
                    <strong><?= htmlspecialchars($msg['name']) ?></strong>
                    (<?= htmlspecialchars($msg['email']) ?>):<br>
                    <?= htmlspecialchars($msg['message']) ?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

    </div>
</main>

<?php include "components/footer.php"; ?>
