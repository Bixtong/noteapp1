<?php
function connectDB() {
    // Fetching environment variables for database connection
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_DATABASE') ?: 'default';
    $username = getenv('DB_USERNAME') ?: 'mysql';
    $password = getenv('DB_PASSWORD') ?: '';
    $port = getenv('DB_PORT') ?: '3306';

    try {
        // Create a new PDO instance for MySQL connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; // Return the connection object
    } catch (PDOException $e) {
        error_log("Connection failed: " . $e->getMessage()); // Log the error
        return null; // Return null if connection fails
    }
}
?>
