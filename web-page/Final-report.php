<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Final report</title>
</head>
<body>
    <?php include("nav.php"); ?>
    <div class="report">
        <?php include("sidebar.php"); ?>
        <h1>Final report</h1>

        <h3>Progress between Week 14 and Final</h3>

        <div class="text">
            <p>
                For our progress between the last check-in and now, we made small changes to
                one of our tables, like taking out <b>NOT NULL</b> from our <b>Owns</b> table
                to do some testing. Also, random insert function was made to randomly insert data 
                into one of our tables that has the game and user id attributes. Another function
                was made to just insert data into the <b>Wants</b> table just to have mock data from the
                
                <b>IGDB API</b> 
                <sup>
                    <a href="https://www.igdb.com/api">
                        <span>[</span>
                        1
                        <span>]</span>
                    </a>
                </sup>
                
                that we are using. Within the random function, it checks to see for duplicates,
                and it checks to see if the values in the <b>Wants</b> table already exists, and 
                it also checks to see if that same data is in the <b>Owns</b> table.
                 
            </p>
        </div>

        <div class="text">
            <p>
                Later on, another file was made to insert atleast one thousand data pairs to our
                <b>Owns</b> and <b>Wants</b> table. It does the same check while also inserting
                at least one thousand games into each user. To check if this script made any duplicates,
                another file was made to check this. It was more efficient than us doing it manually, the
                script takes around an hour to run but results in 0 integrity failures, as shown in this screenshot.

                <sup>
                    <a href="../images/integrity.png">
                        <span>[</span>
                        2
                        <span>]</span>
                    </a>
                </sup>

                Currently we are trying to make an index to reduce the time it takes for searches in our tables, however, in our
                school server (Artemis), it reads the tables differently. The way it reads it is already efficient and is a little
                difficult for us to optimize the search since the server is reading from a file which is already relatively fast, so
                making an index would only make a small change instead of a bigger one.
            </p>
        </div>
        
        <hr>

        <h3>Summary</h3>

        <div class="text">
            <p>
                Our final state of the project is a large database that includes games with users that either want or own these games
                just like certain game libraries like steam, epic games, etc. We used an API called <b>IGDB</b> to get our games,
                we have around 92k games within our database with different titles, genres, and descriptions. Each user
                owning/wanting around 1k games. This results in the owning/wanting table to have around 1 million entries.
                With this large database, we wanted to make an index to help improve our query searches. However, due to the fact that 
                sqlite3 in our schools server is so efficient, it is quite difficult to make an index that makes searches faster.
                However, (talk about inputting indexes anyways with results)
            </p>
        </div>

        <div class="text">
            <p>
                When compared to our proposal when we first started to work on the project, it has some similarities. We have all the tables that are mentioned
                in the Proposal, however, some changes were made like making Genre it's own class or not using some attributes. Due to some time 
                restraints, we were unable to make it to the degree that we wanted. However, we might work on this project on our own
                time in the future, either together or seperately.
            </p>
        </div>

        <div class="text">
            <p>
                What we learned from working on this project is that there are a lot of types of indexes depending on what type of database you are 
                working on. Also inputting a large amount of mock data was a little difficult. At first, we inserted some random <b>Users</b> using 
                a website called 
                
                <b>Mockaroo</b>
                <sup>
                    <a href="https://www.mockaroo.com">
                        <span>[</span>
                        3
                        <span>]</span>
                    </a>
                </sup>
                
                However,
                we needed a lot of game data and putting it in ourselves would be a huge hassle and with the limited time that we had, we decided to
                find an API that already has a lot of games in their database. The API that we chose to use is called <b>IGDB</b>.
                They allow you to use their API for free with around 31k games from many different companies and series. We had a hard time figuring out
                how to get the data from the API into our own database. While trying to find a way to use the <b>IGDB API</b>, we discovered a software called
                
                <b>Postman</b>
                <sup>
                    <a href="https://www.postman.com">
                        <span>[</span>
                        4
                        <span>]</span>
                    </a>
                </sup>
                
                to get a JSON file and use the data in that JSON file and input it into our database. Seeing how much
                data that was inside the JSON file from <b>IGDB</b> was really an amazing thing to see, it had some recent games that came out last year so we knew that
                it was still being updated. It was our first time using something like Postman so it was a learning experience to figure out. 
            </p>
        </div>

        <hr>

        <h3>Github</h3>

        <div class="text">
            <p>
                Here you will find the Github to our project <b>Game_library</b>.
                <sup>
                    <a href="https://github.com/Loon01/4420_Game-Library#">
                        <span>[</span>
                        5
                        <span>]</span>
                    </a>
                </sup>
            </p>
        </div>
        <!--
        <div class="code-block">  Just to see how we could input code in the page
            <div class="text">
                <p>A schema of how our tables were made.</p>
                <pre>
                    <code> <b>
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
                    </code> </b>
                </pre>
            </div>
        </div> -->
        <hr>
    </div>
</body>
</html>