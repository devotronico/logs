<?php
// Author: Ngo Minh Nam

// $dir = "/.git/logs/";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\logs\refs\heads\master";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\logs\HEAD";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\objects";
// $dir = "C:\xampp_8\htdocs\workspace\CHANGELOG\.git\index";
// $dir = ".git/COMMIT_EDITMSG";

// $dir = ".git";
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
foreach($output as $line){
    if(strpos($line, 'commit') === 0){
        echo '1 <br>';
        if(!empty($commit)){
            array_push($history, $commit);
            unset($commit);
        }
        $commit['hash'] = substr($line, strlen('commit'));
    } else if(strpos($line, 'Author')===0){
        echo '2 <br>';
	    $commit['author'] = substr($line, strlen('Author:'));
    } else if(strpos($line, 'Date')===0){
        echo '3 <br>';
	    $commit['date']   = substr($line, strlen('Date:'));
    } else{
        echo '4 <br>';
	    // $commit['message']  .= $line;
    }
}

print_r($history);

?>