-- 1st: When running this sql, do: "sqlite3 library.db < library.sql"
-- 2nd: Then run: "sqlite3 library.db < data.sql"
-- Alt: OR just run: ' sqlite3 library.db ".read library.sql" ".read data.sql" ' in one line

-- Then: In command line, do "litecli library.db"
-- To exit litecli, do "exit"

--For Game Table
INSERT INTO Game (g_name, genre, release_date, description) 
VALUES ('COD', 'shooter', 2026, 'pew-pew');

INSERT INTO Game (g_name, genre, release_date, description) 
VALUES ('APEX', 'shooter', 2018, 'pew-pew');

--For User Table
INSERT INTO User (name, password) 
VALUES ('username', 'password');

--For Developer Table
INSERT INTO Developer (dev_name)
VALUES ('Activision');

INSERT INTO Developer (dev_name)
VALUES ('Respawn');

--For Owns Table
INSERT INTO Owns (game_id, uid, date_bought, date_last_played, hours_played)
VALUES (2, 1, "2018-11-14", "2025-04-04", 2.5);

-- Example of inserting to table
--INSERT INTO Table (attribute1, attribute2, ...) 
--  VALUES (value1, value2,....);