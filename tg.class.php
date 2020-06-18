<?php

class TG {
  
    public $token = '';
  
    public function __construct($token) {
        $this->token = $token;
    }
      
    public function send_message($id, $message) {  

        $data = array(
            'chat_id'      => $id,
            'text'     => $message,
        );

        $out = $this->request('sendMessage', $data);

        return $out;
    }   

    public function send_sticker($id, $file_id){
        $data = array(
            'chat_id'   => $id,
            'sticker'   => $file_id,
        );

        $out = $this->request('sendSticker', $data);
        return $out;
    }

    public function send_photo($id, $file_id){
        $data = array(
            'chat_id'   => $id,
            'photo'   => $file_id,
        );

        $out = $this->request('sendPhoto', $data);
        return $out;
    }
      
    public function get_file($file_id){
        $data = array(
            'file_id'   => $file_id,
        );

        $out = $this->request('getFile', $data);
        return $out;
    }
    public  function request($method, $data = array()) {
        $curl = curl_init(); 
          
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $this->token .  '/' . $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          
        $out = json_decode(curl_exec($curl), true); 
          
        curl_close($curl);
          
        return $out;
    }

    public function send_to_db($tg_user_id, $tg_chat_id, $tg_username, $tg_message, $tg_url_pict, $tg_date){
        $mysqli = new mysqli("codercat.ru", "rootya", "rootyalove", "telegram_mess");
        $mysqli->set_charset("utf8");
        if ($mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }

        $mysqli->query("INSERT INTO `Message`(`user_id`, `chat_id`, `user_name`, `text`, `url_pict`, `created_at`) VALUES ('$tg_user_id', '$tg_chat_id', '$tg_username', '$tg_message', '$tg_url_pict', '$tg_date');");
    }
}