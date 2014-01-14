<?php
include_once("lib/xtemplate.class.php");
include_once("model/User.class.php");

class PasswordList {
    private $user;
    private $xtpl;
    private $mysqli;

    function __construct(&$mysqli) {
        $this->mysqli = $mysqli;
        $this->user = new User($mysqli);

        $rows = $this->mysqli->select(
                "pw",
                false,
//                array("user_id", $this->user->getId()),
                array("id", "label")
                );
       
        $this->xtpl = new XTemplate("tpl/Password.html");
       
        foreach($rows as $row) {
            $this->xtpl->assign("label", $row["label"]);
            $this->xtpl->assign("id", $row["id"]);
            $this->xtpl->parse("list.pw");
        }
        
        $this->xtpl->parse("list");
    }

    function parse() {
        return $this->xtpl->out("list");
    }
}
?>
