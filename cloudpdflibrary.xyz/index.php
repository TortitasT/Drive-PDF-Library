<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

include_once("config.php");

$ready_to_print[] = "";

$connect = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
mysqli_select_db($connect, DB_NAME);

$user_id = htmlspecialchars($_SESSION["id"]);

$_SESSION['nexturl'] = "https://drive.google.com/file/d/1T6OVsKgd0Zq0dp-ayo8V_xcXHWuchJbq/preview?usp=sharing";

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

if (isset($_GET['nexturl'])){
$_SESSION['nexturl'] = $_GET['nexturl'];
}


if (isset($_GET['deletebook'])){
    $book_delete_name = $_GET['delete_input'];
    $stmt = $connect->prepare("DELETE FROM belongings WHERE bookid = (SELECT id FROM books WHERE book_name = '$book_delete_name');");
    $stmt->execute();
    $stmt = $connect->prepare("DELETE FROM books WHERE book_name = '$book_delete_name';");
    $stmt->execute();
    header("Location: index.php");
    }

mysqli_free_result($result);

if (isset( $_REQUEST['submit'] ) ) {
$bname = $_REQUEST['bname'];
$burl = $_REQUEST['burl'];

$stmt = $connect->prepare("INSERT INTO books (book_name, book_url) VALUES ('$bname', '$burl');");
$stmt->execute();

$stmt = $connect->prepare("INSERT INTO belongings (bookid, userid) VALUES ((SELECT id FROM books WHERE book_name = '$bname'), '$user_id');");
$stmt->execute();
header("Location: index.php");
}


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
            <td id="scren">Your books: </td>
            <td>
            <?php 
    $implode_ready = implode (", " ,$ready_to_print);
    print (substr($implode_ready,(strlen($implode_ready)*-1)+2));
            ?>
            </td>
        </tr>
    </table>
    <audio controls loop autoplay style="display:none;">
    <source src="sound/BGM_VICTOO.ogg" type="audio/ogg">
    Your browser does not support the audio element.
    </audio>
    <br>
    <div>
    <form autocomplete="off" action="index.php" method="request" id="registerbooks"><br>
    <label>Insert your books</label><br><br>
    <label for="bname">Book name:</label><br>
    <input required pattern="[^' ']+" type="text" name="bname" value=""><br><br>
    <label for="burl">Book URL:</label><br>
    <input required type="text" name="burl" value=""><br><br>
    <input type="submit" value="Send" name="submit"><br><br>
    </form>
    <br>
    <?php
    if(count($ready_to_print)>1){
    foreach(array_slice($ready_to_print, 1) as $item)
    {
    $stmt = $connect->prepare("SELECT book_url FROM books WHERE book_name = '$item';");
    $stmt->execute();
    $result = $stmt->get_result();
    $get_url_to_print[]="";
    foreach ($result as $row) {
        //print_r($row);
        $get_url_to_print = array();
        $get_url_to_print[] = $row['book_url'];
    }
    echo '<br>';
    echo '<div id="Library">';
    echo '<form autocomplete="off" action="index.php" method="GET"><br>';
    echo "<label for='nexturl'>Book name: $item</label><br>";
    echo "<input type='text' id='inputtextp' name='nexturl' value=" . implode ($get_url_to_print) ."><br>";
    echo '<input type="submit" value="Load" name="nexturl_b"> ';
    echo "<form action='index.php' method='GET'><input type='text' name='delete_input' value='$item' style='display:none;'><input type='submit' value='Delete' name='deletebook'></form><br>";
    echo '</form>';
    echo '</div>';
    echo '<br>';
    }
}
    mysqli_close($connect);
    ?>
    
</div>
<div id="footer">
<a href="https://paypal.me/pools/c/8vWrgCsgSt" target="_blank">Donate :)</a> <a href="https://github.com/TortitasT/Drive-PDF-Library" target="_blank">GitHub</a>
</div>
</body>
<script type="text/javascript" src="js/query.js"></script>
</html>