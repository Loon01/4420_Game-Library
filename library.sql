-- When running this sql, do "sqlite3 library.db < library.sql"
-- Then: In command line, do "litecli library.db"
-- To exit litecli, do "exit"

PRAGMA foreign_key = ON;

DROP TABLE IF EXISTS Game;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Owns;

--Game Table
CREATE TABLE Game (
    game_id INTEGER PRIMARY KEY AUTOINCREMENT,
    g_name VARCHAR(255),
    genre VARCHAR(255),
    release_date INTEGER,
    developer VARCHAR(255),
    description TEXT
);

INSERT INTO Game (g_name, genre, release_date, developer, description) 
VALUES ('COD', 'shooter', 2026, 'Activision', 'pew-pew');

INSERT INTO Game (g_name, genre, release_date, developer, description) 
VALUES ('APEX', 'shooter', 2018, 'Respawn', 'pew-pew');


--User Table
CREATE TABLE User (
    uid INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255),
    password VARCHAR(255) --Maybe need to hash the passwords for security reasons
);

INSERT INTO User (name, password) 
VALUES ('username', 'password');

--Owns Table
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

INSERT INTO Owns (game_id, uid, date_bought, date_last_played, hours_played)
VALUES (2, 1, "2018-11-14", "2025-04-04", 2.5);

PRAGMA foreign_key = OFF;

-- Example of inserting to table
--INSERT INTO Table (attribute1, attribute2, ...) 
--  VALUES (value1, value2,....);