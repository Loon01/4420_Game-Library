-- 1st: When running this sql, do "sqlite3 library.db < library.sql"
-- 2nd: Then run "sqlite3 library.db < data.sql"
-- Alt: OR just run "sqlite3 library.db ".read library.sql" ".read data.sql" in one line

-- Then: In command line, do "litecli library.db"
-- To exit litecli, do "exit"

-- Turn Foreign Keys on
PRAGMA foreign_key = ON;

-- Drops table at start up
DROP TABLE IF EXISTS Game;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Developer;
DROP TABLE IF EXISTS Owns;

-- Game Table
CREATE TABLE Game (
    game_id INTEGER PRIMARY KEY AUTOINCREMENT,
    g_name VARCHAR(255),
    genre VARCHAR(255),
    release_date INTEGER,
    description TEXT
);

-- User Table
CREATE TABLE User (
    uid INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255),
    password VARCHAR(255) --Maybe need to hash the passwords for security reasons
);

-- Dev Table
CREATE TABLE Developer (
    dev_id INTEGER PRIMARY KEY AUTOINCREMENT,
    dev_name VARCHAR(255)
);

-- Owns Table
CREATE TABLE Owns (
    own_id INTEGER PRIMARY KEY AUTOINCREMENT,
    game_id INTEGER NOT NULL,
    uid INTEGER NOT NULL,
    date_bought DATE NOT NULL,
    date_last_played DATE NOT NULL,
    hours_played FLOAT,
    FOREIGN KEY (game_id) REFERENCES Game(game_id),
    FOREIGN KEY (uid) REFERENCES User(uid)
);

-- Turn Foreign Keys off
PRAGMA foreign_key = OFF;
