<?php
echo("Dane klienta:</br>");
foreach($_REQUEST as $key=>$value) {
    echo "$key = $value <br />";
}
?>