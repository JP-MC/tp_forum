<?php
$check = false;

if(isset($_SESSION["my_get"]["post"]))
{
    $id_post = checkId($_SESSION["my_get"]["post"]);

    if($id_post)
    {
        //On récupère le id_user du post
        $post_id_user = getPostOwnerID($id_post);

        if($post_id_user)
        {
            //On vérifie que l'utilisateur a le droit de modifier le post
            if( (isLogged() && isGranted($_SESSION["user"]["id_role"],CAN_EDIT_POST))  || (isLogged() && $post_id_user == $_SESSION["user"]["id_user"] && isGranted($_SESSION["user"]["id_role"],CAN_EDIT_OWN_POST)) )
            {
                $post = getPost($id_post);
                $topic = getTopic($post["id_topic"]);
                $check = true;
            }
        }
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
        <h2>Edit post</h2>
        <p>formulaire d'édition de message</p>
        <p>Catégorie : <?php echo $topic["category_label"]; ?></p>
        <p>Sujet : <a href="?page=topic&topic=<?php echo $post["id_topic"]; ?>"><?php echo $topic["title"]; ?></a></p>
        <p>Créé par <?php echo $topic["user_login"] ?> le <?php echo $topic["date"] ?></p>
        <p>Message publié le : <?php echo $post["date_creation"]; ?></p>
        
        <form action="?service=edit_post" method="post">
            
            <input type="hidden" name="id_post" value="<?php echo $id_post; ?>">

            <?php echo $html_error; ?>
            <?php echo $html_message; ?>
            
            <label for="content">Message</label><br>
            <textarea name="content" placeholder="Tapez votre message ici (mais pas trop fort s'il vous plait)." cols="80" rows="10"><?php echo $post["content"]; ?></textarea><br>
            <input type="submit" value="Poster"><a href="?<?php echo $_SESSION["origin_page"]; ?>">Annuler</a>
        </form>
    
    </section>