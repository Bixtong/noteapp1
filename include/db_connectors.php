<?php
function connectDB() {
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_DATABASE') ?: 'default'; // Default to 'default'
    $username = getenv('DB_USERNAME') ?: 'mysql'; // Default username
    $password = getenv('DB_PASSWORD') ?: ''; // Default password
    $port = getenv('DB_PORT') ?: '3306'; // Default to 3306

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return null;
}
?>
