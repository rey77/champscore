

<!-- Navigation -->
<nav  class="navbar top-nav navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        
        <a class="navbar-brand" href="organizer.php"><img class="logo" src="../img/Logo.png" alt=""/><img class ="logo-text" src="../img/text.png" alt=""/></a>
        
        
    </div>
    <!-- Top Menu Items -->
    <ul class="nav navbar-right top-nav">
        <li >
            <a href="allScoreboardsPublic.php" target="_blank"> ALL SCOREBOARDS

            </a>
        </li>
        <!--<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">

                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong><?php echo $_SESSION['username']; ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong><?php echo $_SESSION['username']; ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong><?php echo $_SESSION['username']; ?></strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-footer">
                    <a href="#">Read All New Messages</a>
                </li>
            </ul>
        </li>-->
        <!--<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu alert-dropdown">
                <li>
                    <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                </li>
                <li>
                    <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">View All</a>
                </li>
            </ul>
        </li>-->

        <li>
            <a href="loginsec/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
        </li>
        <!--
        
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li>
                    <a href="person.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="./public_html/php/loginsec/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                </li>
            </ul>
        </li>-->
    </ul>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <div  class="collapse navbar-collapse navbar-ex1-collapse">

        
        <ul  class="nav navbar-nav side-nav">
             
            
            <li><figure class="profile-userpic">
                    <img src="uploads/profile/<?php echo $_SESSION['user_id'] . ".jpg" ?>" class="img-responsive" alt="Profile Picture">
                </figure>

                <br></li>


            <li>
                <a href="index.php"><i class="fa fa-fw fa-home"></i> Home</a>
            </li>
            <li>
                <a href="person.php"><i class="fa fa-fw fa-user"></i> My Profile</a>
            </li>

            <li>
                <a href="organizer.php"><i class="fa fa-fw fa-fire"></i> Competitions</a>
            </li>

            <!--<li>
                <a href="javascript:;" data-toggle="collapse" data-target="#dropAthlete"><i class="fa fa-fw fa-user"></i> Athlete <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="dropAthlete" class="collapse">
                    <li>
                        <a href="athlete.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="enterRegCode.php"><i class="fa fa-fw fa-pencil"></i> Enter Reg Code</a>
                    </li>

                </ul>
            </li> -->

            <!--<li>
                <a href="javascript:;" data-toggle="collapse" data-target="#dropOrganizer"><i class="fa fa-fw fa-user"></i> Competition Host <i class="fa fa-fw fa-caret-down"></i></a>
                <ul id="dropOrganizer" class="collapse">
                    <li>
                        <a href="organizer.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>

                </ul>
            </li>-->
            <!-- <li>
                 <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
             </li>
             <li>
                 <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
             </li>
             <li>
                 <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
             </li>
             <li>
                 <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
             </li>
             <li>
                 <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
             </li>
             
             
            
         </ul>
     </div>
           
            <!-- /.navbar-collapse -->
            
        </ul>
        
        
    </div>
</nav>
