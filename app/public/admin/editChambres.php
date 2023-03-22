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
    <form action="../controllers/Chambres.php" method="POST">
        <input type="hidden" name="type" value="update">
        <input type="hidden" name="chambresId" value="<?php echo $queries['chambresId']; ?>">

        <label>
            Prix

            <input type="number" name="prix" value="<?php echo $queries['prix']; ?>">
        </label>

        <label>
            Photo

            <input type="text" name="photo" value="<?php echo $queries['photo']; ?>">
        </label>

        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>