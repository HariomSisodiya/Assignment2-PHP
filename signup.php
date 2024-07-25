<?php
echo "Connecting to MySQL database...<br>";

// Establish a connection to the MySQL database
$conn = mysqli_connect('localhost', 'Hariom', '', 'userlogin');

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully to the database.<br>";

// SQL query to create the 'user' table if it doesn't exist
$createTableQuery = 'CREATE TABLE IF NOT EXISTS user (
    Id INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(100),
    Email VARCHAR(200) UNIQUE NOT NULL,
    Password VARCHAR(200) NOT NULL
)';

// Execute the query to create the table
if (mysqli_query($conn, $createTableQuery)) {
    echo "Table 'user' created successfully.<br>";
} else {
    echo "Table creation failed: " . mysqli_error($conn) . "<br>";
}

// Check if the POST data is not empty and insert the data into the table
if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // Sanitize and escape the input data to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // SQL query to insert the user data into the table
    $insertQuery = "INSERT INTO user (Username, Email, Password) VALUES ('$username', '$email', '$password')";

    // Execute the query to insert the data
    if (mysqli_query($conn, $insertQuery)) {
        echo "SignUp successfully.<br>";
    } else {
        echo "SignUp failed: " . mysqli_error($conn) . "<br>";
    }
} else {
    echo "All fields are required.<br>";
}

// Close the database connection
mysqli_close($conn);
?>
