<?php
require_once 'connect.php';
include_once ('../tg.class.php');

$count_mess = $_POST['count_mess'];
$viev_message = $_POST['viev_message'];
$chat_id = $_POST['chat_id'];

$tg = new tg('token');

$count = mysqli_query($connect, "SELECT COUNT(*) AS coun FROM `Message` WHERE `chat_id` = ".$chat_id."");
$count_row = mysqli_fetch_assoc($count);
                if($count_mess == 0){
                $check_mess = mysqli_query($connect, "SELECT `user_name`, `text`, `url_pict` FROM `Message` WHERE `chat_id` = ".$chat_id." ORDER BY `id` DESC limit ".$viev_message."");
                echo "<div class='hiddenn' style='display: none'>".$count_row['coun']."</div>";
                if (mysqli_num_rows($check_mess) > 0){
                    while ($row = mysqli_fetch_assoc($check_mess)){
                        if($row['url_pict']){
                            if(stristr($row['url_pict'], '.webp')){
                                echo '<div class="mess">'.$row['user_name'].'<img src="'.$row['url_pict'].'" class="sticker"/></div>';
                            }elseif(stristr($row['url_pict'], '.jpg')){
                                echo '<div class="mess">'.$row['user_name'].'<img src="'.$row['url_pict'].'" class="sticker"/></div>';
                            }elseif(stristr($row['url_pict'], '.oga')){
                                echo '<div class="mess">'.$row['user_name'].'<audio controls><source src="'.$row['url_pict'].'" type="audio/ogg; codecs=vorbis"></audio></div>';
                            }
                        }else{
                            echo "<div class='mess'>".$row['user_name'].": ".$row['text']."</div>";

                        }
                    }
                }
                return;
            }
            if($count_row['coun'] > $count_mess){
                $check_mess = mysqli_query($connect, "SELECT `user_name`, `text`, `url_pict` FROM `Message` WHERE `chat_id` = ".$chat_id." ORDER BY `id` DESC limit ".$viev_message."");
                echo "<div class='hiddenn' style='display: none'>".$count_row['coun']."</div>";
                if (mysqli_num_rows($check_mess) > 0){
                    while ($row = mysqli_fetch_assoc($check_mess)){
                        if($row['url_pict']){
                            if(stristr($row['url_pict'], '.webp')){
                                echo '<div class="mess">'.$row['user_name'].'<img src="'.$row['url_pict'].'" class="sticker"/></div>';
                            }elseif(stristr($row['url_pict'], '.jpg')){
                                echo '<div class="mess">'.$row['user_name'].'<img src="'.$row['url_pict'].'" class="sticker"/></div>';
                            }elseif(stristr($row['url_pict'], '.oga')){
                                echo '<div class="mess">'.$row['user_name'].'<audio controls><source src="'.$row['url_pict'].'" type="audio/ogg; codecs=vorbis"></audio></div>';
                            }
                        }else{
                            echo "<div class='mess'>".$row['user_name'].": ".$row['text']."</div>";

                        }
                    }
                }

            }
            if($count_row['coun'] == $count_mess){
                echo 1;
            }
?>