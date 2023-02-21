<html>
<head>
    <meta charset="UTF-8">
    <title>Показать всех пользователей</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/show_all.css">
</head>
    <body>
    <?php
        require_once '../static/header.php';
        require_once 'connect.php';
     ?>

    <h1>Вывод всех пользователей</h1>

    <?php

    $select_query = "select * from user";
    $select_result = mysqli_query($mysqli, $select_query);

    if (isset($_GET)) {
        $del_user = $_GET['user_id'];
        $delete_query = "delete from user where user_id = '$del_user'";
        $del_res = mysqli_query($mysqli, $delete_query);
        if ($del_res) {
            header('show_all.php');
        } else echo "Ошибка";
    }

    if ($select_result) {
        while ($row = mysqli_fetch_assoc($select_result)){
            ?>
                <div>
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
                        </ul>
                    </div>
                    <div class="btn-cntr">
                        <a class="delete_btn" href="?user_id=<?=$row['user_id']?>">Удалить</a>
                    </div>
                </div>
            <?php
        }
    }
    ?>
</body>
</html>