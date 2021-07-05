<?php

require_once 'php/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['material_id'])) {
        $stmt = $db->prepare("INSERT INTO `material_link` (`id`, `material_id`, `link_title`, `link_url`) VALUES (NULL, ?, ?, ?)") or die("$stmt->error");
        $stmt->bind_param('iss', $_GET['material_id'], $_POST['title'], $_POST['url']) or die("$stmt->error");
        $stmt->execute() or die("$stmt->error");
        header('location: view-material.php?id='.$_GET['material_id']);
    }
}

?>