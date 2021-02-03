     <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom:0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="color: black"><img id="logoimage" class="img-responsive" src=" <?php echo base_url();?>assets/img/sulogo.png" style="max-width: 140px;min-height:  20px ;max-height: 40px;margin-top: -10px; margin-left: -10px"</a>
                <a class="navbar-brand" href="#" style="color: black; margin-top:-10px; " id="brand-name">Clubs Management System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right" >
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <?php echo $this->session->userdata('crepName');//session to show who is logged in?>
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('index.php/LoginCtrl/logoutadmin'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url('index.php/Home/crep');?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <!--manage users-->
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Manage Users<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#"><i class="fa fa-angle-double-right fa-fw"></i>&nbsp;Manage Club Official<span class="fa arrow"></span></a>

                                         <ul class="nav nav-third-level">
                                            <li>
                                                <a href="<?php echo base_url('index.php/Home/crepclubofficialreg');?>"><i class="fa fa-plus-circle fa-fw"></i>&nbsp;Add/View Club Official</a>
                                            </li>
                                        </ul>
                                    </li>

                            </ul>
                            <!--second-level-->
                        </li>
                        <!--manage users-->

                        <!--manage clubs-->
                        <li>
                            <a href="#"><i class="fa fa-tasks fa-fw"></i> Manage Clubs <span class="fa arrow"></span></a>

                            <!-- /.nav-second-level -->
                            <ul class="nav nav-second-level">
                                <li>
                                     <a  href="<?php echo base_url('index.php/Home/crep'); ?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>View Club</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('index.php/Home/viewinactiveclubs');?>"><i class="fa fa-remove fa-fw" ></i>View Inactive Clubs</a>
                                </li>
                            </ul>

                        <li>
                            <a href="#"><i class="fa fa-bars fa-fw"></i> Club Members Views<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url('index.php/Home/crepclubmemberviews');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Members Per Club</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('index.php/Home/crepclubofficialviews');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Officials Per Club</a>
                                    </li>


                            </ul>
                            <!--second-level-->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-group fa-fw"></i> Club Meetings Views<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url('index.php/ClubController/crepmeetingsviews');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Club Meetings & Attendance</a>
                                    </li>

                                    <li>
                                        <a href="<?php echo base_url('index.php/ClubController/crep_clubminutesviews');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Club Minutes</a>
                                    </li>
                            </ul>
                            <!--second-level-->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-calendar fa-fw"></i> Club Events Views<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url('index.php/ClubController/crepeventsviews');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Club Events & Attendance</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('index.php/ClubController/crepevent_report_views');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Club Events Reports</a>
                                    </li>
                            </ul>
                            <!--second-level-->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-info-circle fa-fw"></i> Club Profiles<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url('index.php/Home/crep_clubconstitutions'); ?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Club Constitutions</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url('index.php/Home/crep_clubhistories'); ?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Clubs History</a>
                                    </li>
                            </ul>
                            <!--second-level-->
                        </li>
                         <li>
                            <a href="#"><i class="fa fa-certificate fa-fw"></i> Club Awards<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                    <li>
                                        <a href="#"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i>Add Club Award</a>
                                    </li>
                            </ul>
                            <!--second-level-->
                        </li>

                        <li class="text-center">
                            <a href="#" style="background-color: maroon;font-weight: bold;color:white"><span><i class="fa fa-copyright fa-fw"></i>2019 Clubs and Societies:</span><br><span ><i class="fa fa-flag fa-fw"></i>  Office of The Dean of Students</span><i class="fa fa-flag fa-fw"></i></a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
