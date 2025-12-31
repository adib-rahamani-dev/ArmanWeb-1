<?php   

  const SERVER = 'localhost';
  const USERNAME = 'root';
  const PASSWORD = '';
  const DBNAME = 'arman';


  try {
      $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];
      $pdo = new PDO('mysql:host=' . SERVER . ';dbname=' . DBNAME , USERNAME, PASSWORD, $options);
 
      
    



  } catch (PDOException $e) {
    echo 'ERROR  ' . $e->getMessage();
    exit();
  }





?>