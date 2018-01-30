<?php
//Récupération des get
$get_login = (isset($_SESSION["my_get"]["login"])) ? $_SESSION["my_get"]["login"] : "";
?>

    <section class="main-wrap">
        <h2>Inscription</h2>
        <p>Formulaire d'inscription</p>
        <p>Le login doit faire entre 3 et 60 caractère et ne peut être composé que des 26 lettres de l'alphabet en majuscules ou minuscules, de chiffres de 0 à 9, du tiret "-" et du tiret bas "_".</p>
        <p>Le Mot de passe doit faire entre 8 et 60 caractère et ne comporter ni espace, ni slash "/", ni antislash "\".</p>
        <?php echo $html_error; ?>
        <?php echo $html_message; ?>
        <form action="?service=subscribe" method="post">
            <label for="">Login</label><input type="text" name="login" value="<?php echo $get_login; ?>"><br>
            <label for="">Pass</label><input type="password" name="password"><br>
            <input type="submit" value="Valider"><a href="?<?php echo $_SESSION["origin_page"]; ?>">Annuler</a>
        </form>
    </section>
    