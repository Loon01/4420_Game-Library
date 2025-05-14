<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Game Library</title>
</head>
<body>
    <?php include("nav.php"); ?>
    <h1>Game Library Management System</h1>

    <h2>4420 Adv. Database Project</h2>

    <sub><b>By: Adrian Rodriguez, Matthew Wehrmeyer</b></sub>

    <h2>Introduction</h2>
    <h3>Project Proposal</h3>
    <p>Our project proposal is to make a game library similar to steam library where you can browse games and search for their genres, name, developers, release date, etc. 
        We are also going to try to implement something that keeps track of what games the user has and the date they bought the game, last played and how many hours they played the game. 
        Since this game library has a lot of types of games to look through, we will likely need to use an index to be able to search through this library efficiently. 
        We will also have to look at the different forms of data normalization to see which one is right to use on what we are making.</p>
    
    <h3>Technology Stacks we would like to use: </h3>
    <ul>
        <li>Postgres</li>
        <li>Indexing/Multi-level Indexing</li>
        <li>Possibly Using php with html/css</li>
    </ul>

   <h3>Research</h3> 
   <p>We will most likely be looking at other places that use similar types of libraries (Steam, Epic Games, etc.). 
    We do not want to completely copy these libraries but to use them as references for what we are making to help us.</p>

    <h3>Reason of Interest</h3>
    <p>The reason we want to do this project is because we are both interested in gaming and playing video games. 
        Also, we both use game libraries from different companies that sell video games like Steam, Epic Games, etc.. 
        Gaming today is becoming more popular so there has to be a way to keep track of what games you own, and how to find them. 
        Being able to sort of know how this is done by implementing a mock up of what it could look like, can help better understand how it works today. </p>

    <h3>Users and Data Access</h3>
    <dl>
        <dt>Groups</dt>
        <dd> -[Administrators]</dd>
        <dd> -[Users]</dd>
        <dd> -[Developers]</dd>
        <dd> -[Guests]</dd>
        <dt>Operations and Data Access:</dt>
        <dd> -[Admins and developers can moderate and maintain game records]</dd>
        <dd> -[Users would have access to seeing all games, as well as be able to view other users games]</dd>
        <dd> -[Developers can publish games for users to be able to view]</dd>
        <dd> -[Guests cannot view other users games, but be able to view all games in the library]</dd>
    </dl>

    <h3>Summary of Entities and Relationships</h3>
    <ul>
        <li>A user can own many games and a game is owned by many users</li>
        <li>A game can be wanted by many users and a user can want many games</li>
        <li>A developer can create multiple games but a game can be created by a single developer</li>
    </ul>
    
    <h2>Conceptual Database Design</h2>
    <h3>Entities</h3>
    <h4>Game</h4>
    <ul>
        <li>Weak</li>
        <ul>
            <li>Depends on the Developer Entity</li>
        </ul>
        <li>Attributes</li>
        <ul>
            <li>Game_id</li>
            <ul>
                <li>Game's identification</li>
                <li>Unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
            <li>Game_name</li>
            <ul>
                <li>Name of the game</li>
                <li>Not Unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
            <li>Genre</li>
            <ul>
                <li>Genre of the game</li>
                <li>Not Unique</li>
                <li>Multiple-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
            <li>Release Date</li>
            <ul>
                <li>Game's id</li>
                <li>Not Unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
            <li>Description</li>
            <ul>
                <li>Games description</li>
                <li>Not Unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
        </ul>
    </ul>
    <h4>User</h4>
    <ul>
        <li>Strong</li>
        <li>Attributes:</li>
        <ul>
            <li>User_id</li>
            <ul>
                <li>Identification of the player</li>
                <li>Unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
            <li>Username</li>
            <ul>
                <li>The player's username</li>
                <li>Not unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
            <li>Password</li>
            <ul>
                <li>Store the value for the player to login to this program/site</li>
                <li>Not unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
        </ul>
    </ul>
    <h4>Developer</h4>
    <ul>
        <li>Strong</li>
        <li>Attributes:</li>
        <ul>
            <li>Developer_name</li>
            <ul>
                <li>Name of the developer group</li>
                <li>Unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
        </ul>
    </ul>

    <h3>Relationships</h3>
    <h4>Owns</h4>
    <ul>
        <li>To be able to see which games a user owns</li>
        <li>Entities:</li>
        <ul>
            <li>User</li>
            <ul>
                <li>Patricipation: Mandatory</li>
                <li>Cardinality: M</li>
            </ul>
            <li>Game</li>
            <ul>
                <li>Patricipation: Optional</li>
                <li>Cardinality: M</li>
            </ul>
        </ul>
        <li>Attributes:</li>
        <ul>
            <li>Date Brought</li>
            <ul>
                <li>Date when user first owned</li>
                <li>Not unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
            <li>Date last played</li>
            <ul>
                <li>Date when user last played</li>
                <li>Not unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored</li>
            </ul>
            <li>Hours Played</li>
            <ul>
                <li>How many hours the user has played the game</li>
                <li>Not unique</li>
                <li>Single-value</li>
                <li>Simple</li>
                <li>Stored/Derived</li>
            </ul>
        </ul>
    </ul>
    <h4>Wants</h4>
    <ul>
        <li>To be able to see which games a user would want to eventually own</li>
        <li>Entities:</li>
        <ul>
            <li>User</li>
            <ul>
                <li>Patricipation: Mandatory</li>
                <li>Cardinality: M</li>
            </ul>
            <li>Game</li>
            <ul>
                <li>Patricipation: Optional</li>
                <li>Cardinality: M</li>
            </ul>
        </ul>
        <li>Attributes: null</li>
    </ul>
    <h4>Creates</h4>
    <ul>
        <li>To see who created a certain game</li>
        <li>Entities:</li>
        <ul>
            <li>Developer</li>
            <ul>
                <li>Patricipation: Mandatory</li>
                <li>Cardinality: 1</li>
            </ul>
            <li>Game</li>
            <ul>
                <li>Patricipation: Optional</li>
                <li>Cardinality: M</li>
            </ul>
        </ul>
        <li>Attributes: null</li>
    </ul>

    <h2>ER Diagram</h2>
    <img src="../images/GameLibraryER_diagram.png" alt="ER diagram">

</body>
</html>
