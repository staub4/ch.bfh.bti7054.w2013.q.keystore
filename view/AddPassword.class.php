<?php
include_once("lib/xtemplate.class.php");
include_once("model/User.class.php");

class AddPassword {
    private $xtpl;
    private $mysqli;
    private $id;
    private $privkey;
    private $pubkey;

    function __construct(&$mysqli) {
        $this->mysqli = $mysqli;
        $this->xtpl = new XTemplate("tpl/Password.html");
        $this->xtpl->parse("new");
    }

    function genKeys() {
        $gpg = new gnupg();
    }

    function parse() {
        return $this->xtpl->out("new");
    }
}
?>
