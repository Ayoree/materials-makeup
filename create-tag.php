<?php

require_once 'php/config.php';

$name_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && strlen($_POST['name']) > 0) {
        // изменение имеющегося тега если задан get['id']
        if (isset($_GET['id'])) {
            $stmt = $db->prepare("UPDATE `tags` SET `name` = ? WHERE `id` = ?") or die("$stmt->error");
            $stmt->bind_param('si', $_POST['name'], $_GET['id']) or die("$stmt->error");;
            $stmt->execute() or die("$stmt->error");
            $stmt->close();
        }
        // добавление
        else {
            $stmt = $db->prepare("INSERT INTO `tags` (`id`, `name`) VALUES (NULL, ?)") or die("$stmt->error");
            $stmt->bind_param('s', $_POST['name']) or die("$stmt->error");
            $stmt->execute() or die("$stmt->error");
            $stmt->close();
        }
        header('location: list-tag.php');
    }
    else $name_err = 'Введите название категории';
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-utilities.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Теги</title>
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
            <h1 class="my-md-5 my-4"> <?php echo isset($_GET['id']) ? 'Изменить тег' : 'Добавить тег' ?></h1>
            <div class="row">
                <div class="col-lg-5 col-md-8">
                    <?php // получение имеющегося названия если меняем тег
                        $name = '';
                        if (isset($_GET['id']) && strlen($_GET['id'] > 0)) {
                            $stmt = $db->prepare("SELECT `name` FROM `tags` WHERE `id` = ?") or die("$stmt->error");
                            $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
                            $stmt->execute();
                            $res = $stmt->get_result();
                            $name = $res->fetch_row()[0];
                        }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF'] . (isset($_GET['id']) ? ('?id='.$_GET['id']) : ''); ?>" method="POST">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Напишите название" id="floatingName" name="name" required value="<?php echo $name; ?>">
                            <label for="floatingName">Название</label>
                            <div class="invalid-feedback" <?php if (strlen($name_err) != 0) echo "style='display:block;'" ?>>
                                <?php echo $name_err; ?>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit"><?php echo isset($_GET['id']) ? 'Изменить' : 'Добавить'?></button>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>

</body>
</html>