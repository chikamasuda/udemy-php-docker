<?php

//csvファイルのオープンとクローズ
//$fp = fopen("開きたいファイル", "モード"); //モード: r:読込, w：書込, a:追記書込
//while ($data = fgetcsv($fp)) {
//  何かしら処理
//}
//fclose($fp);

//社員情報csvオープン
$fp = fopen(__DIR__ . "/input.csv", "r");

//ファイルを1行ずつ読込、終端まで繰り返し
$lineCount = 0;
$manCount = 0;
$womanCount = 0;
while ($data = fgetcsv($fp)) {
  $lineCount++;
  //1行目？
  if ($lineCount === 1) {
    //次の行へすすむ
    continue;
  }

  if ($data[4] === "男性") {
    $manCount++;
  } else {
    $womanCount++;
  }
}

//社員情報csvクローズ
fclose($fp);

//debug
echo "${manCount}, ${womanCount}";

//出力ファイルオープン
$fpOut = fopen(__DIR__ . "/output.csv", "w");

//ヘッダー行書き込み
$header = ["男性", "女性"];
fputcsv($fpOut, $header);

//男性人数、女性人数書き込み
$outputData = [$manCount, $womanCount];
fputcsv($fpOut, $outputData);

//出力ファイルクローズ
fclose($fpOut);
