<?php

require_once 'php/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_GET['material_id'])) {
        $stmt = $db->prepare("INSERT INTO `material_tag` (`id`, `material_id`, `tag_id`) VALUES (NULL, ?, ?)") or die("$stmt->error");
        $stmt->bind_param('ii', $_GET['material_id'], $_POST['tag_id']) or die("$stmt->error");
        $stmt->execute() or die("$stmt->error");
        header('location: view-material.php?id='.$_GET['material_id']);
    }
}

?>