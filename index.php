<?php
include_once("model/Database.class.php");
include_once("lib/xtemplate.class.php");

$mysqli= new Database("localhost", "key", "12345", "key_main" );
$xtpl = new XTemplate('tpl/main.html');

$menu = $mysqli->select("pages", array("menu"=>"1"));

foreach($menu as $entry) {
    $xtpl->assign("label", $entry['label']);
    $xtpl->assign("page", $entry['page']);
    $xtpl->parse("main.menu");
}

if (isset($_GET['page']))
    $page = $mysqli->mysqli->real_escape_string($_GET['page']);
else
    $page = "main";
$xtpl->assign("title", $page);
$xtpl->assign("user", $_SERVER["SSL_CLIENT_S_DN_CN"]);

switch($page) {
    case "User":
        include("view/UserView.class.php");
        $view = new UserView($mysqli);
        $content = $view->parse();
        break;
    case "Password":
        include_once("view/PasswordList.class.php");
        $view = new PasswordList($mysqli);
        $content = $view->parse();
        break;
    case "pwdetail":
        include_once("view/PwDetail.class.php");
        $id = $mysqli->mysqli->real_escape_string($_GET['id']);
        $view = new PwDetail($mysqli, $id);
        $content = $view->parse();
        break;
    case "newPassword":
        include_once("view/AddPassword.class.php");
        $view = new AddPassword($mysqli);
        $content = $view->parse();
        break;
    default:
        $content = "Hello World!";
}
if(!isset($content))
    $content="Page not found!";
$xtpl->assign("content", $content);
$xtpl->parse('main');
echo $xtpl->out("main");
?>
