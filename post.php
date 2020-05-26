    <!-- import header function -->
    <?php include "includes/header.php"; ?>

    <!-- import nav function -->
    <?php include "includes/nav.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <?php

                    if(isset($_GET['post_id'])){

                        $post_id = $_GET['post_id'];

                    }
                    
                    $query = "UPDATE posts SET view_count = view_count + 1 WHERE id = $post_id ";
                    $updateCount = mysqli_query($connection, $query);

                    queryErrors($updateCount);

                    if(isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'){

                        $query = "SELECT * FROM posts WHERE id = $post_id";    

                    }else{
                    
                        $query = "SELECT * FROM posts WHERE id = $post_id AND status = 'Published'";
                        
                    }


                    $posts = mysqli_query($connection, $query);

                    if(mysqli_num_rows($posts) < 1){

                        echo "<h1 class='text-center'>No Posts Available</h1>";

                    }else{

                    while($post = mysqli_fetch_assoc($posts)){

                        $title = $post['title'];
                        $author = $post['author'];
                        $date = $post['date'];
                        $content = $post['content'];
                        $image = $post['image'];

                ?>

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
                <hr>

                <!-- Blog Comments -->
                <?php include "comments.php"; ?>    
           
                <?php    

                        }
                    }
                ?>

                            
            </div>

            <?php include "includes/sidewidget.php"; ?>

        </div>
        <!-- /.row -->

        <hr>
<?php

    include "includes/footer.php";

?>