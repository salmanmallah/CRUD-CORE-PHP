<?php
include 'db_config.php';


// checking if login_table table exists or not 
    $conn = new mysqli($host, $username, $password, $database_name);

    $table = "login_table";
    $sql_query = "SHOW TABLES LIKE '$table'";
    $result = mysqli_query($conn, $sql_query);

    if(mysqli_num_rows($result) > 0){
        echo "<br>";
        echo "table '$table' exists";
    }else{
        // sql query to create table if not exists.
        $sql_query = "CREATE TABLE IF NOT  EXISTS login_table (
            id INT AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            role ENUM('admin', 'user') NOT NULL,
            email VARCHAR(255) UNIQUE NOT NULL,
            password VARCHAR(255) NOT NULL,
            PRIMARY KEY(id)
        )";

        // execute query.
        if($conn->query($sql_query) === TRUE){
            echo "<br>table created.";
        }else{
            echo "error creating table.";
        }
    }


// start of data filteration
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// getting values from html form
$name = $email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $password = test_input($_POST["password"]);
}
  
// CREATING QUERY TO INSERT DATA INTO LOGIN-TABLE.
$sql = "INSERT INTO login_table (role, name, email, password) VALUES ('user', '$name', '$email', '$password')";

if ($conn->query($sql) === TRUE){
    $success = true;
}else{
    $success = false;
    $error_message = "Error" . $sql . "<br>" . $conn->error;
}

// CLOSING THE CONNECTION.
$conn->close();

// passing the success variable  to index.html
header("Location: ../login.php?signup_success=" . ($success ? 'true' : 'false') . "&signup_error_message=" . urlencode($error_message));


?>