<html>
    <head>
        <title>Создание пользователя</title>
        <link rel="stylesheet" href="../styles/create_user.css">
    </head>
<body>
    <?php
    require_once '../static/header.php';
    require_once 'connect.php';
    ?>

    <h1>Создание пользователя</h1>

    <form method="post">
        <label>ФИО</label>
        <input type="text" name="username">
        <label>Баланс</label>
        <input type="text" name="balance">
        <label>Номер телефона</label>
        <input type="text" name="phone_number">
        <label>Номер паспорта</label>
        <input type="text" name="passpost_number">
        <label>Серия паспорта</label>
        <input type="text" name="passport_series">
        <label>Пароль</label>
        <input type="text" name="password">
        <input class="btn" type="submit">
    </form>

    <?php

    if (isset($_POST['phone_number'])) {

        $username = strip_tags($_POST['username']);
        $balance = strip_tags($_POST['balance']);
        $phone_number = strip_tags($_POST['phone_number']);
        $passport_number = strip_tags($_POST['passpost_number']);
        $passport_series = strip_tags($_POST['passport_series']);
        $password = strip_tags($_POST['password']);

    // Внесение данных о пользователе в БД

        $insert_query = "insert into user(username, 
                     balance, 
                     phone_number, 
                     passport_number, 
                     passport_series, 
                     password) values ('$username', '$balance', 
                                       '$phone_number',
                                       '$passport_number', 
                                       '$passport_series', 
                                       '$password')";


        if (mysqli_query($mysqli, $insert_query)){
            ?>
            <h2>Пользователь <?=$username?> успешно добавлен!</h2>
            <?php
        } else {
            echo "error;";
        }

        $select_user = mysqli_query($mysqli, "select * from user where phone_number = '$phone_number'");

    }

    ?>
</body>
</html>
