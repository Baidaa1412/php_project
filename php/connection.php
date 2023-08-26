<?php 

try{
  $conn = new PDO("mysql:host=localhost:4306;dbname=testpresento", "root", "");
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "database error" . $e->getMessage();
}
?>