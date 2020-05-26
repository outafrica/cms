<h1 class="page-header">
    Welcome
    <small>Admin</small>
</h1>

<ol class="breadcrumb">
    <li>
        <i class="fa fa-dashboard"></i>  <a href="../admin">Dashboard</a>
    </li>
    <li class="active">
        <i class="fa fa-file"></i> View All Comments
    </li>
</ol>

<table class = "table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Post Name</th>
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
            show_comments();
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