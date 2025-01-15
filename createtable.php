<!-- <?php
// Include database connection
// include('db.php');

// // SQL query to create a table
// $sql_users = "CREATE TABLE IF NOT EXISTS users (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(100) NOT NULL,
//     email VARCHAR(100) NOT NULL,
//     phone VARCHAR(15) NOT NULL,
//     password VARCHAR(255) NOT NULL,
//     subjects VARCHAR(100),
//     profile VARCHAR(255) NOT NULL,
//     city TEXT,
//     reg_date TIMESTAMP
// )";
// $sql_usama = "CREATE TABLE IF NOT EXISTS usama (
//      id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(100) NOT NULL,
//     email VARCHAR(100) NOT NULL,
//      phone VARCHAR(15) NOT NULL,                     //if you want to more than one table you can create like this
//     password VARCHAR(255) NOT NULL,
//     subjects VARCHAR(100),
//     city TEXT,
//     reg_date TIMESTAMP
// )";
// // Check if the table is created successfully
// if ($conn->query($sql_users) === TRUE) {
//     echo "Table users created successfully. <br>";
// } else {
//     echo "Error creating table: " . $conn->error;
// }
// if ($conn->query($sql_usama) === TRUE) {
//     echo "Table 'usama' created successfully.";
// } else {
//     echo "Error creating table: " . $conn->error;
// }
// // Close connection
// $conn->close();
?> 
