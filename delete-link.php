<?php

require_once 'php/config.php';

if (!isset($_GET['material_id']) || empty($_GET['material_id'])
    || !isset($_GET['id']) || empty($_GET['id'])
) header('location: list-materials.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $stmt = $db->prepare("DELETE FROM `material_link` WHERE `material_link`.`id` = ?") or die("$stmt->error");
    $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
    $stmt->execute() or die("$stmt->error");
    header('location: view-material.php?id=' . $_GET['material_id']);
}

?>