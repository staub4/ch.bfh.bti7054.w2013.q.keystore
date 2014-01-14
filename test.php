<?php
$key = base64_encode(openssl_random_pseudo_bytes(24));;
?>
<h1>mcrypt</h1>
<form action="test.php">
Key (32 Chars):<input type="text" name="key" value="<?php echo $key ?>" />
String:<input type="text" name="test_str" />
<input type="submit">
</form>

<?php

$test_str = $_GET['test_str'];

function string_encrypt($string, $key) {
        $crypted_text = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB);
            return $crypted_text;
}

function string_decrypt($encrypted_string, $key) {
        $decrypted_text = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encrypted_string, MCRYPT_MODE_ECB);
            return trim($decrypted_text);
}

echo $test_str;   echo '<br />';
$enc_str = string_encrypt($test_str, $key);
echo bin2hex($enc_str);                                     echo '<br />';
echo string_decrypt($enc_str, $key);                        echo '<br />';

?>

<script src='lib/rijndael.js'></script>
<script src='lib/mcrypt.js'></script>

<script lang='javascript'>
    function toHex(str) {
        var hex = '';
        for(var i=0;i<str.length;i++) {
            var val = ''+str.charCodeAt(i).toString(16);
            if(val.length == 1)
                hex += '0'+val;
            else
                hex += val;
        }
        return hex;
    }
    function hexToString (hex) {
        var str = '';
        for (var i=0; i<hex.length; i+=2) {
            str += ''+String.fromCharCode(parseInt(hex.charAt(i)+hex.charAt(i+1), 16));
        }
        return str;
    }
    var enc_str = mcrypt.Encrypt('<?php echo $test_str ?>', '', '<?php echo $key ?>', 'rijndael-256', 'ecb');
    alert(toHex(enc_str));
    alert(mcrypt.Decrypt(hexToString('<?php echo bin2Hex($enc_str) ?>'), '', '<?php echo $key ?>', 'rijndael-256', 'ecb').replace(/\x00+$/g, ''));
</script>

<h1>PGP</h1

