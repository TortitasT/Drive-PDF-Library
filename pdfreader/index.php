<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$hostname = "127.0.0.1";

$username = "root";

$password = "";

$databaseName = "pdf_library";

$ready_to_print[] = "";

$connect = mysqli_connect($hostname, $username, $password);
mysqli_select_db($connect, $databaseName);

$user_id = htmlspecialchars($_SESSION["id"]);

//$query = "SELECT book_name FROM books WHERE id IN (SELECT book_id FROM belongings WHERE user_id = " . $user_id . ");";
//aYuDa
//$result = mysqli_query($connect, $query);

$stmt = $connect->prepare("SELECT book_name FROM books WHERE id IN (SELECT bookid FROM belongings WHERE userid = $user_id);");
$stmt->execute();
$result = $stmt->get_result();

foreach ($result as $row) {
    //print_r($row);
    $ready_to_print[] .= $row['book_name'];
}
//$ready_to_print = substr($ready_to_print, 0, -2) . "."; 

//while($row = mysqli_fetch_array($result))
//{
//print_r($row);
//} 

//$row = mysqli_fetch_row($result);
mysqli_free_result($result);

if (isset( $_REQUEST['submit'] ) ) {
print ("aaa");
$bname = $_REQUEST['bname'];
$burl = $_REQUEST['burl'];

$stmt = $connect->prepare("INSERT INTO books (book_name, book_url) VALUES ('$bname', '$burl');");
$stmt->execute();

$stmt = $connect->prepare("INSERT INTO belongings (bookid, userid) VALUES ((SELECT id FROM books WHERE book_name = '$bname'), '$user_id');");
$stmt->execute();
header("Location: index.php");
print ("bbb");
//$stmt = $connect->prepare("INSERT INTO belongings (bookid, userid) VALUES ((SELECT id FROM books WHERE book_name = '$bname'), '$user_id');");
//$stmt->execute();
print ("ccc");
}

mysqli_close($connect);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PDF Library</title>
    <meta name="Read your PDF" content="Read your PDF on drive">
    <link rel="stylesheet" media="all" href="stylesheet.css"/>
    <link rel="stylesheet" media="only screen and (max-width: 800px)" href="movil.css"/>
    <link rel="icon" href="images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

</head>
<body>
    <h1>Welcome to Drive PDF Library</h1>
    <hr>
    <b id="user">Username: <?php echo htmlspecialchars($_SESSION["username"]); ?><br>ID: <?php echo $user_id; ?></b><br>
    <a href="reading.php">Start reading</a>
    <a href="logout.php" class="btn btn-danger">Sign Out</a>
    <hr>
    <table>
        <tr>
            <!--<td><button onclick="query_f()">Reload</button></td>-->
        </tr>
        <tr>
            <td id="scren">Tus libros: </td>
            <td>
            <?php print_r ($ready_to_print);?>
            </td>
        </tr>
    </table>
    <audio controls loop autoplay style="display:none;">
    <source src="sound/BGM_VICTOO.ogg" type="audio/ogg">
    Your browser does not support the audio element.
    </audio>
    <br>
    <form action="/pdfreader/index.php" method="request" id="registerbooks"><br><br>
    <label for="bname">Book name:</label><br>
    <input required type="text" name="bname" value=""><br><br>
    <label for="burl">Book URL:</label><br>
    <input required type="text" name="burl" value=""><br><br>
    <input type="submit" value="submit" name="submit"><br><br>
    </form>
<table>
    <?php 
    echo $ready_to_print[1];
    echo $ready_to_print[2];
    echo $ready_to_print[3];
?>
</table>
</body>
<script type="text/javascript" src="js/query.js"></script>
</html>