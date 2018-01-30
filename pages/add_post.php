<?php
//Récupération des get
$get_content = (isset($_SESSION["my_get"]["content"])) ? $_SESSION["my_get"]["content"] : "";

$check = false;

if(isset($_SESSION["my_get"]["topic"]))
{
    //Vérification des grants
    if(isLogged() && isGranted($_SESSION["user"]["id_role"],CAN_CREATE_POST))
    {
        $id_topic = $_SESSION["my_get"]["topic"];
        $topic = getTopic($id_topic);
        $check = true;
    }
}

if(!$check)
{
    //Rediriger vers la page précédente
    header("Location: ?".$_SESSION["origin_page"]);
    die();
}

?>

    <section class="main-wrap">
        <h2>Add post</h2>
        <p>formulaire de création de message</p>
        <p>Catégorie : <?php echo $topic["category_label"]; ?></p>
        <p>Sujet : <a href="?page=topic&topic=<?php echo $id_topic; ?>"><?php echo $topic["title"]; ?></a></p>
        <p>Créé par <?php echo $topic["user_login"]; ?> le <?php echo $topic["date"]; ?></p>
        
        <form action="?service=add_post" method="post">
            
            <input type="hidden" name="id_topic" value="<?php echo $id_topic; ?>">
            <input type="hidden" name="id_user" value="<?php echo $_SESSION["user"]["id_user"]; ?>">
            
            <?php echo $html_error; ?>
            <?php echo $html_message; ?>

            <label for="content">Message</label><br>
            <textarea name="content" placeholder="Tapez votre message ici (mais pas trop fort s'il vous plait)." cols="80" rows="10"><?php echo $get_content; ?></textarea><br>
            <input type="submit" value="Poster"><a href="?<?php echo $_SESSION["origin_page"]; ?>">Annuler</a>
        </form>
    
    </section>