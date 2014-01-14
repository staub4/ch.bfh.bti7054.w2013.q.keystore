<?php
include_once("../model/User.class.php");
include_once("../model/MyDb.class.php");
$db = new MyDb();
$user = new User($db);
$user->setPubkey($_GET['pubkey']);
$user->save();
echo $user->getPubkey();
?>
