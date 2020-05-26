            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="input-group">
                            <input name = "text" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button name = "search" class="btn btn-default" type="search">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form> <!--search form -->
                    <!-- /.input-group -->
                </div>

                <!-- Login -->
                <div class="well">
                    <h4>Login</h4>
                    <form action="includes/login.php" method="post">
                        <div class="form-group">
                            <!-- <label for="username">Username</label> -->
                            <input name = "username" type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="input-group">
                            <!-- <label for="password">Password</label> -->
                            <input name = "password" type="password" class="form-control" placeholder="Password">

                            <span class="input-group-btn">
                                <button name = "login" class="btn btn-primary" type="submit">Login</button>
                            </span>

                        </div>
                    </form> <!--search form -->
                    <!-- /.input-group -->
                </div>





                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">

                                <?php
                            
                                    $query = "SELECT * FROM categories LIMIT 3";
                                    $category_select = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_assoc($category_select)){

                                        $id = $row['id'];
                                        $title = $row['title'];
                                        echo "<li><a href='category.php?category=$id'>{$title}</a></li>";

                                    }                    
                                    
                                ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <?php include "widget.php"; ?>

            </div>