<html>
<head>
    <meta charset="UTF-8">
    <title>Поиск</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/search.css">
</head>
<body>
    <?php
    require_once '../static/header.php';
    require_once 'connect.php';
    ?>
    <h1>Поиск пользователя</h1>

    <form method="post">
        <label>Введите номер пользователя</label>
        <input type="text" name="phone_number">
        <input class="btn" type="submit">
    </form>


    <?php

    if (isset($_POST['phone_number'])){
        $phone_number = strip_tags($_POST['phone_number']);

        $select_query = "select * from user where phone_number = '$phone_number'";
        $select_result = mysqli_query($mysqli, $select_query);
        if ($select_result) {
             while ($row = mysqli_fetch_assoc($select_result)){
                ?>
                     <div>
                         <h2><?=$row['username']?></h2>
                         <p>Баланс: <?=$row['balance']?></p>
                         <p>Номер паспорта: <?=$row['passport_number']?></p>
                         <p>Серия паспорта: <?=$row['passport_series']?></p>
                         <p>Номер телефона: <?=$row['phone_number']?></p>
                         <?php
                         $service_list_query = "select service_name from service where service_id = 
                                       (select service_id from services_users where user_id = '$row[user_id]')";
                         $service_list = mysqli_fetch_assoc(mysqli_query($mysqli, $service_list_query));

                         if ($service_list){
                             ?>
                                 <br>
                             <ul>Список услуг пользователя
                                 <?php
                                 foreach ($service_list as $service) {
                                     ?>
                                     <li><?=$service?></li>
                                     <?php
                                 }
                                 ?>
                             </ul>
                             <?php
                         }
                         else echo 'У пользователя нет подключенных услуг';
                         ?>
                     </div>
                 <?php
             }
        }

        else {
            ?>
            <h2>Такого пользователя нет</h2>
    <?php
        }
    }
    ?>
</body>
</html>
