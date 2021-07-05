<?php

require_once 'php/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['material_id']) && strlen($_GET['material_id']) != 0) {
        if (isset($_GET['tag_id']) && strlen($_GET['tag_id']) != 0) {
            $stmt = $db->prepare("DELETE FROM `material_tag` WHERE `material_id` = ? AND `tag_id` = ?") or die("$stmt->error");
            $stmt->bind_param('ii', $_GET['material_id'], $_GET['tag_id']) or die("$stmt->error");
            $stmt->execute() or die("$stmt->error");
            header('location: view-material.php?id='.$_GET['material_id']);
        }
    }
}

?>