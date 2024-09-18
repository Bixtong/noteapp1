<?php
include 'db_connectors.php';

session_start(); // Start the session to access session variables

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user ID from the session
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;


    // Check if the user is logged in
    if (!$user_id) {
        // Redirect the user to the login page if not logged in
        header("Location: ../login.php");
        exit();
    }

    // Get the updated name and photo (if provided)
    $name = $_POST['userName'];
    $photo = $_FILES['userPhoto']['name']; // Assuming your file input has name="userPhoto"
    $errors = array();

    // Sanitize the name input (optional)
    $name = htmlspecialchars($name);

   
    // Validate name
    if (empty($_POST['userName'])) {
        $errors['userName'] = "Name is required.";
    } else {
        // Remove spaces from the input name
        $nameWithoutSpaces = str_replace(' ', '', $_POST['userName']);
        
        // Validate the length of the name (excluding spaces)
        $nameLength = strlen($nameWithoutSpaces);
        if ($nameLength < 3 || $nameLength > 10) {
            $errors['userName'] = "Name must be 3 to 10 characters long.";
        } else {
            // If validation passes, store the name with HTML special characters escaped
            $name = htmlspecialchars($_POST['userName']);
        }
    }

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
         $_SESSION['submitted_values'] = $_POST;
        header("Location: ../note.php");
        exit();
    }
    // Check if a photo is uploaded
    if (!empty($photo)) {
        // Set the target directory where the photo will be uploaded
        $target_dir = "../img/"; // Change this path as needed

        // Set the target file path
        $target_file = $target_dir . basename($photo);

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES['userPhoto']['tmp_name'], $target_file)) {
            // If the file is uploaded successfully, update the database
            try {
                $conn = connectDB();

                // Update only the name if no photo is uploaded
                $sql = "UPDATE users SET name = ?, photo = ? WHERE u_id = ?";
                $stmt = $conn->prepare($sql);
                $photo = str_replace('../', '', $target_file);

                $stmt->execute([$name, $photo, $user_id]);

                // Update session variables with new name and photo
                $_SESSION['username'] = $name;
                $_SESSION['user_photo'] = $photo;

                // Close the database connection
                $conn = null;

                // Redirect the user to the profile page or any other page
                header("Location: ../note.php");
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // If no photo is uploaded, update only the name in the database
        try {
            $conn = connectDB();

            // Update only the name
            $sql = "UPDATE users SET name = ? WHERE u_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $user_id]);

            // Update session variable with new name
            $_SESSION['user_name'] = $name;

            // Close the database connection
            $conn = null;

            // Redirect the user to the profile page or any other page
            header("Location: ../note.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
