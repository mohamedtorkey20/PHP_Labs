<?php
require 'vendor/autoload.php';

$DB = new MySQLHandler();

$page = isset($_GET['page']) ? $_GET['page'] : 1; 

$limit = 5; 

$offset = ($page - 1) * $limit; 
 

if (isset($_POST['show_all'])) {
    $users=$DB->get_data(0,0);

} elseif (isset($_POST["search"])) {
    $value = $_POST["search_term"];
      $users=$DB->search_by_column('product_name', $value);
} else {
    $users=$DB->get_data($offset,$limit);

}

$totalPages = ceil(Items::count() / $limit); 




?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data items</title>
    <link rel="stylesheet" href="views/bootstrap-5.3.3-dist/css/bootstrap.css">
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            font-size: 16px;
            line-height: 1.8;
            font-weight: normal;
            background: #2b3035; /* Background color */
            color: gray;
        }
    </style>
</head>
<body>
<section class="ftco-section">
    <div class="container">

        
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mt-5 mb-5">
                    <h2 class="heading-section">Data item</h2>
                </div>
            </div>
    
            <div class="row">
            <div class="col-12 col-md-3 col-lg-1 offset-2 ">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <form method="post">
                            <input type="submit" class="btn btn-outline-secondary" name="show_all" value="Show All">
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-3 col-lg-3 ">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <form method="post">
                            <a href=<?=__PATH_SERVER__."add.php"?> class="btn btn-outline-secondary">Add glass</a>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-3 col-lg-3 mx-lg-5 ">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <form  method="post">
                            <input type="submit" class="btn btn-outline-secondary" name="search" value="Search">
                    </div>
                    <input type="text" name="search_term" class="form-control" placeholder="Search by name" aria-label="" aria-describedby="basic-addon1">
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-9 offset-2">
                <div class="table-wrap">
                    <table class="table  rounded table-dark table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Item Details</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                           
                        foreach ($users as $user) {
                            ?>
                            <tr>
                                <th scope="row"><?= 1; ?></th>
                                <td><?= $user->id; ?></td>
                                <td><?= $user->product_name; ?></td>
                                <td><a href="<?= __PATH_SERVER__ ."details.php?id=" . $user->id?>">more</a></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="pagination justify-content-center">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?= $page - 1; ?>" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                                <li class="page-item <?= $page == $i ? 'active' : ''; ?>">
                                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                                </li>
                            <?php } ?>
                            <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                                <a class="page-link" href="?page=<?= $page + 1; ?>" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
