<?php
class User {
    private $mysqli;
    private $id;
    private $pubkey;
    private $name;

    function __construct(&$mysqli) {
        $this->mysqli=$mysqli;
        $this->name = $_SERVER["SSL_CLIENT_S_DN_CN"];
        $this->id = $this->mysqli->select("user", array("name"=>$this->name), "id");
        $this->load();
    }

    function save() {
        $this->pubkey = $this->mysqli->real_escape_string($this->pubkey);
        if(empty($this->id))
            $this->mysqli->insert("user", array("name"=>$this->name, "pubkey"=>$this->pubkey));
        else
            $this->mysqli->query("UPDATE user SET name=\"".$this->name."\", pubkey=\"".$this->pubkey."\" WHERE id=".$this->id.";");
    }

    function load() {
        $sql="SELECT * FROM user WHERE name=\"".$this->name."\";";
        $rows = $this->mysqli->select("user", array("name"=>$this->name));
        foreach($rows as $row) {
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->pubkey = $row['pubkey'];
        }
    }

    function getPubkey() {
        return $this->pubkey;
    }

    function setPubkey($pubkey) {
        $this->pubkey = $pubkey;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }
}
?>
