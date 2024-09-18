<?php
function connectDB() {
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_DATABASE') ?: 'noteapp';
    $username = getenv('DB_USERNAME') ?: 'root';
    $password = getenv('DB_PASSWORD') ?: '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;port=" . getenv('DB_PORT'), $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return null;
}
?>
