    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./">CMS PROJECT</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                   

                    <?php
                  
                        $query = "SELECT * FROM categories";
                        $category = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($category)){

                            $id = $row['id'];
                            $title = $row['title'];

                            $cat_class = '';                            

                            if(isset($_GET['category']) && $_GET['category'] == $id ){

                                $cat_class = 'active';

                            }
                            

                            echo "<li class = '{$cat_class}'><a href='./category.php?category={$id}'>{$title}</a></li>";

                        }
                        
                        $reg_class = '';
                        $reg_name = 'registration.php';
                        $pageName = basename($_SERVER['PHP_SELF']);

                        if($pageName == $reg_name){

                            $reg_class = 'active';

                        }
                    
                    ?>

                    <li>
                        <a href="admin">Admin</a>
                    </li>

                    <li class="<?php echo $reg_class; ?>">
                        <a href="registration.php">Register</a>
                    </li>
                    <!-- <li>
                        <a href="#">Services</a>
                    </li> -->

                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
