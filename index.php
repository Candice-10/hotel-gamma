<?php
require_once "functions.php";
require_once "model/database.php";

$accommodations = get_all_accommodations();
$types = get_all_rows("type");
$bigrooms = getBiggestRooms();
$pricemax = getMaxPrice();



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
                    <option><?= $type["name"]; ?></option>
                    
                <?php endforeach; ?>
            </select>

            

            <form method="post" action="process.php">


             

                    
        </div>

        <div class="form-group">
            <label for="search-price-from">Prix min</label>
            <input type="number" id="search-price-from" min="0" value="0">
        </div>

        <select MAX($pricemax) as LargestPrice from $pricemax>
        <div class="form-group">
            <label for="search-price-to">Prix max</label>
            <input type="number" id="search-price-to" min="0" value="<? $pricemax" >
        </div>

        
        

        <button type="submit" class="button button-primary">
            <i class="fa fa-search"></i>
            Rechercher
        </button>
    </form>




    <h2>Découvrez nos chambres</h2>
    <div class="grid grid-rooms">

        <!-- TODO: Afficher dynamiquement les données des logements -->
        <?php foreach($bigrooms as $accommodations): ?>
            <article>
                <header>
                    <img src="uploads/<?= $accommodations["photo"]; ?>" class="img-responsive" alt="<?= $accommodations["type"]." ".$accommodations["category"]; ?>">
                </header>
                <footer>
                    <h3><?= $accommodations["type"]." ".$accommodations["category"]; ?></h3>
                    <ul class="room-features">
                        <li><i class="fa fa-bed"></i> <?= $accommodations["beds"]; ?></li>
                        <li><i class="fa fa-user"></i> <?= $accommodations["persons"]; ?></li>
                        <li><i class="fa fa-expand"></i> <?= $accommodations["size"]; ?>m<sup>2</sup></li>
                        <li><i class="fa fa-euro"></i> <?= $accommodations["price"]; ?></li>
                    </ul>
                    <a href="room.php?id=<?= $accommodations["id"]; ?>" class="button button-primary">
                        <i class="fa fa-eye"></i>
                        Voir plus
                    </a>
                </footer>
            </article>
        <?php endforeach; ?>

    </div>
</section>

<?php get_footer();