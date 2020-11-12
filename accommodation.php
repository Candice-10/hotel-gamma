<?php
require_once "functions.php";
require_once "model/database.php";

// Récupérer l'id dans l'URL
$id = $_GET["id"];
$accommodation = get_one_accommodation($id);
$photos = get_all_photo_by_accommodation($id);
//debug($accommodation);

get_header();
?>

<section class="page-header room-header container">
    <img src="uploads/<?= $accommodation["photo"]; ?>" class="img-responsive" alt="Gamma Hotel">
</section>

<section class="container room-content">
    <article class="room-description">
        <div class="room-description-images">
            <img src="uploads/<?= $accommodation["photo"]; ?>" class="img-responsive" alt="Appartement standard">
            <?php foreach ($photos as $photo) : ?>
                <img src="uploads/<?= $photo["filename"]; ?>" class="img-responsive" alt="<?= $photo["alt"]; ?>">
            <?php endforeach; ?>
        </div>
        <div class="room-description-content">
            <h1><?= $accommodation["name"]; ?></h1>
            <ul class="room-features">
                <li><i class="fa fa-bed"></i> <?= $accommodation["beds"]; ?></li>
                <li><i class="fa fa-user"></i> <?= $accommodation["persons"]; ?></li>
                <li><i class="fa fa-expand"></i> <?= $accommodation["size"]; ?>m<sup>2</sup></li>
                <li><i class="fa fa-euro"></i> <?= $accommodation["price"]; ?></li>
            </ul>
            <p><?= $accommodation["description"]; ?></p>
        </div>
    </article>
</section>

<?php get_footer(); ?>