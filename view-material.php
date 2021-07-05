<?php
require_once 'php/config.php';
if (!isset($_GET['id']) || strlen($_GET['id']) == 0) header('location: list-materials.php');
?>

<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Материалы</title>
</head>
<body>
<div class="main-wrapper">
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">Test</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Материалы</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Теги</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Категории</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
            $stmt = $db->prepare("SELECT `materials`.`id`, `materials`.`name` AS `material_name`, `materials`.`author`, `materials`.`type`, `categories`.`name` AS 'category_name', `materials`.`description` FROM `materials` INNER JOIN `categories` ON `materials`.`category` = `categories`.`id` WHERE `materials`.`id` = ?") or die("$stmt->error");
            $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
            $stmt->execute() or die("$stmt->error");
            $res = $stmt->get_result() or die("$stmt->error");
            $row = $res->fetch_assoc();
        ?>
        <div class="container">
            <h1 class="my-md-5 my-4"><?php echo $row['material_name']; ?></h1>
            <div class="row mb-3">
                <div class="col-lg-6 col-md-8">
                    <div class="d-flex text-break">
                        <p class="col fw-bold mw-25 mw-sm-30 me-2">Авторы</p>
                        <p class="col"><?php echo $row['author']; ?></p>
                    </div>
                    <div class="d-flex text-break">
                        <p class="col fw-bold mw-25 mw-sm-30 me-2">Тип</p>
                        <p class="col"><?php echo $types[$row['type'] - 1]; ?></p>
                    </div>
                    <div class="d-flex text-break">
                        <p class="col fw-bold mw-25 mw-sm-30 me-2">Категория</p>
                        <p class="col"><?php echo $row['category_name']; ?></p>
                    </div>
                    <div class="d-flex text-break">
                        <p class="col fw-bold mw-25 mw-sm-30 me-2">Описание</p>
                        <p class="col"><?php echo $row['description']; ?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <form action="add-tag.php?material_id=<?php echo $_GET['id']; ?>" method="POST">
                        <h3>Теги</h3>
                        <div class="input-group mb-3">
                            <select class="form-select" id="selectAddTag" name="tag_id" required>
                                <option value="" disabled selected>Выберите тег</option>
                                <?php
                                    $stmt = $db->prepare("SELECT * FROM `tags` WHERE `id` NOT IN (SELECT `tag_id` FROM `material_tag` WHERE `material_id` = ?)") or die($stmt->error);
                                    $stmt->bind_param('i', $_GET['id']) or die($stmt->error);
                                    $stmt->execute() or die($stmt->error);
                                    $res = $stmt->get_result();
                                    while ($row = $res->fetch_assoc())
                                    {
                                    ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            <button class="btn btn-primary" type="submit">Добавить</button>
                        </div>
                    </form>
                    <ul class="list-group mb-4">
                        <?php
                        $stmt = $db->prepare("SELECT `tags`.`id`, `tags`.`name` FROM `material_tag` INNER JOIN `tags` ON `tags`.`id` = `material_tag`.`tag_id` WHERE `material_tag`.`material_id` = ?") or die($stmt->error);
                        $stmt->bind_param('i', $_GET['id']) or die($stmt->error);
                        $stmt->execute() or die($stmt->error);
                        $res = $stmt->get_result() or die($stmt->error);;
                        while ($row = $res->fetch_assoc())
                        {
                            $tag_id = $row['id'];
                            $material_id = $_GET['id'];
                            ?>
                            <li class="list-group-item list-group-item-action d-flex justify-content-between">
                                <a href="#" class="me-3">
                                    <?php echo $row['name']; ?>
                                </a>
                                <a href="<?php echo "remove-tag.php?tag_id=$tag_id&material_id=$material_id"; ?>"
                                    onclick="return confirm('Удалить тег?')" class="text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd"
                                            d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                </a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-between mb-3">
                        <h3>Ссылки</h3>
                        <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Добавить</a>
                    </div>
                    <ul class="list-group mb-4">
                        <?php
                        $stmt = $db->prepare("SELECT * FROM `material_link` WHERE `material_id` = ?") or die($stmt->error);
                        $stmt->bind_param('i', $_GET['id']) or die($stmt->error);
                        $stmt->execute() or die($stmt->error);
                        $res = $stmt->get_result() or die($stmt->error);
                        while ($row= $res->fetch_assoc())
                        {
                        ?>
                            <li class="list-group-item list-group-item-action d-flex justify-content-between">
                                <a href="<?php echo $row['link_url']; ?>" class="me-3">
                                    <?php
                                        echo empty($row['link_title']) ? $row['link_url'] : $row['link_title'];
                                    ?>
                                </a>
                                <span class="text-nowrap">
                                    <a href="<?php echo "edit-link.php?id=". $row['id'] . "&material_id=" . $_GET['id']; ?>" class="text-decoration-none me-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                    <a href="<?php echo "delete-link.php?id=". $row['id'] . "&material_id=" . $_GET['id']; ?>"
                                        onclick="return confirm('Удалить ссылку?')" class="text-decoration-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                            <path fill-rule="evenodd"
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                        </svg>
                                    </a>
                                </span>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer py-4 mt-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col text-muted">Test</div>
            </div>
        </div>
    </footer>

</div>

<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
     tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="<?php echo 'add-link.php?material_id='. $_GET['id']; ?>" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Добавить ссылку</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" placeholder="Добавьте подпись"
                           id="floatingModalSignature" name="title">
                    <label for="floatingModalSignature">Подпись</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>

                </div>
                <div class="form-floating mb-3">
                    <input type="url" class="form-control" placeholder="Добавьте ссылку" id="floatingModalLink" name="url" required>
                    <label for="floatingModalLink">Ссылка</label>
                    <div class="invalid-feedback">
                        Пожалуйста, заполните поле
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Добавить</button>
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Закрыть</button>
            </div>
        </form>
    </div>
</div>
<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>
</html>