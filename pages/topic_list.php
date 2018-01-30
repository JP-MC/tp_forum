<?php
if(isset($_SESSION["my_get"]["category"]))
{
    //Aller chercher le label de la catégorie dans la bdd
    $id_category = $_SESSION["my_get"]["category"];
    $category_label = getCategoryLabel($id_category);
}

if($category_label == '')
{
    header("Location: ?page=404");
    die();
}
else
{
    $html = "";
    $topic_list = getTopicList($id_category);
    if(empty($topic_list))
    {
        //Il n'y a aucun sujet dans cette catégorie
        $html .= "<p>Il n'y a aucun sujet dans cette catégorie. ¯\_(ツ)_/¯</p>";
    }
    else
    {
        $nbr_posts = 0;
        
        //Créé la liste des sujets
        $html .= "<table>";
        $html .= "<thead><tr><th>Sujet</th><th>Date de création</th><th>Auteur du sujet</th><th>Nombre de messages</th></tr></thead>";
        foreach ($topic_list as $topic)
        {
            $nbr_posts = getNbrPostsInTopic($topic["id"]);
            $html .= "<tr id=\"".$topic["id"]."\"><td><a href=\"?page=topic&topic=".$topic["id"]."\">".htmlentities($topic["title"])."</td><td>".$topic["date"]."</td><td>".htmlentities($topic["user"])."</td><td>".$nbr_posts."</td></tr>";
        }
        $html .= "</table>";
    }

//AFFICHAGE
include "commons/nav_category.php";
?>

    <section class="main-wrap">
        <h2><?php echo htmlentities($category_label) ?></h2>
        <?php echo $html_error; ?>
        <?php echo $html_message; ?>
        <p>Liste des topics de la catégorie</p>
    </section>
    <section id="topic-list" class="main-wrap">
        <?php echo $html; ?>
    </section>

<?php
}
?>