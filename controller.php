<?php

require('leibniz.class.php');
$leibniz = new Leibniz();

$action = $_POST['action'];

file_put_contents('gear.txt',$_POST['gear']);
file_put_contents('cyphers.txt',$_POST['alphabets']);

if($action != "save")
  {
    $leibniz->set_gear($_POST['gear']);
    $leibniz->set_alphabets($_POST['alphabets']);
    echo $leibniz->$action($_POST['message']);
  }


?>