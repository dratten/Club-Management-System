        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="color: black"><img id="logoimage" class="img-responsive" src=" <?php echo base_url();?>assets/img/sulogo.png" style="max-width: 140px;min-height:  20px ;max-height: 40px;margin-top: -10px; margin-left: -10px"/a>
                <a class="navbar-brand" href="#" style="color: black; margin-top:-10px; " id="brand-name">Clubs Management System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                     <?php echo $this->session->userdata('officialName');//session to show who is logged in?>
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="<?php //echo base_url('Home/officialprofile?userid='); echo $this->session->userdata('pid'); ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li> -->
                        <!--  -->
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('index.php/LoginCtrl/logoutclub'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="#"><i class="fa fa-users fa-fw"></i> Manage Members<span class="fa arrow"></span></a>
                             <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('index.php/ClubController/clubpage');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Add / View Club Members</a>
                                </li>
                                 <li>
                                    <a href="<?php echo site_url('index.php/ClubController/joinrequests');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>View Join Requests</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('index.php/ClubController/nomination');?>"><i class="fa fa-check-circle fa-fw" aria-hidden="true" ></i>Officials Nomination</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('index.php/ClubController/unnominatemember');?>"><i class="fa fa-close fa-fw" aria-hidden="true" ></i>Officials Unnomination</a>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="#"><i class="fa fa-bars fa-fw"></i> Manage Club Meetings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="<?php echo site_url('index.php/ClubController/meetinginfo');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Add Club Meeting</a>
                                </li>
                                 <li>
                                    <a href="#"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i> Manage Attendance<span class="fa arrow"></span></a>

                                        <ul class="nav nav-third-level">

                                            <li>
                                                <a href="<?php echo site_url('index.php/ClubController/meetingattendance');?>"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i>Add Attendance</a>
                                            </li>
                                             <li>
                                                <a href="<?php echo site_url('index.php/ClubController/viewmeetingattendance');?>"><i class="fa fa-eye fa-fw" aria-hidden="true" ></i> View Attendance</a>
                                            </li>
                                             <li>
                                                <a href="<?php echo site_url('index.php/ClubController/meetingattendanceedit')  ?>"><i class="fa fa-edit fa-fw" aria-hidden="true" ></i> Edit Attendance</a>
                                            </li>

                                        </ul>
                                </li>

                                 <li>
                                    <a href="<?php echo site_url('index.php/ClubController/addminutes');?>"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i> Add/View Minutes</a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-calendar fa-fw"></i> Manage Club Events<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="<?php echo site_url('index.php/ClubController/eventinfo');?>"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i>Add Club Event</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('index.php/ClubController/newattending');?>"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i>Attending Non-Members</a>
                                 <li>
                                    <a href="#"><i class="fa fa-angle-double-right fa-fw" aria-hidden="true" ></i> Manage Attendance<span class="fa arrow"></span></a>

                                        <ul class="nav nav-third-level">

                                            <li>
                                                <a href="<?php echo site_url('index.php/ClubController/membereventattendance');?>"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i>Member Attendance</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('index.php/ClubController/non_membereventattendance');?>"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i>Non-Member Attendance</a>
                                            </li>
                                             <!-- <li>
                                                <a href="#"><i class="fa fa-edit fa-fw" aria-hidden="true" ></i> Edit Attendance</a>
                                            </li> -->

                                        </ul>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('index.php/ClubController/addeventreport');?>"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i> Add/View Event Report</a>
                                </li>

                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-info-circle fa-fw"></i> Club Profile<span class="fa arrow"></span></a>

                                <ul class="nav nav-second-level">

                                    <li>
                                        <a href="<?php echo site_url('index.php/ClubController/addclubconstitution');?>"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i>Add/View Constitution</a>
                                    </li>

                                    <li>
                                        <a href="<?php echo site_url('index.php/ClubController/addclubhistory');?>"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i>Add/View Club History</a>
                                    </li>
                                </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i> Manage Club Finances<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="<?php echo site_url('index.php/ClubController/clubexpenditure');?>"><i class="fa fa-plus-circle fa-fw"></i>&nbsp; Add Expenditure</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('index.php/ClubController/clubincome');?>"><i class="fa fa-plus-circle fa-fw"></i>&nbsp; Add Income</a>
                                </li> 
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-file-o fa-fw"></i> General File Uploads<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo site_url('index.php/ClubController/addclubupload');?>"><i class="fa fa-plus-circle fa-fw" aria-hidden="true" ></i>Club Uploads</a>
                                    </li>

                            </ul>
                            <!--second-level-->
                        </li>
                         <!-- <li>
                            <a href="#"><i class="fa fa-file-image-o fa-fw"></i> Image Gallery</a>
                        </li> -->
                        <li class="text-center">
                            <a href="#" style="background-color: maroon;font-weight: bold;color:white"><span><i class="fa fa-copyright fa-fw"></i>2019 Clubs and Societies:</span><br><span ><i class="fa fa-flag fa-fw"></i>  Office of The Dean of Students</span><i class="fa fa-flag fa-fw"></i></a>
                        </li>


                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
