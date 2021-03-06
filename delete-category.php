<?php

require_once 'php/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $stmt = $db->prepare("DELETE FROM `categories` WHERE `id` = ?") or die("$stmt->error");
        $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
        $stmt->execute() or die("$stmt->error");
        $stmt = $db->prepare("DELETE FROM `materials` WHERE `category` = ?") or die("$stmt->error");
        $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
        $stmt->execute() or die("$stmt->error");
        header('location: list-category.php');
    }
}

?>