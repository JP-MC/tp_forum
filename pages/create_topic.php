<?php
//Récupération des get
//TODO récupérer id_category et mettre le select sur la bonne valeur
$topic_title = (isset($_SESSION["my_get"]["topic_title"])) ? $_SESSION["my_get"]["topic_title"] : "";
$post_content = (isset($_SESSION["my_get"]["post_content"])) ? $_SESSION["my_get"]["post_content"] : "";

//récupérer la liste des catégories
$category_list = getCategoryList();
$html_category_list = "";
foreach ($category_list as $category)
{
    $html_category_list .= "<option value=\"".$category["id"]."\">".$category["label"]."</option>";
}
?>

    <section class="main-wrap">
        <h2>Create topic</h2>
        <p>formulaire de création d'un nouveau sujet.</p>
        <?php echo $html_error; ?>
        <?php echo $html_message; ?>
        
        <form action="?service=create_topic" method="post">
            
            <input type="hidden" name="id_user" value="<?php echo $_SESSION["user"]["id_user"] ?>">
            
            <h3>Sujet</h3>
            <label for="topic_title">Titre</label><br>
            <input type="text" name="topic_title" value="<?php echo $topic_title; ?>"><br>
            <label for="id_category">Catégorie</label><br>
            <select name="id_category">
                <?php echo $html_category_list; ?>
            </select><br>
            <h3>Premier message</h3>
            <label for="post_content">Message</label><br>
            <textarea name="post_content" placeholder="Tapez votre message ici (mais pas trop fort s'il vous plait)." cols="80" rows="10"><?php echo $post_content; ?></textarea><br>
            <input type="submit" value="Créer le sujet"><a href="?<?php echo $_SESSION["origin_page"]; ?>">Annuler</a>
        </form>
    
    </section>