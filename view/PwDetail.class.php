<?php
include_once("lib/xtemplate.class.php");
include_once("model/User.class.php");

class PwDetail {
    private $xtpl;
    private $mysqli;
    private $id;
    private $pw;
    private $privkey;

    function __construct(&$mysqli, $id) {
        $this->mysqli = $mysqli;
        $this->id = $mysqli->mysqli->real_escape_string($id);
        $this->xtpl = new XTemplate("tpl/Password.html");
        $this->loadPw();
        $this->xtpl->assign("pw", $this->pw);
        $this->loadPrivkey();
        $this->xtpl->assign("privkey", htmlspecialchars($this->privkey));
        $this->xtpl->parse("detail");
    }

    function loadPw() {
        $rows = $this->mysqli->select("pw", array("id"=>$this->id));
        foreach($rows as $row) {
            $this->pw = $row;
        }
    }

    function loadPrivkey() {
        $user = new User($this->mysqli);
        $rows = $this->mysqli->select("pw_keys", array("user_id"=>$user->getId(), "pw_id"=>$this->id));
        foreach($rows as $row) {
                $this->privkey = $row['key'];
        }
    }

    function parse() {
        return $this->xtpl->out("detail");
    }
}
?>
