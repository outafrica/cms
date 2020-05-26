<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="./">CMS SYSTEM</a>
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
       
        <li>
            
            <a href=""> Users Online: <span class="online_users"></span></a>

        </li>
        
        <li>
            <a href="/">Home</a>
        </li>

        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i>
                <?php 
                    if(isset($_SESSION['username'])){
                        echo $_SESSION['username'];
                    } 
                ?> 
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="./profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>
    </ul>    
    <!-- /.navbar-collapse -->

    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php

        include "includes/sidemenu.php";

    ?>
</nav>