<?php
function connectDB() {
    // Fetching environment variables for database connection
    $host = getenv('DB_HOST') ?: 'localhost'; // Default to localhost if not set
    $dbname = getenv('DB_DATABASE') ?: 'default'; // Default database name
    $username = getenv('DB_USERNAME') ?: 'mysql'; // Default username
    $password = getenv('DB_PASSWORD') ?: ''; // Default password
    $port = getenv('DB_PORT') ?: '3306'; // Default to 3306

    try {
        // Create a new PDO instance for MySQL connection
        $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; // Return the connection object
    } catch (PDOException $e) {
        // Handle connection errors
        echo "Connection failed: " . $e->getMessage();
        return null; // Return null if connection fails
    }
}
?>
