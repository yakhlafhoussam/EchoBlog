<?php

use App\Config\Database;

$test = new Database();
$conn = $test->connect();
$stmt = $conn->prepare('INSERT INTO likes (article_id, reader_id) VALUES (?, ?)');
$stmt->execute([$_POST['article_id'], $_POST['reader_id']]);
$_SESSION['successmsg'] = 'The like has added successfully!';
return 'sama3ikom';

?>