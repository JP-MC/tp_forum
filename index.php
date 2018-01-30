<?php
//TODO vérification des inputs (create_topic.php, delete_topic.php, service_create_topic.php, service_delete_topic.php)
//TODO vérifier les champs date
//TODO Message de confirmation lors d'une inscription
//TODO navigation par posts page topic
//TODO Interdire la suppression du premier post d'un topic
//TODO menu logged / admin
//TODO Breadcrumb
//TODO Cryptage des mots de passe
//TODO types des redirections

require "assets/config/config.php";
require "functions.php";

//phpinfo();

/* Filtrage de QUERY_STRING */
filterQuery();
//var_dump($_SESSION);

/* Routage des services */
if(isset($_SESSION["my_get"]["service"]))
{
    $service = $_SESSION["my_get"]["service"];

    switch($service)
    {
        case "subscribe":													include "services/service_subscribe.php";break;
        case "login":														include "services/service_login.php";break;
        case "logout":		connectionRequired();	setOriginPage(false);	include "services/service_logout.php";break;
        case "add_post":	connectionRequired();							include "services/service_add_post.php";break;
        case "edit_post":	connectionRequired();							include "services/service_edit_post.php";break;
        case "delete_post":	connectionRequired();	setOriginPage(false);	include "services/service_delete_post.php";break;
        case "create_topic":connectionRequired();                           include "services/service_create_topic.php";break;
        case "delete_topic":connectionRequired();                           include "services/service_delete_topic.php";break;
        default:															header("Location: ?page=home");
    }
    die();
}

//Récupération des mesages
$html_error = (isset($_SESSION["my_get"]["error"])) ? "<p class='error'>".$_SESSION["my_get"]["error"]."</p>" : "";
$html_message = (isset($_SESSION["my_get"]["message"])) ? "<p class='message'>".$_SESSION["my_get"]["message"]."</p>" : "";

/* Routage des pages */
$page = $_SESSION["my_get"]["page"];
$header = "header.php";

switch($page)
{
	case "home":        											$page_file = "home.php";break;
	case "login":								setOriginPage();	$page_file = "login.php";break;
	case "subscribe":   						setOriginPage();	$page_file = "subscribe.php";break;
	case "topic_list":  											$page_file = "topic_list.php";break;
	case "topic":       											$page_file = "topic.php";break;
	case "add_post":	connectionRequired();	setOriginPage();	$page_file = "add_post.php";break;
	case "edit_post":	connectionRequired();	setOriginPage();	$page_file = "edit_post.php";break;
	case "create_topic":connectionRequired();	setOriginPage();	$page_file = "create_topic.php";break;
	case "delete_topic":connectionRequired();	setOriginPage();	$page_file = "delete_topic.php";break;
	case "page404":                                                 $page_file = "page404.php";$header = "header404.php";break;
	default:            											$page_file = "page404.php";$header = "header404.php";
}

include "commons/".$header;
include "commons/nav.php";
include "pages/".$page_file;
include "commons/footer.php";

//Stockage de la page en cours en session à la fin du script (permet de récupérer la page précédente)
$_SESSION["my_previous_get"] = $_SESSION["my_get"];

//var_dump($_SESSION);
//var_dump($_SERVER);
?>