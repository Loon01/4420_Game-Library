<?php

require_once("../web-page/config.php");

$path = 'fullGameData.json';
$jsonString = file_get_contents($path);
$jsonData = json_decode($jsonString, true);


//$password = '1234567890';
//$insStatement = $pdo->query("UPDATE User SET password = $password WHERE name = 'attilary'");
// $i = 1;
// $allUsers = $pdo->query("SELECT COUNT(*) FROM User");
// $res = $allUsers->fetch(PDO::FETCH_ASSOC);
// $num = $res['COUNT(*)'];
// echo $num . "\n";
// while ($i <= $num ) {
//     $statement = $pdo->query("SELECT * FROM User WHERE uid = $i");
//     $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
//     //echo "<pre>";
//     $item = $rows[0];
//     $id = $item['uid'];
//     $userName = $item['name'];
//     $pass = $item['password'];
//     echo $id . ' : ' . $userName . ' , ' . $pass . "\n";

//     $i++;
// }
//echo "</pre>";

$insertGame = $pdo->prepare("INSERT INTO Game (game_id, g_name, description) VALUES (?, ?, ?)");
$insertGenre = $pdo->prepare("INSERT INTO Genre (game_id, genre) VALUES (?, ?)");
$insertDeveloper = $pdo->prepare("INSERT INTO Developer (game_id, developer) VALUES (?, ?)");

foreach($jsonData as $game)
{
    $gID = $game['id'];
    $gName = $game['name'];
    $gSummary = !empty($game['summary']) ? $game['summary'] : 'No summary';

    $insertGame->execute([$gID, $gName, $gSummary]);
    
    echo $gID . ': ' . $game['name'] . "\n";
    if(empty($game['genres']))
    {
        //echo 'No genres';
        $insertGenre->execute([$gID, 'No genres']);
    }
    else {
        foreach($game['genres'] as $genre)
        {
            //echo $genre['name'] . ' ';
            $insertGenre->execute([$gID, $genre['name']]);
        }
    }
    //echo ' || ';
    if(empty($game['involved_companies'])) {
        // echo 'No devs';
        $insertDeveloper->execute([$gID, 'No devs']);
    }
    else
    {
        foreach($game['involved_companies'] as $companies)
        {
            // The company name is within the company object
            //$c = $companies['company'];
            //echo $c['name'] . ' ';
            if (isset($companies['company']['name'])) {
                $insertDeveloper->execute([$gID, $companies['company']['name']]);
            }
        } 
    }
    //echo "\n";
    /*
    if(empty($game['summary'])) {
        echo "\n";
        echo 'No summary';
    }
    else {
        echo "\n";
        echo $game['summary']; 
    }
        */
    //echo "\n\n";
}
//var_dump($jsonData);
?>

