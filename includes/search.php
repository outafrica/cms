<?php
                
    if(isset($_POST['search'])){
        
        $text = $_POST['text'];
        // echo $text;

        $query = "SELECT * FROM posts WHERE tags LIKE '%$text%'";
        $search = mysqli_query($connection, $query);

        if(!$search){

            die("Query failed!" .mysqli_error($connection));

        }

        $count = mysqli_num_rows($search);

        if($count == 0){
            
            echo '<h1>No results found</h1>';

        }else{
            echo "Some Result";
        }

    }

            ?>
