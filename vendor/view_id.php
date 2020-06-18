<?php 
require_once 'connect.php';

$username = $_POST['username'];

$count = mysqli_query($connect, "SELECT * FROM `Users_auths` WHERE `user_id` = '".$username."'");
// $count_row = mysqli_fetch_assoc($count);
// $asd = "<script>var id = ".$count_row['chat_id'].";</script>";
echo $asd;
if (mysqli_num_rows($count) > 0){
    while ($row = mysqli_fetch_assoc($count)){
            echo "<a class='id'>".$row['chat_id']."</a>";
            
    }
}else{
    echo "Нет добавленых чатов";
};
?>