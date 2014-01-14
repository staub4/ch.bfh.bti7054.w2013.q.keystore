<?php
include_once("lib/xtemplate.class.php");

class UserView {
    private $user;
    private $xtpl;
    private $mysqli;

    function __construct(&$mysqli) {
        $this->mysqli = $mysqli;
        include("model/User.class.php");
        $this->user = new User($this->mysqli);
        $this->xtpl = new XTemplate("tpl/User.html");
        $this->xtpl->assign("id", $this->user->getId());
        $this->xtpl->assign("name", $this->user->getName());
        $this->xtpl->assign("pubkey", $this->user->getPubkey());
        $this->xtpl->parse("user");
    }

    function parse() {
        return $this->xtpl->out("user");
    }
}
?>
