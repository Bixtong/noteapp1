<?php
function connectDB() {
    // Fetching environment variables for database connection
    $host = getenv('DB_HOST') ?: 'localhost'; // Default to localhost if not set
    $dbname = getenv('DB_DATABASE') ?: 'default'; // Default database name
    $username = getenv('DB_USERNAME') ?: 'mysql'; // Default username
    $password = getenv('DB_PASSWORD') ?: ''; // Default password
    $port = getenv('DB_PORT') ?: '3306'; // Default to 3306

    // Create a new mysqli instance for MySQL connection
    $conn = mysqli_connect($host, $username, $password, $dbname, $port);

    // Check connection
    if (!$conn) {
        echo "Connection failed: " . mysqli_connect_error();
        return null; // Return null if connection fails
    }

    return $conn; // Return the connection object
}
?>
