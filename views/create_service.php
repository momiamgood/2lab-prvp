<html>
<head>
    <meta charset="UTF-8">
    <title>Создание услуги</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/create_service.css">
</head>
<body>
    <?php
    require_once '../static/header.php';
    require_once 'connect.php';
    ?>

    <h1>Добавление услуги в базу данных</h1>
    <form method="post">
        <label>Название услуги</label>
        <input type="text" name="service_name">
        <label>Стоимость услуги</label>
        <input type="text" name="price">
        <input  class="btn" type="submit">
    </form>

    <?php
    if (isset($_POST['service_name'])) {

        $service_name = strip_tags($_POST['service_name']);
        $price = strip_tags($_POST['price']);

        // Внесение данных об услуге в БД

        $insert_query = "insert into service(service_name, price) values ('$service_name', '$price')";

        if (mysqli_query($mysqli, $insert_query)){
            ?>
            <h2>Услуга "<?=$service_name?>" успешно добавлена!</h2>
            <?php
        }
    }
    ?>
</body>
</html>
