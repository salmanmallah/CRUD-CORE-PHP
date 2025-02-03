<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database_name = "cit_crud_db";


    // Create connection
    $conn = new mysqli($host, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        // die("Connection failed: " . $conn->connect_error);
    }


    // checking if db exists 
    $db_check = $conn->query("SHOW DATABASES LIKE '$database_name'");
    if($db_check->num_rows < 1){
        // creating database. 
        $sql = "CREATE DATABASE IF NOT EXISTS cit_crud_db";
        if(mysqli_query($conn, $sql)){
            echo "No db found, created one";
        }
    }



  

    // mysqli_close($conn);


?>
