<?php

    function queryErrors($query){

        global $connection;

        if(!$query){

            die("Query Failed!". mysqli_error($connection));

        }

    }

    function usersOnline(){

        if(isset($_GET['usersonline'])){

            // global $connection;
             
            if(!$connection){

                session_start();

                include("../includes/db.php");

                $session = session_id();
                $time = time();
                $time_out = 30; //time in seconds

                $userTimeOut = $time - $time_out;
                
                $query = "SELECT * FROM online_users WHERE session = '{$session}'";
                $check = mysqli_query($connection, $query);
                $count = mysqli_num_rows($check);
                
                if($count == NULL){

                    $query = "INSERT INTO online_users (session, time) VALUES('{$session}', {$time})";
                    $save = mysqli_query($connection, $query);
                    queryErrors($save);
                    
                }else{

                    $query = "UPDATE online_users SET time = {$time} WHERE session = '{$session}'";
                    $update = mysqli_query($connection, $query);
                    queryErrors($update);

                }

                $query = "SELECT * FROM online_users WHERE time > {$userTimeOut}";
                $useronline = mysqli_query($connection, $query);
                queryErrors($useronline);

                echo $count_user = mysqli_num_rows($useronline);


            }
        
        }

    }

    usersOnline();

    function add_categories(){

        global $connection;
                            
        if(isset($_POST['submit'])){

            $title = $_POST['title'];
            
            if($title == ""|| empty($title)){

                echo "This field is required!";

            }else{

                $query = "INSERT INTO categories(title) ";
                $query .= "VALUE('{$title}')";
                
                $create = mysqli_query($connection, $query);

                queryErrors($create);

            }
            

        }

    }

    function show_categories(){

        global $connection;

        $query = "SELECT * FROM categories";
        $category_select = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($category_select)){

            $id = $row['id'];
            $title = $row['title'];
            echo "<tr>";
            echo "<td>{$id}</td>";
            echo "<td>{$title}</td>";
            echo "<td> <a href = 'categories.php?edit={$id}'>Edit</a> | <a href = 'categories.php?delete={$id}'>Delete</a> </td>";
            echo "</tr>";

        }                    
        

    }
    
    function edit_categories(){

        global $connection;

        if(isset($_GET['edit'])){

            // $cat_id = $_GET['edit'];

            include "./edit_category.php";

        }
        
    }

    function select_category(){

        global $connection;

        $query = "SELECT * FROM categories";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        echo "<option value=3>Select Category</option>";
        
        while($row = mysqli_fetch_assoc($result)){

            $id = $row['id'];
            $title = $row['title'];

            echo "<option value='$id'>{$title}</option>";
        }

    }

    function select_author(){

        global $connection;

        $query = "SELECT * FROM users";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        while($row = mysqli_fetch_assoc($result)){

            $id = $row['id'];
            $first = $row['firstname'];
            $last = $row['lastname'];
            $name = $first;
            $name .= ' ';
            $name .= $last;


            echo "<option value='{$name}'>{$name}</option>";
        }

    }

    function update_categories($cat_id){

        global $connection;

        if(isset($_POST['update'])){

            $title = $_POST['title'];
            
            if($title == ""|| empty($title)){

                echo "This field is required!";

            }else{

                $query = "UPDATE categories SET title = '{$title}' WHERE id = {$cat_id} ";
                
                $update = mysqli_query($connection, $query);

                queryErrors($update);

            }
        }
        
    }

    function delete_categories(){

        global $connection;

        if(isset($_SESSION['role'])){

            if($_SESSION['role'] == 'Admin'){

                if(isset($_GET['delete'])){

                    $cat_id = $_GET['delete'];
       
                   $query = "DELETE FROM categories WHERE id = {$cat_id}";
                   $delete = mysqli_query($connection, $query);
       
                   if($delete){
                       header("Location: categories.php");
                   }
       
               }

            }
        }
       
    }

    function toggle_posts(){

        global $connection;

        if(isset($_GET['source'])){

            $source = $_GET['source'];
        }else{
            $source = '';
        }

        switch($source){

            case 'add_post':
                include "./add_posts.php";
            break;

            case 'edit_post':
                include "./edit_posts.php";
            break;

            default:
                include "./all_posts.php";
            break;


        }

    }

    function add_post(){

        global $connection;

        if(isset($_POST['submit'])){

            $post_title = $_POST['title'];
            $post_cat_id = $_POST['post_category'];
            $post_author = $_POST['author'];
            $post_status = $_POST['status'];
            $post_image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $post_tags = $_POST['tags'];
            $post_content = $_POST['content'];
            $post_date = date('d-m-y');
            $post_comment_count = 0;

            move_uploaded_file($image_tmp, "../images/$post_image");
            $post_content = mysqli_real_escape_string($connection, $post_content);

            $query = "INSERT INTO posts(category_id, title, author, date, image, content, tags, comment_count, status)";
            $query .= "VALUES({$post_cat_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}')";

            $addPost = mysqli_query($connection, $query);

            queryErrors($addPost);

          

        }

    }

    function show_posts(){
        
        global $connection;

        $query = "SELECT * FROM posts ORDER BY id DESC";
        $posts = mysqli_query($connection, $query);

        while($post = mysqli_fetch_assoc($posts)){
            
            $id = $post['id'];
            $author = $post['author'];
            $cat_id = $post['category_id'];
            $title = $post['title'];
            $image = $post['image'];
            $status = $post['status'];
            $tags = $post['tags'];
            $views = $post['view_count'];
            $comments = $post['comment_count'];
            $date = $post['date'];


            $query = "SELECT * FROM categories WHERE id = $cat_id";
            $results = mysqli_query($connection, $query);

            while($result = mysqli_fetch_assoc($results)){

                $category = $result['title'];

            }

            $query = "SELECT * FROM comments WHERE post_id = {$id}";
            $comments_num = mysqli_query($connection, $query);

            $comment_count = mysqli_num_rows($comments_num);



            echo "<tr>";
                echo "<td><input type='checkbox' name='checkBoxArray[]' class='checkBoxes' value='{$id}'></td>";
                echo "<td>{$id}</td>";
                echo "<td>{$author}</td>";
                echo "<td>{$category}</td>";
                echo "<td>{$title}</td>";
                echo "<td><img class='img-responsive' width='70' src='../images/$image' alt='image'></td>";
                echo "<td>{$status}</td>";
                echo "<td>{$tags}</td>";
                echo "<td>{$views} | <a href = 'posts.php?reset={$id}'>Reset</a></td>";
                echo "<td>{$comment_count} | <a href = 'comments.php?source=comments&post_id={$id}'>View Comment(s)</a></td>";
                echo "<td>{$date}</td>";
                echo "<td> <a href = '../post.php?post_id={$id}'>View</a> | <a href = 'posts.php?source=edit_post&post_id={$id}'>Edit</a> | <a href = 'posts.php?delete={$id}' onClick =\"javasvript: return confirm('Are you sure you want to delete this post?')\" >Delete</a> </td>";                   
            echo "</tr>";


        }

    }

    function delete_post(){

        global $connection;

        if(isset($_SESSION['role'])){

            if($_SESSION['role'] == 'Admin'){

                if(isset($_GET['delete'])){

                    $post_id = $_GET['delete'];
       
                   $query = "DELETE FROM posts WHERE id = {$post_id}";
                   $delete = mysqli_query($connection, $query);
       
                   if($delete){
                       header("Location: posts.php");
                   }
       
                }
    
            }

        }

    }


    function resetView(){

        global $connection;

        if(isset($_GET['reset'])){

            $post_id = $_GET['reset'];
            $count = 0;

            $query = "UPDATE posts SET view_count = {$count} WHERE id = {$post_id}";
            $reset = mysqli_query($connection, $query);
            
            if($reset){

                header("Location: posts.php");
                
            }


        }


    }

    function toggle_comments(){

        global $connection;

        if(isset($_GET['source'])){

            $source = $_GET['source'];

        }else{
            
            $source = '';

        }

        switch($source){

            case 'edit_comment':
                include "./edit_comments.php";
            break;

            case 'comments':
                include "./post_comments.php";
            break;

            default:
                include "./all_comments.php";
            break;


        }

    }

    function show_comments(){

        global $connection;

        $query = "SELECT * FROM comments ";
        $query .= "ORDER BY id DESC";
        $comments = mysqli_query($connection, $query);

        while($comment = mysqli_fetch_assoc($comments)){
            
            $id = $comment['id'];
            $post_id = $comment['post_id'];
            $author = $comment['author'];
            $email = $comment['email'];
            $content = $comment['content'];
            $status = $comment['status'];
            $date = $comment['date'];


            $query = "SELECT * FROM posts WHERE id = $post_id";
            $results = mysqli_query($connection, $query);

            while($result = mysqli_fetch_assoc($results)){

                $title = $result['title'];

            }

            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td><a href='../post.php?post_id=$post_id'>{$title}</a></td>";
                echo "<td>{$author}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$content}</td>";
                echo "<td>{$status}</td>";
                echo "<td>{$date}</td>";

                if($status == 'Approved'){
                    echo "<td> <a href = 'comments.php?status=Unapprove&comment_id={$id}'>Unapprove</a></td>";
                }else{
                    echo "<td> <a href = 'comments.php?status=Approve&comment_id={$id}'>Approve</a></td>";
                }

                echo "<td> <a href = 'comments.php?delete={$id}'>Delete</a> </td>";

            echo "</tr>";

        }
        
    }

    function change_comment_status(){
        
        global $connection;

        if(isset($_GET['status'])){

            $status = $_GET['status'];
            $id = $_GET['comment_id'];

            if($status == 'Approve'){
                $status = 'Approved';
            }else{
                $status = 'Unapproved';
            }

            $query = "UPDATE comments SET status = '{$status}' WHERE id = {$id} ";
                
            $update = mysqli_query($connection, $query);

            if($update){

                header("Location: comments.php");
                
            }


        }
        



    }

    function delete_comment(){

        global $connection;
    
        if(isset($_SESSION['role'])){

            if($_SESSION['role'] == 'Admin'){

                if(isset($_GET['delete'])){
    
                    $comment_id = $_GET['delete'];
       
                   $query = "DELETE FROM comments WHERE id = {$comment_id}";
                   $delete = mysqli_query($connection, $query);
       
                   if($delete){
                       header("Location: comments.php");
                   }
       
                }

            }

        }    

    }

  
    function toggle_users(){

        global $connection;

        if(isset($_GET['source'])){

            $source = $_GET['source'];
        }else{
            $source = '';
        }

        switch($source){

            case 'add_user':
                include "./add_user.php";
            break;

            case 'edit_user':
                include "./edit_user.php";
            break;

            default:
                include "./all_users.php";
            break;

        }

    }

    function add_user(){

        global $connection;

        if(isset($_POST['add_user'])){

            $username = $_POST['username'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $image = $_FILES['image']['name'];
            $image_tmp = $_FILES['image']['tmp_name'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            move_uploaded_file($image_tmp, "../images/$image");

            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
            
            $query = "INSERT INTO users(username, firstname, lastname, email, password, image, role)";
            $query .= "VALUES('{$username}', '{$firstname}', '{$lastname}', '{$email}', '{$password}', '{$image}', '{$role}')";

            $addUser = mysqli_query($connection, $query);

            queryErrors($addUser);

            echo "User successfully created!". " " . "<a href='./users.php'> View Users</a>";

        }

    }

    function show_users(){
        
        global $connection;

        $query = "SELECT * FROM users";
        $users = mysqli_query($connection, $query);

        while($user = mysqli_fetch_assoc($users)){
            
            $id = $user['id'];
            $name = $user['username'];
            $firstname = $user['firstname'];
            $lastname = $user['lastname'];
            $email = $user['email'];
            $image = $user['image'];
            $role = $user['role'];
            
            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$firstname}</td>";
                echo "<td>{$lastname}</td>";
                echo "<td>{$email}</td>";
                echo "<td><img class='img-responsive' width='70' src='../images/$image' alt='image'></td>";
                echo "<td>{$role}</td>";
                echo "<td> <a href = 'users.php?source=edit_user&user_id={$id}'>Edit</a> | <a href = 'users.php?delete={$id}' onClick =\"javasvript: return confirm('Are you sure you want to delete this user?')\" >Delete</a> </td>";                   
            echo "</tr>";


        }

    }

    function delete_users(){

        global $connection;

        if(isset($_SESSION['role'])){

            if($_SESSION['role'] == 'Admin'){

                if(isset($_GET['delete'])){

                    $user_id = $_GET['delete'];
       
                   $query = "DELETE FROM users WHERE id = {$user_id}";
                   $delete = mysqli_query($connection, $query);
       
                   if($delete){
                       header("Location: users.php");
                   }
       
               }


            }

        }
        
        
    }



    function postCount(){

        global $connection;

        $query = "SELECT * FROM posts";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        $count = mysqli_num_rows($result);

        return $count;

    }

    function commentCount(){

        global $connection;

        $query = "SELECT * FROM comments";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        $count = mysqli_num_rows($result);

        return $count;

    }

    function userCount(){

        global $connection;

        $query = "SELECT * FROM users";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        $count = mysqli_num_rows($result);

        return $count;

    }

    function categoryCount(){

        global $connection;

        $query = "SELECT * FROM categories";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        $count = mysqli_num_rows($result);

        return $count;

    }

    function publishedCount(){

        global $connection;

        $query = "SELECT * FROM posts WHERE status = 'Published' ";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        $count = mysqli_num_rows($result);

        return $count;

    }

    function draftCount(){

        global $connection;

        $query = "SELECT * FROM posts WHERE status = 'Draft' ";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        $count = mysqli_num_rows($result);

        return $count;

    }
    

    function approvedCount(){

        global $connection;

        $query = "SELECT * FROM comments WHERE status = 'Approved' ";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        $count = mysqli_num_rows($result);

        return $count;

    }

    function subscriberCount(){

        global $connection;

        $query = "SELECT * FROM users WHERE role = 'Subscriber' ";
        $result = mysqli_query($connection, $query);

        queryErrors($result);

        $count = mysqli_num_rows($result);

        return $count;

    }

    function postBoxArray(){

        global $connection;

        if(isset($_POST['checkBoxArray'])){
            
            foreach($_POST['checkBoxArray'] as $checkBoxValue){

                $bulkOptions = $_POST['bulkOptions'];

                switch($bulkOptions){

                    case 'Published':
                        
                        $query = "UPDATE posts SET status = '{$bulkOptions}' WHERE id = {$checkBoxValue}";
                        $update = mysqli_query($connection, $query);
                        
                        if($update){

                            header("Location: posts.php");
                            
                        }

                    break;

                    case 'Draft':
                        
                        $query = "UPDATE posts SET status = '{$bulkOptions}' WHERE id = {$checkBoxValue}";
                        $draft = mysqli_query($connection, $query);
                        
                        if($draft){

                            header("Location: posts.php");
                            
                        }

                    break;

                    case 'Clone':
                        
                        $query = "SELECT * FROM posts WHERE id = {$checkBoxValue}";
                        $clone = mysqli_query($connection, $query);
                        
                        while($row = mysqli_fetch_assoc($clone)){
                            $title = $row['title'];
                            $category = $row['category_id'];
                            $author = $row['author'];
                            $status = $row['status'];
                            $image = $row['image'];
                            $tags = $row['tags'];
                            $content = $row['content'];
                            $date = $row['date'];
                            $count = $row['comment_count'];

                        }

                        $query = "INSERT INTO posts(category_id, title, author, date, image, content, tags, comment_count, status)";
                        $query .= "VALUES({$category}, '{$title}', '{$author}', '{$date}', '{$image}', '{$content}', '{$tags}', {$count}, '{$status}')";

                        $postClone = mysqli_query($connection, $query);

                        queryErrors($postClone);

                        if($postClone){

                            header("Location: posts.php");
                            
                        }

                    break;


                    case 'Delete':
                        
                        $query = "DELETE FROM posts WHERE id = {$checkBoxValue}";
                        $delete = mysqli_query($connection, $query);
                        
                        if($delete){

                            header("Location: posts.php");
                            
                        }

                    break;


                }

                
            }

        }

    }

    function postTitle(){

        global $connection;

        if(isset($_GET['post_id'])){

            $post_id = $_GET['post_id'];

            $query = "SELECT title FROM posts where id = {$post_id}";
            $title_query = mysqli_query($connection, $query);

            queryErrors($title_query);
            
            $row = mysqli_fetch_array($title_query);
            $title = $row['title'];

            return $title;

        }

    }

    function showPostComments(){

        global $connection;

        if(isset($_GET['post_id'])){    

            $post_id = $_GET['post_id'];
            $query = "SELECT * FROM comments WHERE post_id = {$post_id} ";
            $query .= "ORDER BY id DESC";
            $comments = mysqli_query($connection, $query);

            while($comment = mysqli_fetch_assoc($comments)){
                
                $id = $comment['id'];
                $author = $comment['author'];
                $email = $comment['email'];
                $content = $comment['content'];
                $status = $comment['status'];
                $date = $comment['date'];

                echo "<tr>";
                    echo "<td><input type='checkbox' name='checkBoxArray[]' class='checkBoxes' value='{$id}'></td>";
                    echo "<td>{$id}</td>";
                    echo "<td>{$author}</td>";
                    echo "<td>{$email}</td>";
                    echo "<td>{$content}</td>";
                    echo "<td>{$status}</td>";
                    echo "<td>{$date}</td>";

                    if($status == 'Approved'){
                        echo "<td> <a href = 'comments.php?status=Unapprove&comment_id={$id}'>Unapprove</a></td>";
                    }else{
                        echo "<td> <a href = 'comments.php?status=Approve&comment_id={$id}'>Approve</a></td>";
                    }

                    echo "<td> <a href = 'comments.php?delete={$id}'>Delete</a> </td>";

                echo "</tr>";

            }

        }

    }

    function commentsBoxArray(){

        global $connection;

        if(isset($_POST['checkBoxArray'])){
            
            foreach($_POST['checkBoxArray'] as $checkBoxValue){

                $bulkOptions = $_POST['bulkOptions'];

                switch($bulkOptions){

                    case 'Approved':
                        
                        $query = "UPDATE comments SET status = '{$bulkOptions}' WHERE id = {$checkBoxValue}";
                        $update = mysqli_query($connection, $query);
                        
                        if($update){

                            header("Location: comments.php?source=comments&post_id={$_GET['post_id']}");
                            
                        }

                    break;

                    case 'Unapproved':
                        
                        $query = "UPDATE comments SET status = '{$bulkOptions}' WHERE id = {$checkBoxValue}";
                        $draft = mysqli_query($connection, $query);
                        
                        if($draft){

                            header("Location: comments.php?source=comments&post_id={$_GET['post_id']}");
                            
                        }

                    break;

                    case 'Clone':
                        
                        $query = "SELECT * FROM comments WHERE id = {$checkBoxValue}";
                        $clone = mysqli_query($connection, $query);
                        
                        while($row = mysqli_fetch_assoc($clone)){
                            $post_id = $row['post_id'];
                            $author = $row['author'];
                            $email = $row['email'];
                            $content = $row['content'];
                            $status = $row['status'];
                            $date = $row['date'];

                        }

                        $query = "INSERT INTO comments(post_id, author, email, content, status, date) ";
                        $query .= "VALUES({$post_id}, '{$author}', '{$email}', '{$content}', '{$status}', '{$date}')";

                        $postClone = mysqli_query($connection, $query);

                        queryErrors($postClone);

                        if($postClone){

                            header("Location: comments.php?source=comments&post_id={$_GET['post_id']}");
                            
                        }

                    break;


                    case 'Delete':
                        
                        $query = "DELETE FROM comments WHERE id = {$checkBoxValue}";
                        $delete = mysqli_query($connection, $query);
                        
                        if($delete){

                            header("Location: comments.php?source=comments&post_id={$_GET['post_id']}");
                            
                        }

                    break;


                }

                
            }

        }

    }



?>