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

<form action="#contact__form" method="POST" id="contact__form" class="row">

                <div class="contact__content flex__container around">

                    <div class="margg">
                        <label for="name" class="hdn__text">Nom</label>
                        <input type="text" name="name" id="name" minlength="2" maxlength="25" required placeholder="Nom" class="col-l-6">
                    </div>

                    <div>
                        <label for="forname"class="hdn__text">Prénom</label>
                        <input type="text" name="forname" id="forname" minlength="2" maxlength="25" required placeholder="Prénom"class="col-l-6">
                    </div>

                    <div class="margg">
                        <label for="mail"class="hdn__text">Email</label>
                        <input type="email" name="mail" id="mail" placeholder="Email" required class="col-l-6">
                    </div>

                    <div>
                        <label for="code postal"class="hdn__text">Code postal</label>
                        <input type="number" name="code_postal" id="code postal"  required placeholder="Code postal" class="col-l-6">
                    </div>

                    <label for="mail" class="hdn__text">Message</label>
                    <textarea class="textarea" name="message" id="message" class="col-l-12" placeholder="Message"></textarea>

                </div>

                <div class="rox flex__container between align-items">
                    <button type="submit" class="btn btn-1 col-l-2 btn__contact">Me contacter</button>
                </div>

                <?php
                if (isset($_POST["message"])) {
                    // Stockage des données du formulaire dans des variables
                    $firstname = $_POST["forname"];
                    $lastname = $_POST["name"];
                    $email = $_POST["mail"];
                    $zipcode = $_POST["code_postal"];
                    $message = $_POST["message"];

                    $headers = "From: " . $email . "\r\n" .
                        'Reply-To: ' . $email . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    $content = "Vous avez reçu un message de $firstname $lastname.";
                    $content .= "<br>";
                    $content .= "<ul>";
                    $content .= "<li>Email : $email</li>";
                    $content .= "<li>Code postal : $zipcode</li>";
                    $content .= "</ul>";
                    $content .= "Message :</br>";
                    $content .= $message;
                    $sent = mail("alison.lepolles18@gmail.com", "Formulaire de contact", $content, $headers);
                    if ($sent) {
                        echo "Message envoyé";
                    } else {
                        echo "Erreur lors de l'envoi du message";
                    }
                }
                ?>

            </form>


<?php get_footer(); ?>