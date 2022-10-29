<?php

//データベース接続
$username = "udemy_user";
$password = "udemy_pass";
$hostname = "db";
$db = "udemy_db";
$pdo = new PDO("mysql:host={$hostname};dbname={$db};charset=utf8", $username, $password);

//社員情報取得SQLの実行
$sql = "SELECT * FROM users ORDER BY id";
$stmt = $pdo->prepare($sql);
$stmt->execute();

//SQL結果を１行ずつ読込、終端まで繰り返し
$outputData = [];
$dataCount = 0;
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
  //出力データの作成
  $outputData[$dataCount]["id"] = $row["id"];
  $outputData[$dataCount]["name"] = $row["name"];
  $outputData[$dataCount]["name_kana"] = $row["name_kana"];
  $outputData[$dataCount]["birthday"] = $row["birthday"];
  $outputData[$dataCount]["gender"] = $row["gender"];
  $outputData[$dataCount]["organaization"] = $row["organization"];
  $outputData[$dataCount]["post"] = $row["post"];
  $outputData[$dataCount]["start_date"] = $row["start_date"];
  $outputData[$dataCount]["tel"] = $row["tel"];
  $outputData[$dataCount]["mail_address"] = $row["mail_address"];
  $outputData[$dataCount]["created"] = $row["created"];
  $outputData[$dataCount]["updated"] = $row["updated"];
  $dataCount++;
}

//出力ファイルオープン
$fpOut = fopen(__DIR__ . "/export_users.csv", "w");

//ヘッダー行書き込み
$header = [
  "社員番号",
  "社員名",
  "社員名カナ",
  "生年月日",
  "性別",
  "所属部署",
  "役職",
  "入社年月日",
  "電話番号",
  "メールアドレス",
  "作成日時",
  "更新日時",
];
fputcsv($fpOut, $header);

//出力データ数分繰り返し
foreach ($outputData as $data) {
  fputcsv($fpOut, $data);
}

//出力ファイル
fclose($fpOut);
