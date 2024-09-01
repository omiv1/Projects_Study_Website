<?php
session_start();
echo 'ID: '.session_id().'<br />';
if (!isset($_SESSION['our_own']))
{
    //echo 'PHPSESSID: '.$_GET['PHPSESSID'].'<br />';
session_regenerate_id();
$_SESSION['our_own'] = true;
}
?>
