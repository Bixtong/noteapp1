<?php
function connectDB() {
    $config = [
        'host' => getenv('DB_HOST') ?: 'localhost',
        'dbname' => getenv('DB_DATABASE') ?: 'default', // Default value
        'username' => getenv('DB_USERNAME') ?: 'mysql', // Default value
        'password' => getenv('DB_PASSWORD') ?: '',
        'dbport' => getenv('DB_PORT') ?: '3306', // Default to 3306
    ];

    try {
        $conn = new PDO("mysql:host={$config['host']};dbname={$config['dbname']};port={$config['dbport']}", $config['username'], $config['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return null;
}
?>
