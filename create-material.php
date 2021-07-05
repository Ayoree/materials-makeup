<?php
require_once 'php/config.php';

$type_err = '';
$category_err = '';
$name_err = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && strlen($_POST['name']) > 0) {
        if (isset($_POST['type'])) {
            if (isset($_POST['category'])) {
                // изменение имеющегося материала если задан get['id']
                if (isset($_GET['id']) && strlen($_GET['id']) != 0) {
                    $stmt = $db->prepare("UPDATE `materials` SET `type` = ?, `category` = ?, `name` = ?, `author` = ?, `description` = ? WHERE `id` = ?") or die("$stmt->error");
                    $stmt->bind_param('iisssi', $_POST['type'], $_POST['category'], $_POST['name'], $_POST['author'], $_POST['description'], $_GET['id']) or die("$stmt->error");
                    $stmt->execute() or die("$stmt->error");
                    $stmt->close();
                }
                // добавление
                else {
                    $stmt = $db->prepare("INSERT INTO `materials` (`id`, `type`, `category`, `name`, `author`, `description`) VALUES (NULL, ?, ?, ?, ?, ?)") or die("$stmt->error");
                    $stmt->bind_param('iisss', $_POST['type'], $_POST['category'], $_POST['name'], $_POST['author'], $_POST['description']) or die("$stmt->error");
                    $stmt->execute() or die("$stmt->error");
                    $stmt->close();
                }
                header('location: list-materials.php');
                }
            else $category_err = 'Выберите корректную категорию';
        }
        else $type_err = 'Выберите корректый тип';
    }
    else $name_err = 'Введите название материала';
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
            <h1 class="my-md-5 my-4"><?php echo isset($_GET['id']) && strlen($_GET['id']) != 0 ? 'Изменить материал' : 'Добавить материал' ?></h1>
            <div class="row">
                <div class="col-lg-5 col-md-8">
                    <?php // получение информации о материале если меняем его
                        $type = '';
                        $category = '';
                        $name = '';
                        $author = '';
                        $description = '';
                        if (isset($_GET['id']) && strlen($_GET['id'] > 0)) {
                            $stmt = $db->prepare("SELECT * FROM `materials` WHERE `id` = ?") or die("$stmt->error");
                            $stmt->bind_param('i', $_GET['id']) or die("$stmt->error");
                            $stmt->execute() or die("$stmt->error");;
                            $res = $stmt->get_result();
                            $row = $res->fetch_assoc();
                            $type = $row['type'];
                            $category = $row['category'];
                            $name = $row['name'];
                            $author = $row['author'];
                            $description = $row['description'];
                        }
                    ?>
                    <form action="<?php echo $_SERVER['PHP_SELF'] . (isset($_GET['id']) ? ('?id='.$_GET['id']) : ''); ?>" method="POST">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelectType" name="type" required>
                                <option value="" disabled <?php if (empty($type)) echo 'selected' ?>>Выберите тип</option>
                                <?php
                                    $len = count($types);
                                    for ($i = 1; $i <= $len; $i++)
                                    {
                                    ?>
                                        <option value="<?php echo $i; ?>"
                                            <?php if (!empty($type) && intval($type) == $i) echo 'selected'; ?>>
                                            <?php echo $types[$i - 1]; ?>
                                        </option>
                                    <?php
                                    }
                                ?>
                            </select>
                            <label for="floatingSelectType">Тип</label>
                            <div class="invalid-feedback" <?php if (strlen($type_err) != 0) echo "style='display:block;'" ?>>
                                <?php echo $type_err; ?>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelectCategory" name="category" required>
                                <option value="" disabled <?php if (empty($category)) echo 'selected' ?>>Выберите категорию</option>
                                <?php
                                    $query = $db->query("SELECT * FROM `categories`");
                                    while ($row = $query->fetch_assoc())
                                    {
                                    ?>
                                        <option value="<?php echo $row['id']; ?>"
                                            <?php if (!empty($category) && intval($category) == $row['id']) echo ' selected'; ?>>
                                            <?php echo $row['name']; ?>
                                        </option>
                                    <?php
                                    }
                                ?>
                            </select>
                            <label for="floatingSelectCategory">Категория</label>
                            <div class="invalid-feedback" <?php if (strlen($category_err) != 0) echo "style='display:block;'" ?>>
                                <?php echo $category_err; ?>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Напишите название" id="floatingName" name="name" required value="<?php if(!empty($name)) echo $name; ?>">
                            <label for="floatingName">Название</label>
                            <div class="invalid-feedback" <?php if (strlen($name_err) != 0) echo "style='display:block;'" ?>>
                                <?php echo $name_err; ?>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Напишите авторов" id="floatingAuthor" name="author" value="<?php if(!empty($author)) echo $author; ?>">
                            <label for="floatingAuthor">Авторы</label>
                        </div>
                        <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Напишите краткое описание" id="floatingDescription"
                              style="height: 100px" name="description"><?php if(!empty($description)) echo $description; ?></textarea>
                            <label for="floatingDescription">Описание</label>
                        </div>
                        <button class="btn btn-primary" type="submit"><?php echo isset($_GET['id']) && strlen($_GET['id']) != 0 ? 'Изменить' : 'Добавить' ?></button>
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