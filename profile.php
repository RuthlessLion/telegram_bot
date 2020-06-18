<?php


session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
require_once 'vendor/connect.php';

$username = $_SESSION['user']['full_name'];

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Диалоги</title>
    <link rel="stylesheet" href="assets/css/main.css">
    <script type='text/javascript' src='https://code.jquery.com/jquery.min.js'></script>
    <script type="text/javascript">

	$(document).ready(function(){
        var countMessage = 0;
        var viev_message = 30;
        var chatId;
        let name = $('div.hidden').data('name');

        $.ajax({
					url: "vendor/view_id.php",
					type: "POST",
                    data: {'username': name},
					success: function(data){
                        $("#chat-id").html(data);
					}
                });

                // var myvar = $('#myid').attr('data-hren');
                //     alert(myvar);
        $.ajax({
				url: "vendor/get_mess.php",
				type: "POST",
                data: {'count_mess':countMessage,
                'viev_message':viev_message,},
				success: function(data){
						$("#message").html(data);
				}
            });    
            $(document).on('click', 'a[class="id"]', function(e) {
            chatId = this.innerText;
});
//             $('.id').click(function( event ) {
//                 alert();
//             $( "#chat-id" ).html( "clicked: " + event.target.nodeName );
// });

        $('.push-button').click(function (e) {
            viev_message = Number(viev_message) + 1;
            let name = $('div.hidden').data('name');
            let text = $(".push-input").val()
                $.ajax({
					url: "vendor/push_mess.php",
					type: "POST",
                    data: {'text_chat': text,
                    'username': name,
                    'chat_id': chatId},
					success: function(data){
						$(".push-input").val("");
					}
                });
    e.preventDefault();});

        $('.viev-button').click(function (e) {
            viev_message = Number(viev_message) + 10;
            countMessage = 0;
                $.ajax({
				url: "vendor/get_mess.php",
				type: "POST",
                data: {'count_mess':countMessage,
                'viev_message':viev_message,
                'chat_id': chatId},
				success: function(data){
						$("#message").html(data);
				}
			});
    e.preventDefault();});

    $('.add-button').click(function (e) {
            let name = $('div.hidden').data('name');
            let text = Number.parseInt($(".add-input").val());
            if (!Number.isInteger(text)){
                alert("Введите правильный id");
                $(".add-input").val("");
            }else{
                $.ajax({
					url: "vendor/add_id.php",
					type: "POST",
                    data: {'text_id': text,
                    'username': name},
					success: function(data){
                        $("#chat-id").html(data);
                        $.ajax({    
					url: "vendor/view_id.php",
					type: "POST",
                    data: {'username': name},
					success: function(data){
                        $("#chat-id").html(data);
					}
                });
					}
                });};
    e.preventDefault();});

		window.setInterval(function(){
            // var id = $(".mess:last").attr("id");
            countMessage = $('.hiddenn').html();
			$.ajax({
				url: "vendor/get_mess.php",
				type: "POST",
                data: {'count_mess':countMessage,
                'viev_message':viev_message,
                'chat_id': chatId},
				success: function(data){
					if(data==1) {
					} else {
                        $("#message").html(data);
					}
				}
			});
        },1000);
	
	});
</script>
</head>
<body>
<div style="display: none" class='hidden'
    data-name='<?= $username ?>' 
    data-chat='1'
></div>
    <div class="main-box">
        <div class="add-block">
        <div class="logout"><a href="vendor/logout.php">Выход</a></div>
        <form class="add" method="post">
                <input type="text" value="" name="textfield" class="add-input">
                <button type="submit" class="add-button">Добавить</button>
                <div id="chat-id"></div>
                                
            </form>
        </div>
        <div class="main-block">
            <form class="push" method="post">
                <input type="text" value="" name="textfield" class="push-input">
                <button type="submit" class="push-button">Отправить</button>                
            </form>

        <div id="message"></div>
        <button type="submit" class="viev-button">Показать больше сообщений</button>                
        </div>   
    </div>
</body>
</html>