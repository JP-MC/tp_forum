<?php
$check = false;
$error = "";
$message = "";
$get_topic = "";
$get_content = "";

if(isset($_POST["id_topic"]) && isset($_POST["id_user"]) && isset ($_POST["content"]))
{
    if(isLogged() && isGranted($_SESSION["user"]["id_role"],CAN_CREATE_POST))
    {
        $get_topic = "&topic=".urlencode($_POST["id_topic"]);
        $get_content = "&content=".urlencode($_POST["content"]);

        $id_topic = $_POST["id_topic"];
        $id_user = $_POST["id_user"];
        $content = $_POST["content"];
        $date_creation = date("Y-m-d H:i:s");

        //Vérifications
        if(checkId($id_topic) && checkId($id_user))
        {
            if(checkText($content))
            {
                if(createPost($id_topic,$id_user,$content,$date_creation))
                {
                    $check = true;
                    $message = "&message=".urlencode("Le message a bien été ajouté!");
                }
                else
                {
                    $error = "&error=".urlencode("Une erreur est survenue lors de l'insertion.");
                }
            }
            else
            {
                $error = "&error=".urlencode("Texte non conforme (3 caratères minimum).");
            }
        }
    }
    else
    {
        $error = "&error=".urlencode("Vous n'avez pas les autorisations nécéssaires");
    }
}

if($check)
{
    //Rediriger vers la page précédente
    header("Location: ?".$_SESSION["origin_page"].$error.$message);
}
else
{
    //Rediriger vers la page add post avec $content
    header("Location: ?page=add_post".$get_topic.$get_content.$error.$message);
}

?>