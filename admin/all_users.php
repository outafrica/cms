<h1 class="page-header">
    Welcome Admin
    <small>Author</small>
</h1>

<ol class="breadcrumb">
    <li>
        <i class="fa fa-dashboard"></i>  <a href="../admin">Dashboard</a>
    </li>
    <li class="active">
        <i class="fa fa-file"></i> View All Users
    </li>
</ol>

<table class = "table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
            show_users();
        ?>
        <!-- Delete a post -->
        <?php
            delete_users();                                    
        ?>
    </tbody>
</table>