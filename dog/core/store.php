<?php
  //直接のページ遷移を阻止
  $request = isset($_SERVER['HTTP_X_REQUESTED_WITH']) ? strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) : '';
  if($request !== 'xmlhttprequest') exit;
  //DBへの接続
  //本来は db_connect関数 を作成して、DRYにした方が良いです。
  try {
    $dsn = 'mysql:host=localhost;dbname=wanwan;charset=utf8';
    $user = 'root';
    $pass = 'root';
    $pdo = new PDO($dsn, $user, $pass, array(PDO::ATTR_EMULATE_PREPARES => false));
  }
  catch (Exception $e) {
    exit('データベース接続失敗'.$e->getMessage());
  }
  //Ajaxで渡ってきた値をもとに modelテーブル から該当する model を抽出
  $maker_no = $_POST['maker_no'];
  $sql = 'SELECT dog_name FROM dog_books WHERE dog_janru_id = :dog_janru_id';
  $stmt=$pdo->prepare($sql);
  $stmt->bindValue(':dog_janru_id', (int)$maker_no, PDO::PARAM_INT);
  $stmt->execute();

  //抽出された値を $model_list配列 に格納
  $model_list = array();
  while($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
    $model_list[$row['id']] = $row['name'];
  }
  header('Content-Type: application/json');
  //json形式で index.php へバックする
  echo json_encode($model_list);
 ?>