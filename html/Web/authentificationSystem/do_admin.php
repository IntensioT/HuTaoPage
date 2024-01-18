<?php

require_once __DIR__.'/boot.php';

$stmt = $pdo->query('SELECT * FROM users');
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $row) {
    echo "<p>" . $row["username"] . "</p>";
    echo "<p>" . $row["email"] . "</p>";
}

