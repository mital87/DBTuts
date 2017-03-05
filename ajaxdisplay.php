<?php

include_once 'config.php';

$query = $db->prepare('select * from users');
$query->execute();
$data = $query->fetchAll(PDO::FETCH_ASSOC);

$displayData = '<table class="table table-striped">';
$displayData = '<tr><th>Firstname</th><th>Lastname</th><th>City</th></tr>';
foreach($data as $key=>$value){
    $displayData .= '<tr>';
    $displayData .= "<td>".$value['first_name']."</td>";
    $displayData .= "<td>".$value['last_name']."</td>";
    $displayData .= "<td>".$value['user_city']."</td>";
    $displayData .= '</tr>';
}
$displayData .= '</table>';

print_r($displayData);
