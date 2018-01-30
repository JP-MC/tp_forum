<?php
//Récupération des get
$get_login = (isset($_SESSION["my_get"]["login"])) ? $_SESSION["my_get"]["login"] : "";
?>

    <section class="main-wrap">
        <h2>Login</h2>
        <p>formulaire de connexion</p>
        <?php echo $html_error; ?>
        <?php echo $html_message; ?>
        <form action="?service=login" method="post">
            <label for="">Login</label><input type="text" name="login" value="<?php echo $get_login; ?>"><br>
            <label for="">Pass</label><input type="password" name="password"><br>
            <input type="submit" value="Connexion"><a href="?<?php echo $_SESSION["origin_page"]; ?>">Annuler</a>
        </form>
    </section>
    