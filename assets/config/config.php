<?php
// BDD
define("DB_HOST", "localhost");
define("DB_NAME", "forum2");
define("DB_USER", "root");
define("DB_PASS", "root");

// PERMISSION
define("CAN_CREATE_TOPIC", 1);
define("CAN_CREATE_POST", 2);
define("CAN_EDIT_POST", 3);
define("CAN_EDIT_OWN_POST", 4);
define("CAN_DELETE_POST", 5);
define("CAN_DELETE_OWN_POST", 6);
define("CAN_DELETE_TOPIC", 7);

// ROLE
define("ADMINISTRATOR", 1);
define("MODERATOR", 2);
define("SUBSCRIBER", 3);

// TIMEZONE
date_default_timezone_set('EUROPE/PARIS');
?>