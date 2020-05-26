<h1 class="page-header">
    Welcome Admin
    <small>Author</small>
</h1>
<ol class="breadcrumb">
    <li>
        <i class="fa fa-dashboard"></i>  <a href="../admin">Dashboard</a>
    </li>
    <li class="active">
        <i class="fa fa-file"></i> Edit Post
    </li>
</ol>

    
<?php

    if(isset($_GET['post_id'])){

        $post_id = $_GET['post_id'];

        $query = "SELECT * FROM posts WHERE id = $post_id";
        $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result)){

            $title = $row['title'];
            $cat_id = $row['category_id'];
            $author = $row['author'];
            $status = $row['status'];
            $tags = $row['tags'];
            $content = $row['content'];
            $image = $row['image'];
        }

    }


    if(isset($_POST['update'])){

        $post_title = $_POST['title'];
        $post_cat_id = $_POST['post_category'];
        $post_author = $_POST['author'];
        $post_status = $_POST['status'];
        $post_image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $post_tags = $_POST['tags'];
        $post_content = $_POST['content'];

        move_uploaded_file($image_tmp, "../images/$post_image");
        $post_content = mysqli_real_escape_string($connection, $post_content);

        
        if(empty($post_image)){

            $query = "SELECT * FROM posts WHERE id = $post_id";
            $query_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($query_image)){

                $post_image = $row['image'];

            }

        }

            $query = "UPDATE posts SET ";
            $query .= "category_id = '{$post_cat_id}', ";
            $query .= "title = '{$post_title}', ";
            $query .= "author = '{$post_author}', ";
            $query .= "date = now(), ";
            $query .= "image = '{$post_image}', ";
            $query .= "content = '{$post_content}', ";
            $query .= "tags = '{$post_tags}', ";
            $query .= "status = '{$post_status}' ";
            $query .= "WHERE id = '{$post_id}' ";
            
            $update_post = mysqli_query($connection, $query);

            queryErrors($update_post);
    }

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
    
        <label for="post_title">Post Title</label>                 
        <input class = "form-control" type="text" name = "title"  value = "<?php echo $title; ?>">
       
    
    </div>

    <div class="form-group">
    
        <label for="post_category">Post Category</label>
        <select name="post_category" id="" class = "form-control">
        
            <?php

                select_category();
        
            ?>
        
        </select>   

    </div>


    <div class="form-group">
        <label for="post_author">Post Author</label>
        <select name="author" id="" class = "form-control">

            <?php

                if(isset($_GET['post_id'])){

                    $post_id = $_GET['post_id'];

                    $query = "SELECT * FROM posts WHERE id = $post_id";
                    $result = mysqli_query($connection, $query);

                    $row = mysqli_fetch_array($result);
                    $name = $row['author'];

                }

                echo "<option value='{$name}' class = 'form-control'>{$name}</option>";

                $query = "SELECT * FROM users";
                $users_result = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($users_result)){

                    $first = $row['firstname'];
                    $last = $row['lastname'];
                    $fullname = $first;
                    $fullname .= ' ';
                    $fullname .= $last;


                    if($name == $fullname){

                    }else{

                        echo "<option value='{$fullname}' class = 'form-control'>{$fullname}</option>";

                    }

                }
                

            ?>

        </select> 

    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <select name="status" id="" class = "form-control">

            <?php

                if(isset($_GET['post_id'])){

                    $post_id = $_GET['post_id'];

                    $query = "SELECT * FROM posts WHERE id = $post_id";
                    $result = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($result)){

                        $status = $row['status'];
                    
                    }

                }

                echo "<option value='{$status}' class = 'form-control'>{$status}</option>";

                if($status == 'Published'){

                    echo "<option value='Draft' class = 'form-control'>Draft</option>";

                }else{

                    echo "<option value='Published' class = 'form-control'>Publish</option>";
                    
                }

            ?>

        </select> 

    </div>

    <div class="form-group">

        <label for="post_image">Post Image</label>
        <img height='200' src="../images/<?php echo $image ?>" alt="image">
         <input name="image" type="file" class = "form-control">    

    </div>

    <div class="form-group">
    
        <label for="post_tags">Post Tags</label>
        <input name="tags" type="text" class="form-control" value = "<?php echo $tags; ?>">    

    </div>

    <div class="form-group">
        
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"><?php echo $content; ?></textarea>

    </div>

    <div class="form-group">
        
        <input class="btn btn-primary" name="update" type="submit" value="Update Post" > 
        
    </div>

</form>