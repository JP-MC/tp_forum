<?php
session_start();

/* CONNECTION */
function getConnection()
{
    $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	mysqli_set_charset($link,"utf8mb4");
	
    if($errors = mysqli_connect_error($link))
    {
        $errors = urlencode($errors);
        header("Location: ?page=home&error=".$errors);
        die();
    }
    return $link;
}

/* QUERY STRING */
function filterQuery()
{
    //Filtrage des clés
    //TODO Filtrer les valeurs?
	$query["page"] = (isset($_GET["page"])) ? $_GET["page"] : "home";
	if(isset($_GET["service"])){$query["service"] = $_GET["service"];}
	if(isset($_GET["category"])){$query["category"] = $_GET["category"];}
	if(isset($_GET["topic"])){$query["topic"] = $_GET["topic"];}
	if(isset($_GET["post"])){$query["post"] = $_GET["post"];}
	if(isset($_GET["message"])){$query["message"] = $_GET["message"];}
	if(isset($_GET["error"])){$query["error"] = $_GET["error"];}
	if(isset($_GET["login"])){$query["login"] = $_GET["login"];}
	if(isset($_GET["topic_title"])){$query["topic_title"] = $_GET["topic_title"];}
	if(isset($_GET["content"])){$query["content"] = $_GET["content"];}

	$_SESSION["my_get"] = $query;
}

function setOriginPage($condition = true)
{
	//initialisation de previous page
	if(!isset($_SESSION["my_previous_get"])){$_SESSION["my_previous_get"] = ["page" => "home"];}
	
	//Retire error et message de previous get
	if(isset($_SESSION["my_previous_get"]["error"])){unset($_SESSION["my_previous_get"]["error"]);}
	if(isset($_SESSION["my_previous_get"]["message"])){unset($_SESSION["my_previous_get"]["message"]);}
	
	if($condition)
	{
		$previous_page = $_SESSION["my_previous_get"]["page"];
		//On n'enregistre pas la page d'origine quand on vient d'une de ces pages : 
		//subscribe, login, add_post, edit_post, create_topic
        switch($previous_page)
        {
            case "subscribe":
            case "login":
            case "add_post":
            case "edit_post":
            case "create_topic":
            case "delete_topic":
                return;
        }
    }

    //Stocke la page précédente en session
    $_SESSION["origin_page"] = http_build_query($_SESSION["my_previous_get"]);
}

/* CATEGORY */
function getCategoryList()
{
    $link = getConnection();
    $sql = "SELECT * FROM category";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$b_id,$b_label);

    $category_list = [];
    while(mysqli_stmt_fetch($statement))
    {
        $category_list[] = [
            "id" => $b_id,
            "label" => $b_label
        ];
    }
    
    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $category_list;
}

function getCategoryLabel($id_category)
{
    $link = getConnection();
    $sql = "SELECT label FROM category WHERE id_category=?";

    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement,"i",$id_category);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$category_label);
    mysqli_stmt_fetch($statement);

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $category_label;
}

/* TOPIC */
function getTopicList($id_category)
{
    $link = getConnection();

    $sql = "SELECT topic.id_topic,topic.title,topic.date_creation,user.login 
        FROM topic 
        JOIN user
        ON topic.id_user = user.id_user
        WHERE topic.id_category =?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"i",$id_category);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$b_id_topic,$b_title,$b_date_creation,$b_user_login);

    $topic_list = [];
    while(mysqli_stmt_fetch($statement))
    {
        $topic_list[] = [
            "id" => $b_id_topic,
            "title" => $b_title,
            "date" => $b_date_creation,
            "user" => $b_user_login
        ];
    }
    
    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $topic_list;
}

function getIdTopicList($id_category)
{
    $link = getConnection();
    $sql = "SELECT id_topic FROM topic WHERE id_category =?";

    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement,"i",$id_category);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$b_id_topic);

    $id_topic_list = [];
    while(mysqli_stmt_fetch($statement))
    {
        $id_topic_list[] = $b_id_topic;
    }

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $id_topic_list;
}

function getTopic($id_topic)
{
    $link = getConnection();
    $sql = "SELECT topic.title,topic.date_creation,topic.id_user,user.login,category.label
        FROM topic 
        JOIN user
        ON topic.id_user = user.id_user
        JOIN category
        ON topic.id_category = category.id_category
        WHERE topic.id_topic =?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"i",$id_topic);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$b_title,$b_date_creation,$b_id_user,$b_user_login,$b_category_label);
    mysqli_stmt_fetch($statement);

	$topic = null;
    if($b_title)
    {
        $topic = [
            "title" => $b_title,
            "date" => $b_date_creation,
            "id_user" => $b_id_user,
            "user_login" => $b_user_login,
            "category_label" => $b_category_label
        ];
    }

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $topic;
}

/* TOPIC CREATE DELETE */
function createTopic($title,$date_creation,$id_user,$id_category)
{
    $link = getConnection();
    $sql = "INSERT INTO topic VALUES (null,?,?,?,?)";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"ssii",$title,$date_creation,$id_user,$id_category);
    mysqli_stmt_execute($statement);
    $topic_id = mysqli_stmt_insert_id($statement);

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $topic_id;
}

function deleteTopic($id_topic)
{
    $link = getConnection();
    $sql = "DELETE FROM topic WHERE id_topic =?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"i",$id_topic);
    mysqli_stmt_execute($statement);
	$deleted = mysqli_stmt_affected_rows($statement);

	mysqli_stmt_close($statement);
    mysqli_close($link);
	
	return (boolean)($deleted > 0);
}

function deletePostsByTopic($id_topic)
{
    $link = getConnection();
    $sql = "DELETE FROM post WHERE id_topic =?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"i",$id_topic);
    mysqli_stmt_execute($statement);
	$deleted = mysqli_stmt_affected_rows($statement);

	mysqli_stmt_close($statement);
    mysqli_close($link);
	
	return (boolean)($deleted > 0);
}

/* POST */
function getNbrPostsInTopic($id_topic)
{
    $link = getConnection();
    $sql = "SELECT COUNT(*) as nbr FROM post WHERE id_topic =?";

    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement,"i",$id_topic);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$nbr_posts);
    mysqli_stmt_fetch($statement);

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $nbr_posts;
}

function getPostList($id_topic)
{
    $link = getConnection();
    $sql = "SELECT post.id_post,post.content,post.date_creation,post.id_user,user.login
        FROM post 
        JOIN user
        ON post.id_user = user.id_user
        WHERE id_topic =?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"i",$id_topic);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$b_id_post,$b_content,$b_date_creation,$b_id_user,$b_user_login);

    $post_list = [];
    while(mysqli_stmt_fetch($statement))
    {
        $post_list[] = [
            "id" => $b_id_post,
            "content" => $b_content,
            "date" => $b_date_creation,
            "id_user" => $b_id_user,
            "user_login" => $b_user_login
        ];
    }
    
    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $post_list;
}

function getPost($id_post)
{
    $link = getConnection();
    $sql = "SELECT content,date_creation,id_topic,id_user FROM post WHERE id_post=?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"i",$id_post);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$b_content,$b_date_creation,$b_id_topic,$b_id_user);
    mysqli_stmt_fetch($statement);

    $post = null;
    if($b_id_user)
    {
        $post = [
            "content" => $b_content,
            "date_creation" => $b_date_creation,
            "id_topic" => $b_id_topic,
            "id_user" => $b_id_user
        ];
    }

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $post;
}

function getLastPost($id_topic)
{
    $link = getConnection();
	
	$sql = "SELECT user.login,post.date_creation
	FROM post
	JOIN user
	ON post.id_user = user.id_user
	WHERE date_creation = (SELECT MAX(date_creation) FROM post WHERE id_topic =?)";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"i",$id_topic);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$b_user_login,$b_date_creation);
    mysqli_stmt_fetch($statement);
	
	$last_post = null;
	if($b_user_login)
	{
		$last_post = [
			"user_login" => $b_user_login,
			"date_creation" => $b_date_creation
		];
	}

    mysqli_stmt_close($statement);
    mysqli_close($link);
	
    return $last_post;
}

function getPostOwnerID($id_post)
{
    $link = getConnection();
    $sql = "SELECT id_user FROM post WHERE id_post=?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"i",$id_post);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$b_id_user);
    mysqli_stmt_fetch($statement);

    $id_user = $b_id_user;

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $id_user;
}

/* POST CREATE UPDATE DELETE */
function createPost($content,$date_creation,$id_topic,$id_user)
{
    $link = getConnection();
    $sql = "INSERT INTO post VALUES (null,?,?,?,?)";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"ssii",$id_topic,$id_user,$content,$date_creation);
    mysqli_stmt_execute($statement);
    $inserted = mysqli_stmt_affected_rows($statement);

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return (boolean)($inserted > 0);
}

function updatePost($id_post,$content)
{
    $link = getConnection();
    $sql = "UPDATE post SET content=? WHERE id_post=?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"si",$content,$id_post);
    mysqli_stmt_execute($statement);
    $inserted = mysqli_stmt_affected_rows($statement);

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return (boolean)($inserted > 0);
}

function deletePost($id_post)
{
    $link = getConnection();
    $sql = "DELETE FROM post WHERE id_post =?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"i",$id_post);
    mysqli_stmt_execute($statement);
	$deleted = mysqli_stmt_affected_rows($statement);

	mysqli_stmt_close($statement);
    mysqli_close($link);
	
	return (boolean)($deleted > 0);
}

/* SUBSCRIBE */
function loginExist($login)
{
    $link = getConnection();
    $sql = "SELECT COUNT(*) as nbr FROM user WHERE login =?";

    $statement = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($statement,"s",$login);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$login_exist);
    mysqli_stmt_fetch($statement);

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return $login_exist;
}

function createUser($login,$password,$id_role)
{
    $link = getConnection();
    $sql = "INSERT INTO user VALUES (null,?,?,?)";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"ssi",$login,$password,$id_role);
    mysqli_stmt_execute($statement);
    $inserted = mysqli_stmt_affected_rows($statement);

    mysqli_stmt_close($statement);
    mysqli_close($link);

    return (boolean)($inserted > 0);
}

/* USER LOGIN PERMISSION */
function getUser($login,$password)
{
    $link = getConnection();
    $sql = "SELECT * FROM user WHERE login=? AND password=?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"ss",$login,$password);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$b_id_user,$b_login,$b_password,$b_id_role);
    mysqli_stmt_fetch($statement);

    $user = null;
    if($b_id_user)
    {
        $user = [
            "id_user" => $b_id_user,
            "login" => $b_login,
            "password" => $b_password,
            "id_role" => $b_id_role
        ];
    }

    mysqli_stmt_close( $statement );
    mysqli_close( $link );

    return $user;
}

function isLogged($as_role = SUBSCRIBER)
{
    return(isset($_SESSION["user"]) && $_SESSION["user"]["id_role"] <= $as_role);
}

function connectionRequired($as_role = SUBSCRIBER)
{
    if(!isset($_SESSION["user"]))
	{
        header("Location: ?page=home");
        die();
    }
    else if(!isLogged($as_role))
	{
        $error = "Vous n'avez les autorisations nécessaires !";
        header("Location: ?page=home&error=".$error);
        die();
    }
}

function isGranted($id_role,$id_permission)
{
    $link = getConnection();
    $sql = "SELECT COUNT(*)
    FROM role_permission
    WHERE role_permission.id_role = ? 
    AND role_permission.id_permission = ?";

    $statement = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($statement,"ii",$id_role,$id_permission);
    mysqli_stmt_execute($statement);
    mysqli_stmt_bind_result($statement,$result);
    mysqli_stmt_fetch($statement);

    return (boolean)$result;
}

/* VÉRIFICATIONS */
//Return $value or false
function checkId($id)
{
    //Integer supérieur ou égal à 1
    $options = ['options'=>['min_range'=>1]];
    return filter_var($id,FILTER_VALIDATE_INT,$options);
}
function checkLogin($string)
{
    //Entre 3 et 60 caractères, les 26 lettres de l'alphabet en majuscules ou minuscules, les chiffres de 0 à 9, le tiret "-" et le tiret bas "_".
    $options = ["options" => ["regexp" => "/^[a-zA-Z0-9_-]{3,60}$/"]];
    return filter_var($string,FILTER_VALIDATE_REGEXP,$options);
}
function checkPassword($password)
{
    //Entre 8 et 60 caractère, ni espace, ni slash "/", ni antislash "\"
    $options = ["options" => ["regexp" => "/^[^\/\\\s]{8,60}$/"]];
    return filter_var($password,FILTER_VALIDATE_REGEXP,$options);
}
function checkTitle($string)
{
    //Entre 3 et 60 caractères
    $options = ["options" => ["regexp" => "/.{3,60}/"]];
    return filter_var($string,FILTER_VALIDATE_REGEXP,$options);
}
function checkText($text)
{
    //Au moins 3 caractères
    $options = ["options" => ["regexp" => "/.{3,}/"]];
    return filter_var($text,FILTER_VALIDATE_REGEXP,$options);
}
function checkCategory($string)
{
    //Entre 3 et 30 caractères
    $options = ["options" => ["regexp" => "/.{3,30}/"]];
    return filter_var($string,FILTER_VALIDATE_REGEXP,$options);
}
?>