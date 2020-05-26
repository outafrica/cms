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
                                               
                        <!-- Main content -->
                        <?php
                        
                            toggle_comments();
                        
                        ?>  
                        
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
