<?php

    include "db.php";
    include "functions.php";

    session_start();

    global $connection;

    if(isset($_POST['login'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_user = mysqli_query($connection, $query);

        queryErrors($select_user);

        while($row = mysqli_fetch_assoc($select_user)){

            $id = $row['id'];
            $name = $row['username'];
            $first = $row['firstname'];
            $last = $row['lastname'];
            $pass = $row['password'];
            $role = $row['role'];

        }

        if(password_verify($password, $pass) && $role == 'Admin'){

            $_SESSION['id'] = $id;
            $_SESSION['username'] = $name;
            $_SESSION['firstname'] = $first;
            $_SESSION['lastname'] = $last;
            $_SESSION['role'] = $role;

            header("Location: ../admin");

        }else{

            header("Location: ../index.php");

        }

    }





?>