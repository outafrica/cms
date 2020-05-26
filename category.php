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

                    if(isset($_GET['category'])){

                        $cat_id = $_GET['category'];
           
                        $query = "SELECT * FROM posts WHERE category_id = $cat_id AND status = 'Published'";
                        $posts = mysqli_query($connection, $query);

                        if(mysqli_num_rows($posts) < 1){

                            echo "<h1 class='text-center'>No Posts Available</h1>";
                   
                        }else{

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
                    by <a href="index.php"><?php echo $author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $date; ?> </p>
                <hr>
                <a href="post.php?post_id=<?php echo $id; ?>">
                
                    <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">

                </a>
                
                <hr>
                <p> <?php echo $content ?>... </p>
                <a class="btn btn-primary" href="post.php?post_id=<?php echo $id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>


                <?php    

                        }
                    }
                }else{
                    
                    // echo "<h1 class='text-center'>No Categories Available</h1>";
                    header("Location: index.php");

                }

                ?> 

                <hr>     

            </div>

        <!-- importing side widget function -->
        <?php include "includes/sidewidget.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php

    include "includes/footer.php";

?>