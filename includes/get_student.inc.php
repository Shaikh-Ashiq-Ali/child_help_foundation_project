<?php

require ('db.php');

// Get Specific Collection
$array = ['stu_uniID'=>$_GET['id']];
$data = json_decode($database->getData('student',$array));
echo json_encode($data);

?>