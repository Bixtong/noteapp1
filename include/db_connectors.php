<?php
function connectDB() {
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_DATABASE') ?: 'default'; // Update to match your ENV
    $username = getenv('DB_USERNAME') ?: 'mysql'; // Update as necessary
    $password = getenv('DB_PASSWORD') ?: '';
    $port = getenv('DB_PORT') ?: '3306'; // Default port

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
