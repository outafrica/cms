<h1 class="page-header">
    Welcome
    <small>Admin</small>
</h1>

<ol class="breadcrumb">
    <li>
        <i class="fa fa-dashboard"></i>  <a href="../admin">Dashboard</a>
    </li>
    <li class="active">
        <i class="fa fa-file"></i> View All Comments for <?php echo postTitle(); ?>
    </li>
</ol>

<form action="" method="post">

    <table class = "table table-bordered table-hover">
        
        <div id="bulkOptionsContainer" class="col-xs-4">
            
            <select name="bulkOptions" id="" class="form-control">
            
                <option value="">Select Option</option>
                <option value="Approved">Approve</option>
                <option value="Unapproved">Unapprove</option>
                <option value="Clone">Clone</option>
                <option value="Delete">Delete</option>  
        
            </select>
        
        
        </div>

        <div id="bulkAction" class="col-xs-4">
        
            <input type="submit" nam="submit" class="btn btn-success" value="Apply">

        </div>

        <thead>
            <tr>
                <th><input type="checkbox" name="" id="selectAll"></th>
                <th>Id</th>
                <th>Comment Author</th>
                <th>Email</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Date</th>
                <th>Actions</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <!-- show comments -->
            <?php
                showPostComments();
            ?>
            <!-- Change status -->
            <?php
                change_comment_status();                                    
            ?>
            <!-- Delete a comment -->
            <?php
                delete_comment();                                    
            ?>
        </tbody>
    </table>
    <?php
    
        commentsBoxArray();

    ?>

</form>