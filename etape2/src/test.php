
<?php
$host = 'data';
$user = 'root';
$pass = 'root';
$db   = 'tp3';

$mysqli = new mysqli($host, $user, $pass);
if ($mysqli->connect_errno) {
  die("Connexion échouée: " . $mysqli->connect_error);
}

$mysqli->query("CREATE DATABASE IF NOT EXISTS $db");
$mysqli->select_db($db);
$mysqli->query("CREATE TABLE IF NOT EXISTS notes(id INT AUTO_INCREMENT PRIMARY KEY, txt VARCHAR(255))");
$mysqli->query("INSERT INTO notes(txt) VALUES('Hello MariaDB via PHP-FPM')");
$res = $mysqli->query("SELECT * FROM notes");

echo "<h1>Notes</h1><ul>";
while ($row = $res->fetch_assoc()) {
  echo "<li>{$row['id']} - {$row['txt']}</li>";
}
echo "</ul>";
