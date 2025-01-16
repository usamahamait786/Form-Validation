 <?php
// Include database connection file
include('db.php');

// SQL query to create a table
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    password VARCHAR(255) NOT NULL,
    subjects VARCHAR(100),
    city TEXT,
    profile VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

// Check if the table is created successfully
if ($conn->query($sql_users) === TRUE) {
    echo "Table users created successfully. <br>";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close connection
$conn->close();
?> 

