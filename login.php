<?php

$is_invalid = false;

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $conn = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM user
            WHERE email = '%s'",
            $conn->real_escape_string($_POST["email"]));

            $result = $conn->query($sql);

            $user = $result->fetch_assoc();

            if($user){
                if (password_verify($_POST["password"], $user["password_hash"])){

                    session_start();

                    session_regenerate_id();

                    $_SESSION["user_id"] = $user["id"];

                    header("Location: index.php");
                    exit;
                };
            }
            $is_invalid = true;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="">
</head>

<body>
    <h1>Login</h1>

    <?php if($is_invalid): ?>
        <em>invalid Login</em>
        <?php endif; ?>

    <form method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email" value="<?php htmlspecialchars($_POST["email"] ?? "") ?>"
        <label for="password">password</label>
        <input type="password" name="password" id="password">
        <button>Log in</button>
    </form>

</body>
</html>