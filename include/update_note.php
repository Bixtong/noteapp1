<?php
session_start();
include_once 'db_connectors.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or display an appropriate message if the user is not logged in
    header("Location: ../login.php");
    exit();
}

// Assuming you receive note ID along with title and content for update
$note_id = $_POST['note_id'];
$title = $_POST['noteTitleModal'];
$content = $_POST['noteContentModal'];
$user_id = $_SESSION['user_id']; 

$errors = array();

// Fetch the existing values of the note from the database
try {
    $conn = connectDB();
    $stmt = $conn->prepare("SELECT title, content FROM notes WHERE n_id=? AND u_id=?");
    $stmt->execute([$note_id, $user_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $existing_title = $row['title'];
    $existing_content = $row['content'];

    // Compare the existing values with the submitted values
    if ($title === $existing_title && $content === $existing_content) {
        $errors['noteTitleModal'] = "No changes were made to the note.";
    }
} catch (PDOException $e) {
    // Handle database connection or query errors gracefully
    $_SESSION['note_update_message'] = "Failed to fetch existing note details from the database.";
    header("Location: ../note.php");
    exit();
}

// Validate note title
if (empty($title) || trim($title) === '') {
    $errors['noteTitleModal'] = "Add title.";
} else {
    // Check if the first character is a space
    if ($title[0] === ' ') {
        $errors['noteTitleModal'] = "Title must not start with a space.";
    }
    // Check if the first character is an uppercase letter
    else if (!ctype_upper($title[0])) {
        $errors['noteTitleModal'] = "Title must start with an uppercase letter.";
    } else {
        $title = htmlspecialchars($_POST['noteTitleModal']);
    }
}

// Validate note content
if (empty($content) || trim($content) === '') {
    $errors['noteContentModal'] = "Add Content.";
} else {
    $content = htmlspecialchars($_POST['noteContentModal']);
}

if (!empty($errors)) {
    // Store validation errors in session and redirect back to the note page
    $_SESSION['Updatesubmitted_values']['note_id'] = $note_id;
    $_SESSION['note_update_errors'] = $errors;
    $_SESSION['Updatesubmitted_values'] = $_POST;
    header("Location: ../note.php");
    exit();
}

// Update the note if there are no validation errors
try {
    $conn = connectDB();
    $stmt = $conn->prepare("UPDATE notes SET title=?, content=? WHERE n_id=? AND u_id=?");
    $stmt->execute([$title, $content, $note_id, $user_id]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['note_update_message'] = "Note updated successfully";
    } else {
        $_SESSION['note_update_message'] = "Failed to update note";
    }

    header("Location: ../note.php");
    exit();
} catch (PDOException $e) {
    // Handle database connection or query errors gracefully
    $_SESSION['note_update_message'] = "Failed to update note due to a database error.";
    header("Location: ../note.php");
    exit();
}
?>
