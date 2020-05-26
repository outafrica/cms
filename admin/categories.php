<?php

    include "includes/header.php";

?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php

            include "includes/nav.php";

        ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome Admin
                            <small>Author</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="../admin">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Categories
                            </li>
                        </ol>
                        
                        <div class="col-xs-6">

                            <?php add_categories(); ?>

                            <!-- Add category -->
                            <form action="" method="post">
                            
                                <div class="form-group">

                                    <label for="category_title">Add New Category</label>
                                    <input class = "form-control" type="text" name = "title" >
                                
                                </div>
                                <div class="form-group">
                                
                                    <input class = "btn btn-primary" type = "submit" name = "submit" value = "Add Category" >
                            
                                </div>
                            
                            </form> 
                            
                            <!-- call edit function -->
                            <?php 

                                edit_categories();
                            
                            ?>                     
                        </div>
                        
                        <div class="col-xs-6">
                            <table class = "table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Display categories -->
                                    <?php
                                        show_categories();
                                    ?>

                                    <!-- Delete a category -->
                                    <?php
                                        delete_categories();                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php

        include "includes/footer.php";

    ?>
