<?php add_post(); ?>

<h1 class="page-header">
    Welcome Admin
    <small>Author</small>
</h1>
<ol class="breadcrumb">
    <li>
        <i class="fa fa-dashboard"></i>  <a href="../admin">Dashboard</a>
    </li>
    <li class="active">
        <i class="fa fa-file"></i> Add Post
    </li>
</ol>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
    
        <label for="post_title">Post Title</label>
        <input name="title" type="text" class="form-control">    
    
    </div>

    <div class="form-group">
    
        <label for="post_category">Post Category</label>
       
        <select name="post_category" id="" class="form-control">
        
        <?php

            select_category();    
        
        ?>
        
        </select>  

    </div>

    <div class="form-group">
    
        <label for="post_category">Post Author</label>
       
        <select name="author" id="" class="form-control">
        
        <?php

            select_author();    
        
        ?>
        
        </select>  

    </div>
    
    <div class="form-group">
    
        <label for="post_status">Post Status</label>
       
        <select name="status" id="" class="form-control">
        
            <option value="Draft" class="form-control">Select Option</option>
            <option value="Draft" class="form-control">Draft</option>
            <option value="Published" class="form-control">Publish</option>
        
        </select>  

    </div>

    <div class="form-group">

        <label for="post_image">Post Image</label>
        <input name="image" type="file">    

    </div>

    <div class="form-group">
    
        <label for="post_tags">Post Tags</label>
        <input name="tags" type="text" class="form-control">    

    </div>

    <div class="form-group">
        
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="content" id="" cols="30" rows="10"></textarea>

    </div>

    <div class="form-group">
        
        <input class="btn btn-primary" name="submit" type="submit" value="Submit Post" >    

    </div>

</form>