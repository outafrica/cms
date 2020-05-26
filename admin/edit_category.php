<!-- Edit category -->
<form action="" method="post">

    <div class="form-group">

        <label for="category_title">Edit Category</label>

        <?php
        
            if(isset($_GET['edit'])){

                $cat_id = $_GET['edit'];

                $query = "SELECT * FROM categories WHERE id = $cat_id";
                $result = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($result)){

                    $title = $row['title'];


        ?>            
                    <input class = "form-control" type="text" name = "title"  value = "<?php if(isset($title)){ echo $title; }?>">
        <?php            
                }

            }
        
        ?>

        <!-- Update edit -->
        <?php
        
        update_categories($cat_id);

        ?>

    </div>
    <div class="form-group">
    
        <input class = "btn btn-primary" type = "submit" name = "update" value = "Update Category" >

    </div>

</form>