<?php 
require_once('Models/Task.php');
require_once('function.php');
session_start();
$task = new Task();
// var_dump($_SESSION['user']);die;
$username = $_SESSION['user']['username'];
// var_dump($username);die;
$tasks = $task->getUserTweets([$username]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Todoアプリ</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>

<body>
    <div class="container-fulid">
        <?php include "includes/header.php"; ?>

        <div class="row p-3">
            <?php foreach ($tasks as $task) : ?>
                <div class="col-sm-6 col-md-4 col-lg-3 py-3 py-3">
                    <div class="card">
                        <!-- <img src="https://picsum.photos/200" class="card-img-top" alt="..."> -->
                        <div class="card-body">
                            <h5 class="card-title"><?= h($task["tweetedBy"]); ?></h5>
                            <p class="card-text">
                                <?= h($task["contents"]); ?>
                            </p>
                            <div class="text-right d-flex justify-content-end">
                                <a href="edit.php?id=<?= h($task['id']); ?>" class="btn text-success">EDIT</a>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= h($task['id']); ?>">
                                    <button type="submit" class="btn text-danger">DELETE</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


</body>

</html>