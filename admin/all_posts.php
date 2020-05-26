<h1 class="page-header">
    Welcome Admin
    <small>Author</small>
</h1>

<ol class="breadcrumb">
    <li>
        <i class="fa fa-dashboard"></i>  <a href="../admin">Dashboard</a>
    </li>
    <li class="active">
        <i class="fa fa-file"></i> View All Posts
    </li>
</ol>

<form action="" method="post">
    <table class = "table table-bordered table-hover">

        <div id="bulkOptionsContainer" class="col-xs-4">
        
            <select name="bulkOptions" id="" class="form-control">
            
                <option value="">Select Option</option>
                <option value="Published">Publish</option>
                <option value="Draft">Draft</option>
                <option value="Clone">Clone</option>
                <option value="Delete">Delete</option>  
        
            </select>
        
        
        </div>

        <div id="bulkAction" class="col-xs-4">
        
            <input type="submit" nam="submit" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="./posts.php?source=add_post">Add New</a>
    
        </div>
        
        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAll"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Category</th>
                <th>Title</th>
                <th>Image</th>
                <th>Status</th>
                <th>Tags</th>
                <th>Views</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                show_posts();
            ?>
            <!-- Delete a post -->
            <?php
                delete_post();                                    
            ?>
            <?php
                resetView();                                    
            ?>
        </tbody>
    </table>

    <?php
    
        postBoxArray();
    
    ?>

</form>