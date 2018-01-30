<?php
if(isLogged())
{
    $html_connection = "<li><a href=\"?page=create_topic\">Créer un sujet</a></li>";
    $html_connection .= "<li><a href=\"?service=logout\">".$_SESSION["user"]["login"]." > Se déconnecter</a></li>";
}
else
{
    $html_connection = "<li><a href=\"?page=subscribe\">S'inscrire</a></li>";
    $html_connection .= "<li><a href=\"?page=login\">Se connecter</a></li>";
}
    ?>

    <nav id="main-menu" class="main-wrap">
        <ul>
            <li><a href="?page=home">Home</a></li>
            <?php echo $html_connection; ?>
        </ul>
    </nav>
