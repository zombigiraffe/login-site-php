<?php

session_start();

if (isset($_SESSION["user_id"])){

    $conn = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

            $result = $conn->query($sql);

            $user = $result->fetch_assoc();
}

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="">
</head>

<body>
    <h1>Home</h1>

    <?php if(isset($user)): ?>

        <p>Hello <?= htmlspecialchars($user["name"]) ?></p>

        <p><a href="logout.php">Log out</a></p>

        <?php else: ?>

            <p><a href="login.php">Log in</a> or <a href="signup.html">sign up</a></p>

            <?php endif; ?>

</body>
</html>