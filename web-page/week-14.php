<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Week 14</title>
</head>
<body>
    <?php include("nav.php"); ?>
    <h1>Weekly Progress</h1>
    <h2>Week 14</h2>

    <p style="font-size:20px">
        More info was looked into about indexing from the previous week. <br>
        Looking at documention from <a href="https://dev.mysql.com/doc/refman/8.4/en/mysql-indexes.html">MySQL</a>, 
        <a href="https://www.postgresql.org/docs/current/btree.html">PostgreSQL</a> and other sources to see <br>
        what type of index could be used for what we want to do. <br>
    </p>

    <p style="font-size:20px">
        After speaking with Toothman about what types of indexes we should use <br>
        to accomplish what we want to do, we could just use the basic <b>CREATE INDEX</b> <br>
        tha uses a B-tree for our db. We can use a reference from the <a href="https://www.sqlite.org/lang_createindex.html">SQLite</a> website
    </p>

    <p style="font-size:20px">
        We looked more into Postman to help get data from the IGDB API using a JSON file that postman provides. <br>
        <a href="https://www.postman.com/"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSdMJXk5oq774oiFgM4ug-wqI8nWLL1jtRqHg&s" alt="POSTMAN" width="400" height="300"></a>
    </p>

    <p style="font-size:20px">
        Currently we have more data in our tables than last week. <br>
        There are around 23k games, 47k genres, 45k devs, and still around 1k users. <br>
        <img src="../images/table-count.png" alt="table count">
    </p>

    <h3>Hope to have by next week</h3>
    <ul>
        <li>Have more data in our db</li>
        <li>Have some adjustments to our tables</li>
        <li>Have some indexes in place for some queries</li>
    </ul>
</body>
</html>