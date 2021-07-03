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
        <div class="container">
            <h1 class="my-md-5 my-4">Добавить материал</h1>
            <div class="row">
                <div class="col-lg-5 col-md-8">
                    <form>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelectType">
                                <option selected>Выберите тип</option>
                                <option value="0">Книга</option>
                                <option value="1">Статья</option>
                                <option value="2">Видео</option>
                                <option value="3">Сайт/Блог</option>
                                <option value="3">Подборка</option>
                                <option value="3">Ключевые идеи книги</option>
                            </select>
                            <label for="floatingSelectType">Тип</label>
                            <div class="invalid-feedback">
                                Пожалуйста, выберите значение
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select class="form-select" id="floatingSelectCategory">
                                <option selected>Выберите категорию</option>
                                <option value="0">Деловые/Бизнес-процессы</option>
                                <option value="1">Деловые/Найм</option>
                                <option value="2">Деловые/Реклама</option>
                                <option value="3">Деловые/Управление бизнесом</option>
                                <option value="4">Деловые/Управление людьми</option>
                                <option value="5">Деловые/Управление проектами</option>
                                <option value="6">Детские/Воспитание</option>
                                <option value="7">Дизайн/Общее</option>
                                <option value="8">Дизайн/Logo</option>
                                <option value="9">Дизайн/Web дизайн</option>
                                <option value="10">Разработка/PHP</option>
                                <option value="11">Разработка/HTML и CSS</option>
                                <option value="12">Разработка/Проектирование</option>
                            </select>
                            <label for="floatingSelectCategory">Категория</label>
                            <div class="invalid-feedback">
                                Пожалуйста, выберите значение
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Напишите название" id="floatingName">
                            <label for="floatingName">Название</label>
                            <div class="invalid-feedback">
                                Пожалуйста, заполните поле
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="Напишите авторов" id="floatingAuthor">
                            <label for="floatingAuthor">Авторы</label>
                            <div class="invalid-feedback">
                                Пожалуйста, заполните поле
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Напишите краткое описание" id="floatingDescription"
                              style="height: 100px"></textarea>
                            <label for="floatingDescription">Описание</label>
                            <div class="invalid-feedback">
                                Пожалуйста, заполните поле
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Добавить</button>
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