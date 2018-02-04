<?php
$pass2=$_POST["pass2"];
//編集ボタンを押した場合
if(isset($_POST['edit'])){
// 編集対象番号を受信
$number1=$_POST["hensyuu"];
//2-2のテキストファイルをfileで配列化して読み込み、配列の数だけループさせる
$filename=file("mission_2-2.txt");
foreach($filename as $line){ 
//dループの中でexplodeを使って投稿番号を取得する
	$data=explode("<>",$line);
	$data4=$data[4];
	if($data[0]==$number1 and $data4==$pass2){
	//$number1と同じ時にカッコ内を処理
		$data0 = $data[0];
		$data1 = $data[1];
		$data2 = $data[2];
		$data3 = $data[3];
		}else{
	echo "パスワードを入力しなおしてください";//パスワードが違った場合
	}
}
}
?>

<html>
<meta charset="utf-8">
<form action="mission_2-2.php" method="post"><p>
編集用フォーム
</p>
<input type="hidden" name="edit_num" value="<?php echo $data0;?>">
名前：<input type="text" name="name" size="40" value="<?php echo $data1;?>">
<p>
コメント：
</p>
<p>
<textarea name="コメント" cols="50" rows="5"><?php echo $data2;?></textarea>
</p>
<p>
<input type="submit" name="edit2" value="書き換え"><input type="reset" value="リセット">
</p>
</form>
</html>

