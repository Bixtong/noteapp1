<?php
function connectDB() {
    $host = getenv('DB_HOST') ?: 'localhost'; // Use DB_HOST from environment or default to localhost
    $dbname = getenv('DB_DATABASE') ?: 'default'; // Use DB_DATABASE from environment or default to 'default'
    $username = getenv('DB_USERNAME') ?: 'mysql'; // Use DB_USERNAME from environment or default to 'mysql'
    $password = getenv('DB_PASSWORD') ?: ''; // Use DB_PASSWORD from environment or default to empty string
    $port = getenv('DB_PORT') ?: '3306'; // Use DB_PORT from environment or default to 3306

    try {
        // Create a PDO connection using the above variables
        $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set error mode to exception
        return $conn; // Return the connection object
    } catch (PDOException $e) {
        // Catch and display connection errors
        echo "Connection failed: " . $e->getMessage();
    }

    return null; // Return null if connection fails
}
?>
