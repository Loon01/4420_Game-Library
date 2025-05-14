# 4420 Advanced Database

Project Name:
- Game Library

Summary:
- Our project was to create a large database that held thousands of games with Users Owning or Wanting
  games. We wanted to use what we learned in our adv. database class and use an index to help improve
  search time with a large database. We used our school server to create our database and to do tests.


Prerequisite:
- To run this project, you will need to have sqlite3
- Optional: you can have litecli installed to make outputting the tables more visible

Note:
- The database under the name "library.db" is outdated but has some data within it. Rebuilding it from the ground up,
provided in the instruction, may be better. 

Instructions:
 - First you would need to run library.sql to create the tables. You can run it by using the command
    "sqlite3 library.db < library.sql" to prepare the tables for data
 - To setup the user data run "sqlite3 library.db < data.sql".
 - To setup the game data you want to unzip the file fullGameData. This is a JSON file
    that was a too large for github so we needed to compress it. Make sure that file stays in the db
    folder for the right path. Afterwards run the command "php insertGameData.php". This will
    insert data into the Game table, along with the Genre table and Developer table
 - For the tables Owns and Wants, you would run the command "php randomRecordTest.php" or
    "php random_insert.php". The first one is inserting roughly 1000 random games for each user into
    the Owns tables and Wants table, which is good for a bulk amount for testing index purposes.
    The second command will randomly select a user and a game to be inserted into Owns or Wants, which
    represents more randomness to the amount of games each user would want or have.

Stuff we used: 
- We used Mockaroo to input a random amount of Users (https://www.mockaroo.com/)

- We used an API called IGDB to help get data for games (https://www.igdb.com/api)

- We also used Postman to get a JSON file to be able to input the games from the 
  IGDB API (https://www.postman.com/)

