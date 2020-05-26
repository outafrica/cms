<?php

    function queryErrors($query){

        global $connection;

        if(!$query){

            die("Query Failed!". mysqli_error($connection));

        }

    }

    function add_comment(){

        global $connection;

        if(isset($_GET['post_id'])){

            $post_id = $_GET['post_id'];

        }
        
        if(isset($_POST['submit'])){

            $author = $_POST['author'];
            $email = $_POST['email'];
            $content = $_POST['comment'];
            $status = 'Unapproved';
                     
            if($author == ""|| empty($author)){

                echo "The author field is required!";

            }elseif($email == ""|| empty($email)){

                echo "The email field is required!";

            }elseif($content == ""|| empty($content)){

                echo "The comment field is required!";

            }else{

                $query = "INSERT INTO comments(post_id, author, email, content, status, date) ";
                $query .= "VALUE({$post_id}, '{$author}', '{$email}', '{$content}', '{$status}', now())";
                
                $create = mysqli_query($connection, $query);

                queryErrors($create);

                // $query = "UPDATE posts SET comment_count = comment_count + 1 WHERE id = $post_id ";
                // $update = mysqli_query($connection, $query);

                // queryErrors($update);

            }


            
        }

    }


    function registerUser(){

        global $connection;

        if(isset($_POST['submit'])){

            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if($username == "" || empty($username)){

                echo "Username required";

            }elseif($email == "" || empty($email)){

                echo "Email required";

            }elseif($password == "" || empty($password)){

                echo "Password required";

            }else{
                
                $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 10));
                $role = 'Subscriber';
                $query = "INSERT INTO users (username, email, password, role) ";
                $query .= "VALUES ('{$username}', '{$email}', '{$password}', '{$role}')";
                $register = mysqli_query($connection, $query);

                queryErrors($register);

                $message = "Successfully registered!";

                echo $message;

            }

            


        }

    }

    function contact(){

        global $connection;

        if(isset($_POST['submit'])){

            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $content = $_POST['content'];

            if($email == "" || empty($email)){

                echo "Email required";

            }elseif($subject == "" || empty($subject)){

                echo "Subject required";

            }elseif($content == "" || empty($content)){

                echo "Enter something in the message body";

            }else{
                
                $email = mysqli_real_escape_string($connection, $email);
                $subject = wordwrap(mysqli_real_escape_string($connection, $subject), 70);
                $content = mysqli_real_escape_string($connection, $content);

                mail("mohos96411@provlst.com", $subject, $content, $email);

                

            }

            


        }

    }
 
?>