    <?php
    /*the Club Controller Contains most of the functionalities of the Club Heads Section.
        General Organization:
        *   Begins with page loading functions
        *   Followed by page specific functions
        *   Related functions are follow each other more closely
    */
    defined('BASEPATH') OR exit('No direct script access allowed');
    /**
     * @name: Club Controller
     * @author: Stephen Mokoro: Student No: 078581; Phone: +254 (0) 719-508-386
     ** Phenom Technologies (Ph.T) Center, Strathmore University Research Club: researchclub@strathmore.edu
     *Disclaimer: All intellectual property rights remain with the developer
     */

    //controller to login users
    class ClubController extends CI_Controller
    {
        /*constructor to initialize variables and load tools*/
        function __construct()
            {
                parent::__construct();

                $this->load->model("ClubModel", "model");//contains most database connections for club heads section
                $this->load->model("MainModel", "mainmodel");//contains most database connections for admin section
                 $this->load->helper(array('form', 'url'));

            }
        public function joinrequests()
            {
                 if(!($this->session->userdata('clubhead_login')))//check if its club head logged in
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                            {
                                $this->load->view('clubheads/joinrequests');
                            }
            }
        public function rolespage()
            {
                 if(!($this->session->userdata('clubhead_login')))//check if its club head logged in
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                            {
                                $this->load->view('clubheads/roleselect');
                            }
            }

        public function clubpage()/*first page on club head login*/

            {
                if(!$this->session->userdata('clubhead_login'))//check if its club head logged in
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $clubID=$this->session->userdata('clubEmail');

                            $list =$this->model->clubmemberslist($clubID);

                            foreach ($list as $members)
                                {
                                    $pid=$members['pID'];
                                    $this->session->set_userdata('pid', $pid);
                                }
                           $this->load->view('clubheads/clubmemberreg');//load club members registration page
                        }
            }

    /* public function clubmember()//not in use for now
            {
                if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/clubmemberreg');
                        }
            }
    */
        public function meetinginfo()
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/meetinginfo');
                        }
            }


        public function eventinfo()/*load events list & event registration page*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/eventinfo');
                        }
            }

        public function meetingattendance()/*load new meeting attendance registration page*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/meetingattendance');
                        }
            }


        public function meetingattendanceedit()/*load meeting attendance updating page*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/editmeetingatt');
                        }
            }

    public function getmeetinginfo()/*get meeting info to populate meeting update form*/
        {
            if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $pid=$this->input->post('pid');

                            $list =$this->model->getmeetinginfo($pid);

                            $info=array();
                            foreach ($list as $meeting)
                                {   $end=$meeting['endTime'];
                                    $endtime=date("g:i A", strtotime($end));

                                    $start=$meeting['startTime'];
                                    $starttime=date("g:i A", strtotime($start));

                                    // date_format( date_create(date($endt)), ' g:i A' );
                                    $info= array('pID'=>$meeting['autoID'],'studentID' => $meeting['takingMinutes'],'meetingDate' => $meeting['meetingDate'],'meetingVenue' => $meeting['meetingVenue'],'startTime'=>$starttime,'endTime'=>$endtime,'firstName'=>$meeting['firstName'],'lastName'=>$meeting['lastName']);
                                }
                            echo json_encode($info);
                        }


        }
    public function meetingsviews()//view by admin
            {
                if(!$this->session->userdata('admin_login'))
                {
                         $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }else{
                    $this->load->view('admin/clubs/meetingsperclub');
                }
            }
    public function crepmeetingsviews()//view by clubs representative
            {
                if(!$this->session->userdata('crep_login'))
                {
                         $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }else{
                    $this->load->view('clubsrep/clubs/meetingsperclub');
                }
            }

    public function deletemeeting()//deleting meeting info. Generally updates status. No real deletion
        {

            if(!$this->session->userdata('clubhead_login'))//check if its club head logged in
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $meetingID=$this->input->post('id');
                            $deleted=array('deleted'=>1);
                            $outcome=$this->model->deletemeeting($meetingID,$deleted);

                           if ($outcome)
                                {
                                    $message['successful'][]=  "Meeting info successfully trashed";
                                    echo json_encode($message);//return success
                                }else
                                    {
                                        $message['fail'][]=  "Meeting not trashed";
                                         echo json_encode($message);//return no changes made
                                    }
                        }


        }

    public function viewmeetingattendance()/*load meeting attendance viewing page. Both admins and club heads can access this function*/
            {
                if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))

                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/viewmeetingattendance');
                        }
            }

    public function viewmeetingattperclubid()/*for admins  only. Load meetings per club view*/
            {
                 if(!($this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                                /*create session for meeting ID. This is used to show admin for which meeting he is viewing attendance*/
                                $_SESSION['meetingattendanceID']=$this->input->GET('meetingID');

                                $meetingID=$_SESSION['meetingattendanceID'];
                                $list2 = $this->model->meeting($meetingID);
    ;
                                $dat=array();

                                foreach ($list2->result() as $meeting)
                                    {
                                        $dat['date']=$meeting->meetingDate;
                                        $dat['venue']=$meeting->meetingVenue;
                                        $dat['from']=$meeting->startTime;
                                        $dat['meetingid']=$meetingID;
                                        $dat['clubname']=$this->input->GET('clubName');
                                    }


                                $this->load->view('admin/clubs/meetingattendance',$dat);
                        }


            }
    public function crepviewmeetingattperclubid()/*for clubs representative only. Load meetings per club view*/
            {
                 if(!($this->session->userdata('crep_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                                /*create session for meeting ID. This is used to show admin for which meeting he is viewing attendance*/
                                $_SESSION['meetingattendanceID']=$this->input->GET('meetingID');

                                $meetingID=$_SESSION['meetingattendanceID'];
                                $list2 = $this->model->meeting($meetingID);
    ;
                                $dat=array();

                                foreach ($list2->result() as $meeting)
                                    {
                                        $dat['date']=$meeting->meetingDate;
                                        $dat['venue']=$meeting->meetingVenue;
                                        $dat['from']=$meeting->startTime;
                                        $dat['meetingid']=$meetingID;
                                        $dat['clubname']=$this->input->GET('clubName');
                                    }


                                $this->load->view('clubsrep/clubs/meetingattendance',$dat);
                        }


            }

         public function eventsviews()//admin viewing events
            {
            if(!$this->session->userdata('admin_login'))
                {
                         $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }else{
                    $this->load->view('admin/clubs/eventsperclub');
                }
            }
            public function crepeventsviews()//clubs representative viewing events
            {
            if(!$this->session->userdata('crep_login'))
                {
                         $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }else{
                    $this->load->view('clubsrep/clubs/eventsperclub');
                }
            }
         public function vieweventattperclubid()/*load view for viewing event attendance per club by admin. */
            {
                if(!($this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            /*create session for event ID to be used to display the event for whcih the dean is viewing attendance*/

                            $_SESSION['eventattendanceID']=$this->input->GET('eventID');

                            $eventid=$_SESSION['eventattendanceID'];

                            $list = $this->model->event($eventid);

                            $data=array();

                            foreach ($list->result() as $event)
                                {
                                    $data['date']=$event->eventDate;
                                    $data['venue']=$event->eventVenue;
                                    $data['from']=$event->startTime;
                                    $data['eventid']=$eventid;
                                    $data['clubname']=$this->input->GET('clubName');

                                }

                                $this->load->view('admin/clubs/eventattendance',$data);
                        }
            }
         public function crepvieweventattperclubid()
         /*load view for viewing event attendance per club by club representative. */
            {
                if(!($this->session->userdata('crep_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            /*create session for event ID to be used to display the event for whcih the dean is viewing attendance*/

                            $_SESSION['eventattendanceID']=$this->input->GET('eventID');

                            $eventid=$_SESSION['eventattendanceID'];

                            $list = $this->model->event($eventid);

                            $data=array();

                            foreach ($list->result() as $event)
                                {
                                    $data['date']=$event->eventDate;
                                    $data['venue']=$event->eventVenue;
                                    $data['from']=$event->startTime;
                                    $data['eventid']=$eventid;
                                    $data['clubname']=$this->input->GET('clubName');

                                }

                                $this->load->view('clubsrep/clubs/eventattendance',$data);
                        }


            }
        public function membereventattendance()/*load page for adding event attendance for members*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/membereventattendance');
                        }
            }
        public function non_membereventattendance()/*load page for adding event attendance for members*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/nonmembereventattendance');
                        }
            }
        public function newattending()/*load page for adding non club members attending an event*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/eventattending');
                        }
            }
        public function geteventinfo()/*get event info to populate event update form*/
        {
            if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $pid=$this->input->post('pid');

                            $list =$this->model->geteventinfo($pid);

                            $info=array();
                            foreach ($list as $event)
                                {   $end=$event['endTime'];
                                    $endtime=date("g:i A", strtotime($end));

                                    $start=$event['startTime'];
                                    $starttime=date("g:i A", strtotime($start));

                                    // date_format( date_create(date($endt)), ' g:i A' );
                                    $info= array('pID'=>$event['autoID'],'eventDate' => $event['eventDate'],'eventVenue' => $event['eventVenue'],'startTime'=>$starttime,'endTime'=>$endtime,'description'=>$event['description']);
                                }
                        }
                            echo json_encode($info);



        }

        public function deleteevent()//deleting event info. Generally updates status. No real deletion
        {

            if(!$this->session->userdata('clubhead_login'))//check if its club head logged in
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $eventID=$this->input->post('id');
                            $deleted=array('deleted'=>1);
                            $outcome=$this->model->deleteevent($eventID,$deleted);

                           if ($outcome)
                                {
                                    $message['successful'][]=  "Event info successfully trashed";
                                    echo json_encode($message);//return success
                                }else
                                    {
                                        $message['fail'][]=  "Event not trashed";
                                         echo json_encode($message);//return no changes made
                                    }
                        }


        }
        public function nonmembereventattendance()/*load page for adding event attendance for non-members*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/nonmembereventattendance');
                        }
            }
        public function meetinginattendance()/*load page for adding new people o=inattendance.*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                             $this->load->view('clubheads/inattendance');
                        }
            }
        public function addclubconstitution()/*load page for adding club constitution*/
            {
                if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                            $data = array('files'=>$this->model->getconstitutions($clubID));

                            $this->load->view('clubheads/addclubconstitution',$data);
                        }
            }



      //
      public function addclubupload()/*load page for adding club constitution*/
          {
              if(!$this->session->userdata('clubhead_login'))
                  {
                           $data = array('profile'=>$this->mainmodel->clubProfile());
                             $this->load->view('login',$data);
                  }
                      else
                      {
                          $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                          $data = array('files'=>$this->model->getuploads($clubID));

                          $this->load->view('clubheads/clubuploads',$data);
                      }
          }
         public function addclubhistory()/*load page for adding club history*/
            {
                if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                            $data = array('files'=>$this->model->getclubhistories($clubID));

                            $this->load->view('clubheads/addclubhistory',$data);
                        }
            }
        public function partnerships()/*load page for adding club partnerships*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/partnerships');
                        }
            }
        function dossuggestions()/*load page for adding suggestions to Dean of Students*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/dossuggestions');
                        }
            }

        function clubexpenditure()/*load page for adding club expenses*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/clubexpenditure');
                        }
            }
      function clubincome()//load page for adding club incomes
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $this->load->view('clubheads/clubincome');
                        }
            }


    public function nomination()/*load page for nominating club leaders. */
        {
            if(!$this->session->userdata('clubhead_login'))
                {
                         $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }else
                    {
                        $this->load->view('clubheads/officialsnomination');
                    }
        }

    public function unnominatemember()/*load page for unnominating club */
        {
            if(!$this->session->userdata('clubhead_login'))
                {
                         $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }else
                    {
                        $this->load->view('clubheads/unnominate');
                    }
        }

     public   function addminutes()/* load page for adding club minutes*/
            {
                 if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                            {
                                $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                                $data = array('files'=>$this->model->getclubminutes($clubID));
                                $this->load->view('clubheads/minutes',$data);
                            }

            }
    public function event_report_views()/*club event reports admin view*/
    {
         if(!($this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $this->load->view('admin/clubs/club_event_reports_views');
                    }

    }
    public function crepevent_report_views()/*club event reports*/
    {
         if(!($this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $this->load->view('clubsrep/clubs/club_event_reports_views');
                    }

    }
    public function club_minutes_views()/*club minutes views by admin*/
    {
         if(!($this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $this->load->view('admin/clubs/club_minutes');
                    }

    }
    public function crep_clubminutesviews()/*club minutes views by clubs representative*/
    {
         if(!($this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $this->load->view('clubsrep/clubs/club_minutes');
                    }

    }
    public function perclubeventreports()//get event reports per club
            {
                 if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $clubID=$this->input->get('clubID');
                            $list = $this->model->perclubeventreports($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $report)
                                {
                                    $eventdate=$report['eventDate'];
                                    $formattedDate = date("d/m/Y", strtotime($eventdate));

                                    $start=$report['startTime'];
                                    $starttime=date("g:i A", strtotime($start));


                                    $reportParticulars="";
                                    if($report['file_ext']==".doc"||$report['file_ext']==".docx")
                                        {
                                            $reportParticulars='<span><i class="fa fa-file-word-o fa-lg" style="color:blue"></i></span> Report of the event held on '.$formattedDate." at ".$report['eventVenue']." from ".$starttime;
                                        }
                                        else if($report['file_ext']==".pdf")
                                            {
                                                $reportParticulars='<span><i class="fa fa-file-pdf-o fa-lg" style="color:red"></i></span> Report of the event held on '.$formattedDate." at ".$report['eventVenue']." from ".$starttime;
                                            }else if($report['file_ext']==".xls"||$report['file_ext']==".xlsx")
                                                {
                                                    $reportParticulars='<span><i class="fa fa-file-excel-o fa-lg" style="color:#33bbff "></i></span> Report of the event held on '.$formattedDate." at ".$report['eventVenue']." from ".$starttime;
                                                }


                                    $data['data'][] = array('particulars' => $reportParticulars,'action'=>$report['file_name'],'count'=>$count);
                                    $count=$count +1;
                                }

                            echo json_encode($data);

                        }
            }


        function addeventreport()
            {
                if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                             $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                                $data = array('files'=>$this->model->geteventreports($clubID));
                            $this->load->view('clubheads/ereport',$data);
                        }


            }




    public function clubmemberslist()/* List of club members*/
        {

                if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                            $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/

                            $list =$this->model->clubmemberslist($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $members)
                                {
                                    if ($members['payment']=='1')/* check if member has paid registration fee. If 1 i.e. paid, return "Paid"*/
                                    {
                                        $fullname=$members['firstName']. " ". $members['lastName'];
                                    $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'payment'=>"Paid",'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                                    $count=$count +1;
                                    }else if ($members['payment']=='0') {
                                        $fullname=$members['firstName']. " ". $members['lastName'];
                                    $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'payment'=>"Not Paid",'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                                    $count=$count +1;
                                    }


                                }

                            echo json_encode($data);
                        }
        }

    public function joinrequestslist()/* List of club members*/
        {

                if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                            $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/

                            $list =$this->model->joinrequestslist($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $members)
                                {
                                    $fullname=$members['firstName']. " ". $members['lastName'];
                                    $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'payment'=>"Paid",'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                                    $count=$count +1;

                                }

                            echo json_encode($data);
                        }
        }


    public function nonclubmemberslist()/* List of club event attending students not members of a clubmembers*/
        {

                if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                            $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/

                            $list =$this->model->nonclubmemberslist($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $members)
                                {

                                    $fullname=$members['firstName']. " ". $members['lastName'];
                                    $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                                    $count=$count +1;
                                }

                            echo json_encode($data);
                        }
        }

    /*function viewclubmember() to view members profiles. Both admin and club head can see member profiles. Both Admin i.e. Dean and Club heads have access to this function*/
    public function viewclubmember()
        {

            if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                            $pid=$this->input->post('pid');

                            $list =$this->model->viewclubmember($pid);

                            $data = array();

                            foreach ($list as $members)
                                {
                                     $dateRegistered=$members['dateRegistered'];
                                    // $formattedDate = date("d/m/Y", strtotime($meetingdate));

                                    $fullname=$members['firstName']. " ". $members['lastName'];
                                    $data= array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'gender'=>$members['gender'],'courseID'=>$members['courseID'],'clubName'=>$members['clubName'],'suEmail'=>$members['suEmail'],'dateRegistered'=>$dateRegistered,'lastUpdated'=>$members['updated']);
                                }

                            echo json_encode($data);//data should be a plain array...
                        }



        }


    /*function legible() below checks members legible for nomination as club officials. Member should be active, not deleted, and should not be having a current leadership role in the same club. If he/she has an active role in the same club, he/she must first be disabled from current leadership in club by the Dean of Students.*/
    public function legible()
        {

                if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                            $clubID=$this->session->userdata('clubEmail');

                            $list =$this->model->legibleclubmemberslist($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $members)
                                {

                                        $fullname=$members['firstName']. " ". $members['lastName'];
                                    $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                                    $count=$count +1;

                                }

                            echo json_encode($data);
                        }



        }


    public function officialnomination()/*function to nominate club officials*/
        {
            if(!$this->session->userdata('clubhead_login'))
                {
                         $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }else
                    {
                        $studentPID=$this->input->post('studentPID');
                        $studentInfo=array('nominated'=>"1");
                        if($this->model->officialnomination($studentPID,$studentInfo))
                            {
                                $message['successful'][]=  "Nomination Successful";
                                 echo json_encode($message);
                            }else{$message['fail'][]=  "Nomination Failed";
                                 echo json_encode($message);}
                    }
        }

    public function officialunnomination()/*function to unnominate a nominated official*/
        {
            if(!$this->session->userdata('clubhead_login'))
                {
                         $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }else
                    {
                        $studentPID=$this->input->post('studentPID');
                        $studentInfo=array('nominated'=>"0");
                        if($this->model->officialunnomination($studentPID,$studentInfo))
                            {
                                $message['successful'][]=  "Nomination Successful";
                                 echo json_encode($message);
                            }else{$message['fail'][]=  "Nomination Failed";
                                 echo json_encode($message);}
                    }
        }


    /*function to get a list of nominated club officials. this function is accessible to both the club heads and the admin*/
    public function nominated()
        {

                if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                            $clubID=$this->session->userdata('clubEmail');

                            $list =$this->model->nominatedclubmemberslist($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $members)
                                {

                                        $fullname=$members['firstName']. " ". $members['lastName'];
                                    $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                                    $count=$count +1;

                                }

                            echo json_encode($data);
                        }



        }


    /*function viewclubmemberslist() get the list of club members. Accessible to Dean of Students and the Club heads*/
    public function viewclubmemberslist()
        {
            if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                                $clubID=$this->input->GET('clubID');/*get the club id as posted*/
                                if($clubID=="All")/*For admin: if viewing club members from all clubs */
                                    {
                                         $list =$this->model->allclubmemberslist();

                                        $data = array();
                                        $count=1;/*counter to count per returned member*/

                                        foreach ($list as $members)
                                            {
                                                if ($members['status']=='1')/*if status is one, indicate active*/
                                                {
                                                    $fullname=$members['firstName']. " ". $members['lastName'];
                                                $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'status'=>$members['clubName'],'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                                                $count=$count +1;
                                                }else if ($members['status']=='0') {
                                                    $fullname=$members['firstName']. " ". $members['lastName'];
                                                $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'status'=>$members['clubName'],'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                                                $count=$count +1;
                                                }


                                            }

                                        echo json_encode($data);


                                    }else/*if a specific club id (clubemail) is submitted, get members for that club*/
                                        {
                                           $list =$this->model->clubmemberslist($clubID);

                                            $data = array();
                                            $count=1;

                                            foreach ($list as $members)
                                                {
                                                    if ($members['status']=='1')
                                                    {
                                                        $fullname=$members['firstName']. " ". $members['lastName'];
                                                        $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'status'=>"Active",'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                                                        $count=$count +1;
                                                    }else if ($members['status']=='0')
                                                        {
                                                            $fullname=$members['firstName']. " ". $members['lastName'];
                                                            $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseID'],'status'=>"Inactive",'action'=>$members['suID'],'count'=>$count,'clubID'=>$clubID);
                                                            $count=$count +1;
                                                        }


                                                }

                                            echo json_encode($data);

                                        }
                        }
        }


    /* function oursedropdownlist() to return a list of courses to populate a dropdown list during clubmember registration and/or update */
    public function coursedropdownlist()
        {
             $list = $this->model->coursedropdown();

             $data=array();
            foreach ($list->result() as $courses)
                {
                    $data[$courses->courseID]=$courses->courseID;/*returns course with associated courseID. The second parameter may be something like $data[$courses->courseID]=$courses->$courseName*/
                }
            $new=array_unique($data,SORT_STRING);
            echo json_encode($new);
        }


    public function getclubmember()/*get club member for editing*/

        {
            if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $id=$this->input->post('pid');

                            $list =$this->model->editclubmember($id);

                            $info=array();
                            foreach ($list as $member)
                                {

                                    $info= array('pID'=>$member['pID'],'suID' => $member['suID'],'firstName' => $member['firstName'],'lastName' => $member['lastName'],'gender'=>$member['gender'],'payment'=>$member['payment'],'suEmail' => $member['suEmail'],'telNo' => $member['telNo'],'courseID' => $member['courseID']);
                                }
                            echo json_encode($info);
                        }


        }


    public function fnongistration()/*function to register club members*/
    {
        if(!$this->session->userdata('clubhead_login'))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
            }
                else
                    {
                        //collect ajax-submitted data
                           $suid=$this->input->post('suid');
                           $lastname=$this->input->post('lastname');
                           $firstname=$this->input->post('firstname');
                           $gender=$this->input->post('gender');
                           $payment=$this->input->post('payment');
                           $phone=$this->input->post('phone');
                           $suemail=$this->input->post('suemail');
                           $course=$this->input->post('course');


                          $clubid=$this->session->userdata('clubEmail');
                          $defaultpass=md5($suid.$course);

                            //create an array of data to be saved into db
                            $clubmemberinfo=array(
                                                'suID'=>$suid,
                                                'lastName'=>$lastname,
                                                'firstName'=>$firstname,
                                                'gender'=>$gender,
                                                'payment'=>$payment,
                                                'telNo'=>$phone,
                                                'suEmail'=>$suemail,
                                                'clubID'=>$clubid,
                                                'courseID'=>$course,
                                                'password'=>$defaultpass

                                            );


                             //set success messages array
                        $array = array('successful' =>"Club Member Registration Successful!",'fail'=>"Registration failed",'null'=>"null entry",'error'=>"No changes were made",'exists_but_inactive'=>"inactive");


                        //check if required fields are empty
                        if ($suid=="" || $lastname=="" || $firstname=="" || $suemail==""|| $clubid==""||$course=="" ||$phone==""||$gender==""||$payment=="")
                            {
                                $message['null'][]=  $array;//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else//if all required fields are not null, proceed
                                    {
                                         //check if the new member was earlier registered to the club and is active

                                        $this->db->select('*');
                                        $this->db->from('clubmembers');
                                        $this->db->where('suID',$suid);
                                        $this->db->where('clubID',$clubid);
                                        $this->db->where('status',1);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();



                                        if($num>0)
                                           {//If the new member was earlier registered to the club and is active return fail message

                                                        $message['fail'][]=  $array;
                                                        echo json_encode($message);

                                            }   else
                                                    {
                                                        //If the new member was earlier registered to the club but has been marked as inactive.
                                                        $this->db->select('*');
                                                        $this->db->from('clubmembers');
                                                        $this->db->where('suID',$suid);
                                                        $this->db->where('clubID',$clubid);
                                                        $this->db->where('status',0);
                                                        $this->db->where('deletionStatus',0);
                                                        $query = $this->db->get();
                                                        $num=$query->num_rows();

                                                                if ($num>0)
                                                                {// If the member exists but marked inactive, Ask clubhead to activate member instead of registering him/her again
                                                                    $message['exists_but_inactive'][]=  $array;
                                                                    echo json_encode($message);
                                                                } else {
                                                                        //If the member doesn't exist in the club or was deleted proceed to register
                                                                        //If the new member was earlier registered to the club but has been marked as inactive.
                                                                        $this->db->select('*');
                                                                        $this->db->from('clubmembers');
                                                                        $this->db->where('suID',$suid);
                                                                        $this->db->where('clubID',$clubid);
                                                                        $this->db->where('status',0);
                                                                        $this->db->where('deletionStatus',1);
                                                                        $query = $this->db->get();
                                                                        $num=$query->num_rows();


                                                                        if($num>0)
                                                                            {
                                                                                 $updates=array('status' =>"1",'deletionStatus'=>"0");
                                                                                $result=$this->model->undeleteclubmember($suid,$clubid,$updates);

                                                                                if ($result)
                                                                                    {
                                                                                        $message['successful'][]=  $array;

                                                                                        echo json_encode($message);//return success
                                                                                    }else
                                                                                        {
                                                                                            $message['error'][]=  $array;

                                                                                            echo json_encode($message);//return fail
                                                                                        }
                                                                            }
                                                                            else{
                                                                                    $result=$this->model->registerclubmember($clubmemberinfo);

                                                                                    if ($result)
                                                                                        {
                                                                                            $message['successful'][]=  $array;

                                                                                            echo json_encode($message);//return success
                                                                                        }else
                                                                                            {
                                                                                                $message['error'][]=  $array;

                                                                                                echo json_encode($message);//return fail
                                                                                            }
                                                                                }
                                                                        }
                                                    }



                                    }
                   }
    }

    public function clubmemberregistration()/*function to register club members*/
    {
        if(!$this->session->userdata('clubhead_login'))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
            }
                else
                    {
                        //collect ajax-submitted data
                           $suid=$this->input->post('suid');
                           $lastname=$this->input->post('lastname');
                           $firstname=$this->input->post('firstname');
                           $gender=$this->input->post('gender');
                           $payment=$this->input->post('payment');
                           $phone=$this->input->post('phone');
                           $suemail=$this->input->post('suemail');
                           $course=$this->input->post('course');

                            $dateRegistered = date("Y-m-d H:i:s");



                          $clubid=$this->session->userdata('clubEmail');
                          $defaultpass=md5($suid.$course);

                            //create an array of data to be saved into db
                            $clubmemberinfo=array(
                                                'suID'=>$suid,
                                                'lastName'=>$lastname,
                                                'firstName'=>$firstname,
                                                'gender'=>$gender,
                                                'payment'=>$payment,
                                                'telNo'=>$phone,
                                                'suEmail'=>$suemail,
                                                'clubID'=>$clubid,
                                                'courseID'=>$course,
                                                'password'=>$defaultpass,
                                                'dateRegistered'=>$dateRegistered

                                            );


                             //set success messages array
                        $array = array('successful' =>"Club Member Registration Successful!",'fail'=>"Registration failed",'null'=>"null entry",'error'=>"No changes were made",'exists_but_inactive'=>"inactive");


                        //check if required fields are empty
                        if ($suid=="" || $lastname=="" || $firstname=="" || $suemail==""|| $clubid==""||$course=="" ||$phone==""||$gender==""||$payment=="")
                            {
                                $message['null'][]=  $array;//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else//if all required fields are not null, proceed
                                    {
                                         //check if the new member was earlier registered to the club and is active

                                        $this->db->select('*');
                                        $this->db->from('clubmembers');
                                        $this->db->where('suID',$suid);
                                        $this->db->where('clubID',$clubid);
                                        $this->db->where('status',1);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();



                                        if($num>0)
                                           {//If the new member was earlier registered to the club and is active return fail message

                                                        $message['fail'][]=  $array;
                                                        echo json_encode($message);

                                            }   else
                                                    {
                                                        //If the new member was earlier registered to the club but has been marked as inactive.
                                                        $this->db->select('*');
                                                        $this->db->from('clubmembers');
                                                        $this->db->where('suID',$suid);
                                                        $this->db->where('clubID',$clubid);
                                                        $this->db->where('status',0);
                                                        $this->db->where('deletionStatus',0);
                                                        $query = $this->db->get();
                                                        $num=$query->num_rows();

                                                                if ($num>0)
                                                                {// If the member exists but marked inactive, Ask clubhead to activate member instead of registering him/her again
                                                                    $message['exists_but_inactive'][]=  $array;
                                                                    echo json_encode($message);
                                                                } else {
                                                                        //If the member doesn't exist in the club or was deleted proceed to register
                                                                        //If the new member was earlier registered to the club but has been marked as inactive.
                                                                        $this->db->select('*');
                                                                        $this->db->from('clubmembers');
                                                                        $this->db->where('suID',$suid);
                                                                        $this->db->where('clubID',$clubid);
                                                                        $this->db->where('status',0);
                                                                        $this->db->where('deletionStatus',1);
                                                                        $query = $this->db->get();
                                                                        $num=$query->num_rows();


                                                                        if($num>0)
                                                                            {
                                                                                 $updates=array('status' =>"1",'deletionStatus'=>"0");
                                                                                $result=$this->model->undeleteclubmember($suid,$clubid,$updates);

                                                                                if ($result)
                                                                                    {
                                                                                        $message['successful'][]=  $array;

                                                                                        echo json_encode($message);//return success
                                                                                    }else
                                                                                        {
                                                                                            $message['error'][]=  $array;

                                                                                            echo json_encode($message);//return fail
                                                                                        }
                                                                            }
                                                                            else{
                                                                                    $result=$this->model->registerclubmember($clubmemberinfo);

                                                                                    if ($result)
                                                                                        {
                                                                                            $message['successful'][]=  $array;

                                                                                            echo json_encode($message);//return success
                                                                                        }else
                                                                                            {
                                                                                                $message['error'][]=  $array;

                                                                                                echo json_encode($message);//return fail
                                                                                            }
                                                                                }
                                                                        }
                                                    }



                                    }
                   }
    }

public function joinClub()/*function to send request to join a club*/
    {
                            //collect ajax-submitted data
                           $clubid=$this->input->post('clubemail');
                           $suid=$this->input->post('suid');
                           $lastname=$this->input->post('lastname');
                           $firstname=$this->input->post('firstname');
                           $gender=$this->input->post('gender');
                           $payment=$this->input->post('payment');
                           $phone=$this->input->post('phone');
                           $suemail=$this->input->post('suemail');
                           $course=$this->input->post('course');

                            $dateRegistered = date("Y-m-d H:i:s");

                          $defaultpass=md5($suid.$course);

                            //create an array of data to be saved into db
                            $clubmemberinfo=array(
                                                'suID'=>$suid,
                                                'lastName'=>$lastname,
                                                'firstName'=>$firstname,
                                                'gender'=>$gender,
                                                'telNo'=>$phone,
                                                'suEmail'=>$suemail,
                                                'clubID'=>$clubid,
                                                'courseID'=>$course,
                                                'password'=>$defaultpass,
                                                'status'=>0,
                                                'membership'=>0,
                                                'joinRequest'=>1,
                                                'dateRegistered'=>$dateRegistered

                                            );
                        //check if required fields are empty
                        if ($suid=="" || $lastname=="" || $firstname=="" || $suemail==""|| $clubid==""||$course=="" ||$phone==""||$gender=="")
                            {
                                $message['null'][]=  "A required field is empty";//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else//if all required fields are not null, proceed
                                    {
                                        //check if the new member was earlier registered to the club and is active
                                        $this->db->select('*');
                                        $this->db->from('clubmembers');
                                        $this->db->where('suID',$suid);
                                        $this->db->where('clubID',$clubid);
                                        $this->db->where('status',1);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();
                                        if($num>0)
                                           {//If the new member was earlier registered to the club and is active return fail message
                                                    $message['activemember'][]=  "Already an active member of the club";
                                                    echo json_encode($message);
                                            }   else
                                                    {
                                                        //If the new member was earlier registered to the club but has been marked as inactive.
                                                        $this->db->select('*');
                                                        $this->db->from('clubmembers');
                                                        $this->db->where('suID',$suid);
                                                        $this->db->where('clubID',$clubid);
                                                        $this->db->where('status',0);
                                                        $this->db->where('joinRequest',0);
                                                        $this->db->where('deletionStatus',0);//not necessary
                                                        $query = $this->db->get();
                                                        $num=$query->num_rows();

                                                                if ($num>0)
                                                                {// If the member exists but marked inactive, Ask clubhead to activate member instead of registering him/her again
                                                                    $message['inactive'][]=  "Already exists but is marked as inactive";
                                                                    echo json_encode($message);
                                                                } else {
                                                                            //If the member was deleted proceed to undelete and mark as request
                                                                            $this->db->select('*');
                                                                            $this->db->from('clubmembers');
                                                                            $this->db->where('suID',$suid);
                                                                            $this->db->where('clubID',$clubid);
                                                                            $this->db->where('status',0);
                                                                            $this->db->where('deletionStatus',1);
                                                                            $query = $this->db->get();
                                                                            $num=$query->num_rows();
                                                                            if($num>0)
                                                                                {
                                                                                     $updates=array('status' =>"0",'deletionStatus'=>"0",'joinRequest'=>"1",'membership'=>"0");
                                                                                    $result=$this->model->undeleteclubmember($suid,$clubid,$updates);

                                                                                    if ($result)
                                                                                        {
                                                                                            $message['successful'][]=  "Request to join club successful";

                                                                                            echo json_encode($message);//return success
                                                                                        }else
                                                                                            {
                                                                                                $message['error'][]=  "An error occurred";

                                                                                                echo json_encode($message);//return fail
                                                                                            }
                                                                                }//
                                                                                    else{

                                                                                            //Check If request already sent.
                                                                                            $this->db->select('*');
                                                                                            $this->db->from('clubmembers');
                                                                                            $this->db->where('suID',$suid);
                                                                                            $this->db->where('clubID',$clubid);
                                                                                            $this->db->where('joinRequest',1);
                                                                                            $query = $this->db->get();
                                                                                            $num=$query->num_rows();

                                                                                                    if ($num>0)
                                                                                                    {// If request already sent then..
                                                                                                        $message['requested'][]=  "Already Requested to join this club";
                                                                                                        echo json_encode($message);
                                                                                                    } else {//if completely new request proceed to save
                                                                                                            $result=$this->model->registerclubmember($clubmemberinfo);

                                                                                                            if ($result)
                                                                                                                {
                                                                                                                    $message['successful'][]="Request Successfully Sent";

                                                                                                                    echo json_encode($message);//return success
                                                                                                                }else
                                                                                                                    {
                                                                                                                        $message['error'][]=  "An error occurred";

                                                                                                                        echo json_encode($message);//return fail
                                                                                                                    }
                                                                                                            }
                                                                                        }
                                                                        }
                                                    }



                                    }
    }


    public function nonclubmemberregistration()/*function to register club members*/
    {
        if(!$this->session->userdata('clubhead_login'))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
            }
                else
                    {
                        //collect ajax-submitted data
                           $suid=$this->input->post('suid');
                           $lastname=$this->input->post('lastname');
                           $firstname=$this->input->post('firstname');
                           $gender=$this->input->post('gender');
                           $phone=$this->input->post('phone');
                           $suemail=$this->input->post('suemail');
                           $course=$this->input->post('course');
                            $dateRegistered = date("Y-m-d H:i:s");


                          $clubid=$this->session->userdata('clubEmail');
                          $defaultpass=md5($suid.$course);

                            //create an array of data to be saved into db
                            $nonclubmemberinfo=array(
                                                'suID'=>$suid,
                                                'lastName'=>$lastname,
                                                'firstName'=>$firstname,
                                                'gender'=>$gender,
                                                'telNo'=>$phone,
                                                'suEmail'=>$suemail,
                                                'clubID'=>$clubid,
                                                'courseID'=>$course,
                                                'status'=>0,
                                                'membership'=>0,
                                                'password'=>$defaultpass,
                                                'dateRegistered'=>$dateRegistered

                                            );


                        //check if required fields are empty
                        if ($suid=="" || $lastname=="" || $firstname=="" || $suemail==""|| $clubid==""||$course=="" ||$phone==""||$gender=="")
                            {
                                $message['null'][]=  "Some required field is missing";//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else//if all required fields are not null, proceed
                                    {
                                         //check if the new event attending member was earlier registered to the club

                                        $this->db->select('*');
                                        $this->db->from('clubmembers');
                                        $this->db->where('suID',$suid);
                                        $this->db->where('clubID',$clubid);
                                        $this->db->where('membership',0);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();

                                        if($num>0)
                                           {//If the new event attending member was earlier registered to the club  return fail message

                                                        $message['duplicate'][]=  "Duplicate entries";
                                                        echo json_encode($message);

                                            }   else
                                                    {

                                                        $result=$this->model->registernonclubmember($nonclubmemberinfo);

                                                        if ($result)
                                                            {
                                                                $message['successful'][]=  "Successful registration";
                                                                 echo json_encode($message);//return success
                                                            }else
                                                                {
                                                                    $message['error'][]=  "Failed. Error";
                                                                    echo json_encode($message);//return fail
                                                                }
                                                    }



                                    }
                   }
    }



    public function clubmemberupdate()/*function  to update club member*/
    {
         if(!$this->session->userdata('clubhead_login'))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
            }
                else
                    {
                       //collect ajax-submitted data
                       $pid=$this->input->post('pid');
                       $suid=$this->input->post('suid');
                       $lastname=$this->input->post('lastname');
                       $firstname=$this->input->post('firstname');
                       $gender=$this->input->post('gender');
                       $payment=$this->input->post('payment');
                       $phone=$this->input->post('phone');
                       $suemail=$this->input->post('suemail');
                       $course=$this->input->post('course');

                        $dateUpdated = date("Y-m-d H:i:s");



                      $clubid=$this->session->userdata('clubEmail');

                        //create an array of data to be saved into db
                        $clubmemberinfo=array('lastName'=>$lastname, 'firstName'=>$firstname,'gender'=>$gender,
                                            'payment'=>$payment, 'telNo'=>$phone, 'suID'=>$suid,'suEmail'=>$suemail,
                                            'clubID'=>$clubid, 'courseID'=>$course,'updated'=>$dateUpdated);

                         //set success messages array
                        $array = array('successful' =>"Club Member Info Updated Successfully!",'fail'=>"Updating Unsuccessful",'null'=>"null entry",'nochange'=>"No changes were made");


                    //check if required fields are empty
                    if ( $lastname=="" || $firstname=="" || $suemail==""|| $clubid==""||$course=="" ||$phone==""||$gender==""||$payment=="")
                        {
                            $message['null'][]=  $array;// message if required field is empty

                            echo json_encode($message);//return null message

                        }else//if all required fields are not null, proceed
                                {
                                     //pass array of data to model for saving
                                     $result=$this->model->updateclubmember($clubmemberinfo, $pid);
                                            if ($result)
                                                {
                                                    $message['successful'][]=  $array;

                                                    echo json_encode($message);//return success
                                                }else
                                                {
                                                    $message['nochange'][]=  $array;

                                                    echo json_encode($message);//return no changes made
                                                }




                                }
                }
    }

    public function nonclubmemberupdate()/*function  to update club member*/
    {
         if(!$this->session->userdata('clubhead_login'))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
            }
                else
                    {
                       //collect ajax-submitted data
                       $pid=$this->input->post('pid');
                       $suid=$this->input->post('suid');
                       $lastname=$this->input->post('lastname');
                       $firstname=$this->input->post('firstname');
                       $gender=$this->input->post('gender');
                       $phone=$this->input->post('phone');
                       $suemail=$this->input->post('suemail');
                       $course=$this->input->post('course');
                        $dateUpdated = date("Y-m-d H:i:s");



                      $clubid=$this->session->userdata('clubEmail');

                        //create an array of data to be saved into db
                        $nonclubmemberinfo=array('lastName'=>$lastname, 'firstName'=>$firstname,'gender'=>$gender,
                                             'telNo'=>$phone, 'suID'=>$suid,'suEmail'=>$suemail,
                                            'clubID'=>$clubid, 'courseID'=>$course,'updated'=>$dateUpdated);

                         //set success messages array
                        $array = array('successful' =>"Club Member Info Updated Successfully!",'fail'=>"Updating Unsuccessful",'null'=>"null entry",'nochange'=>"No changes were made");


                    //check if required fields are empty
                    if ( $lastname=="" || $firstname=="" || $suemail==""|| $clubid==""||$course=="" ||$phone==""||$gender=="")
                        {
                            $message['null'][]=  $array;// message if required field is empty

                            echo json_encode($message);//return null message

                        }else//if all required fields are not null, proceed
                                {
                                     //pass array of data to model for saving
                                     $result=$this->model->updatenonclubmember($nonclubmemberinfo, $pid);
                                            if ($result)
                                                {
                                                    $message['successful'][]=  $array;

                                                    echo json_encode($message);//return success
                                                }else
                                                {
                                                    $message['nochange'][]=  $array;

                                                    echo json_encode($message);//return no changes made
                                                }




                                }
                }
    }



    public function deleteclubmember()/*function to delete club members. Actually, only status changes to indicate deletion.*/
        {
            if(!$this->session->userdata('clubhead_login'))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
            }
                else
                    {

                        $pid=$this->input->post('pid');
                         $updates=array('status' =>"0",'deletionStatus'=>"1");

                        $array = array('successful' =>"Club member deleted successfully!",'fail'=>"Club member deletion failed");


                         if ($this->model->deleteclubmember($pid,$updates)==true)
                                        {
                                            $message['successful']=  $array;

                                            echo json_encode($message);
                                        }else
                                            {
                                                $message['fail']=  $array;
                                                echo json_encode($message);
                                            }
                    }
        }

    public function approverequest()/*function to approve join requests.*/
        {
            if(!$this->session->userdata('clubhead_login'))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
            }
                else
                    {

                        $pid=$this->input->post('pid');
                         $updates=array('status' =>"1",'membership'=>'1','joinRequest'=>"0");

                         if ($this->model->approverequest($pid,$updates)==true)
                                        {
                                            $message['successful']=  "Request Successfully Approved";

                                            echo json_encode($message);
                                        }else
                                            {
                                                $message['fail']=  "Request not approved. Error occurred";
                                                echo json_encode($message);
                                            }
                    }
        }
   function deletenonclubmember()/*function to delete club members. Actually, only status changes to indicate deletion.*/
        {
            if(!$this->session->userdata('clubhead_login'))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
            }
                else
                    {

                        $pid=$this->input->post('pid');

                        $array = array('successful' =>"Non club-member deleted successfully!",'fail'=>"Non-Club member deletion failed");


                         if ($this->model->deletenonclubmember($pid)==true)
                                        {
                                            $message['successful']=  $array;

                                            echo json_encode($message);
                                        }else
                                            {
                                                $message['fail']=  $array;
                                                echo json_encode($message);
                                            }
                    }
        }


    public function clubmemberspdf()/*pdf of club members*/
    {
        if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                        //session to pass club id
                            $clubID=$this->session->userdata('clubEmail');

                        $this->load->library('Pdf');
                        $list['clubmembers'] =$this->model->clubmemberslist($clubID);

                        $this->load->view('clubheads/clubmemberspdf',$list);
                    }
    }

    public function registeredclubmemberspdf()/*pdf of members who have paid registration fees*/
    {
        if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        //session to pass club id
                            $clubID=$this->session->userdata('clubEmail');

                        $this->load->library('Pdf');
                        $list['clubmembers'] =$this->model->registeredclubmemberslist($clubID);

                        $this->load->view('clubheads/paymentspdf',$list);
                    }
    }
    /*perclubmembers() function is for Admin only: Gets club id for whcih admin wants to view club members and returns the same club id (club email) to ajax call which then loads per club page with the members of the club. */
    public function perclubmembers()
    {
        if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                        echo json_encode(array('clubID' =>$this->input->post('clubEmail')));
                    }
    }



    public function perclubmemberspdf()/*function prints pdf of club members of a particular club. Only for admin and clubs representative*/
    {

        if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->input->get('clubID');
                         $sessdata=array();
                        $sessdata = array('clubEmail' =>$clubID);
                        $this->session->set_userdata($sessdata);
                        if($clubID=="All")/*prints pdf of members from all clubs*/
                        {
                             $this->load->library('Pdf');
                                $list['clubmembers'] =$this->model->allclubmemberslist();/*removes duplicate members appearing in many clubs*/

                            $this->load->view('clubheads/clubmemberspdf',$list);
                        }else{
                            $this->load->library('Pdf');
                            $list['clubmembers'] =$this->model->clubmemberslist($clubID);
                            $this->load->view('clubheads/clubmemberspdf',$list);
                        }
                    }


    }

    public function meetingattendancerecord()/*function to save attendance for a given meeting*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                         $data=$this->input->post('selected[]');/*attendance is submitted as a json array*/
                         $meeting=  $this->input->post('meetingid');
                         ;

                        $clubid=$this->session->userdata('clubEmail');

                        $dateRecorded = date("Y-m-d H:i:s");

                             //check if required fields are empty
                        if ( $clubid=="" || $meeting=="" ||$data==NULL )
                            {
                                $message['null'][]=  "Null entry";// message if required field is empty

                                echo json_encode($message);//return null message

                            }else
                                {/*check if the attendance for the meeting has already been added*/
                                        $this->db->select('*');
                                        $this->db->from('meetingattendance');
                                        $this->db->where('meetingID',$meeting);
                                        $this->db->where('clubID',$clubid);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();

                                if($num >0 )
                                    {/*message if attendance already exists*/
                                        $message['alreadyadded'][]=  "Attendance for this meeting has already been added";
                                        echo json_encode($message);//return fail

                                    } else
                                        {

                                           foreach( $_POST as $posted )/*loop through and create an array of the data*/
                                               {
                                                if( is_array( $posted ) ) /*if is array created*/
                                                    {
                                                        foreach( $posted as $record ) /*loop through and get individual items*/
                                                            {
                                                                $attendanceinfo=array('clubID'=>$clubid,'meetingID'=>$meeting,'studentID'=>$record['studentID'],'pID'=>$record['pID'],'status'=>$record['status'],'dateRecorded'=>$dateRecorded);

                                                                //pass array of data to model for saving
                                                                $result=$this->model->meetingattendanceinfosave($attendanceinfo);

                                                            }

                                                            if ($result)
                                                                            {
                                                                                $message['successful'][]=  "Attendance Successfully Added";

                                                                                echo json_encode($message);//return success
                                                                            }else
                                                                                {
                                                                                    $message['error'][]=  "An error occurred";

                                                                                    echo json_encode($message);//return no changes made
                                                                                }
                                                    } else
                                                        {
                                                            $message['notarray'][]=  "No array was posted";
                                                        }
                                                }
                                        }

                            }
                }

    }




    public function meetingattendancerecordcheck()/*check if meeting attendance has already been added*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $meetingid=$this->input->post('meetingid');
                        $clubid=$this->userdata('clubEmail');


                             //check if required fields are empty
                        if ( $clubid=="" || $meetingid=="" )
                            {
                                $message['null'][]=  "Required field is null";//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else
                                {
                                        $this->db->select('*');
                                        $this->db->from('meetingattendance');
                                        $this->db->where('meetingID',$meetingid);
                                        $this->db->where('clubID',$clubid);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();

                                if($num >0 )
                                    {
                                        $message['exists'][]=  "Attendance for this meeting has already been added";
                                        echo json_encode($message);//return fail

                                    } else
                                        {
                                            $_SESSION['recordid']=$meetingid;
                                           $message['proceed'][]= $meetingid;
                                        echo json_encode($message);//

                                        }

                            }
                    }

    }




    public function meetinginfosave()/*function to save meeting info*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubid=$this->session->userdata('clubEmail');
                        $meetingdate=$this->input->post('meetingdate');
                        $meetingvenue=$this->input->post('meetingvenue');
                        $starttime=$this->input->post('starttime');
                        $endtime=$this->input->post('endtime');
                        $studentpid=$this->input->post('studentpid');
                        // $newDate = date("d-m-Y", strtotime($meetingdate));

                        $dateRecorded = date("Y-m-d H:i:s");


                        $start=date("H:i", strtotime($starttime));
                        $end=date("H:i", strtotime($endtime));


                        //set success messages array


                        $meetinginfo=array('clubID' => $clubid, 'meetingDate'=>$meetingdate,'meetingVenue'=> $meetingvenue,'startTime'=>$start,'endTime'=>$end,'takingMinutes'=>$studentpid,'dateRecorded'=>$dateRecorded);

                         //check if required fields are empty
                    if ( $clubid=="" || $meetingdate=="" || $meetingvenue==""|| $starttime==""||$studentpid=="" )
                        {
                            $message['null'][]=  "Null entry";//error message if required field is empty

                            echo json_encode($message);//return error message

                        }else//if all required fields are not null, proceed
                                {
                                    /*check if the meeting has already been recorded*/
                                   $result=$this->model->checkmeetingexists($clubid,$meetingdate,$meetingvenue,$start,$end);

                                    if($result)
                                        {/*if meeting already exists, show duplicate message*/
                                            $message['duplicate'][]="This Meeting has already been recorded";
                                            echo json_encode($message);
                                        }else {
                                                     //pass array of data to model for saving
                                                     $result=$this->model->meetinginfosave($meetinginfo);
                                                            if ($result)
                                                                {
                                                                    $message['successful'][]=  "Meeting info saved successfully";

                                                                    echo json_encode($message);//return success
                                                                }else
                                                                {
                                                                    $message['error'][]=  "An error occurred";

                                                                    echo json_encode($message);//return no changes made
                                                                }
                                                }




                                }
                }

    }




    public function meetinginfoupdate()/*function to update meeting info*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $meetingpid=$this->input->post('pid');
                        $meetingdate=$this->input->post('meetingdate');
                        $meetingvenue=$this->input->post('meetingvenue');
                        $starttime=$this->input->post('starttime');
                        $endtime=$this->input->post('endtime');
                        $studentpid=$this->input->post('studentpid');
                        // $newDate = date("d-m-Y", strtotime($meetingdate));

                        $dateUpdated = date("Y-m-d H:i:s");

                        //set success messages array

                        $start=date("H:i", strtotime($starttime));
                        $end=date("H:i", strtotime($endtime));

                        $meetinginfo=array( 'meetingDate'=>$meetingdate,'meetingVenue'=> $meetingvenue,'startTime'=>$start,'endTime'=>$end,'takingMinutes'=>$studentpid,'dateUpdated'=>$dateUpdated);

                         //check if required fields are empty
                    if ( $meetingpid==""||$meetingdate=="" || $meetingvenue==""|| $starttime==""||$studentpid=="" )
                        {
                            $message['null'][]=  "Null entry";//error message if required field is empty

                            echo json_encode($message);//return error message

                        }else//if all required fields are not null, proceed
                                {

                                     //pass array of data to model for saving
                                     $result=$this->model->meetingupdate($meetinginfo,$meetingpid);
                                            if ($result)
                                                {
                                                    $message['successful'][]=  "Meeting info updated successfully";

                                                    echo json_encode($message);//return success
                                                }else
                                                    {
                                                        $message['nochange'][]=  "No changes made";

                                                        echo json_encode($message);//return no changes made
                                                    }




                                }
                }

    }




    public function meetingslist()/*function to return a list of meetings for a particular club*/
        {
            if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');

                        $list =$this->model->meetingslist($clubID);

                        $data = array();
                        $count=1;

                        foreach ($list as $meeting)
                            {
                                $meetingdate=$meeting['meetingDate'];
                                $formattedDate = date("d/m/Y", strtotime($meetingdate));

                                    $end=$meeting['endTime'];
                                    $endtime=date("g:i A", strtotime($end));

                                    $start=$meeting['startTime'];
                                    $starttime=date("g:i A", strtotime($start));



                                    $fullname=$meeting['firstName']. " ". $meeting['lastName'];
                                $data['data'][] = array('meetingDate' => $formattedDate, 'meetingVenue' => $meeting['meetingVenue'],'startTime' => $starttime,'endTime' => $endtime,'fullName'=>$fullname, 'action'=>$meeting['autoID'],'count'=>$count);
                                $count=$count +1;


                            }

                        echo json_encode($data);
                 }



        }

        public function meetingsperclub()/*for admin. function to return a list of meetings per selected club*/
        {
            if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                            $clubID=$this->input->GET('clubID');

                            $list =$this->model->meetingslist($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $meeting)
                                {

                                        $fullname=$meeting['firstName']. " ". $meeting['lastName'];
                                    $data['data'][] = array('meetingDate' => $meeting['meetingDate'], 'meetingVenue' => $meeting['meetingVenue'],'startTime' => $meeting['startTime'],'endTime' => $meeting['endTime'],'fullName'=>$fullname, 'action'=>$meeting['autoID'],'clubName'=>$meeting['clubName'],'count'=>$count);
                                    $count=$count +1;


                                }

                            echo json_encode($data);
                    }



        }


    public function meetingattendancelist()/*function to return a list of attendance per meeting */
        {

            if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {


                            $meetingID=$this->input->get('meetingID');

                            $list =$this->model->meetingattendancelist($meetingID);

                            $data = array();
                            $count=1;

                           foreach ($list as $attendance)
                                {

                                    $fullname=$attendance['firstName']. " ". $attendance['lastName'];
                                    $data['data'][] = array('suID' => $attendance['studentID'],'fullName'=>$fullname,'status'=>$attendance['status'],'count'=>$count);
                                    $count=$count +1;

                                }


                            echo json_encode($data);
                        }
    }


    public function meetingattlist()/*function to meeting attendance*/
        {

            if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {


                            $meetingID=$this->input->get('meetingID');

                            $list =$this->model->meetingattendancelist($meetingID);

                            $data = array();
                            $count=1;

                           foreach ($list as $attendance)
                                {

                                    $fullname=$attendance['firstName']. " ". $attendance['lastName'];
                                    $data['data'][] = array('suID' => $attendance['studentID'],'fullName'=>$fullname,'status'=>$attendance['status'],'action'=>$attendance['pID'],'count'=>$count);
                                    $count=$count +1;

                                }


                            echo json_encode($data);
                        }
    }
    public function viewmeetingattendancelist()/*admin only. return attendance list for meetings per club*/
        {

            if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {


                            $meetingID=$_SESSION['meetingattendanceID'];/*session is created when admin clicks on view meeting attendance. The captured meeting id is used here to retrieve information for the loaded meeting attendance page*/

                            $list =$this->model->meetingattendancelist($meetingID);

                            $data = array();
                            $count=1;

                           foreach ($list as $attendance)
                                {

                                    $fullname=$attendance['firstName']. " ". $attendance['lastName'];
                                    $data['data'][] = array('suID' => $attendance['studentID'],'fullName'=>$fullname,'status'=>$attendance['status'],'count'=>$count);
                                    $count=$count +1;

                                }


                                echo json_encode($data);


                        }
    }

    public function nullattendancemeetingsdropdown()

    {
          if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                        $clubID=$this->session->userdata('clubEmail');

                        $list = $this->model->nullattendancemeetingsdropdown($clubID);

                             $data=array();
                            foreach ($list->result() as $meetings)
                                {
                                    $meetingDescription="Date held: ".$meetings->meetingDate."  ; Venue: ".$meetings->meetingVenue." ; Time started: ".$meetings->startTime;
                                    $data[$meetings->autoID]=$meetingDescription;
                                }
                            echo json_encode($data);
                    }
    }
    public function withattendancemeetingsdropdown()

    {
          if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                        $clubID=$this->session->userdata('clubEmail');

                        $list = $this->model->withattendancemeetingsdropdown($clubID);

                             $data=array();
                            foreach ($list->result() as $meetings)
                                {
                                    $meetingDescription="Date held: ".$meetings->meetingDate."  ; Venue: ".$meetings->meetingVenue." ; Time started: ".$meetings->startTime;
                                    $data[$meetings->autoID]=$meetingDescription;
                                }
                            echo json_encode($data);
                    }
    }
    public function meetingswithoutminutesdropdown()

    {
          if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                        $clubID=$this->session->userdata('clubEmail');

                        $list = $this->model->meetingswithoutminutesdropdown($clubID);

                             $data=array();
                            foreach ($list->result() as $meetings)
                                {
                                    $meetingDescription="Date held: ".$meetings->meetingDate."  ; Venue: ".$meetings->meetingVenue." ; Time started: ".$meetings->startTime;
                                    $data[$meetings->autoID]=$meetingDescription;
                                }
                            echo json_encode($data);
                    }
    }



    public function meetingswithminutesdropdown()

    {
          if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                        $clubID=$this->session->userdata('clubEmail');

                        $list = $this->model->meetingswithminutesdropdown($clubID);

                             $data=array();
                            foreach ($list->result() as $meetings)
                                {
                                    $meetingDescription="Date held: ".$meetings->meetingDate."  ; Venue: ".$meetings->meetingVenue." ; Time started: ".$meetings->startTime;
                                    $data[$meetings->autoID]=$meetingDescription;
                                }
                            echo json_encode($data);
                    }
    }
    public function meetingsdropdown()/*populates meetings dropdown lists*/
    {
          if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                        $clubID=$this->session->userdata('clubEmail');

                        $list = $this->model->meetingsdropdown($clubID);

                             $data=array();
                            foreach ($list->result() as $meetings)
                                {
                                    $meetingDescription="Date held: ".$meetings->meetingDate."  ; Venue: ".$meetings->meetingVenue." ; Time started: ".$meetings->startTime;
                                    $data[$meetings->autoID]=$meetingDescription;
                                }
                            echo json_encode($data);
                    }
    }
    public function perclubminutes()//get minutes per club
            {
                 if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $clubID=$this->input->get('clubID');
                            $list = $this->model->perclubminutes($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $minutes)
                                {
                                    $meetingdate=$minutes['meetingDate'];
                                    $formattedDate = date("d/m/Y", strtotime($meetingdate));

                                    $start=$minutes['startTime'];
                                    $starttime=date("g:i A", strtotime($start));


                                    $minutesParticulars="";
                                    if($minutes['file_ext']==".doc"||$minutes['file_ext']==".docx")
                                        {
                                            $minutesParticulars='<span><i class="fa fa-file-word-o fa-lg" style="color:blue"></i></span> Minutes of the meeting held on '.$formattedDate." at ".$minutes['meetingVenue']." from ".$starttime;
                                        }
                                        else if($minutes['file_ext']==".pdf")
                                            {
                                                $minutesParticulars='<span><i class="fa fa-file-pdf-o fa-lg" style="color:red"></i></span> Minutes of the meeting held on '.$formattedDate." at ".$minutes['meetingVenue']." from ".$starttime;
                                            }else if($minutes['file_ext']==".xls"||$minutes['file_ext']==".xlsx")
                                                {
                                                    $minutesParticulars='<span><i class="fa fa-file-excel-o fa-lg" style="color:#33bbff"></i></span> Minutes of the meeting held on '.$formattedDate." at ".$minutes['meetingVenue']." from ".$starttime;
                                                }


                                    $data['data'][] = array('particulars' => $minutesParticulars,'action'=>$minutes['file_name'],'count'=>$count);
                                    $count=$count +1;
                                }

                            echo json_encode($data);

                        }
            }

            public function perclubuploads()//get minutes per club
                    {
                         if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                            {
                                     $data = array('profile'=>$this->mainmodel->clubProfile());
                                       $this->load->view('login',$data);
                            }
                                else
                                {
                                    $clubID=$this->input->get('clubID');
                                    $list = $this->model->perclubuploads($clubID);

                                    $data = array();
                                    $count=1;

                                    foreach ($list as $uploads)
                                        {





                                            $uploadParticulars="";
                                            if($uploads['file_ext']==".doc"||$uploads['file_ext']==".docx")
                                                {
                                                    $uploadParticulars='<span><i class="fa fa-file-word-o fa-lg" style="color:blue"></i></span> Club File: '.$uploads['file_name'];
                                                }
                                                else if($uploads['file_ext']==".pdf")
                                                    {
                                                        $uploadParticulars='<span><i class="fa fa-file-pdf-o fa-lg" style="color:red"></i></span> Club File: '.$uploads['file_name'];
                                                    }else if($uploads['file_ext']==".xls"||$uploads['file_ext']==".xlsx")
                                                        {
                                                            $uploadParticulars='<span><i class="fa fa-file-excel-o fa-lg" style="color:#33bbff"></i></span> Club File: '.$uploads['file_name'];
                                                        }


                                            $data['data'][] = array('particulars' => $uploadParticulars,'action'=>$uploads['file_name'],'count'=>$count);
                                            $count=$count +1;
                                        }

                                    echo json_encode($data);

                                }
                    }


    public function newinattendance()/*function to add in attendance minutes*/
    {
        if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        //collect ajax-submitted data
                           $meeting=$this->input->post('meeting');
                           $participantid=$this->input->post('participantid');
                           $lastname=$this->input->post('lastname');
                           $firstname=$this->input->post('firstname');
                           $gender=$this->input->post('gender');
                           $phone=$this->input->post('phone');
                           $emailadd=$this->input->post('emailadd');
                           $category=$this->input->post('category');
                           $profile=$this->input->post('profile');

                            $clubid=$this->session->userdata('clubEmail');

                            //create an array of data to be saved into db
                            $participantinfo=array(
                                                'suID'=>$suid,
                                                'lastName'=>$lastname,
                                                'firstName'=>$firstname,
                                                'gender'=>$gender,
                                                'telNo'=>$phone,
                                                'suEmail'=>$suemail,
                                                'clubID'=>$clubid,
                                                'courseID'=>$course,
                                                'password'=>$defaultpass//

                                            );


                             //set success messages array
                        $array = array('successful' =>"Club Member Registration Successful!",'fail'=>"Registration failed",'null'=>"null entry",'error'=>"No changes were made",'exists_but_inactive'=>"inactive");

                        //check if required fields are empty
                        if ($suid=="" || $lastname=="" || $firstname=="" || $suemail==""|| $clubid==""||$course=="" ||$phone==""||$gender=="")
                            {
                                $message['null'][]=  $array;//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else//if all required fields are not null, proceed
                                    {
                                         //check if the new member was earlier registered to the club and is active

                                        $this->db->select('*');
                                        $this->db->from('clubmembers');
                                        $this->db->where('suID',$suid);
                                        $this->db->where('clubID',$clubid);
                                        $this->db->where('status',1);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();



                                        if($num>0)
                                           {//If the new member was earlier registered to the club and is active

                                                        $message['fail'][]=  $array;
                                                        echo json_encode($message);

                                            }   else
                                                    {
                                                        //If the new member was earlier registered to the club but has been marked as inactive.
                                                        $this->db->select('*');
                                                        $this->db->from('clubmembers');
                                                        $this->db->where('suID',$suid);
                                                        $this->db->where('clubID',$clubid);
                                                        $this->db->where('status',0);
                                                        $this->db->where('deletionStatus',0);
                                                        $query = $this->db->get();
                                                        $num=$query->num_rows();

                                                                if ($num>0)
                                                                {// If the member exists but marked inactive, Ask clubhead to activate member instead of registering him/her again
                                                                    $message['exists_but_inactive'][]=  $array;
                                                                    echo json_encode($message);
                                                                } else {
                                                                        //If the member doesn't exist in the club or was deleted proceed to register
                                                                        //If the new member was earlier registered to the club but has been marked as inactive.
                                                                        $this->db->select('*');
                                                                        $this->db->from('clubmembers');
                                                                        $this->db->where('suID',$suid);
                                                                        $this->db->where('clubID',$clubid);
                                                                        $this->db->where('status',0);
                                                                        $this->db->where('deletionStatus',1);
                                                                        $query = $this->db->get();
                                                                        $num=$query->num_rows();

                                                                            if($num>0)
                                                                            {

                                                                                 $updates=array('status' =>"1",'deletionStatus'=>"0");
                                                                                $result=$this->model->undeleteclubmember($suid,$clubid,$updates);

                                                                                if ($result)
                                                                                    {
                                                                                        $message['successful'][]=  $array;

                                                                                        echo json_encode($message);//return success
                                                                                    }else
                                                                                        {
                                                                                            $message['error'][]=  $array;

                                                                                            echo json_encode($message);//return success
                                                                                        }
                                                                            }
                                                                            else{
                                                                                    $result=$this->model->registerclubmember($clubmemberinfo);

                                                                                    if ($result)
                                                                                        {
                                                                                            $message['successful'][]=  $array;

                                                                                            echo json_encode($message);//return success
                                                                                        }else
                                                                                            {
                                                                                                $message['error'][]=  $array;

                                                                                                echo json_encode($message);//return success
                                                                                            }
                                                                                }
                                                                        }
                                                    }



                                    }
                    }
    }



    public function eventslist()/*list of events*/
        {
             if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');

                        $list =$this->model->eventslist($clubID);

                        $data = array();
                        $count=1;

                        foreach ($list as $event)
                            {


                                $data['data'][] = array('eventDate' => $event['eventDate'], 'eventVenue' => $event['eventVenue'],'startTime' => $event['startTime'],'endTime' => $event['endTime'],'action'=>$event['autoID'],'count'=>$count);
                                $count=$count +1;


                            }

                        echo json_encode($data);
                    }



        }

    public function eventsperclub()/*function to return a list of events per club */
        {
             if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->input->GET('clubID');

                        if($clubID=="All")
                        {

                            $list =$this->model->eventslist($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $event)
                                {


                                    $data['data'][] = array('eventDate' => $event['eventDate'], 'eventVenue' => $event['eventVenue'],'startTime' => $event['startTime'],'endTime' => $event['clubName'],'action'=>$event['autoID'],'count'=>$count);
                                    $count=$count +1;


                                }

                            echo json_encode($data);

                        }else
                            {

                                $list =$this->model->eventslist($clubID);

                                $data = array();
                                $count=1;

                                foreach ($list as $event)
                                    {


                                        $data['data'][] = array('eventDate' => $event['eventDate'], 'eventVenue' => $event['eventVenue'],'startTime' => $event['startTime'],'endTime' => $event['endTime'],'action'=>$event['autoID'],'count'=>$count);
                                        $count=$count +1;


                                    }

                                echo json_encode($data);
                            }



                        }


        }


    public function eventsdropdown()/*dropdown list of events*/
    {
         if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');

                        $list = $this->model->eventsdropdown($clubID);

                             $data=array();
                            foreach ($list->result() as $events)
                                {
                                    $eventDescription="Date held: ".$events->eventDate."  ; Venue: ".$events->eventVenue." ; Time started: ".$events->startTime;
                                    $data[$events->autoID]=$eventDescription;
                                }
                            echo json_encode($data);
                        }
    }


    public function eventsinattendancedropdown()/*dropdown list of events without inattendance record*/
    {
         if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');

                        $list = $this->model->eventsinattendancedropdown($clubID);

                             $data=array();
                            foreach ($list->result() as $events)
                                {
                                    $eventDescription="Date held: ".$events->eventDate."  ; Venue: ".$events->eventVenue." ; Time started: ".$events->startTime;
                                    $data[$events->autoID]=$eventDescription;
                                }
                            echo json_encode($data);
                        }
    }
    public function eventswithoutreport()/*dropdown list of events without reports*/
    {
         if(!($this->session->userdata('clubhead_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');

                        $list = $this->model->eventswithoutreport($clubID);

                             $data=array();
                            foreach ($list->result() as $events)
                                {
                                    $eventDescription="Date held: ".$events->eventDate."  ; Venue: ".$events->eventVenue." ; Time started: ".$events->startTime;
                                    $data[$events->autoID]=$eventDescription;
                                }
                            echo json_encode($data);
                        }
    }

    public function eventinfosave()/*save events info*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubid=$this->session->userdata('clubEmail');
                        $eventdate=$this->input->post('eventdate');
                        $eventvenue=$this->input->post('eventvenue');
                        $starttime=$this->input->post('starttime');
                        $endtime=$this->input->post('endtime');
                        $description=$this->input->post('description');

                        $dateRecorded = date("Y-m-d H:i:s");

                        $start=date("H:i", strtotime($starttime));
                        $end=date("H:i", strtotime($endtime));


                        $eventinfo=array('clubID' => $clubid, 'eventDate'=>$eventdate,'eventVenue'=> $eventvenue,'startTime'=>$start,'endTime'=>$end,'description'=>$description,'dateRecorded'=>$dateRecorded);

                         //check if required fields are empty
                        if ( $clubid=="" || $eventdate=="" || $eventvenue==""|| $starttime==""||$description=="" )
                            {
                                $message['null'][]=  "A required field is empty";//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else//if all required fields are not null, proceed
                                {
                                     //check if event has already been recorded
                                    $result=$this->model->checkeventexists($clubid,$eventdate,$eventvenue,$start,$end);

                                    if($result)
                                        {/*if event already exists, show duplicate message*/
                                            $message['duplicate'][]="This Event has already been recorded";
                                            echo json_encode($message);
                                        }else {

                                                 //pass array of data to model for saving
                                                 $result=$this->model->eventinfosave($eventinfo);
                                                        if ($result)
                                                            {
                                                                $message['successful'][]=  "Event added successfully";

                                                                echo json_encode($message);//return success
                                                            }else
                                                            {
                                                                $message['fail'][]=  "Meeting failed to save";

                                                                echo json_encode($message);//return fail
                                                            }
                                               }

                                }
                }

    }

    public function eventinfoupdate()/*function to update event info*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $eventpid=$this->input->post('pid');
                        $eventdate=$this->input->post('eventdate');
                        $eventvenue=$this->input->post('eventvenue');
                        $starttime=$this->input->post('starttime');
                        $endtime=$this->input->post('endtime');
                        $description=$this->input->post('description');

                        $dateUpdated = date("Y-m-d H:i:s");

                        $start=date("H:i", strtotime($starttime));
                        $end=date("H:i", strtotime($endtime));


                        $eventinfo=array('eventDate'=>$eventdate,'eventVenue'=> $eventvenue,'startTime'=>$start,'endTime'=>$end,'description'=>$description,'dateUpdated'=>$dateUpdated);


                         //check if required fields are empty
                    if ( $eventpid==""||$eventdate=="" || $eventvenue==""|| $starttime==""||$description=="")
                        {
                            $message['null'][]=  "Null entry";//error message if required field is empty

                            echo json_encode($message);//return error message

                        }else//if all required fields are not null, proceed
                                {
                                     //pass array of data to model for saving
                                     $result=$this->model->eventinfoupdate($eventinfo,$eventpid);
                                            if ($result)
                                                {
                                                    $message['successful'][]=  "Event info updated successfully";

                                                    echo json_encode($message);//return success
                                                }else
                                                    {
                                                        $message['nochange'][]=  "No changes made";

                                                        echo json_encode($message);//return no changes made
                                                    }




                                }
                }

    }

    public function vieweventattendancelist()/* for admin only: function to view a list of attendance for club events*/
        {

            if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {

                            $eventID=$_SESSION['eventattendanceID'];
                            $list =$this->model->eventattendancelist($eventID);

                            $data = array();
                            $count=1;

                           foreach ($list as $attendance)
                                {

                                    $fullname=$attendance['firstName']. " ". $attendance['lastName'];
                                    $data['data'][] = array('suID' => $attendance['studentID'],'fullName'=>$fullname,'status'=>$attendance['status'],'count'=>$count);
                                    $count=$count +1;

                                }


                                echo json_encode($data);


                        }
    }


    public function eventattendancerecordcheck()/*check if event attendance exists before saving as new attendance*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                         $eventid=$this->input->post('eventid');
                            $clubid=$this->session->userdata('clubEmail');
                            $_SESSION['eventid']= $eventid;

                             //check if required fields are empty
                        if ( $clubid=="" || $eventid=="" )
                            {
                                $message['null'][]=  "Required field is null";//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else
                                {
                                        $this->db->select('*');
                                        $this->db->from('eventattendance');
                                        $this->db->where('eventID',$eventid);
                                        $this->db->where('clubID',$clubid);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();

                                if($num >0 )
                                    {
                                        $message['exists'][]=  "Attendance for this event has already been added";
                                        echo json_encode($message);//return fail

                                    } else
                                        {
                                           $message['proceed'][]= $eventid;
                                        echo json_encode($message);//

                                        }

                            }
                    }

    }



    public function eventattendancerecord()/*function to get save attendance for a given event*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                         $data=$this->input->post('selected[]');/*attendance is submitted as a json array*/
                         $eventid=  $this->input->post('eventid');
                         ;
                        $clubid=$this->session->userdata('clubEmail');

                        $dateRecorded = date("Y-m-d H:i:s");



                             //check if required fields are empty
                        if ( $clubid=="" || $eventid=="" ||$data==NULL )
                            {
                                $message['null'][]=  "Null entry";// message if required field is empty

                                echo json_encode($message);//return null message

                            }else
                                {/*check if the attendance for the event has already been added*/
                                        $this->db->select('*');
                                        $this->db->from('eventattendance');
                                        $this->db->where('eventID',$eventid);
                                        $this->db->where('clubID',$clubid);
                                        $this->db->where('inattendance',0);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();

                                if($num >0 )
                                    {/*message if attendance already exists*/
                                        $message['alreadyadded'][]=  "Attendance for this event has already been added";
                                        echo json_encode($message);//return fail

                                    } else
                                        {

                                           foreach( $_POST as $posted )/*loop through and create an array of the data*/
                                               {
                                                if( is_array( $posted ) ) /*if is array created*/
                                                    {
                                                        foreach( $posted as $record ) /*loop through and get individual items*/
                                                            {
                                                                $attendanceinfo=array('clubID'=>$clubid,'eventID'=>$eventid,'studentID'=>$record['studentID'],'pID'=>$record['pID'],'status'=>$record['status'],'dateRecorded'=>$dateRecorded);

                                                                //pass array of data to model for saving
                                                                $result=$this->model->eventattendanceinfosave($attendanceinfo);

                                                            }

                                                            if ($result)
                                                                            {
                                                                                $message['successful'][]=  "Attendance Successfully Added";

                                                                                echo json_encode($message);//return success
                                                                            }else
                                                                                {
                                                                                    $message['error'][]=  "An error occurred";

                                                                                    echo json_encode($message);//return no changes made
                                                                                }
                                                    } else
                                                        {
                                                            $message['notarray'][]=  "No array was posted";
                                                        }
                                                }
                                        }

                            }
                }

    }

    public function eventinattendancerecord()/*function to get save attendance for a given event*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {

                         $data=$this->input->post('selected[]');/*attendance is submitted as a json array*/
                         $eventid=  $this->input->post('eventid');
                         ;
                        $clubid=$this->session->userdata('clubEmail');


                             //check if required fields are empty
                        if ( $clubid=="" || $eventid=="" ||$data==NULL )
                            {
                                $message['null'][]=  "Null entry";// message if required field is empty

                                echo json_encode($message);//return null message

                            }else
                                {/*check if the attendance for the event has already been added*/
                                        $this->db->select('*');
                                        $this->db->from('eventattendance');
                                        $this->db->where('eventID',$eventid);
                                        $this->db->where('inattendance',1);
                                        $this->db->where('clubID',$clubid);
                                        $query = $this->db->get();
                                        $num=$query->num_rows();

                                if($num >0 )
                                    {/*message if attendance already exists*/
                                        $message['alreadyadded'][]=  "In-attendance for this event has already been added";
                                        echo json_encode($message);//return fail

                                    } else
                                        {

                                           foreach( $_POST as $posted )/*loop through and create an array of the data*/
                                               {
                                                if( is_array( $posted ) ) /*if is array created*/
                                                    {
                                                        foreach( $posted as $record ) /*loop through and get individual items*/
                                                            {
                                                                $attendanceinfo=array('clubID'=>$clubid,'eventID'=>$eventid,'studentID'=>$record['studentID'],'pID'=>$record['pID'],'status'=>$record['status'],'inattendance'=>1);

                                                                //pass array of data to model for saving
                                                                $result=$this->model->eventattendanceinfosave($attendanceinfo);

                                                            }

                                                            if ($result)
                                                                            {
                                                                                $message['successful'][]=  "Event In-attendance Successfully Added";

                                                                                echo json_encode($message);//return success
                                                                            }else
                                                                                {
                                                                                    $message['error'][]=  "An error occurred";

                                                                                    echo json_encode($message);//return no changes made
                                                                                }
                                                    } else
                                                        {
                                                            $message['notarray'][]=  "No array was posted";
                                                        }
                                                }
                                        }

                            }
                }

    }

     function cmp($a, $b)//to sort constitution by upload date
        {
            return strcmp($a->dateUploaded, $b->versionNo);
        }

     public function upload_eventimage()
            { 
                if(!($this->session->userdata('clubhead_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID = $this->session->userdata('clubEmail');/*get email for logged in club*/
                        $eventID = $this->input->post('pid'); 
                        $config['upload_path'] = 'club_uploads/event_images/';
                        $config['allowed_types'] = 'jpeg|JPEG|jpg|JPG|';
                        $config['overwrite'] = true;
                        $config['file_ext_tolower'] = true;

                        $this->load->library('upload', $config);
                                        $file="eventimage";
                                        if (!$this->upload->do_upload($file))
                                        {
                                             $feedback = array('error' => $this->upload->display_errors(),'success' => "",'files'=>$this->model->event($eventID));

                                              $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url(('index.php/ClubController/eventinfo')));
                                        }
                                        else
                                        {
                                               $db_debug = $this->db->db_debug;
                                               $this->db->db_debug = FALSE; //disable debugging for queries
                                                $data =$this->upload->data();

                                                $file_info=array('file_name'=>$data['file_name'],'full_path'=>$data['full_path'],'file_ext'=>$data['file_ext']);
                                                $ID=array('autoID'=>$eventID);

                                            if($this->db->update('eventinfo',$file_info,$ID))
                                                {
                                                    $feedback = array('error' => "",'success' => "Event Image Upload was Successful",'files'=>$this->model->event($eventID));


                                                    // usort($feedback, "cmp");

                                                    // $this->load->view('clubheads/addclubconstitution', $feedback);
                                                     $this->session->set_flashdata('msg',$feedback);
                                                        redirect(base_url(('index.php/ClubController/eventinfo')));
                                                }
                                            else
                                                {
                                                    $feedback = array('error' => "Duplicate Entries. The File name already exists. ",'success' => "",'files'=>$this->model->event($eventID));

                                                    $this->session->set_flashdata('msg',$feedback);
                                                    redirect(base_url(('index.php/ClubController/eventinfo')));
                                                }


                                        }



                     }
            }
    public function upload_constitution()
            { if(!($this->session->userdata('clubhead_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                        $this->db->select('*');
                        $this->db->from('club_constitutions');
                        $this->db->where('clubID',$clubID);
                        $query = $this->db->get();
                        $num=$query->num_rows();

                        $version=$num +1;

                        // if($num>0)
                        //     {
                        //         $feedback = array('error' => "Duplicate Entries. The Constitution or File name already exists. ",'success' => "",'files'=>$this->model->getconstitutions($clubID));
                        //         $this->session->set_flashdata('msg',$feedback);
                        //         redirect(base_url(('ClubController/addclubconstitution')));
                        //     } else {
                                        $config['upload_path']          = 'club_uploads/club_constitutions/';
                                        // $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
                                        $config['allowed_types']        = 'pdf|PDF|doc|DOC|docx|DOCX';
                                        // $config['max_size']             = 4096;
                                        // $config['max_width']            = 1024;
                                        // $config['max_height']           = 768;
                                        $config['overwrite']           = true;
                                        $config['file_ext_tolower']     = true;

                                        $this->load->library('upload', $config);
                                        $file="constitution";

                                        if ( ! $this->upload->do_upload($file))
                                        {
                                             $feedback = array('error' => $this->upload->display_errors(),'success' => "",'files'=>$this->model->getconstitutions($clubID));

                                              $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url(('index.php/ClubController/addclubconstitution')));
                                        }
                                        else
                                        {


                                               $db_debug = $this->db->db_debug;
                                               $this->db->db_debug = FALSE; //disable debugging for queries
                                                $data =$this->upload->data();

                                                $dateUploaded = date("Y-m-d H:i:s");


                                                $file_info=array('file_name'=>$data['file_name'],'client_name'=>$data['client_name'],'full_path'=>$data['full_path'],'file_ext'=>$data['file_ext'],'clubID'=>$clubID,'versionNo'=>$version,'dateUploaded'=>$dateUploaded);


                                            if($this->db->insert('club_constitutions',$file_info))
                                                {
                                                    $feedback = array('error' => "",'success' => "Constitution Upload was Successful",'files'=>$this->model->getconstitutions($clubID));


                                                    // usort($feedback, "cmp");

                                                    // $this->load->view('clubheads/addclubconstitution', $feedback);
                                                     $this->session->set_flashdata('msg',$feedback);
                                                        redirect(base_url(('index.php/ClubController/addclubconstitution')));
                                                }
                                            else
                                                {
                                                    $feedback = array('error' => "Duplicate Entries. The Constitution or File name already exists. ",'success' => "",'files'=>$this->model->getconstitutions($clubID));

                                                    $this->session->set_flashdata('msg',$feedback);
                                                    redirect(base_url(('index.php/ClubController/addclubconstitution')));
                                                }


                                        }
                            // }
                    }


            }


    //upload reports

    public function upload_report()
            { if(!($this->session->userdata('clubhead_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                        $this->db->select('*');
                        $this->db->from('club_uploads');
                        $this->db->where('clubID',$clubID);
                        $query = $this->db->get();
                        $num=$query->num_rows();

                        $version=$num +1;

                        // if($num>0)
                        //     {
                        //         $feedback = array('error' => "Duplicate Entries. The Constitution or File name already exists. ",'success' => "",'files'=>$this->model->getconstitutions($clubID));
                        //         $this->session->set_flashdata('msg',$feedback);
                        //         redirect(base_url(('ClubController/addclubconstitution')));
                        //     } else {
                                        $config['upload_path']          = 'club_uploads/club_uploads/';
                                        // $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
                                        $config['allowed_types']        = 'pdf|PDF|doc|DOC|docx|DOCX';
                                        // $config['max_size']             = 4096;
                                        // $config['max_width']            = 1024;
                                        // $config['max_height']           = 768;
                                        $config['overwrite']           = true;
                                        $config['file_ext_tolower']     = true;

                                        $this->load->library('upload', $config);
                                        $file="upload";

                                        if ( ! $this->upload->do_upload($file))
                                        {
                                             $feedback = array('error' => $this->upload->display_errors(),'success' => "",'files'=>$this->model->getuploads($clubID));

                                              $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url(('index.php/ClubController/addclubupload')));
                                        }
                                        else
                                        {


                                               $db_debug = $this->db->db_debug;
                                               $this->db->db_debug = FALSE; //disable debugging for queries
                                                $data =$this->upload->data();

                                                $dateUploaded = date("Y-m-d H:i:s");


                                                $file_info=array('file_name'=>$data['file_name'],'full_path'=>$data['full_path'],'file_ext'=>$data['file_ext'],'clubID'=>$clubID,'date_uploaded'=>$dateUploaded);


                                            if($this->db->insert('club_uploads',$file_info))
                                                {
                                                    $feedback = array('error' => "",'success' => "File Upload was Successful",'files'=>$this->model->getuploads($clubID));


                                                    // usort($feedback, "cmp");

                                                    // $this->load->view('clubheads/addclubconstitution', $feedback);
                                                     $this->session->set_flashdata('msg',$feedback);
                                                        redirect(base_url(('index.php/ClubController/addclubupload')));
                                                }
                                            else
                                                {
                                                    $feedback = array('error' => "Duplicate Entries. The Report or File name already exists. ",'success' => "",'files'=>$this->model->getuploads($clubID));

                                                    $this->session->set_flashdata('msg',$feedback);
                                                    redirect(base_url(('index.php/ClubController/addclubupload')));
                                                }


                                        }
                            // }
                    }


            }


    public function download_constitution($filename = NULL)
        {
             if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        // load download helder
                        $this->load->helper('download');
                        // read file contents
                        $data = file_get_contents('club_uploads/club_constitutions/'.$filename);
                        force_download($filename, $data);
                    }
        }
        public function download_upload($filename = NULL)
            {
                 if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                    {
                              $data = array('profile'=>$this->mainmodel->clubProfile());
                                   $this->load->view('login',$data);
                    }
                    else
                        {
                            // load download helder
                            $this->load->helper('download');
                            // read file contents
                            $data = file_get_contents('club_uploads/club_uploads/'.$filename);
                            force_download($filename, $data);
                        }
            }
      public function upload_minutes()
            { if(!($this->session->userdata('clubhead_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $meetingID=$this->input->post('meeting');
                        $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                        $this->db->select('*');
                        $this->db->from('club_minutes');
                        $this->db->where('clubID',$clubID);
                        $this->db->where('meetingID',$meetingID);
                        $query = $this->db->get();
                        $num=$query->num_rows();

                        if($num>0)
                            {
                                $feedback = array('error' => "Duplicate Entries. The Minutes or File name already exists. ",'success' => "",'files'=>$this->model->getclubminutes($clubID));
                                $this->session->set_flashdata('msg',$feedback);
                                redirect(base_url(('ClubController/addminutes')));
                            } else {
                                        $config['upload_path']          = 'club_uploads/club_minutes/';
                                        // $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
                                        $config['allowed_types']        = 'pdf|PDF|docx|doc|DOCX|DOC|xls|xlsx';
                                        // $config['max_size']             = 4096;
                                        // $config['max_width']            = 1024;
                                        // $config['max_height']           = 768;
                                        $config['overwrite']           = true;
                                        $config['file_ext_tolower']     = true;

                                        $this->load->library('upload', $config);
                                        $file="minutes";

                                        if ( ! $this->upload->do_upload($file))
                                        {
                                             $feedback = array('error' => $this->upload->display_errors(),'success' => "",'files'=>$this->model->getclubminutes($clubID));

                                              $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url(('index.php/ClubController/addminutes')));
                                        }
                                        else
                                        {


                                               $db_debug = $this->db->db_debug;
                                               $this->db->db_debug = FALSE; //disable debugging for queries
                                                $data =$this->upload->data();

                                                $dateUploaded = date("Y-m-d H:i:s");

                                                $file_info=array('file_name'=>$data['file_name'],'client_name'=>$data['client_name'],'full_path'=>$data['full_path'],'file_ext'=>$data['file_ext'],'clubID'=>$clubID,'meetingID'=>$meetingID,'dateUploaded'=>$dateUploaded);


                                            if($this->db->insert('club_minutes',$file_info))
                                                {
                                                    $feedback = array('error' => "",'success' => "Minutes Upload was Successful",'files'=>$this->model->getclubminutes($clubID));

                                                    // $this->load->view('clubheads/addclubconstitution', $feedback);
                                                     $this->session->set_flashdata('msg',$feedback);
                                                        redirect(base_url(('index.php/ClubController/addminutes')));
                                                }
                                            else
                                                {
                                                    $feedback = array('error' => "Duplicate Entries. The Minutes or File name already exists. ",'success' => "",'files'=>$this->model->getclubminutes($clubID));

                                                 $this->session->set_flashdata('msg',$feedback);
                                                form_open(base_url(('ClubController/addminutes')));
                                                }


                                        }
                            }
                    }


            }

    public function download_minutes($filename = NULL)
        {
             if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        // load download helder
                        $this->load->helper('download');
                        // read file contents
                        $data = file_get_contents('club_uploads/club_minutes/'.$filename);
                        force_download($filename, $data);
                    }
        }


        public function download_report($filename = NULL)
            {
                 if(!($this->session->userdata('admin_login')||$this->session->userdata('clubhead_login')||$this->session->userdata('crep_login')))
                    {
                              $data = array('profile'=>$this->mainmodel->clubProfile());
                                   $this->load->view('login',$data);
                    }
                    else
                        {
                            // load download helder
                            $this->load->helper('download');
                            // read file contents
                            $data = file_get_contents('club_uploads/club_uploads/'.$filename);
                            force_download($filename, $data);
                        }
            }

        public function download_uploads($filename = NULL)
            {
                 if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                    {
                              $data = array('profile'=>$this->mainmodel->clubProfile());
                                   $this->load->view('login',$data);
                    }
                    else
                        {
                            // load download helder
                            $this->load->helper('download');
                            // read file contents
                            $data = file_get_contents('club_uploads/club_uploads/'.$filename);
                            force_download($filename, $data);
                        }
            }

    public function delete_club_minutes($filename = NULL)
        {
            if(!($this->session->userdata('clubhead_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                        $meetingID=$this->input->get('meetingID');

                        $minutes=$this->model->getclubminutes($clubID);
                            $filename="";
                            foreach($minutes as $file)
                                    {
                                        $filename=$file->file_name;
                                    }


                        $this->db->where('clubID',$clubID);
                        $this->db->where('meetingID',$meetingID);
                        $this->db->delete('club_minutes');
                        $affected=$this->db->affected_rows();
                            if($affected>0)
                                {
                                    $this->load->helper("file");
                                    unlink('club_uploads/club_minutes/'.$filename);

                                        $feedback = array('error'=>"",'success' => "The Minutes have been  successfully deleted",'files'=>$this->model-> getclubminutes($clubID));

                                                 $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url('index.php/ClubController/addminutes'));
                                }else {
                                        $this->load->helper("file");
                                        // unlink(APPPATH.'club_uploads/club_minutes/'.$filename);
                                        $feedback = array('error'=>"Failed to delete minutes",'success' => "",'files'=>$this->model-> getclubminutes($clubID));

                                                 $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url('index.php/ClubController/addminutes'));
                                    }
                    }
        }


      public function upload_event_report()
            { if(!($this->session->userdata('clubhead_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $eventID=$this->input->post('event');
                        $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                        $this->db->select('*');
                        $this->db->from('event_reports');
                        $this->db->where('clubID',$clubID);
                        $this->db->where('eventID',$eventID);
                        $query = $this->db->get();
                        $num=$query->num_rows();

                        if($num>0)
                            {
                                $feedback = array('error' => "Duplicate Entries. The Event Report or File name already exists. ",'success' => "",'files'=>$this->model->geteventreports($clubID));
                                $this->session->set_flashdata('msg',$feedback);
                                redirect(base_url(('ClubController/addeventreport')));
                            } else {
                                        $config['upload_path']          = 'club_uploads/event_reports/';
                                        // $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
                                        $config['allowed_types']        = 'pdf|PDF|docx|doc|DOCX|DOC|xls|xlsx';
                                        // $config['max_size']             = 4096;
                                        // $config['max_width']            = 1024;
                                        // $config['max_height']           = 768;
                                        $config['overwrite']           = true;
                                        $config['file_ext_tolower']     = true;

                                        $this->load->library('upload', $config);
                                        $file="report";

                                        if ( ! $this->upload->do_upload($file))
                                        {
                                             $feedback = array('error' => $this->upload->display_errors(),'success' => "",'files'=>$this->model->geteventreports($clubID));

                                              $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url(('ClubController/addeventreport')));

                                        }
                                        else
                                        {


                                               $db_debug = $this->db->db_debug;
                                               $this->db->db_debug = FALSE; //disable debugging for queries
                                                $data =$this->upload->data();

                                                $dateUploaded = date("Y-m-d H:i:s");

                                                $file_info=array('file_name'=>$data['file_name'],'client_name'=>$data['client_name'],'full_path'=>$data['full_path'],'file_ext'=>$data['file_ext'],'eventID'=>$eventID,'clubID'=>$clubID,'dateUploaded'=>$dateUploaded);


                                            if($this->db->insert('event_reports',$file_info))
                                                {
                                                    $feedback = array('error' => "",'success' => "Report Upload was Successful",'files'=>$this->model->geteventreports($clubID));

                                                     $this->session->set_flashdata('msg',$feedback);
                                                        redirect(base_url(('ClubController/addeventreport')));
                                                }
                                            else
                                                {
                                                    $feedback = array('error' => "Duplicate Entries. Report or File name already exists. ",'success' => "",'files'=>$this->model->geteventreports($clubID));

                                                 $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url(('ClubController/addeventreport')));
                                                }


                                        }
                            }
                    }


            }

    public function download_event_report($filename = NULL)
        {
             if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        // load download helder
                        $this->load->helper('download');
                        // read file contents
                        $data = file_get_contents('club_uploads/event_reports/'.$filename);
                        force_download($filename, $data);
                    }
        }




    public function delete_event_report($filename = NULL)
        {
            if(!($this->session->userdata('clubhead_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                        $eventID=$this->input->get('eventID');

                        $ereport=$this->model->geteventreports($clubID);
                            $filename="";
                            foreach($ereport as $file)
                                    {
                                        $filename=$file->file_name;
                                    }


                        $this->db->where('clubID',$clubID);
                        $this->db->where('eventID',$eventID);
                        $this->db->delete('event_reports');
                        $affected=$this->db->affected_rows();
                            if($affected>0)
                                {
                                    $this->load->helper("file");
                                    unlink('club_uploads/event_reports/'.$filename);

                                        $feedback = array('error'=>"",'success' => "The Report has been  successfully deleted",'files'=>$this->model-> geteventreports($clubID));

                                                 $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url('ClubController/addeventreport'));
                                }else {
                                        $this->load->helper("file");
                                        unlink('club_uploads/event_reports/'.$filename);

                                        $feedback = array('error'=>"Failed to delete event report",'success' => "",'files'=>$this->model-> geteventreports($clubID));

                                                 $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url('ClubController/addeventreport'));
                                    }
                    }
        }


    public function upload_clubhistory()
            { if(!($this->session->userdata('clubhead_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');/*get email for logged in club*/
                        $this->db->select('*');
                        $this->db->from('club_histories');
                        $this->db->where('clubID',$clubID);
                        $query = $this->db->get();
                        $num=$query->num_rows();

                        $version=$num +1;

                        // if($num>0)
                        //     {
                        //         $feedback = array('error' => "Duplicate Entries. The Constitution or File name already exists. ",'success' => "",'files'=>$this->model->getclubhistories($clubID));
                        //         $this->session->set_flashdata('msg',$feedback);
                        //         redirect(base_url(('ClubController/addclubhistory')));
                        //     } else {
                                        $config['upload_path']          = 'club_uploads/club_histories/';
                                        // $config['allowed_types']        = 'gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx';
                                        $config['allowed_types']        = 'pdf|PDF|doc|DOC|docx|DOCX';
                                        // $config['max_size']             = 4096;
                                        // $config['max_width']            = 1024;
                                        // $config['max_height']           = 768;
                                        $config['overwrite']           = true;
                                        $config['file_ext_tolower']     = true;

                                        $this->load->library('upload', $config);
                                        $file="clubhistory";

                                        if ( ! $this->upload->do_upload($file))
                                        {
                                             $feedback = array('error' => $this->upload->display_errors(),'success' => "",'files'=>$this->model->getclubhistories($clubID));

                                              $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url(('index.php/ClubController/addclubhistory')));
                                        }
                                        else
                                        {


                                               $db_debug = $this->db->db_debug;
                                               $this->db->db_debug = FALSE; //disable debugging for queries
                                                $data =$this->upload->data();

                                                $dateUploaded = date("Y-m-d H:i:s");


                                                $file_info=array('file_name'=>$data['file_name'],'client_name'=>$data['client_name'],'full_path'=>$data['full_path'],'file_ext'=>$data['file_ext'],'clubID'=>$clubID,'versionNo'=>$version,'dateUploaded'=>$dateUploaded);


                                            if($this->db->insert('club_histories',$file_info))
                                                {
                                                    $feedback = array('error' => "",'success' => "Constitution Upload was Successful",'files'=>$this->model->getclubhistories($clubID));

                                                    // usort($feedback, "cmp");

                                                    // $this->load->view('clubheads/addclubhistory', $feedback);
                                                     $this->session->set_flashdata('msg',$feedback);
                                                        redirect(base_url(('index.php/ClubController/addclubhistory')));
                                                }
                                            else
                                                {
                                                    $feedback = array('error' => "Duplicate Entries. The Constitution or File name already exists. ",'success' => "",'files'=>$this->model->getclubhistories($clubID));

                                                 $this->session->set_flashdata('msg',$feedback);
                                                redirect(base_url(('index.php/ClubController/addclubhistory')));
                                                }


                                        }
                            // }
                    }


            }

    public function download_clubhistory($filename = NULL)
        {
             if(!($this->session->userdata('clubhead_login')||$this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        // load download helder
                        $this->load->helper('download');
                        // read file contents
                        $data = file_get_contents('club_uploads/club_histories/'.$filename);
                        force_download($filename, $data);
                    }
        }

public function addclubexpenditure()/*save club expenditure*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubid=$this->session->userdata('clubEmail');
                        $datespent=$this->input->post('datespent');
                        $unitname=$this->input->post('unitname');
                        $amounteach=$this->input->post('amounteach');
                        $unitscount=$this->input->post('unitscount');
                        $description=$this->input->post('description');
                        $studentpid=$this->input->post('studentpid');//club official recording expenditure

                        $dateRecorded = date("Y-m-d H:i:s");

                        $expenseinfo=array('clubID' => $clubid, 'dateSpent'=>$datespent,'unitName'=> $unitname,'amountEach'=>$amounteach,'unitsCount'=>$unitscount,'description'=>$description,'studentPID'=>$studentpid,'dateRecorded'=>$dateRecorded);

                         //check if required fields are empty
                        if ( $clubid=="" || $datespent=="" || $unitname==""|| $unitscount==""||$description==""||$studentpid=="" )
                            {
                                $message['null'][]=  "A required field is empty";//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else//if all required fields are not null, proceed
                                {
                                     //check if expense has already been recorded
                                    $result=$this->model->checkexpenseexists($clubid,$datespent,$unitname,$unitscount,$description);

                                    if($result)
                                        {/*if expense already exists, show duplicate message*/
                                            $message['duplicate'][]="This Expense has already been recorded";
                                            echo json_encode($message);
                                        }else {

                                                 //pass array of data to model for saving
                                                 $result=$this->model->addclubexpenditure($expenseinfo);
                                                        if ($result)
                                                            {
                                                                $message['successful'][]=  "Event added successfully";

                                                                echo json_encode($message);//return success
                                                            }else
                                                            {
                                                                $message['fail'][]=  "Expense failed to save";

                                                                echo json_encode($message);//return fail
                                                            }
                                               }

                                }
                }

    }

public function expenditureslist()/*function to return a list of expenditures for a particular club*/
        {
            if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $clubID=$this->session->userdata('clubEmail');

                        $list =$this->model->expenditureslist($clubID);

                        $data = array();
                        $count=1;


                        foreach ($list as $expenditure)
                            {
                                $totalCost=$expenditure['unitsCount']*$expenditure['amountEach'];
                                $datespent=$expenditure['dateSpent'];
                                $formattedDate = date("d/m/Y", strtotime($datespent));

                                    $fullname=$expenditure['firstName']. " ". $expenditure['lastName'];
                                $data['data'][] = array('dateSpent' => $formattedDate, 'unitName' => $expenditure['unitName'],'amountEach'=>$expenditure['amountEach'],'unitsCount' => $expenditure['unitsCount'],'totalCost' => $totalCost,'description'=>$expenditure['description'],'fullName'=>$fullname, 'action'=>$expenditure['autoID'],'count'=>$count);
                                $count=$count +1;

                            }

                        echo json_encode($data);
                 }



        }


public function getexpenditure()/*get expenditure info for update form*/
        {
            if(!$this->session->userdata('clubhead_login'))
                    {
                             $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                    }
                        else
                        {
                            $pid=$this->input->post('pid');

                            $list =$this->model->getexpenditure($pid);

                            $data=array();
                            foreach ($list as $expenditure)
                            {

                                $data = array('pID'=>$expenditure['autoID'], 'studentPID'=>$expenditure['studentPID'],'dateSpent' =>$expenditure['dateSpent'], 'unitName' => $expenditure['unitName'],'amountEach'=>$expenditure['amountEach'],'unitsCount' => $expenditure['unitsCount'],'description'=>$expenditure['description'],'firstName'=>$expenditure['firstName'],'lastName'=>$expenditure['lastName']);

                            }
                            echo json_encode($data);
                        }
        }
public function clubexpenditureupdate()/*update club expenditure*/
    {
        if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $pid=$this->input->post('pid');
                        $datespent=$this->input->post('datespent');
                        $unitname=$this->input->post('unitname');
                        $amounteach=$this->input->post('amounteach');
                        $unitscount=$this->input->post('unitscount');
                        $description=$this->input->post('description');
                        $studentpid=$this->input->post('studentpid');//club official recording expenditure

                        $dateUpdated = date("Y-m-d H:i:s");



                        $expenseupdateinfo=array('dateSpent'=>$datespent,'unitName'=> $unitname,'amountEach'=>$amounteach,'unitsCount'=>$unitscount,'description'=>$description,'studentPID'=>$studentpid,'dateUpdated'=>$dateUpdated);

                         //check if required fields are empty
                        if ($datespent=="" || $unitname==""|| $unitscount==""||$description==""||$studentpid=="" )
                            {
                                $message['null'][]=  "A required field is empty";//error message if required field is empty

                                echo json_encode($message);//return error message

                            }else//if all required fields are not null, proceed
                                {
                                  //pass array of data to model for updating
                                    $result=$this->model->clubexpenditureupdate($expenseupdateinfo, $pid);
                                    if ($result)
                                        {
                                            $message['successful'][]=  "Expense Updated successfully";

                                            echo json_encode($message);//return success
                                        }else
                                            {
                                                $message['fail'][]=  "Expense failed to update";

                                                echo json_encode($message);//return fail
                                            }
                                    }

                }

    }
    public function clubuploads()
        {
             if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $this->load->view('clubheads/clubuploads');
                    }

        }

    public function yearlyreportuploads()
        {
             if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $this->load->view('clubheads/yearlyreportuploads');
                    }

        }

     public function uncategorizedreportuploads()
        {
             if(!$this->session->userdata('clubhead_login'))
                {
                          $data = array('profile'=>$this->mainmodel->clubProfile());
                               $this->load->view('login',$data);
                }
                else
                    {
                        $this->load->view('clubheads/uncategorizedreportuploads');
                    }

        }


    }
