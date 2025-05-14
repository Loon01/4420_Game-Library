<?php
// Check if there are any records in Wants that are in Owns
require_once("../web-page/config.php");

// Setup userID set and gameID
// $userStmt = $pdo->query("SELECT uid FROM User");
// $userData = $userStmt->fetchAll(PDO::FETCH_ASSOC);

$gameStmt = $pdo->query("SELECT game_id , uid FROM Owns");
$gameData = $gameStmt->fetchAll(PDO::FETCH_ASSOC);

//$amountGameStmt = $pdo->prepare("SELECT COUNT(*) as Total FROM Owns WHERE uid = ?");
//$ownsGameStmt = $pdo->prepare("SELECT game_id FROM Owns WHERE uid = ?");
$wantsGameStmt = $pdo->prepare("SELECT * FROM Wants WHERE uid = ?");
$count = 0;

foreach ($gameData as $gO) {
    //echo 'ID: ' . $user['uid'] . ' : ';
    $userID = $gO['uid'];
    $gameID = $gO['game_id'];
    
    $wantsGameStmt->execute([$userID]);
    $gWants = $wantsGameStmt->fetchAll();

    $i = 0;
    foreach($gWants as $gW) {
        if ($gW['game_id'] == $gameID) { // If a row is returned, user already owns the game so skip
            $i += 1;
        }
        if ($i != 0)
            break 1;
    }
    if ($i != 0) { // If a row is returned, user already owns the game so skip
        echo 'UserID: ' . $userID . ', GameID: ' . $gameID . ' || Integrity fail' . "\n";
        $count += 1;
    } else {
        echo 'UserID: ' . $userID . ', GameID: ' . $gameID . ' cleared' . "\n";
    }
}

echo $count . ' time(s) of integrity failure' . "\n";

?>