<?php
$topic = false;

if(isset($_SESSION["my_get"]["topic"]))
{
    $id_topic = $_SESSION["my_get"]["topic"];
	
	//Aller chercher : title / date / id_user / id_category dans la table topic
    $topic = getTopic($id_topic);

    if($topic)
    {
        //Aller chercher tous les messages de ce topic
        $post_list = getPostList($id_topic);
        
        //Création du header du topic
        $html_topic_title = $topic["title"];
        $html_topic_infos = "<p class=\"topic-infos\">Catégorie : ".htmlentities($topic["category_label"])." / Date de création : ".$topic["date"]." / Créé par : <a href=\"?user_id=".$topic["id_user"]."\">".htmlentities($topic["user_login"])."</a></p>\n";

        //Création de la liste des messages
        $html_post_list = "";
        foreach ($post_list as $post)
        {
            $html_post_list .= "<article id=\"".$post["id"]."\">";
            
            //Liens éditer / supprimer
            $html_edit_link = "";
            $html_delete_link = "";

            //Affiche le lien éditer en fonction des grants
            if( (isLogged() && isGranted($_SESSION["user"]["id_role"],CAN_EDIT_POST)) || (isLogged() && $post["id_user"] == $_SESSION["user"]["id_user"] && isGranted($_SESSION["user"]["id_role"],CAN_EDIT_OWN_POST)) )
            {
                $html_edit_link = "<a href=\"?page=edit_post&post=".$post["id"]."\">Éditer</a>";
            }
            //Affiche le lien supprimer en fonction des grants
            if( (isLogged() && isGranted($_SESSION["user"]["id_role"],CAN_DELETE_POST))  || (isLogged() && $post["id_user"] == $_SESSION["user"]["id_user"] && isGranted($_SESSION["user"]["id_role"],CAN_DELETE_OWN_POST)) )
            {
                $html_delete_link = "<a href=\"?service=delete_post&post=".$post["id"]."\">Supprimer</a>";
            }
            
            $html_post_list .= "<div class=\"post-infos\">Posté le ".$post["date"]." par <a href=\"?user_id=".$topic["id_user"]."\">".htmlentities($post["user_login"])."</a><div class=\"post_tools\">".$html_edit_link.$html_delete_link."</div></div>\n";
            $html_post_list .= "<p>".nl2br(htmlentities($post["content"]))."</p>\n";
            $html_post_list .= "</article>\n";
        }

        //Lien pour poster
        $html_post_link = "";
        if(isLogged())
        {
            $html_post_link = "<a href=\"?page=add_post&topic=".$id_topic."\">Poster un message</a>\n";
        }

        //Lien pour supprimer le topic
        $html_delete_topic_link ="";
        if( isLogged() && isGranted($_SESSION["user"]["id_role"],CAN_DELETE_TOPIC) )
        {
            $html_delete_topic_link = "<a href=\"?page=delete_topic&topic=".$id_topic."\" class=\"delete-link\">Supprimer le sujet</a>";
        }
    }
}

if(!$topic)
{
    header("Location: ?page=404");
    die();
}

//AFFICHAGE
include "commons/nav_category.php";
?>

    <nav>
        TODO : breadcrumb
    </nav>

    <section id="topic" class="main-wrap">
        <?php echo $html_delete_topic_link; ?>
        <h2><?php echo $html_topic_title; ?></h2>
        <?php echo $html_topic_infos; ?>
        <?php echo $html_error; ?>
        <?php echo $html_message; ?>
        <?php echo $html_post_list; ?>
        <?php echo $html_post_link; ?>
    </section>

    <nav>TODO : Navigation par pages (10 posts par page?)</nav>