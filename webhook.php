<?php
$body = file_get_contents('php://input');
$arr = json_decode($body, true);
  

function getKeyVals($arr) {
    foreach ($arr as $k => $v) {
          yield $v;
        if (is_array($v)) {
            foreach (getKeyVals($v) as $v2) {
                yield $v2;
            }
        }
    }
}

include_once ('tg.class.php');
  

$tg = new tg('token');
  


$tg_chat_id = $arr['message']['chat']['id'];
$tg_user_id = $arr['message']['from']['id'];
$tg_username = $arr['message']['from']['username'];
$tg_message = $arr['message']['text'];
$tg_sticker = $arr['message']['sticker']['file_id'];
$tg_doc = $arr['message']['document']['file_id'];
$tg_photo = $arr['message']['photo']['2']['file_id'];
$tg_mess2 = $arr['message']['photo']['0']['file_id'];
$tg_audio = $arr['message']['voice']['file_id'];
$tg_file = $arr['file']['file_id'];
$tg_date = gmdate("Y-m-d\TH:i:s", $arr['message']['date']);
$tg_url_pict = "";
$tg_mess = $tg_chat_id." ".$tg_id." ".$tg_username." ".$tg_message." ".$tg_sticker." ".$tg_date;

if(!empty($tg_chat_id)){


    if($tg_photo){    
        $data = array(
            'file_id'   => $tg_photo,
        );

        $res = $tg->request('getFile', $data);

        if ($res['ok']) {
            $src = 'https://api.telegram.org/file/bot' . $tg->token . '/' . $res['result']['file_path'];
            $dest = 'uploads/' . time() . '-' . basename($src);
     
            copy($src, $dest);
            $url = $dest;
            $tg->send_to_db($tg_user_id, $tg_chat_id, $tg_username, $tg_message, $url, $tg_date);    
        }
        exit();	
    }

    if($tg_sticker){
        $data = array(
            'file_id'   => $tg_sticker,
        );

        $res = $tg->request('getFile', $data);



        if ($res['ok']) {
            $src = 'https://api.telegram.org/file/bot' . $tg->token . '/' . $res['result']['file_path'];
            $dest = 'uploads/' . time() . '-' . basename($src);
     
            copy($src, $dest);
            $tg->send_to_db($tg_user_id, $tg_chat_id, $tg_username, $tg_message, $dest, $tg_date);    
        }
        exit();	
    }

    if($tg_audio){
        $data = array(
            'file_id'   => $tg_audio,
        );

        $res = $tg->request('getFile', $data);


        if ($res['ok']) {
            $src = 'https://api.telegram.org/file/bot' . $tg->token . '/' . $res['result']['file_path'];
            $dest = 'uploads/' . time() . '-' . basename($src);
     
            copy($src, $dest);
            $tg->send_to_db($tg_user_id, $tg_chat_id, $tg_username, $tg_message, $dest, $tg_date);    
        }
        exit();	
    }
    
    if(!stristr($tg_message, '/id') === FALSE){
        $tg->send_message($tg_chat_id, $tg_chat_id);
    }
    if(!$tg_message == ''){
        $tg->send_to_db($tg_user_id, $tg_chat_id, $tg_username, $tg_message, $tg_url_pict, $tg_date);
    }
}




exit('ok'); 
?>