<?php
// Author: Ngo Minh Nam

// $dir = "/.git/logs/";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\logs\refs\heads\master";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\logs\HEAD";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\objects";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\index";
// $dir = ".git/COMMIT_EDITMSG";

// $dir = ".git";
// $dir = ".git/logs/refs/heads";
// $dir = ".git/refs/heads/master";
$dir = ".git/logs/refs/heads";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\COMMIT_EDITMSG";
// $dir = "/path/to/your/repo/";

if (!is_dir($dir)) {
    echo "La cartella $dir NON esiste";
} else {
    echo "La cartella $dir esiste";
}
echo '<br>';
// if (file_exists($dir)) {
//     echo "The file $dir exists";
// } else {
//     echo "The file $dir does not exist";
// }

$output = array();
chdir($dir);
exec("git log",$output);
$history = array();
$commit = [
    'hash' => '',
    'author' => '',
    'date' => '',
    'message' => ''
];



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


echo '<pre>';
print_r($history);
echo '</pre>';


foreach ($history as $key => $arr) {
    echo '<div>';
    foreach ($arr as $k => $value) {
        echo '<p><span>' . $k . ': </span><span>' . $value . '</span></p>';
    }
    echo '</div>';
    echo '<hr>';
}



// print_r($history);

?>