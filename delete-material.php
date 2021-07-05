<?php

require_once 'php/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $stmt = $db->prepare("DELETE FROM `materials` WHERE `id` = ?") or die("$stmt->error");
        $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
        $stmt->execute() or die("$stmt->error");
        $stmt = $db->prepare("DELETE FROM `material_link` WHERE `material_id` = ?") or die("$stmt->error");
        $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
        $stmt->execute() or die("$stmt->error");
        $stmt = $db->prepare("DELETE FROM `material_tag` WHERE `material_id` = ?") or die("$stmt->error");
        $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
        $stmt->execute() or die("$stmt->error");
        header('location: list-materials.php');
    }
}

?>