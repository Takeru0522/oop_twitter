<?php
session_start();
if(isset($_SESSION['user']))
{
    $curretUser = $_SESSION['user'];
    $email = $_SESSION['user']['email'];
} else {
    $currentUser = Null;
}


require_once('Models/Task.php');
require_once('function.php');

$task = new Task();
// $title = null;

if (isset($_GET['contents'])) {
    $contents = $_GET['contents'];
    $tasks = $task->findByContents(["%$contents%"]);
} else {
    $tasks = $task->getAll();
}
// $tasks = $task->findByTitle(["%title%"]);
// $title = $_GET['title'];
// var_dump($task)
// $el = $task->search('Test');
// var_dump($el);

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
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-dark bg-dark">
                    <a href="index.php" class="navbar-brand">Todo</a>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="create.php">Create</a>
                        </li>
                        
                        <!-- ユーザーがサインインしている時とそうでない時で表示内容を変える -->
                        <?php
                        if(isset($curretUser))
                        {
                            echo 
                            '<li class="nav-item">
                                <a class="nav-link text-light" href="signout.php">Sign out</a>
                            </li>';
                        } else {
                            echo 
                            '
                            <li class="nav-item">
                                <a class="nav-link text-light" href="signupform.php">Sign up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-light" href="signinform.php">Sign in</a>
                            </li>';
                        }
                        
                        ?>
                        
                        <li class="nav-item">
                                <p class="nav-link text-light">
                                    <a href="userpage.php">
                                <?php
                                if(isset($email)) 
                                {
                                    echo $email;
                                }
                                ?>
                                    </a>
                                </p>
                        </li>

                        
                        </li>
                        <li class="nav-item">
                            <!-- Serach -->
                            <form class="form-inline" method="get">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="contents">
                                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </li>
                    </ul>

                </nav>
            </div>
        </div>

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