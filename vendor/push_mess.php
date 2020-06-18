<?php

include_once ('../tg.class.php');

$tg = new tg('token');



$username = $_POST['username'];
$text = $_POST['text_chat'];
$chat_id = $_POST['chat_id'];


$tg->send_message($chat_id, $_POST['username'].": ".$text);
if(!stristr($text, '/id') === FALSE){
    $tg->send_message($chat_id, $chat_id);
    $tg->send_to_db(null, $chat_id, "bot", $chat_id, null, null);    
}
$tg->send_to_db(null, $chat_id, $username, $text, null, null);    


echo($text);
?>