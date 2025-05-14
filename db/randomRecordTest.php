<?php

require_once("../web-page/config.php");

// Get max index value for random picking
$gameNum = $pdo->query("SELECT COUNT(*) AS Total from Game");
$gRes = $gameNum->fetch(PDO::FETCH_ASSOC);
$gameTotal = $gRes["Total"];

$gameStmt = $pdo->query("SELECT game_id FROM Game");
$gameData = $gameStmt->fetchAll(PDO::FETCH_ASSOC);

$userNum = $pdo->query("SELECT COUNT(*) AS Total from User");
$uRes = $userNum->fetch(PDO::FETCH_ASSOC);
$userTotal = $uRes["Total"];

$userStmt = $pdo->query("SELECT uid FROM User");
$userData = $userStmt->fetchAll(PDO::FETCH_ASSOC);

$gIndex = rand(0, $gameTotal);
$uIndex = rand(0, $userTotal);

$gItem = $gameData[$gIndex];
$uItem = $userData[$uIndex];

//echo $index . ': ' . $item['game_id'] . ' | ' . $item['name'] . "\n";
//echo $gIndex . ': ' . $gItem['game_id'] . "\n";
//echo $uIndex . ': ' . $uItem['uid'] . "\n";

// Preparing for queries
$insertWants = $pdo->prepare("INSERT INTO Wants (game_id, uid) VALUES (?, ?)");
$insertOwns = $pdo->prepare("INSERT INTO Owns (game_id, uid) VALUES (?, ?)");
$checkOwns = $pdo->prepare("SELECT 1 FROM Owns WHERE game_id = ? AND uid = ?"); // Checking if the row exists in the Owns table in case of duplicate
$checkWants = $pdo->prepare("SELECT 1 FROM Wants WHERE game_id = ? AND uid = ?"); // Checking if the row exists in the Wants table in case of duplicate

// Max number of games a user will own
$max = 500;

foreach ($userData as $user) {
    //echo 'ID: ' . $user['uid'] . ' : ';
    $userID = $user['uid'];
    
    // Loop to add to Owns
    $i = 0;
    $fail_i = 0;
    while ($i < $max) {
        $rGIndex = rand(0, $gameTotal);
        $gID = $gameData[$rGIndex]['game_id'];

        $x = 0;
        // Skip if already owned
        $checkOwns->execute([$gID, $userID]);
        if ($checkOwns->fetch()) { // If a row is returned, user already owns the game so skip
            $x = 1; // Skips the iteration
        }

        // Skip if already wanted
        $checkWants->execute([$gID, $userID]);
        if ($checkWants->fetch()) { // If a row is returned, user already wants the game so skip
            $x = 1; // Skips the iteration
        }
        echo $gID . ' | ';

        if ($x == 0) {
            // Insert into Owns
            $insertOwns->execute([$gID, $userID]);
            echo 'Owns insert: ' . $gID . ' | ' . $userID . "\n";
            $i += 1;
        } else {
            $fail_i += 1;
        }

        // To make sure one $i iteration doesn't get stuck in a loop
        if ($fail_i == 20) {
            echo 'Skip iteration' . $i . "\n";
            $fail_i = 0;
            $i += 1;
        }
    }

    $j = 0;
    $fail_j = 0;
    while ($j < $max) {
        $rGIndex = rand(0, $gameTotal);
        $gID = $gameData[$rGIndex]['game_id'];

        $x = 0;
        // Skip if already owned
        $checkOwns->execute([$gID, $userID]);
        if ($checkOwns->fetch()) { // If a row is returned, user already owns the game so skip
            $x = 1; // Skips the iteration
        }

        // Skip if already wanted
        $checkWants->execute([$gID, $userID]);
        if ($checkWants->fetch()) { // If a row is returned, user already wants the game so skip
            $x = 1; // Skips the iteration
        }
        echo $gID . ' | ';

        if ($x == 0) {
            // Insert into Wants
            $insertWants->execute([$gID, $userID]);
            echo 'Wants insert: ' . $gID . ' | ' . $userID . "\n";
            $j += 1;
        } else {
            $fail_j += 1;
        }

        // To make sure one $i iteration doesn't get stuck in a loop
        if ($fail_j == 20) {
            echo 'Skip iteration: ' . $j . "\n";
            $fail_j = 0;
            $j += 1;
        }
    }
    //echo "\n";
}
//$i = 0;
//$a = 0;
// while ($i < $val && $a == 0) {
//     $item = $rows[$i];
//     $check = $i + 1;
//     if ($check != $item['game_id']) {
//         echo $i . ' | ID: '. $item['game_id'] . "\n";
//         $a++;
//     }
//     $i++;
// }

?>