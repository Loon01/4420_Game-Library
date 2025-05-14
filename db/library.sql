-- 1st: When running this sql, do "sqlite3 library.db < library.sql"
-- 2nd: Then run "sqlite3 library.db < data.sql"
-- Alt: OR just run "sqlite3 library.db ".read library.sql" ".read data.sql" in one line

-- Then: In command line, do "litecli library.db"
-- To exit litecli, do "exit"

-- Turn Foreign Keys on
PRAGMA foreign_key = ON;

-- Drops table at start up
DROP TABLE IF EXISTS Game;
DROP TABLE IF EXISTS Genre;
DROP TABLE IF EXISTS Developer;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Owns;
DROP TABLE IF EXISTS Wants;

-- Game Table
CREATE TABLE Game (
    game_id INTEGER PRIMARY KEY,
    g_name VARCHAR(255),
    description TEXT
);

-- Genres Table (Multivalue attribute from Game)
CREATE TABLE Genre (
    game_id INTEGER,
    genre VARCHAR(50) NOT NULL,
    PRIMARY KEY (game_id, genre),
    FOREIGN KEY (game_id) REFERENCES Game(game_id)  
);

-- Dev Table (Multivalue attribute from Game)
CREATE TABLE Developer (
    game_id INTEGER,
    developer VARCHAR(255) NOT NULL,
    PRIMARY KEY (game_id, developer),
    FOREIGN KEY (game_id) REFERENCES Game(game_id)  
);

-- User Table
CREATE TABLE User (
    uid INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255),
    password VARCHAR(255) --Maybe need to hash the passwords for security reasons
);

-- Owns Table
CREATE TABLE Owns (
    game_id INTEGER NOT NULL,
    uid INTEGER NOT NULL,
    date_bought DATE,
    date_last_played DATE,
    hours_played FLOAT,
    PRIMARY KEY (uid, game_id),
    FOREIGN KEY (game_id) REFERENCES Game(game_id),
    FOREIGN KEY (uid) REFERENCES User(uid)
);

-- Wants Table
CREATE TABLE Wants (
    game_id INTEGER NOT NULL,
    uid INTEGER NOT NULL,
    PRIMARY KEY (game_id, uid),
    FOREIGN KEY (game_id) REFERENCES Game(game_id),
    FOREIGN KEY (uid) REFERENCES User(uid)
);

-- Turn Foreign Keys off
PRAGMA foreign_key = OFF;