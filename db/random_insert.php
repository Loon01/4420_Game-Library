<?php
require_once("../web-page/config.php");

function insertRandom_Wants($pdo, $numEntries) {
    // Getting all game ids from Game
    $gameStmt = $pdo->query("SELECT game_id FROM Game");
    $gameIDs = $gameStmt->fetchAll(PDO::FETCH_COLUMN);

    // Getting all user ids from User
    $userStmt = $pdo->query("SELECT uid FROM User");
    $userIDs = $userStmt->fetchAll(PDO::FETCH_COLUMN);

    // Preparing for queries
    $insertWants = $pdo->prepare("INSERT INTO Wants (game_id, uid) VALUES (?, ?)");
    $checkOwns = $pdo->prepare("SELECT 1 FROM Owns WHERE game_id = ? AND uid = ?"); // Checking if the row exists in the Owns table in case of duplicate
    $checkWants = $pdo->prepare("SELECT 1 FROM Wants WHERE game_id = ? AND uid = ?"); // Checking if the row exists in the Wants table in case of duplicate

    $insertedCount = 0;
    $attempts = 0;

    while ($insertedCount < $numEntries && $attempts < $numEntries * 10) { // numeEntries * 10 is to keep it from infinitely looping
        $randomGameID = $gameIDs[array_rand($gameIDs)];
        $randomUID = $userIDs[array_rand($userIDs)];
        $attempts++;

        // Skip if already owned
        $checkOwns->execute([$randomGameID, $randomUID]);
        if ($checkOwns->fetch()) { // If a row is returned, user already owns the game so skip
            continue; // Skips the iteration
        }

        // Skip if already wanted
        $checkWants->execute([$randomGameID, $randomUID]);
        if ($checkWants->fetch()) { // If a row is returned, user already wants the game so skip
            continue; // Skips the iteration
        }

        // Insert into Wants
        $insertWants->execute([$randomGameID, $randomUID]);
        $insertedCount++;
    }

    echo "Inserted $insertedCount random entries into 'Wants'.\n";
}

function insertRandom_Owns($pdo, $numEntries) {
    // Getting all game ids from Game
    $gameStmt = $pdo->query("SELECT game_id FROM Game");
    $gameIDs = $gameStmt->fetchAll(PDO::FETCH_COLUMN);

    // Getting all user ids from User
    $userStmt = $pdo->query("SELECT uid FROM User");
    $userIDs = $userStmt->fetchAll(PDO::FETCH_COLUMN);

    // Preparing for the insert query
    $insertOwns = $pdo->prepare("INSERT INTO Owns (game_id, uid) VALUES (?, ?)");

    // For random data
    for ($i = 0; $i < $numEntries; $i++) {
        $randomGameID = $gameIDs[array_rand($gameIDs)];
        $randomUID = $userIDs[array_rand($userIDs)];

        // Executing query
        $insertOwns->execute([$randomGameID, $randomUID]);
    }
    
    echo "Inserted $numEntries random entries into 'Owns'.\n";
}

echo "If random values from Owns are not inserted, check attributes that have NOT NULL.\n";
insertRandom_Owns($pdo, 10000); // Inserts random entries to Owns based on number, for now
insertRandom_Wants($pdo, 10000); // Inserts random entries to Wants based on number, for now

/*
function Random($pdo, $numEntries = 100) {
    // Getting all game ids from Game
    $gameStmt = $pdo->query("SELECT game_id FROM Game");
    $gameIDs = $gameStmt->fetchAll(PDO::FETCH_COLUMN);

    // Getting all user ids from User
    $userStmt = $pdo->query("SELECT uid FROM User");
    $userIDs = $userStmt->fetchAll(PDO::FETCH_COLUMN);

    // Preparing for the insert query
    $insertWants = $pdo->prepare("INSERT INTO Wants (game_id, uid) VALUES (?, ?)");

    // For random data
    for ($i = 0; $i < $numEntries; $i++) {
        $randomGameID = $gameIDs[array_rand($gameIDs)];
        $randomUID = $userIDs[array_rand($userIDs)];

        // Executing query
        $insertWants->execute([$randomGameID, $randomUID]);
    }
    
    echo "Inserted $numEntries random entries into 'Wants'.\n";
}

Random($pdo, 100); // Inserts 100 random entries
*/
?>