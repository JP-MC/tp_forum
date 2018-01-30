<?php
unset($_SESSION["user"]);
header("Location: ?".$_SESSION["origin_page"]);
?>