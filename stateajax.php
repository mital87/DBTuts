<?php
include_once 'config.php';

$locationId = $_POST['location_id'];
$locationType = $_POST['location_type'];
$types = array('country','state','city');

$query = $db->prepare("select * from location where location_type=? and parent_id=?");
$query->execute(array($locationType,$locationId));
$data = $query->fetchAll(PDO::FETCH_ASSOC);

echo '<option value=""> Select '.$types[$locationType].'</option>';
foreach($data as $key=>$value){
    echo '<option value="'.$value['location_id'].'">'.$value['name'].'</option>';
}

?>