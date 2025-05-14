<?php

require_once("../web-page/config.php");

$path = 'fullGameData.json';
$jsonString = file_get_contents($path);
$jsonData = json_decode($jsonString, true);


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
    
}

?>

