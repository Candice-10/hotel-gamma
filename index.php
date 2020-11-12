<?php
require_once "functions.php";
require_once "model/database.php";

$accommodations = get_all_accommodations();
$types = get_all_rows("type");
// debug($accommodations);

get_header();
?>

<section class="page-header home-header container">
    <img src="images/home-header-bg.jpg" class="img-responsive" alt="Gamma Hotel">
</section>

<section class="container home-content">
    <h1>Bienvenue à l'hotel Gamma</h1>

    <form class="form-search">
        <div class="form-group">
            <label for="search-type">Type</label>
            <!-- TODO: Afficher dynamiquement la liste des types de logements -->
            <select name="type_id" id="search-type">
                <?php foreach ($types as $type) : ?>
                    <option><?= $type["name"]; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="search-price-from">Prix min</label>
            <input type="number" id="search-price-from" min="0" value="0">
        </div>
        <div class="form-group">
            <label for="search-price-to">Prix max</label>
            <input type="number" id="search-price-to" min="0" value="200">
        </div>
        <button type="submit" class="button button-primary">
            <i class="fa fa-search"></i>
            Rechercher
        </button>
    </form>

    <h2>Découvrez nos chambres</h2>
    <div class="grid grid-rooms">

        <!-- TODO: Afficher dynamiquement les données des logements -->
        <?php foreach($accommodations as $accommodation): ?>
            <article>
                <header>
                    <img src="uploads/<?= $accommodation["photo"]; ?>" class="img-responsive" alt="<?= $accommodation["name"]; ?>">
                </header>
                <footer>
                    <h3><?= $accommodation["name"]; ?></h3>
                    <ul class="room-features">
                        <li><i class="fa fa-bed"></i> <?= $accommodation["beds"]; ?></li>
                        <li><i class="fa fa-user"></i> <?= $accommodation["persons"]; ?></li>
                        <li><i class="fa fa-expand"></i> <?= $accommodation["size"]; ?>m<sup>2</sup></li>
                        <li><i class="fa fa-euro"></i> <?= $accommodation["price"]; ?></li>
                    </ul>

                    <a href="accommodation.php?id=<?= $accommodation["id"]; ?>" class="button button-primary">
                        <i class="fa fa-eye"></i>
                        Voir plus
                    </a>
                </footer>
            </article>
        <?php endforeach; ?>

    </div>
</section>

<?php get_footer(); ?>