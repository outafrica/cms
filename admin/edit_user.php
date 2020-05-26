<h1 class="page-header">
    Welcome Admin
    <small>Author</small>
</h1>
<ol class="breadcrumb">
    <li>
        <i class="fa fa-dashboard"></i>  <a href="../admin">Dashboard</a>
    </li>
    <li class="active">
        <i class="fa fa-file"></i> Edit User
    </li>
</ol>

    
<?php

    if(isset($_GET['user_id'])){

        $user_id = $_GET['user_id'];

        $query = "SELECT * FROM users WHERE id = $user_id";
        $result = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($result)){

            $username = $row['username'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $password = $row['password'];
            $role = $row['role'];
            $image = $row['image'];
        }

    }


    if(isset($_POST['update'])){

        $user_username = $_POST['username'];
        $user_firstname = $_POST['firstname'];
        $user_lastname = $_POST['lastname'];
        $user_email = $_POST['email'];
        $user_image = $_FILES['image']['name'];
        $image_tmp = $_FILES['image']['tmp_name'];
        $user_role = $_POST['role'];
        $user_password = $_POST['password'];

        move_uploaded_file($image_tmp, "../images/$user_image");
        
        if(empty($user_image)){

            $query = "SELECT * FROM users WHERE id = $user_id";
            $query_image = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($query_image)){

                $user_image = $row['image'];

            }

        }

        if(!empty($user_password)){

            $query = "SELECT password FROM users WHERE id = $user_id";
            $query_password = mysqli_query($connection, $query);

            $row = mysqli_fetch_array($query_password);
            $db_password = row['passowrd'];

            if($db_password != $user_password){

                $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
            }


        }

        $query = "UPDATE users SET ";
        $query .= "username = '{$user_username}', ";
        $query .= "firstname = '{$user_firstname}', ";
        $query .= "lastname = '{$user_lastname}', ";
        $query .= "image = '{$user_image}', ";
        $query .= "email = '{$user_email}', ";
        $query .= "password = '{$user_password}', ";
        $query .= "role = '{$user_role}' ";
        $query .= "WHERE id = {$user_id}";
        
        $update_user = mysqli_query($connection, $query);

        queryErrors($update_user);

        if($update_user){
            header("Location: users.php");
        }
    }

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        
        <label for="username">Username</label>
        <input name="username" type="text" class="form-control" value = "<?php echo $username; ?>">    

    </div>

    <div class="form-group">
    
        <!-- <label for="post_category">Post Category Id</label> -->
        <select name="role" id="" class = "form-control">

            <?php

                if(isset($_GET['user_id'])){

                    $user_id = $_GET['user_id'];

                    $query = "SELECT * FROM users WHERE id = $user_id";
                    $result = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($result)){

                        $role = $row['role'];
                       
                    }

                }

                echo "<option value='{$role}' class = 'form-control'>{$role}</option>";

                if($role == 'Admin'){

                    echo "<option value='Subscriber' class = 'form-control'>Subscriber</option>";

                }else{

                    echo "<option value='Admin' class = 'form-control'>Administrator</option>";
                    
                }
            
            ?>
       
        
        </select>   

    </div>

    <div class="form-group">
    
        <label for="firstname">Firstname</label>
        <input name="firstname" type="text" class="form-control" value = "<?php echo $firstname; ?>">    

    </div>

    <div class="form-group">
    
        <label for="lastname">Lastname</label>
        <input name="lastname" type="text" class="form-control" value = "<?php echo $lastname; ?>">    

    </div>

    <div class="form-group">
    
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control" value = "<?php echo $email; ?>">    

    </div>

    <div class="form-group">

        <label for="image">Profile Image</label>
        <img height='200' src="../images/<?php echo $image ?>" alt="image">
        <input name="image" type="file" class="form-control">    

    </div>

    <div class="form-group">
        
        <label for="password">Password</label>
        <input name="password" type="password" class="form-control" value = "<?php echo $password; ?>">    

    </div>

    <div class="form-group">
        
        <input class="btn btn-primary" name="update" type="submit" value="Update User" > 
        
    </div>

</form>