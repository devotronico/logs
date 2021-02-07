<?php
header('Content-type: application/json');



die(json_encode(['test'=> 'OK 1']));


// $dir = ".git/logs/refs/heads";
// $dir = ".git/refs/heads/master";
$dir = ".git/logs/refs/heads";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\COMMIT_EDITMSG";
// $dir = "/path/to/your/repo/";

// if (!is_dir($dir)) {
//     echo "La cartella $dir NON esiste";
// } else {
//     echo "La cartella $dir esiste";
// }
// echo '<br>';

$output = array();
chdir($dir);
exec("git log",$output);
$history = array();

function parseLog($log) {
    $history = array();
    foreach($log as $key => $line) {
        if(strpos($line, 'commit') === 0 || $key + 1 == count($log)) {
            $commit['hash'] = substr($line, strlen('commit') + 1);
        } else if(strpos($line, 'Author') === 0){
            $commit['author'] = substr($line, strlen('Author:') + 1);
        } else if(strpos($line, 'Date') === 0){
            $commit['date'] = substr($line, strlen('Date:') + 3);
        } elseif (strpos($line, 'Merge') === 0) {
            $commit['merge'] = substr($line, strlen('Merge:') + 1);
            $commit['merge'] = explode(' ', $commit['merge']);
        } else if(!empty($line)){
            $commit['message'] = substr($line, 4);
            array_push($history, $commit);
            unset($commit);
        }
    }
    return $history;
}


$history = parseLog($output);
die(json_encode($history));


// echo '<pre>';
// print_r($history);
// echo '</pre>';


// foreach ($history as $key => $arr) {
//     echo '<div>';
//     foreach ($arr as $k => $value) {
//         echo '<p><span>' . $k . ': </span><span>' . $value . '</span></p>';
//     }
//     echo '</div>';
//     echo '<hr>';
// }



