<?php 
//送信ボタンを押した場合
if(isset($_POST['new'])) {
$filename='mission_2-2.txt';
$fp=fopen($filename,'a');
$name=$_POST["name"];
$コメント=$_POST["コメント"];
$date=date("Y/m/d H:i:s");
$pass=$_POST["pass"];
$count = count( file( $filename ) )+1;
fwrite($fp,$count."<>". $name."<>".$コメント."<>".$date."<>".$pass."<>"."\n");
fclose($fp);
}


	
//削除ボタンを押した場合
$pass1=$_POST["pass1"];//削除フォームで受信したパスワード
if(isset($_POST['delete'])){
	$number=$_POST["sakuzyo"];//受信した削除対象番号
	$filedata = file("mission_2-2.txt"); //一行ずつ配列
	for($i=0;$i<count($filedata);$i++){ //配列から１つずつ取り出す
		$data=explode("<>", $filedata[$i]);//＜＞で切って配列に
		$data4=$data[4];
		if($data4==$pass1 && $data[0]==$number){
			array_splice($filedata,$i,1);
			$fp=fopen("mission_2-2.txt","w");
			foreach($filedata as $line){
				fwrite($fp,$line);
			}
			fclose($fp);
		}else{
			echo"パスワードまたは指定番号が間違っています。";
		}
		}
	
}
	
?>



<html>
<meta charset="utf-8">

<title>プログラミングブログ</title>

プログラミングブログ

<form action="mission_2-2.php" method="post">
<p>
名前：<input type="text" name="name" size="40">
</p>
<p>
コメント：
</p>
<p>
<textarea name="コメント" cols="50" rows="5"></textarea>
</p>
<p>
パスワード：<input type="password" name="pass">
</p>
<p>
<input type="submit" name="new" value="送信"><input type="reset" value="リセット">
</p>
</form>

<title>削除対象番号</title>
<!--2-1の入力フォームとは別に、削除番号指定用フォームを用意する。入力項目は「削除対象番号」-->
<!--POST送信にて削除番号を送信する。その際if文で削除フォームから値が送信された場合のみの処理に分岐させておく-->
<form action="mission_2-2.php" method="post">
<p>
削除対象番号：<input type="text" name="sakuzyo" size="40">
</p>
<p>
パスワード：<input type="password" name="pass1">
</p>
<p>
<input type="submit" name="delete" value="削除"><input type="reset" value="リセット">
</p>
</form>

<!--a編集番号指定用フォームを用意する。入力項目は「編集対象番号」-->
<!--bPOST送信にて編集番号を送信する。その際if文で編集フォームから値が送信された場合のみの処理に分岐させておく-->
<form action="mission_2-2-1.php" method="post">
<p>
編集対象番号：<input type="text" name="hensyuu" size="40">
</p>
<p>
パスワード：<input type="password" name="pass2">
</p>
<p>
<input type="submit" name="edit" value="編集"><input type="reset" value="リセット">
</p>
</html>



<?php
//編集内容の値が送信されたら、同じくc〜dの処理を行い、eと同じように番号の比較を行って、イコールの時に「配列値を取得する」のではなく「編集モード下で2-1のフォームから送信された値と差し替える」

if(isset($_POST['edit_num'])){
//入力データをphpで受け取り
	$edit_num=$_POST['edit_num'];
	$name=$_POST['name'];
	$comment=$_POST['コメント'];
	$date=date("Y/m/d H:i:s");
//1行ずつの配列
	$filename='mission_2-2.txt';
	$filedata=file($filename);
//内容を消して開く
	$fp=fopen('mission_2-2.txt','w');
//配列から1つずつ取り出す
	foreach($filedata as $line){  
//<>で切って配列にする
	$data=explode('<>',$line);
//投稿番号が編集番号と同じなら括弧の中の処理
	if($data[0]==$edit_num){
	$text=$edit_num."<>".$name."<>".$comment."<>".$date."\n";
//編集した1行をファイルに追記
	fwrite($fp,$text);
	}else{ //一致しない時は元のデータを書き込み
		fwrite($fp,$line);//元の1行をファイルに追記
	}
}
fclose($fp);//ファイルを閉じる
}
?>


<?php

//フォーム下に入力データを表示
$filename='mission_2-2.txt';
  // ファイルを全て配列に入れる
  $ret_array = file( $filename );
  // 読み込んで取得した配列を、配列の数（行数分）だけループさせる（繰り返し処理する）
  for( $i = 0; $i < count($ret_array); ++$i ) {
  //さらに記号「<>」で分割することでそれぞれの値を取得する(explodeを使う)
   $hairetsu=explode("<>",$ret_array[$i]);
    // 配列を順番に表示する
    echo( $hairetsu[0]." ".$hairetsu[1]." ".$hairetsu[2]." ".$hairetsu[3] . "<br />\n" );
  }
?>

<?php
//削除フォームの貼り付け1/31
// if($data4==$pass1){
	// $fp=fopen("mission_2-2.txt", 'w'); //内容を消して開く
//if($data[0]!=$number){//$numberと違う時にカッコ内を処理
	 	//fwrite($fp,$line);//ファイルに追記
		// echo"該当番号が見つかりません";//投稿番号と入力番号が一致しなかった場合
//}//$number1と同じ時は何もしない。
//fclose($fp);//ファイルを閉じる
//}else{
	//echo "パスワードを入力しなおしてください";//パスワードが違った場合
	//}	
?>


