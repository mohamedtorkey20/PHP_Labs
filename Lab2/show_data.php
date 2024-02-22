
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require_once "vendor/autoload.php";

$data = file("data_text.txt");
?>
<table >
    <tr>
        <th>Date</th>
        <th>IP Address</th>
        <th>Email</th>
        <th>Name</th>
    </tr>
    <?php foreach($data as $data_User): ?>
        <?php $inf = explode(",", $data_User); ?>
        <tr>
            <td><?= $inf[0] ?></td>
            <td><?= $inf[1] ?></td>
            <td><?= $inf[2] ?></td>
            <td><?= $inf[3] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>


