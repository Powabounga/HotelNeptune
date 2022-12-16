<?php
require_once '../helpers/session_helper.php';
include_once '../models/User.php';


if (!isset($_SESSION['admin'])) {
    redirect('/index.php');
}

if (!$_SESSION['admin']) {
    redirect('/index.php');
}

$model = new User;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="../global.css">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
            <th>Chambre PHOTO</th>
            <th>Chambres Id</th>
            <th>Type Chambre</th>
            <th>Prix</th>
        </tr>
        <?php foreach ($model->getAllChambres() as $key => $chambre) : ?>
        <tr>
            <td><img src="<?php echo ($chambre->photo); ?>" alt="chambre photo"></td>
            <td><?php echo ($chambre->chambresId); ?></td>
            <td><?php echo ($chambre->type_chambre); ?></td>
            <td><?php echo ($chambre->prix); ?></td>
            <?php
                echo ("<td><a href=\"/admin/editChambres.php?chambresId=$chambre->chambresId&prix=$chambre->prix&photo=$chambre->photo\">Edit</a></td>")
                ?>
        </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>