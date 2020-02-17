<?php 
    if(isset($_SESSION['user']))
    {
        $curretUser = $_SESSION['user'];
        $email = $_SESSION['user']['email'];
    } else {
        $currentUser = Null;
    }
?>

<div class="row">
            <div class="col-12">
                <nav class="navbar navbar-dark bg-dark">
                    <a href="index.php" class="navbar-brand">Todo</a>
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link text-light" href="create.php">Create</a>
                        </li>
                        

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
                                <?php
                                if($email) 
                                {
                                    echo $email;
                                }
                                ?>
                                </p>
                        </li>

                        
                        </li>
                        <li class="nav-item">
                            <!-- Serach -->
                            <form class="form-inline" method="get">
                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="title">
                                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </li>
                    </ul>

                </nav>
            </div>
        </div>