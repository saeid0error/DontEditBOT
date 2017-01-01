<?php
ob_start();
define('API_KEY','285389338:AAE8raed53_vYA3PRtjGkqd8_gAJYF_QPFg');
$admin = "270038818";
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$editm = $update->edited_message;
$mid = $message->message_id;
$chat_id = $message->chat->id;
$help= file_get_contents("help.txt");
$creator= file_get_contents("creator.txt");
$text1 = $message->text;
$fadmin = $message->from->id;
$file_o = __DIR__.'/users/'.$mid.'.json';
file_put_contents($file_o,json_encode($update->message->text));
chmod($file_o,0777);
if (isset($update->edited_message)){
  //$chat_id1 = $editm->chat->id;
  $eid = $editm->message_id;
  $edname = $editm->from->first_name;
  $jsu = json_decode(file_get_contents(__DIR__.'/users/'.$eid.'.json'));
  $text = "<b>".$edname."</b>\nمن دیدم که چی گفتی بازم ادیت کنی میفهمم
  گفتی:
".$jsu;
  $id = $update->edited_message->chat->id;
  bot('sendmessage',[
    'chat_id'=>$id,
    'reply_to_message_id'=>$eid,
    'text'=>$text,
    'parse_mode'=>'html'
  ]);
  $file_o = __DIR__.'/users/'.$eid.'.json';
  file_put_contents($file_o,json_encode($update->edited_message->text));
  //$up = file_get_contents(__DIR__.'/users/'.$eid.'.json');
  //str_replace("edited_message","message",$up);
}elseif(preg_match('/^\/([Ss]tart)/',$text1)){
  $text = "به ربات ادیت نکن\nخوش آمدید";
  bot('sendmessage',[
    'chat_id'=>$chat_id,
    'text'=>$text,
    'parse_mode'=>'html',
    'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'درمورد ربات','callback_data'=>'help']
        ],
        [
          ['text'=>'منو ببر گروهت','url'=>'https://telegram.me/testbot?startgroup=new']
        ],
        [
          ['text'=>'ارتباط با سازنده','callback_data'=>'creator']
        ],
        [
          ['text'=>'کانال-ربات','url'=>'https://telegram.me/TELEBOOMBANG_TG']
        ]
      ]
    ])
  ]);
}elseif( $fadmin == $admin |  $fadmin == $admin2 and $update->message->text == '/stats'){
    $txtt = file_get_contents('member.txt');
    $member_id = explode("\n",$txtt);
    $mmemcount = count($member_id) -1;
  bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"کاربران : $mmemcount 👤 "
    ]);

}elseif(preg_match('/^\/([Hh]elp)/',$text)){
coding('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>$help,
    'parse_mode'=>'html'
  ]);
}elseif ($data == "help") {
  coding('editMessagetext',[
    'chat_id'=>$chatid,
	'message_id'=>$message_id,
    'text'=>$help,
    'parse_mode'=>'html',
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
 	         ['text'=>' برگشت 🔙','callback_data'=>'back']
        ]
        ]
    ])
  ]);
 }elseif(preg_match('/^\/([Cc]reator)/',$text)){
coding('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>$creator,
    'parse_mode'=>'html'
  ]);
}elseif ($data == "creator") {
  coding('editMessagetext',[
    'chat_id'=>$chatid,
	'message_id'=>$message_id,
    'text'=>$creator,
    'parse_mode'=>'html',
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
        [
          ['text'=>'سازنده','url'=>'https://telegram.me/A_R_M_i_N_L_U_A']
        ],
        [
	          ['text'=>' برگشت 🔙','callback_data'=>'back']
        ]
        ]
    ])
  ]);
}elseif ($data == "back") {
  coding('editMessagetext',[
    'chat_id'=>$chatid,
	'message_id'=>$message_id,
    'text'=>"Backed!",
    'parse_mode'=>'html',
   'reply_markup'=>json_encode([
     'inline_keyboard'=>[
        [
          ['text'=>'درمورد ربات','callback_data'=>'help']
        ],
        [
          ['text'=>'منو ببر گروهت','url'=>'https://telegram.me/testbot?startgroup=new']
        ],
        [
          ['text'=>'ارتباط با سازنده','callback_data'=>'creator']
        ],
        [
          ['text'=>'کانال-ربات','url'=>'https://telegram.me/TELEBOOMBANG_TG']
        ]
      ]
    ])
  ]);
}elseif(isset($update->message-> new_chat_member )){
bot('sendMessage',[
      'chat_id'=>$chat_id,
      'text'=>"به گروه خوش آمدید "
    ]);
}
  
  
  
  
  
  
  
$txxt = file_get_contents('member.txt');
    $pmembersid= explode("\n",$txxt);
    if (!in_array($chat_id,$pmembersid)){
      $aaddd = file_get_contents('member.txt');
      $aaddd .= $chat_id."\n";
      file_put_contents('member.txt',$aaddd);
    }
  }
