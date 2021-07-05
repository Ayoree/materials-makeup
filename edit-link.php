<?php

require_once 'php/config.php';

if (!isset($_GET['material_id']) || empty($_GET['material_id'])
    || !isset($_GET['id']) || empty($_GET['id'])
) header('location: list-materials.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $db->prepare("UPDATE `material_link` SET `link_title` = ?, `link_url` = ? WHERE `id` = ?") or die("$stmt->error");
    $stmt->bind_param('ssi', $_POST['title'], $_POST['url'], $_GET['id']) or die("$stmt->error");
    $stmt->execute() or die("$stmt->error");
    header('location: view-material.php?id=' . $_GET['material_id']);
}

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
    <title>Категории</title>
</head>

<body>
    <div class="main-wrapper">
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                    <a class="navbar-brand" href="#">Test</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="list-materials.php">Материалы</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="list-tag.php">Теги</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="list-category.php">Категории</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container">
                <h1 class="my-md-5 my-4">Изменить ссылку</h1>
                <div class="row">
                    <div class="col-lg-5 col-md-8">
                        <?php
                        $title = '';
                        $url = '';
                        if (isset($_GET['id']) && strlen($_GET['id'] > 0)) {
                            $stmt = $db->prepare("SELECT `link_title`, `link_url` FROM `material_link` WHERE `id` = ?") or die("$stmt->error");
                            $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
                            $stmt->execute() or die("$stmt->error");;
                            $res = $stmt->get_result();
                            $row = $res->fetch_assoc();
                            $title = $row['link_title'];
                            $url = $row['link_url'];
                        }
                        ?>
                        <form action="<?php echo $_SERVER['PHP_SELF'] . "?material_id=" . $_GET['material_id'] . "&id=" . $_GET['id']; ?>"
                            method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Добавьте подпись" id="floatingModalSignature" name="title" value="<?php echo $title ?>">
                                <label for="floatingModalSignature">Подпись</label>
                                <div class="invalid-feedback">
                                    Пожалуйста, заполните поле
                                </div>

                            </div>
                            <div class="form-floating mb-3">
                                <input type="url" class="form-control" placeholder="Добавьте ссылку" id="floatingModalLink" name="url"  value="<?php echo $url ?>" required>
                                <label for="floatingModalLink">Ссылка</label>
                                <div class="invalid-feedback">
                                    Пожалуйста, заполните поле
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Изменить</button>
                        </form>
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
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>