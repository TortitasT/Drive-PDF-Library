var mysql = require('mysql');
var scren = document.getElementById("scren");

var con = mysql.createConnection({
  host: "127.0.0.1:3306",
  user: "root",
  password: "",
  database: "pdf_library"
});
function query_f(){
    con.connect(function(err) {
        if (err) throw err;
        scren.innerHTML = "connected";
      });
}