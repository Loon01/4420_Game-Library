<?php

require_once("../web-page/config.php");

// Get max index value for random picking
$gameNum = $pdo->query("SELECT COUNT(*) AS Total from Game");
$gRes = $gameNum->fetch(PDO::FETCH_ASSOC);
$gameTotal = $gRes["Total"];

// Get game_id from table for insertions
$gameStmt = $pdo->query("SELECT game_id FROM Game");
$gameData = $gameStmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch uid from User Table
$userStmt = $pdo->query("SELECT uid FROM User");
$userData = $userStmt->fetchAll(PDO::FETCH_ASSOC);

// Preparing for queries
$insertWants = $pdo->prepare("INSERT INTO Wants (game_id, uid) VALUES (?, ?)");
$insertOwns = $pdo->prepare("INSERT INTO Owns (game_id, uid, date_bought, date_last_played, hours_played) VALUES (?, ?, ?, ?, ?)");
$checkOwns = $pdo->prepare("SELECT 1 FROM Owns WHERE game_id = ? AND uid = ?"); // Checking if the row exists in the Owns table in case of duplicate
$checkWants = $pdo->prepare("SELECT 1 FROM Wants WHERE game_id = ? AND uid = ?"); // Checking if the row exists in the Wants table in case of duplicate

// Max number of games a user will own
$max = 1000;

foreach ($userData as $user) {
    $userID = $user['uid'];
    
    // Loop to add to Owns
    $i = 0; // Counter to add 1000 games
    $fail_i = 0; // Counter for failed attempts, so that it isn't stuck on one iteration of $i
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
            $rDateY = rand(2000, 2024);
            $rDateM = rand(1, 12);
            $rDateD = 0;

            // Just to make a calculate where the result is 0 to 3
            // If equal to 0, it is a leap year
            $y = $rDateY % 4;
            

            if ($rDateM == 2){
                if($y == 0)
                    $rDateD = rand(1, 29); // Leap year for February
                else
                    $rDateD = rand(1, 28);
            } else if($rDateM == 1 || $rDateM == 3 || $rDateM == 5 || $rDateM == 7 || $rDateM == 8 || $rDateM == 10 || $rDateM == 12){
                $rDateD = rand(1, 31);
            } else {
            $rDateD = rand(1, 30); 
            }
            
            $date = "$rDateY-$rDateM-$rDateD";
            $date1 = date_create($date);

            $new_rDateY = rand($rDateY, 2024);
            $x = $rDateY % 4;
            
            $new_rDateM = 0;
            $new_rDateD = 0;

            if($new_rDateY == $rDateY) {
                $new_rDateM = rand($rDateM, 12);
                
                if($new_rDateM == $rDateM) {
                    if ($new_rDateM == 2){
                        if($x == 0)
                            $new_rDateD = rand($rDateD, 29);
                        else
                            $new_rDateD = rand($rDateD, 28);
                    } else if($new_rDateM == 1 || $new_rDateM == 3 || $new_rDateM == 5 || $new_rDateM == 7 || $new_rDateM == 8 || $new_rDateM == 10 || $new_rDateM == 12){
                        $new_rDateD = rand($rDateD, 31);
                    } else {
                        $new_rDateD = rand($rDateD, 30); 
                    }
                } else {
                    if ($new_rDateM == 2){
                        if($x == 0)
                            $new_rDateD = rand(1, 29);
                        else
                            $new_rDateD = rand(1, 28);
                    } else if($new_rDateM == 1 || $new_rDateM == 3 || $new_rDateM == 5 || $new_rDateM == 7 || $new_rDateM == 8 || $new_rDateM == 10 || $new_rDateM == 12){
                        $new_rDateD = rand(1, 31);
                    } else {
                        $new_rDateD = rand(1, 30); 
                    }
                }
            }
            else {
                $new_rDateM = rand(1, 12);
                if ($new_rDateM == 2){
                    if($x == 0)
                        $new_rDateD = rand(1, 29);
                    else
                        $new_rDateD = rand(1, 28);
                } else if($new_rDateM == 1 || $new_rDateM == 3 || $new_rDateM == 5 || $new_rDateM == 7 || $new_rDateM == 8 || $new_rDateM == 10 || $new_rDateM == 12){
                    $new_rDateD = rand(1, 31);
                } else {
                    $new_rDateD = rand(1, 30); 
                }
            }
            
            $newDate = "$new_rDateY-$new_rDateM-$new_rDateD";
            $date2 = date_create($newDate);
            
            $diff = date_diff($date1,$date2);
            $days = $diff->format("%a") + 1;
            

            // 2 hours a day max if you rHours uses the maxHours
            $maxHours = $days / 2;
            $rHours = rand(1, $maxHours);
            
            
            // Insert into Owns           
            $insertOwns->execute([$gID, $userID, $date, $newDate, $rHours]);
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
    
}

?>