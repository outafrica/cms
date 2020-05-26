<?php add_user(); ?>

<h1 class="page-header">
    Welcome Admin
    <small>Author</small>
</h1>
<ol class="breadcrumb">
    <li>
        <i class="fa fa-dashboard"></i>  <a href="../admin">Dashboard</a>
    </li>
    <li class="active">
        <i class="fa fa-file"></i> Add User
    </li>
</ol>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
    
        <label for="username">Username</label>
        <input name="username" type="text" class="form-control">    
    
    </div>

    <div class="form-group">
    
        <label for="firstname">Firstname</label>
        <input name="firstname" type="text" class="form-control">    

    </div>

    <div class="form-group">
    
        <label for="lastname">Lastname</label>
        <input name="lastname" type="text" class="form-control">    

    </div>

    <div class="form-group">
    
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control">    

    </div>

    <div class="form-group">
    
        <label for="role">Role</label>
       
        <select name="role" id="" class="form-control">
        
            <option value="Subscriber" class="form-control">Select Option</option>
            <option value="Admin" class="form-control">Administrator</option>
            <option value="Subscriber" class="form-control">Subscriber</option>
        
        </select>  

    </div>



    <div class="form-group">

        <label for="picture">Profile Image</label>
        <input name="image" type="file">    

    </div>

    <div class="form-group">
    
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control">    

    </div>

    <div class="form-group">
        
        <input class="btn btn-primary" name="add_user" type="submit" value="Add User" >    

    </div>

</form>