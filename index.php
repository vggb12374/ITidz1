<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Логін</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
            background-color: burlywood;
        }

        .div1 {
            display: flex;
            width: 100%;
            justify-content: center;
            height: 120px;
            align-items: center;
            
        }

        #form1 {
            padding: 20px;
            width: 220px;
            border: 1px;
            border-style: solid;
            border-radius: 15px;
            background-color: springgreen;
        }

        #username {
            height: 20px;
            border-radius: 9px;
            background-color: lightyellow;
            outline: 0;
        }

        #password {
            height: 20px;
            border-radius: 9px;
            background-color: lightyellow;
            outline: 0;
        }

        #login {
            position: relative;
            top: 10px;
            width: 100px;
            height: 25px;
            border-radius: 14px;
            cursor: pointer;
            background-color: aqua;
        }

        .div2 {
            position: fixed;
            bottom: 40px;
            display: flex;
            width: 100%;
            justify-content: center;
            font-weight: bold;
        }

        #form2 {
            position: fixed;
            bottom: 10px;
            display: flex;
            width: 100%;
            justify-content: center;
        }

        #register {
            height: 25px;
            border-radius: 14px;
            cursor: pointer;
            background-color: aqua;
        }
    </style>
</head>
<body>
    <h1>Блог</h1>
    <h4>Для переходу на сайт, будь ласка, увійдіть!</h4>
    <br>
    <div class="div1">
        <form action="" method="post" id="form1">
            <label for="username">Ім'я користувача:</label>
            <br>
            <input type="text" name="username" id="username" required>
            <br>
            <label for="password">Пароль:</label>
            <br>
            <input type="password" name="password" id="password" required>
            <br>
            <input type="submit" name="login" id="login" value="Увійти">
        </form>
    </div>
    <br>
    <br>
    <div class="div2">Немає аккаунту? Зареєструйтеся!</div>
    <form action="" method="post" id="form2">
        <input type="submit" name="register" id="register" value="Зареєструватися">
    </form>
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["register"])) {
            header('Location: index2.php');
            exit();
        }

        if (isset($_POST["login"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if (isset($username) && isset($password)) {
                if (file_exists($username)) {
                    chdir($username);
                    $fileName = "$username.txt";
                    if (file_exists($fileName)) {
                        $filePassword = file_get_contents($fileName);
                        if ($filePassword == $password) {
                            $_SESSION['username'] = $username;
                            header('Location: index3.php');
                            exit();
                        }
                        else {
                            echo "Логін або пароль неправильний!";
                        }
                    }
                }
                else {
                    echo "Логін або пароль неправильний!";
                }
            }
        }
    }
    ?>
</body>
</html>