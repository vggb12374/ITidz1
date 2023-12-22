<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Реєстрація</title>
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

        #register {
            position: relative;
            top: 10px;
            height: 25px;
            border-radius: 14px;
            cursor: pointer;
            background-color: aqua;
        }

        #form2 {
            position: fixed;
            bottom: 10px;
            display: flex;
            width: 100%;
            justify-content: center;
        }

        #exit {
            height: 25px;
            border-radius: 14px;
            cursor: pointer;
            background-color: aqua;
        }
    </style>
</head>
<body>
<h1>Блог</h1>
    <h4>Створення нового аккаунту:</h4>
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
            <input type="submit" name="register" id="register" value="Зареєструватися">
        </form>
    </div>
    <br>
    <br>
    <form action="" method="post" id="form2">
        <input type="submit" name="exit" id="exit" value="Назад до входу">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["register"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if (isset($username) && isset($password)) {
                if (ctype_space($username)) {
                    echo "Неправильне ім'я користувача!";
                }
                else {
                    if (strpos($username, " ") === 0) {
                        echo "Неправильне ім'я користувача!";
                    }
                    else {
                        $fileName = "$username.txt";
                        if (file_exists($username)) {
                            chdir($username);
                            if (file_exists($fileName)) {
                            echo "Користувач із таким ім'ям вже зареєстрований!";
                            }
                        }
                        else {
                            mkdir($username);
                            chdir($username);
                            file_put_contents($fileName, $password, FILE_APPEND);
                            echo "Ви успішно зареєстувалися!";
                            header('refresh:2;url=index.php');
                            exit();
                        }
                    }
                }
            }
        }

        if (isset($_POST["exit"])) {
            header('Location: index.php');
            exit();
        }
    }
    ?>
</body>
</html>