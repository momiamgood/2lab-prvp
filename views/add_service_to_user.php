<?php
require_once '../static/header.php';
require_once 'connect.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавление услуги к пользователю</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../styles/add_service_to_user.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
    <body>
        <div>
            <h1>Добавление услуги к пользоавтелю</h1>
                <form method="post">
                    <label>Введите номер пользователя</label>
                    <input class="txt-input" type="text" name="phone_number">
                    <b><p>Услуги</p></b>
                        <?php
                        $select_query = "select * from service";
                        $service_list_res = mysqli_query($mysqli, $select_query);
                        while ($row = mysqli_fetch_assoc($service_list_res)) {
                            ?>
                            <label for="service" class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="services[]" id="service" value="<?=$row['service_name']?>">
                                <?=$row['service_name']?>
                            </label>
                        <?php
                        }
                        ?>
                    <input type="submit">
                </form>
            <?php
            $query = "SELECT * FROM `user` inner join `services_users` on user.user_id = services_users.user_id WHERE user.user_id = services_users.user_id";
            $res = mysqli_query($mysqli, $query);
            $numrows = mysqli_num_rows($res);
            if ($numrows){
                if ($numrows != 0) {
                    echo 'У пользователя уже подключена эта услуга';
                }
                else {
                    if (isset($_POST['phone_number']) && isset($_POST['services'])){
                        $phone_number = strip_tags($_POST['phone_number']);
                        $service_name = $_POST['services'];


                        foreach ($service_name as $service) {
                            $query = "INSERT INTO services_users (user_id, service_id) VALUES ((select user_id from user where phone_number = '$phone_number'), 
                                                                               (select service_id from service where service_name = '$service'))";
                            $insert_res = mysqli_query($mysqli, $query);
                        }
                        $username = mysqli_fetch_assoc(mysqli_query($mysqli, "select username from user where phone_number = '$phone_number'"));

                        if ($insert_res) {
                            ?>
                            <h2>Пользователю <?=$username['username']; ?> добавлены услуги:</h2>
                            <?php
                            foreach ($service_name as $service){
                                ?>
                                <p><?= $service?></p>
                                <?php
                            }
                            ?>
                            <?php
                        }
                    }
                }
            }
            ?>
        </div>
    </body>
</html>



