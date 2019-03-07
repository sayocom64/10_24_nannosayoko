<?php
$score = $_POST['score'];
$url_raty = $_POST['url_raty'];
$raty = 'score:' . $score . ',url:' . $url_raty . "\n";
 
$fp = fopen("sample.txt", "a");
fwrite($fp, $raty);
fclose($fp);
?>