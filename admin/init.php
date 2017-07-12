<?php
session_start();
ini_set("register_globals", "off");
ini_set("upload_max_filesize", "20M");
ini_set("post_max_size", "40M");
ini_set("memory_limit", "80M");

require_once("../data/conn.php");
require_once("../data/users.php");
require_once("../data/groups.php");
require_once("../data/program.php");

$program = new Program();
$conn 					= new Dbconn();		
$users	 				= new Users();	
$groups					= new Groups();

define (ADMIN_GALLERY_LIMIT,20);


require_once("../data/constants.php");
require_once("../data/sqlinjection.php");
require_once("../data/youtubeimagegrabber.php");

//for users.php
define("USERDISTRICT", 2)
?>