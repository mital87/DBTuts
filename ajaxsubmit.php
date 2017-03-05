<?php

include_once 'config.php';

$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$city = $_POST['city'];
$insertQuery = $db->prepare('insert into `users` (`id`,`first_name`,`last_name`,`user_city`) values(NULL,?,?,?)');
$query = $insertQuery->execute(array($firstName,$lastName,$city));
if($query){
    echo '1';
}else{
    echo 'Error While Inserting Record';
}


