<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Week 13</title>
</head>
<body>
    <?php include("nav.php"); ?>
    <h1>Weekly Progress</h1>
    <h2>Week 13</h2>

    <p style="font-size:20px">
        Currently we have some tables set up in our database for Games, Users, Owns, and
        Developers. Each table has some data within it for testing. <br>
        <img src="../images/tables.png" alt="Tables" width="auto" height="300"> <br>
    </p>

    <p style="font-size:20px">
        We also have a table with mock data of 1 thousand users with names, and 
        passwords <br>
        <img src="../images/user_mock-data.png" alt="User mock-data" width="400" height="200">
    </p>

    <p style="font-size:20px">
        An index page was also made to connect to the database, for now it only outputs data from a certain table 
        depending on the query given in the code. This is currently a placeholder for if we want to anything with it
        in the future.
        <pre>
            <code>
                require_once("config.php");
                include("nav.php");

                //SQL query
                $statement = $pdo->query("SELECT * FROM User");

                //Runs query
                $rows = $statement->fetchAll(pdo::FETCH_ASSOC);

                //Shows results
                //var_dump($rows);
                echo "pre";
                print_r($rows);
                echo "/pre";
            </code>
        </pre>
    </p>
    
    
    <p style="font-size:20px">
        We later wanted to input data into our game table but we thought maybe inputting
        a thousand games would be a hassle. We looked into APIs of certain game libraries
        that already exist to try to make it easier for us. We looked at Steam's API but 
        then we found an API called <b>IGDB API</b> swhich holds a large video game database for 
        free. <br>
        <a href="https://www.igdb.com/api"><img src="https://www.igdb.com/android-chrome-512x512.png" alt="IGDB" width="400" height="300"></a>
    </p>

    <br>


    <p style="font-size:20px">
        In order to get the data we want to use from the API, we are looking at two possible 
        methods to explore. The first would be to directly use the API in a local database, 
        this could make using any possible wrappers that the API docs reccomends much easier to use. 
        This would mean that we just need to create the table and transfer that into the database on artemis. <br><br>
        
        The other possible method would be to take any info from the IGDB database we need and use a site like
        Postman. Postman can be used to help test API calls. One thing this site does give, is that results can be in the form
        of a json file. This could then be copied, and then used with php to insert the data. <br>
        
        <a href="https://www.postman.com/"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdMJXk5oq774oiFgM4ug-wqI8nWLL1jtRqHg&s" alt="POSTMAN" width="400" height="300"></a>
    </p>

    <h3>Hope to have by next week</h3>
    <ul>
        <li>Have the IGBD API figured out</li>
        <li>Worked on our own tables more</li>
        <li>Have some quieries running for testing</li>
        <li>Look more into indexes</li>
    </ul>

</body>
</html>