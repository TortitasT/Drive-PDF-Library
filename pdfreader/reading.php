<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
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
<body onload="onLoad()">
        <menu>
            <b id="user" style="text-align:left; left:0px;"><?php echo htmlspecialchars($_SESSION["username"]); ?></b>
            <!-- <button onclick="hideun_m()">Hide Menu!</button> -->
            <input onclick="hideun_m()" type="image" id="m_button" src="images/eye_open.png" style="height:2%;width:2%;">
            <input onclick="location.href='index.php';" type="image" src="images/home.png" style="height:2%;width:2%;">
        </menu>
        <iframe id="iFrame" src="https://drive.google.com/file/d/1T6OVsKgd0Zq0dp-ayo8V_xcXHWuchJbq/preview?usp=sharing"></iframe>
        <pdf id="pdf">
        <hr>
        <table>
            <tr>
                <td>Drive share URL: </td>
                <td><input id="prompt" type="text" value="<?php print $_SESSION['nexturl']; ?>"></td>
                <td><button onclick="update_f()">Load</button></td>
            </tr>
         <!--<tr>
                <td>Click if error</td>
                <td><button onclick="editUrl()">Edit</button></td>
            </tr> -->
        </table>
    
    <hr>
    <label id="console">Loading...</label>
    <hr>
    </pdf>
</body>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/stringeditor.js"></script>
</html>