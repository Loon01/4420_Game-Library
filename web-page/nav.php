<?php
$pages = ["index", "proposal", "week_prog"];

// Check if the user is an admin and add the admin_editor page
//if (isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
//    $pages[] = "admin_editor"; 
//}
?>
<ul class="navbar">
<?php
foreach($pages as $page) {
    echo "<li class='link'><a href=\"$page.php\">$page</a></li>";
}
?>
</ul>