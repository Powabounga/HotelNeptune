<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
    ?>
    <form action="../controllers/Users.php" method="POST">
        <input type="hidden" name="type" value="update">
        <input type="hidden" name="userId" value="<?php echo $queries['userId']; ?>">

        <label>
            Full name

            <input type="text" name="username" placeholder="Full name..." value="<?php echo $queries['username']; ?>">
        </label>

        <label>
            Email

            <input type="email" name="userEmail" placeholder="Email" value="<?php echo $queries['userEmail']; ?>">
        </label>


        <label>
            Username

            <input type="text" name="userUid" placeholder="username" value="<?php echo $queries['userUid']; ?>">
        </label>

        <label>
            Admin

            <input type="number" name="admin" min="0" max="1" value="<?php echo $queries['admin']; ?>">
        </label>

        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>