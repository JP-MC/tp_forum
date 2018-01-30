<?php
if(isset($_SESSION["my_get"]["topic"]))
{
    $id_topic = $_SESSION["my_get"]["topic"];
    
    $topic = getTopic($id_topic);

    if($topic)
    {
        $html_topic_title = $topic["title"];
        $html_topic_infos = "<p class=\"topic-infos\">Catégorie : ".$topic["category_label"]." / Date de création : ".$topic["date"]." / Créé par : <a href=\"?user_id=".$topic["id_user"]."\">".$topic["user_login"]."</a></p>\n";
        $html_nbr_posts = getNbrPostsInTopic($id_topic);
    }
}
?>

<section class="main-wrap">
    <h2>Suppression d'un sujet</h2>
    <?php echo $html_error; ?>
    <?php echo $html_message; ?>
    <p>Vous êtes sur le point de supprimer le sujet suivant : </p>

    <div class="border">
        <h3><?php echo $html_topic_title; ?></h3>
        <?php echo $html_topic_infos; ?>
    </div>

    <p>Et les <?php echo $html_nbr_posts; ?> messages qui y sont rattachés.</p>
    <a href="?service=delete_topic&topic=<?php echo $id_topic; ?>" class="delete-link">Supprimer</a><a href="?<?php echo $_SESSION["origin_page"]; ?>">Annuler</a>
</section>