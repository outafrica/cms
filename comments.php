<?php add_comment($post_id); ?>
<!-- Comments Form -->
<div class="well">
    <h4>Leave a Comment:</h4>
    <form action="" method="post" role="form">
        <div class="form-group">
           
            <label for="author">Name</label>
            <input name="author" type="text" class="form-control"> 
           
        </div>

        <div class="form-group">

            <label for="email">Email</label>
            <input name="email" type="email" class="form-control"> 

        </div>

        <div class="form-group">

            <label for="comment">Comment</label>
            <textarea name="comment" class="form-control" rows="3"></textarea>

        </div>
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<hr>

<!-- show comments -->
<?php
    
    $query = "SELECT * FROM comments WHERE post_id = $post_id ";
    $query .= "AND status = 'Approved' ";
    $query .= "ORDER BY id DESC ";

    $comment = mysqli_query($connection, $query);

    if(!$comment){

        die("Query Failed!". mysqli_error($connection));

    }


    while($row = mysqli_fetch_assoc($comment)){

        $comment_date = $row['date'];
        $comment_content = $row['content'];
        $comment_author = $row['author'];

?>

<!-- Posted Comments -->
<!-- Comment -->
<div class="media"> 
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><?php echo $comment_author; ?>
            <small><?php echo $comment_date; ?></small>
        </h4>
        <?php
            echo $comment_content;
        ?>
    </div>
</div>
<?php

    }

?>

<!-- Comment -->
<!-- <div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="http://placehold.it/64x64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading">Start Bootstrap
            <small>August 25, 2014 at 9:30 PM</small>
        </h4>
        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus. -->
        <!-- Nested Comment -->
        <!-- <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64x64" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Nested Start Bootstrap
                    <small>August 25, 2014 at 9:30 PM</small>
                </h4>
                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
            </div>
        </div> -->
        <!-- End Nested Comment -->
    <!-- </div> -->
<!-- </div> -->
