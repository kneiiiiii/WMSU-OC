<?php
include_once('includes/config_mod.php');
include_once('includes/libraries_mod.php');


$post_data['lastname'] 		=   $_POST['lastname'];
$post_data['firstname'] 	=   $_POST['firstname'];
$post_data['mi']			=   $_POST['mi'];
$post_data['contact'] 		=   $_POST['contact'];
$post_data['email_add'] 	=   $_POST['email_add'];
$post_data['pass_word'] 	=   $_POST['pass_word'];
$post_data['avatar_id'] 	=	8;
$post_data['usertype'] 		=   5;
$post_data['datecreated'] 	= 	date("Y/m/d h:i:s");

$id = $SQL_Helper->INSERT_ALL('tbl_customer',$post_data);
$is_added = $id > 0 ? true : false;		
$result =  $is_added==true ? $result='true' : $result='false';
echo $result ;
?>