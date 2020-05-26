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
                
                    if(isset($_POST['search'])){
            
                        $text = $_POST['text'];
                        // echo $text;
                
                        $query = "SELECT * FROM posts WHERE tags LIKE '%$text%'";
                        $search = mysqli_query($connection, $query);
                
                        if(!$search){
                
                            die("Query failed!" .mysqli_error($connection));
                
                        }
                
                        $count = mysqli_num_rows($search);
                
                        if($count == 0){
                            
                            echo '<h1>No results found</h1>';
                
                        }else{
                            // $query = "SELECT * FROM posts WHERE";
                            // $posts = mysqli_query($connection, $query);
        
                            while($post = mysqli_fetch_assoc($search)){
        
                                $title = $post['title'];
                                $author = $post['author'];
                                $date = $post['date'];
                                $content = $post['content'];
                                $image = $post['image'];
    
                    ?>
    
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>
        
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?php echo $title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> <?php echo $date; ?> </p>
                        <hr>
                        <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                        <hr>
                        <p> <?php echo $content ?> </p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                        <hr>
        
                        <?php    
        
                            }
        
                        
                    }
            
                }
                ?>
        
                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
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