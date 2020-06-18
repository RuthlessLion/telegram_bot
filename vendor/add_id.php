<?php 
require_once 'connect.php';

$chat_id = $_POST['text_id'];
$username = $_POST['username'];

$count = mysqli_query($connect, "SELECT `chat_id`, `user_id` FROM `Users_auths` WHERE `user_id` = '".$username."' AND `chat_id` = '".$chat_id."'");
$count_row = mysqli_fetch_assoc($count);
$time = time();
$date = date("d-m-Y",$time);

if($count_row['chat_id']){
    echo "delete";
    $count = mysqli_query($connect, "DELETE FROM `Users_auths` WHERE `user_id` = '".$username."' AND `chat_id` = '".$chat_id."'");
}else{
    echo "add";
    mysqli_query($connect, "INSERT INTO `Users_auths`(`user_id`, `chat_id`, `created_at`) VALUES ('$username', '$chat_id', '$date');");
};
?>