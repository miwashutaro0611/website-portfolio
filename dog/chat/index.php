<?php
  $myid = $_GET["chatme"];
  $friendid = $_GET["chatyou"];
  //チャットする人の情報を取得する
  require_once("../core/chat_user.php");
  //入室する前のチャット情報を取得する
  require_once("../core/chat_content.php");
?>

<!DOCTYPE html>
<html>
<head>
  <!-- php -q /Applications/MAMP/ -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/chat.css" type="text/css" />
</head>
<body>
<?php
$colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
$user_colour = array_rand($colours);
$chattext = "aaa";
?>


<script src="jquery-3.1.1.js"></script>


<script language="javascript" type="text/javascript">
$(document).ready(function(){
	//create a new WebSocket object.
	var wsUri = "ws://localhost:9000/hew/chat/server.php";
	websocket = new WebSocket(wsUri);

	websocket.onopen = function(ev) { // connection is open
    //websocketが接続できた時の処理
		// $('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
	}
  //送信するのボタンがクリックされたときの処理
	$('#send-btn').click(function(){ //use clicks message send button
      //alert("aa");
  		var mymessage = $('#message').val(); //get message text
  		//ユーザ名(ユーザid)の情報を取得
      var myname = $('#name').val(); //get user name
      var friname = $('#friend').val(); //get friendname
  		// if(myname == ""){ //empty name?
  		// 	alert("Enter your Name please!");
  		// 	return;
  		// }
  		if(mymessage == ""){ //emtpy message?
  			alert("未入力です！！");
  			return;
  		}
        var printaa = '<?php echo $chattext ?>';
        //var printaa = mymessage;
        //alert($printbb);
        //データを送るための処理
        $.ajax({
            url: "http://localhost:1024/hew/core/chat_insert.php?msg="+mymessage+"&my="+myname+"&you="+friname+"",
            type: "post",
            // data: "item1 = subject & item2 = content",
            dataType: "html"
        }).done(function (response) {
            // $("#tag").html(response);
            // alert("success");
        }).fail(function () {
            // alert("failed");
        });

    		document.getElementById("name").style.visibility = "hidden";

    		var objDiv = document.getElementById("message_box");
    		objDiv.scrollTop = objDiv.scrollHeight;
    		//prepare json data
    		var msg = {
    		message: mymessage,
    		name: myname,
        friend: friname
    		// color : '<?php echo $colours[$user_colour]; ?>'
    		};
    		//convert and send data to server
    		websocket.send(JSON.stringify(msg));
	});

	//#### Message received from server?
	websocket.onmessage = function(ev) {
		var msg = JSON.parse(ev.data); //PHP sends Json data
		var type = msg.type; //message type
		var umsg = msg.message; //文章のテキスト
		var uname = msg.name; //ユーザ名(ユーザid)の情報
    var fname = msg.friend; //フレンド名(フレンドid)の情報
		// var ucolor = msg.color; //文字色
    var who;//チャットの人を判定するためのもの
    /*ここからjqueryでのget関数取得*/
    var url   = location.href;
        parameters    = url.split("?");
        params   = parameters[1].split("&");
        var paramsArray = [];
        for ( i = 0; i < params.length; i++ ) {
            neet = params[i].split("=");
            paramsArray.push(neet[0]);
            paramsArray[neet[0]] = neet[1];
        }
        var categoryKey = paramsArray["chatme"];
        //alert(categoryKey);
        if(categoryKey == uname){
          who = "myBalloon";
        }else{
          who = "yourBalloon";
        }
    /*ここまでjqueryでのget関数取得*/
		// if(type == 'usermsg')
    var mycheck = "<?php echo $myid ?>";
    var fricheck = "<?php echo $friendid ?>";
    if(uname == mycheck || fname == mycheck){
       if(uname == fricheck || fname == fricheck){
			  //  $('#message_box').append("<div class=\""+who+"\"><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
        $('#message_box').append("<div class=\""+who+"\"><span class=\"user_message\">"+umsg+"</span></div>");
		   }
    }

		if(type == 'system')
		{
			$('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
		}

		$('#message').val(''); //reset text

		var objDiv = document.getElementById("message_box");
		objDiv.scrollTop = objDiv.scrollHeight;
	};

	websocket.onerror	= function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");};
	websocket.onclose 	= function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");};
});

</script>
<div class="chat_wrapper">
<div class="chat_user_name">
  <table>
    <tbody>
      <tr>
        <td class="image"><img src="../img/user_img/<?=$image?>" alt=""></td>
        <td class="name"><?=$friend_first_name?><?=$friend_second_name?> さん</td>
      </tr>
    </tbody>
  </table>
</div>
<div class="message_box" id="message_box">
  <?php
  if(isset($CHATTEXT)){
    for($i=0;$i<count($CHATTEXT);$i++){
  ?>
      <div class="<?=$BALLOON[$i]?>"><span class=user_message><?=$CHATTEXT[$i]?></span></div>
      <div class="<?=$TIME[$i]?>"><?=$TIMESTMP[$i]?></div>
  <?php
    }
  }
  ?>
</div>
<div class="panel">
  <!-- <input type="text" name="name" id="name" placeholder="Your Name" maxlength="15" /> -->
  <input type="hidden" name="name" id="name" value="<?=$myid?>" />
  <input type="hidden" name="friend" id="friend" value="<?=$friendid?>" />
  <input type="text" name="message" id="message" placeholder="Message" maxlength="80" onkeydown = "if (event.keyCode == 13)document.getElementById('send-btn').click()"  />

</div>

<button id="send-btn" class="button" name="send-btn" >送信</button>

</div>

</body>
</html>
