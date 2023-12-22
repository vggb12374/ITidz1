<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Блог</title>
    <style>
        body {
            background-color: burlywood;
        }

        h1 {
            text-align: center;
        }

        #form1{
            position: fixed;
            top: 7px;
            right: 10px;
        }

        #exit{
            height: 25px;
            border-radius: 14px;
            cursor: pointer;
            background-color: aqua;
        }

        #addpost {
            height: 25px;
            border-radius: 14px;
            cursor: pointer;
            background-color: aqua;
        }

        div {
            display: flex;
            justify-content: center;
        }

        #inputpost {
            width: 100%;
            height: 25px;
            border-radius: 14px;
            background-color: lightyellow;
            outline: 0;
        }

        pre {
            border-radius: 8px;
            background-color: springgreen;
            border: 2px solid;
        }
    </style>
</head>
<body>
    <h1>Блог</h1>
    <form action="" method="post" id="form1">
        <input type="submit" name="exit" id="exit" value="Вийти">
    </form>
    <?php
    session_start();
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "<h4>Вітаємо, $username!</h4>";
        if (file_exists($username)) {
            chdir($username);
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["exit"])) {
            session_destroy();
            header('Location: index.php');
            exit();
        }
    }
    ?>
    <form action="" method="post">
        <input type="submit" name="addpost" id="addpost" value="Додати пост">
        <br>
        <br>
        <div>
            <input type="text" name="inputpost" id="inputpost" required>
        </div>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["addpost"])) {
            $inputpost = $_POST["inputpost"];
            if (ctype_space($inputpost)) {
                echo "<br>Неможливо додати порожній пост!";
            }
            else {
                date_default_timezone_set('Europe/Kiev');
                $filePost = "\n" . date('d.m.Y H:i:s') . " - $inputpost\n";
                file_put_contents('posts.txt', $filePost, FILE_APPEND);
                header('Location: index3.php');
                exit();
            }
        }
    }
    echo "<h3>Пости</h3>";
    error_reporting(0);
    $posts = file_get_contents('posts.txt');
        if (!empty($posts)) {
            echo "<pre>$posts</pre>";
        }
        else {
            echo "Постів ще не було!";
        }
    ?>
</body>
</html>