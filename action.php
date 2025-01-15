
<?php
// Include the database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'submit') {

        // Sanitize and validate form inputs
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $useremail = filter_input(INPUT_POST, 'useremail', FILTER_SANITIZE_EMAIL);
        $userphone = filter_input(INPUT_POST, 'userphone', FILTER_SANITIZE_STRING);
        $userpassword = $_POST['userpassword'];  // Raw password for hashing
        $subjects = filter_input(INPUT_POST, 'subjects', FILTER_SANITIZE_STRING);

        // Handle multiple cities selection
        $cities = isset($_POST['city']) && is_array($_POST['city']) ? implode(", ", $_POST['city']) : NULL;

        // Handle profile image upload
        $profile = NULL;
        if (isset($_FILES['profileimage']) && $_FILES['profileimage']['error'] == 0) {
            $targetDir = "Assests/uploads/";
            $targetFile = $targetDir . basename($_FILES['profileimage']['name']);
            $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Validate file type
            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            if (in_array($fileType, $allowedTypes) && move_uploaded_file($_FILES['profileimage']['tmp_name'], $targetFile)) {
                $profile = $targetFile;
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid file type or failed to upload the image.'
                ]);
                exit;
            }
        }

        // Hash the password for security
        $hashed_password = password_hash($userpassword, PASSWORD_DEFAULT);

        // Check if the email or phone already exists in the database
        $user_check_query = $conn->prepare("SELECT * FROM users WHERE email = ? OR phone = ?");
        $user_check_query->bind_param("ss", $useremail, $userphone);
        $user_check_query->execute();
        $result = $user_check_query->get_result();

        $error_messages = [
            'email' => '',
            'phone' => ''
        ];

        // If email or phone exists, set error messages
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['email'] == $useremail)
                    $error_messages['email'] = 'Email already exists.';
                if ($row['phone'] == $userphone)
                    $error_messages['phone'] = 'Phone already exists.';
            }

            // Return errors if found
            if ($error_messages['email'] || $error_messages['phone']) {
                echo json_encode([
                    'status' => 'error',
                    'errors' => $error_messages
                ]);
                exit;
            }
        }

        // Prepare and execute the insert query
        $stmt = $conn->prepare("INSERT INTO users (username, email, phone, password, subjects, city, Profile) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $username, $useremail, $userphone, $hashed_password, $subjects, $cities, $profile);

        if ($stmt->execute()) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Registration successful!'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Database error: ' . $stmt->error
            ]);
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();

    } elseif ($_POST['action'] == 'fetchusers') {
        // Query to fetch all users
        $query = "SELECT * FROM users";
        $result = $conn->query($query);

        $response = [];


        if ($result->num_rows > 0) {
            $response['status'] = 'success';
            $response['usersrecord'] = [];
            // Fetch all users and store them in an array
            while ($row = $result->fetch_assoc()) {

                $response['usersrecord'][] = [
                    'id' => $row['id'],
                    'username' => $row['username'],
                    'email' => $row['email'],
                    'phone' => $row['phone'],
                    'subjects' => $row['subjects'],
                    'city' => $row['city'],
                    'profile' => $row['profile']
                ];

            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'No users found';
        }

        // Close the database connection
        $conn->close();

        // Return the response as JSON
        echo json_encode($response);
    } elseif ($_POST['action'] == 'deleteusers') {

        // Check if the user ID is set
        if (isset($_POST['userId']) && !empty($_POST['userId'])) {
            $userId = $_POST['userId'];

            // Prepare and execute the DELETE query
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $userId);

            if ($stmt->execute()) {
                // Check if any row was deleted
                if ($stmt->affected_rows > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'User deleted successfully.'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'No user found with the provided ID.'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Database error: ' . $stmt->error
                ]);
            }

            // Close the statement and connection
            $stmt->close();
            $conn->close();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'User ID is required.'
            ]);
        }
    } elseif ($_POST['action'] == 'getuser') {

        // Check if the user ID is provided
        if (isset($_POST['userId'])) {
            $userId = $_POST['userId'];

            // Prepare and execute the query
            $query = "SELECT * FROM users WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                echo json_encode([
                    'status' => 'success',
                    'user' => $user
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'User not found.'
                ]);
            }

            $stmt->close();
            $conn->close();
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'User ID is required.'
            ]);
        }
    } 

    elseif ($_POST['action'] == 'updateuser'){
        
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate form inputs
    $userId = $_POST['userId'];
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $subjects = filter_input(INPUT_POST, 'subjects', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    
    // Handle profile image upload
    $profile = NULL;
    if (isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $targetDir = "Assests/uploads/";
        $targetFile = $targetDir . basename($_FILES['profile']['name']);
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate file type
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif','webp'];
        if (in_array($fileType, $allowedTypes) && move_uploaded_file($_FILES['profile']['tmp_name'], $targetFile)) {
            $profile = $targetFile;
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid file type or failed to upload the image.'
            ]);
            exit;
        }
    }

    // If there is a profile image, update it; otherwise, keep the previous value
    if ($profile) {
        // Prepare the update query to update with the profile image
        $query = "UPDATE users SET username = ?, email = ?, phone = ?, subjects = ?, city = ?, Profile = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssssssi", $username, $email, $phone, $subjects, $city, $profile, $userId);
    } else {
        // Prepare the update query without changing the profile image
        $query = "UPDATE users SET username = ?, email = ?, phone = ?, subjects = ?, city = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssssi", $username, $email, $phone, $subjects, $city, $userId);
    }

    // Execute the update query
    if ($stmt->execute()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'User updated successfully!'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $stmt->error
        ]);
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();

} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method!'
    ]);
}


    }
    else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid request method!'
        ]);
    }
}
?>
