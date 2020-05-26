    <!-- import header function -->
    <?php include "includes/header.php"; ?>

    <!-- import nav function -->
    <?php include "includes/nav.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
        
            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php
                
                    if(isset($_GET['page'])){

                        $page = $_GET['page'];
            
                    }else{
            
                        $page = "";
            
                    }
            
                    if($page == "" || $page == 1){
            
                        $pager = 0;
                    
                    }else {
            
                        $pager = ($page * 5) - 5;
            
                    }

                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'){

                        $count_query = "SELECT * FROM posts";

                    }else{
                    
                        $count_query = "SELECT * FROM posts WHERE status = 'Published' ";
                        
                    }
            
                    $post_count = mysqli_query($connection, $count_query);
                    $count = mysqli_num_rows($post_count);

                    $count = ceil($count / 5);

                    if($count < 1){

                        echo "<h1 class='text-center'>No Post Available</h1>";

                    }else{

                        if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'){

                            $query = "SELECT * FROM posts LIMIT $pager, 5";
    
                        }else{
                        
                            $query = "SELECT * FROM posts WHERE status = 'Published' LIMIT $pager, 5";
                            
                        }

                        
                        $posts = mysqli_query($connection, $query);

                        while($post = mysqli_fetch_assoc($posts)){
                            
                            $id = $post['id'];
                            $title = $post['title'];
                            $author = $post['author'];
                            $date = $post['date'];
                            $content = substr($post['content'], 0, 100);
                            $image = $post['image'];

                ?>

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?post_id=<?php echo $id; ?>"><?php echo $title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="user_posts.php?author=<?php echo $author; ?>"><?php echo $author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $date; ?> </p>
                <hr>
                <a href="post.php?post_id=<?php echo $id; ?>">
                
                    <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">

                </a>
                
                <hr>
                <p> <?php echo $content ?>... </p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
                <?php    

                    }
                }

                ?>  

                <!-- Pager -->
                <ul class="pager">
                   
                   <?php
                   
                        for($i = 1; $i <= $count; $i++) {
                        
                            if($i == $page){
                                
                                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";

                            }else{

                                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";

                            }
                            
                        }
                                          
                   ?>
                
                </ul>          

            </div>

        <!-- importing side widget function -->
        <?php include "includes/sidewidget.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php

    include "includes/footer.php";

?>