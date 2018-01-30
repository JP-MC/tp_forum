<?php
$check = false;
$error = "";
$message = "";
$get_post = "";

if(isset($_POST["id_post"]) && isset($_POST["content"]))
{
    //Vérification de l'id_post
    $id_post = checkId($_POST["id_post"]);
    
    if($id_post)
    {
        //On récupère le id_user du post
        $post_id_user = getPostOwnerID($id_post);

        if($post_id_user)
	    {
            //On vérifie que l'utilisateur a le droit de modifier le post
            if( (isLogged() && isGranted($_SESSION["user"]["id_role"],CAN_EDIT_POST))  || (isLogged() && $post_id_user == $_SESSION["user"]["id_user"] && isGranted($_SESSION["user"]["id_role"],CAN_EDIT_OWN_POST)) )
            {
                $get_post = "&post=".$id_post;

                if(checkText($_POST["content"]))
                {
                    if(updatePost($id_post,$content))
                    {
                        $check = true;
                        $message = "&message=".urlencode("Le message a bien été modifié.");
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
            else
            {
                $error = "&error=".urlencode("Vous n'avez pas les permissions nécéssaires.");
            }
        }
    }
}

if($check)
{
    //Rediriger vers la page précédente
    header("Location: ?".$_SESSION["origin_page"].$error.$message);
}
else
{
    //Rediriger vers la page edit post
    header("Location: ?page=edit_post".$get_post.$error.$message);
}
?>