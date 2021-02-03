  <?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name Home.php
 * @Mokoro Stephen: The Phenom Research Lab
 */

//===============================================

class Home extends CI_Controller
{

    function __construct()

    {
        parent::__construct();
         $this->load->library('form_validation','email');
        $this->load->helper('url');//load url helper
        $this->load->model("MainModel", "mainmodel");
        $this->load->model("ClubModel", "model");

    }


//=============================================================

//this function loads home page by default
public function index()
    {
        // begin test @lkasera

        //$this->cas->force_auth();//calling CAS for authentication
        //$user = $this->cas->user();//calling the array with username from CAS and assignin it to the variable $user - @lkasera
    		//$casuser = $user->userlogin;//fetching the username from CAS - @lkasera
    		//$this->cas->logout($url = '');//testing CAS - kill CAS session
    		//$this->load->view('welcome_message');
        //echo $user->userlogin; die();

        // end test @lkasera
        $data = array('profile'=>$this->mainmodel->clubProfile(),'events'=>$this->mainmodel->showevents());
        $this->load->view('login',$data);
    }
 public function adminreg()
        {
             if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
                else{
                    $this->load->view('admin/adminreg');
                }
        }
public function viewuserprofile()
    {
        if(!($this->session->userdata('admin_login')))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else
                {
                    $adminid=$this->input->get('userid');

                    $list['viewuser'] =$this->mainmodel->viewadmin($adminid);

                    $this->load->view('admin/userprofile',$list);
                }
    }

public function usersettings()
    {
        if(!($this->session->userdata('admin_login')))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else
                {
                    $adminid=$this->input->get('userid');

                    $list['viewuser'] =$this->mainmodel->viewadmin($adminid);

                    $this->load->view('admin/usersettings',$list);
                }
    }
// public function crepsettings()//club representative pwd change
//     {
//         if(!($this->session->userdata('crep_login')))
//             {
//                       $data = array('profile'=>$this->mainmodel->clubProfile());
                      // $this->load->view('login',$data);
//             }
//             else
//                 {
//                     $crepid=$this->input->get('userid');

//                     $list['viewuser'] =$this->mainmodel->viewcrep($crepid);

//                     $this->load->view('clubsrep/usersettings',$list);
//                 }
//     }
public function officialprofile()//uses ClubModel
    {
        if(!($this->session->userdata('clubhead_login')))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else
                {
                    $suid=$this->input->get('userid');

                    $list['viewprofile'] =$this->model->viewclubmember($suid);

                    $this->load->view('clubheads/officialprofile',$list);
                }
    }
public function officialsettings()
    {
        if(!($this->session->userdata('clubhead_login')))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else
                {

                    $pid=$this->input->get('userid');

                    // $list['viewprofile'] =$this->model->viewclubmember($pid);

                    $this->load->view('clubheads/clubofficialsettings');
                }
    }
public function clubheed()
    {
         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else{
                $this->load->view('clubheads/clubhead');
            }


    }
public function remindersview()
{
     if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                $this->load->view('admin/reminders');
            }
}
public function changeofficialaccess()
    {
        if(!($this->session->userdata('admin_login')))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else
                {
                    $this->load->view('admin/clubs/resetofficialaccess');
                }
    }
//=============================================================

public function admin()
    {
         if(!$this->session->userdata('admin_login'))
            {
               // $sessdata = array('adminName' =>"Mokoro",'adminID'=>"78581",'admin_login'=>TRUE);
                                        // $this->session->set_userdata($sessdata);
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
                else
                {
                    $this->load->view('admin/admin');
                }
    }
public function crep()//clubs representative
    {
         if(!$this->session->userdata('crep_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
                else{
                    $this->load->view('clubsrep/clubsrep');
                }
    }

public function c_o_view()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $id=$this->input->get('id');
                    // $id=78580; Mokoro Stephen 0719508386
                    $list['c_o_view'] =$this->mainmodel->c_o_viewlist($id);

                    $this->load->view('admin/clubs/c_o_view',$list);
                }
    }

public function clubview()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $id=$this->input->get('clubID');
                    // $id=78580;
                    $list['clubview'] =$this->mainmodel->editclub($id);

                    $this->load->view('admin/clubs/clubview',$list);
                }
    }

public function inactiveclubs()
{
    if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                $this->load->view('admin/clubs/inactiveclubs');
            }

}

public function viewinactiveclubs()//clubs representative
{
    if(!$this->session->userdata('crep_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                $this->load->view('clubsrep/clubs/inactiveclubs');
            }

}


public function reminders()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                $this->load->view('admin/reminders');
            }
    }



public function clubofficial()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/clubs/clubofficialreg');
                }
    }

//=============================================================

public function clubofficialreg() //administrator
    {
      if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/clubs/clubofficialreg');
                    }

    }
//=============================================================

public function crepclubofficialreg() //clubs representative
    {
      if(!($this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('clubsrep/clubs/clubofficialreg');
                    }

    }
//=============================================================

// public function clubmember()
//     {
//         if(!$this->session->userdata('admin_login'))
//             {
//                      $data = array('profile'=>$this->mainmodel->clubProfile());
//                       $this->load->view('login',$data);
//             }else{
//                     $this->load->view('clubs/memberregistration');
//                     }

//     }
public function addseedmember()/*function to register first club member*/
    {
        if(!$this->session->userdata('admin_login'))
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
                            $clubid=$this->input->post('clubid');

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
                                                'dateRegistered'=>$dateRegistered,
                                                'nominated'=>1

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

//=============================================================


public function officials()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                $this->load->view('admin/users/officials');
            }

    }

public function officialsnominees()
{
     if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $clubID=$this->input->post('clubid');
                    $list = $this->mainmodel->officialsnominees($clubID);

                        $data=array();
                        foreach ($list->result() as $nominees)
                            {
                                $data[$nominees->pID]=$nominees->firstName. " ". $nominees->lastName;
                            }

                        $new=array_unique($data,SORT_STRING);
                        echo json_encode($new);

                }
}

//=============================================================

public function clubs()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    //generate number/string/varchar here

                    $this->load->view('admin/clubs/clubs');
                    }

    }

//=============================================================




public function studentportal()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('studentportal');
                }

    }

//=============================================================

public function clubhead()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('clubhead');
                }

    }
//=============================================================

public function adminprofile()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/adminprofile');
                    }

    }

//====================clubmember views=========================

public function clubmemberviews()
{
    if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/clubs/clubmemberviews');
                }
}
public function crepclubmemberviews()//club representative
{
    if(!$this->session->userdata('crep_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('clubsrep/clubs/clubmemberviews');
                }
}

public function clubofficialviews()
{
    if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/clubs/clubofficialviews');
                }
}
public function crepclubofficialviews()//club representative views club officials
{
    if(!$this->session->userdata('crep_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('clubsrep/clubs/clubofficialviews');
                }
}
public function perclubofficials()
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

public function activestudents()
{
    if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                $clubID=$this->input->post('clubid');

                    $list =$this->mainmodel->clubmemberslist($clubID);

                    $data = array();
                    $count=1;

                    foreach ($list as $members)
                        {

                            if ($members['status']=='1')
                            {
                                $fullname=$members['firstName']. " ". $members['lastName'];
                            $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseName'],'status'=>"Active",'action'=>$members['pID'],'count'=>$count,'clubID'=>$clubID);
                            $count=$count +1;
                            }else if ($members['status']=='0') {
                                $fullname=$members['firstName']. " ". $members['lastName'];
                            $data['data'][] = array('suID' => $members['suID'],'fullName'=>$fullname, 'telNo'=>$members['telNo'],'courseName'=>$members['courseName'],'status'=>"Inactive",'action'=>$members['suID'],'count'=>$count,'clubID'=>$clubID);
                            $count=$count +1;
                            }


                        }

                    echo json_encode($data);
                }
}


function registerclub()
{

   if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                   $clubid=$this->input->post('clubid');
                   $clubname=$this->input->post('clubname');
                   $yearstarted=$this->input->post('yearstarted');
                   $yearrebranded=$this->input->post('yearrebranded');
                   $registrationfee=$this->input->post('registrationfee');
                   $regbasis=$this->input->post('regbasis');

                   $dateRegistered=date("Y-m-d H:i:s");



                   $defaultpass=md5($clubid);


                   if(($yearstarted=='')&&($yearrebranded==''))
                   {
                       $clubinfo=array('clubID' =>$clubid ,
                                        'clubName'=>$clubname,
                                        'yearStarted'=>NULL,
                                        'yearRebranded'=>NULL,
                                        'registrationFee'=>$registrationfee,
                                        'registrationBasis'=>$regbasis,
                                        'password'=>$defaultpass,
                                        'dateRegistered'=>$dateRegistered
                                    );

                   }else if(($yearstarted !=='')&&($yearrebranded ==''))
                   {
                         $clubinfo=array('clubID' =>$clubid ,
                                        'clubName'=>$clubname,
                                        'yearStarted'=>$yearstarted,
                                        'yearRebranded'=>NULL,
                                        'registrationFee'=>$registrationfee,
                                        'registrationBasis'=>$regbasis,
                                        'password'=>$defaultpass,
                                        'dateRegistered'=>$dateRegistered
                                    );

                   }
                   else if(($yearstarted=='')&&($yearrebranded !==''))
                   {
                        $clubinfo=array('clubID' =>$clubid ,
                                        'clubName'=>$clubname,
                                        'yearStarted'=>NULL,
                                        'yearRebranded'=>$yearrebranded,
                                        'registrationFee'=>$registrationfee,
                                        'registrationBasis'=>$regbasis,
                                        'password'=>$defaultpass,
                                        'dateRegistered'=>$dateRegistered
                                    );
                   }else
                   {
                        $clubinfo=array('clubID' =>$clubid ,
                                        'clubName'=>$clubname,
                                        'yearStarted'=>$yearstarted,
                                        'yearRebranded'=>$yearrebranded,
                                        'registrationFee'=>$registrationfee,
                                        'registrationBasis'=>$regbasis,
                                        'password'=>$defaultpass,
                                        'dateRegistered'=>$dateRegistered
                                    );
                   }





                $data = array('clubID' =>$this->input->post('clubid'), 'clubName' =>$this->input->post('clubname'));
                if ($clubid=="" || $clubname=="" || $registrationfee=="" || $regbasis=="")
                    {
                        $message['null'][]=  "Null entry";

                        echo json_encode($message);

                    }else
                            {
                                $this->db->select('*');
                                $this->db->from('clubs');
                                $this->db->where('clubID',$clubid);
                                $this->db->where('status',1);
                                $query = $this->db->get();
                                $num=$query->num_rows();



                                if($num>0)
                                   {
                                                $message['fail'][]=  "Registration Unsuccessful.Duplicate entries";
                                                echo json_encode($message);

                                    }   else
                                            {
                                                $this->db->select('*');
                                                $this->db->from('clubs');
                                                $this->db->where('clubID',$clubid);
                                                $this->db->where('status',0);
                                                $query = $this->db->get();
                                                $num=$query->num_rows();


                                                if($num>0)
                                                    {
                                                        $message['inactive'][]=  "Club exists but is inactive";
                                                        echo json_encode($message);
                                                    }else
                                                        {
                                                            $result=$this->mainmodel->registerclub($clubinfo);
                                                                if ($result)
                                                                    {
                                                                        $message['successful'][]=  "Club Successfully Registered";

                                                                        echo json_encode($message);
                                                                    }
                                                        }
                                            }
                            }
            }
    }


//======================club updating==================

function updateclub()
{
    if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                   $clubid=$this->input->post('clubid');
                   $clubname=$this->input->post('clubname');
                   $yearstarted=$this->input->post('yearstarted');
                   $yearrebranded=$this->input->post('yearrebranded');
                   $registrationfee=$this->input->post('registrationfee');
                   $regbasis=$this->input->post('regbasis');

                   $dateUpdated=date("Y-m-d H:i:s");


              if(($yearstarted=='')&&($yearrebranded==''))
                   {
                       $clubinfo=array(
                                        'clubName'=>$clubname,
                                        'yearStarted'=>NULL,
                                        'yearRebranded'=>NULL,
                                        'registrationFee'=>$registrationfee,
                                        'registrationBasis'=>$regbasis,
                                        'updated'=>$dateUpdated
                                    );

                   }else if(($yearstarted !=='')&&($yearrebranded ==''))
                   {
                         $clubinfo=array(
                                        'clubName'=>$clubname,
                                        'yearStarted'=>$yearstarted,
                                        'yearRebranded'=>NULL,
                                        'registrationFee'=>$registrationfee,
                                        'registrationBasis'=>$regbasis,
                                        'updated'=>$dateUpdated

                                    );

                   }
                   else if(($yearstarted=='')&&($yearrebranded !==''))
                   {
                        $clubinfo=array(
                                        'clubName'=>$clubname,
                                        'yearStarted'=>NULL,
                                        'yearRebranded'=>$yearrebranded,
                                        'registrationFee'=>$registrationfee,
                                        'registrationBasis'=>$regbasis,
                                        'updated'=>$dateUpdated
                                    );
                   }else
                   {
                        $clubinfo=array(
                                        'clubName'=>$clubname,
                                        'yearStarted'=>$yearstarted,
                                        'yearRebranded'=>$yearrebranded,
                                        'registrationFee'=>$registrationfee,
                                        'registrationBasis'=>$regbasis,
                                        'updated'=>$dateUpdated
                                    );
                   }


             $array = array('successful' =>"Club updated successfully!",'fail'=>"Club update failed",'null'=>"null entry",'nochange'=>"No Change was made");


                $data = array('clubID' =>$this->input->post('clubid'), 'clubName' =>$this->input->post('clubname'));

                if ($clubid=="" || $clubname=="" || $registrationfee=="" || $regbasis=="")
                    {
                        $message['null'][]=  $array;

                        echo json_encode($message);

                    }else
                            {

                                        if ($this->mainmodel->updateclub($clubid,$clubinfo)==true)
                                             {
                                                  $message['successful'][]=  $array;

                                                        echo json_encode($message);
                                            }else
                                                {
                                                    $message['nochange'][]=  $array;

                                                        echo json_encode($message);
                                                }


                            }
            }

    }


public function clubdescription()
{
    if(!($this->session->userdata('admin_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/clubs/clubprofile');
                }
}

public function clubroles()
{
    if(!($this->session->userdata('admin_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/clubs/clubroles');
                }
}
public function clubsupervisor()
{
    if(!($this->session->userdata('admin_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/clubs/clubpatrons');
                }
}
public function seedmember()
{
    if(!($this->session->userdata('admin_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/clubs/seedmember');
                }
}
public function generalfilesupload()
{
    if(!($this->session->userdata('admin_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->view('admin/generalfileupload');
                }
}
//==================list of clubs========================


public function clublist()
    {
        if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                $list =$this->mainmodel->clubslist();

                $data = array();
                $count=1;

                foreach ($list as $clubs)
                    {
                        if($clubs['status']=="1")
                        {
                             $data['data'][] = array('clubID' => $clubs['clubID'],'clubName'=>$clubs['clubName'],
                            'yearStarted'=>$clubs['yearStarted'], 'yearRebranded'=>$clubs['yearRebranded'],'registrationFee'=>$clubs['registrationFee'],
                            'registrationBasis'=>$clubs['registrationBasis'],'action'=>$clubs['clubID'],'count'=>$count,'status'=>"Active");

                                $count=$count +1;
                        }else {
                             $data['data'][] = array('clubID' => $clubs['clubID'],'clubName'=>$clubs['clubName'],
                            'yearStarted'=>$clubs['yearStarted'], 'yearRebranded'=>$clubs['yearRebranded'],'registrationFee'=>$clubs['registrationFee'],
                            'registrationBasis'=>$clubs['registrationBasis'],'action'=>$clubs['clubID'],'count'=>$count,'status'=>"Inactive");

                                $count=$count +1;
                        }



                    }

                echo json_encode($data);
        }



    }

public function inactiveclubslist()
    { if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                        $list =$this->mainmodel->inactiveclubslist();

                        $data = array();
                        $count=1;

                        foreach ($list as $clubs)
                            {
                                if($clubs['status']=="1")
                                {
                                     $data['data'][] = array('clubID' => $clubs['clubID'],'clubName'=>$clubs['clubName'],
                                    'yearStarted'=>$clubs['yearStarted'], 'yearRebranded'=>$clubs['yearRebranded'],'registrationFee'=>$clubs['registrationFee'],
                                    'registrationBasis'=>$clubs['registrationBasis'],'action'=>$clubs['clubID'],'count'=>$count,'status'=>"Active");

                                        $count=$count +1;
                                }else {
                                     $data['data'][] = array('clubID' => $clubs['clubID'],'clubName'=>$clubs['clubName'],
                                    'yearStarted'=>$clubs['yearStarted'], 'yearRebranded'=>$clubs['yearRebranded'],'registrationFee'=>$clubs['registrationFee'],
                                    'registrationBasis'=>$clubs['registrationBasis'],'action'=>$clubs['clubID'],'count'=>$count,'status'=>"Inactive");

                                        $count=$count +1;
                                }



                            }

                        echo json_encode($data);

            }



    }



//=====================club editing======================


public function getclub()
    {
         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $id=$this->input->post('id');

                    $list =$this->mainmodel->editclub($id);


                    foreach ($list as $clubs)
                        {


                            $data= array('clubID' => $clubs['clubID'],'clubName'=>$clubs['clubName'],
                                'yearStarted'=>$clubs['yearStarted'], 'yearRebranded'=>$clubs['yearRebranded'],'registrationFee'=>$clubs['registrationFee'],
                                'registrationBasis'=>$clubs['registrationBasis']);
                        }
                    echo json_encode($data);
                }


    }



public function getclubofficial()
    {
      if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $id=$this->input->post('id');

                    $list =$this->mainmodel->getclubofficial($id);

                    $info=array();
                    foreach ($list as $co)
                        {
                            $startdate=$co['startDate'];
                            $startDate = date("Y-m-d", strtotime($startdate));
                            $enddate=$co['endDate'];

                            if($enddate=="")
                            {
                               $fullName=$co['firstName']. " ".$co['lastName'];
                                $info= array('pID'=>$co['pID'],'fullName' => $fullName,'clubName' => $co['clubName'],'clubID' => $co['clubID'],'roleID' => $co['roleID'],'roleName' => $co['roleName'],'startDate' => $startDate,'endDate' => "");
                            }else {
                                    $endDate = date("Y-m-d", strtotime($enddate));

                                    $fullName=$co['firstName']. " ".$co['lastName'];
                                    $info= array('pID'=>$co['pID'],'fullName' => $fullName,'clubName' => $co['clubName'],'clubID' => $co['clubID'],'roleID' => $co['roleID'],'roleName' => $co['roleName'],'startDate' => $startDate,'endDate' => $endDate);
                                }
                        }
                    echo json_encode($info);
                }


    }


 public function viewclubofficial()
    {
     if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $id=$this->input->post('id');

                    $list =$this->mainmodel->getclubofficial($id);

                    $info=array();
                    foreach ($list as $co)
                        {
                            $startdate=$co['startDate'];
                            $startDate = date("d/m/Y", strtotime($startdate));
                            $enddate=$co['endDate'];
                            $endDate = date("d/m/Y", strtotime($startdate));

                            // $fullName=$co['firstName']. " ".$co['lastName'];
                            $info= array('pID'=>$co['pID'],'suID' => $co['suID'],'firstName' => $co['firstName'],'lastName' => $co['lastName'],'gender'=>$co['gender'],'suEmail' => $co['suEmail'],'telNo' => $co['telNo'],'clubName' => $co['clubName'],'clubID' => $co['clubID'],'roleID' => $co['roleID'],'roleName' => $co['roleName'],'startDate' => $startDate,'endDate' => $endDate,'dateRegistered'=>$co['dateRegistered'],'lastUpdated'=>$co['updated'],'courseName'=>$co['courseID']);

                        }
                    echo json_encode($info);
                }


    }


//================club deleting========================


public function deleteclub()
    {
         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                $clubid=$this->input->post('id');
                $array = array('successful' =>"Club deleted successfully!",'fail'=>"Club deletion failed");


                 if ($this->mainmodel->deleteclub($clubid)==true)
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

public function deactivateclub()
    {

         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $clubid=$this->input->post('id');
                    // $array=array('status'=>"0");


                     if ($this->mainmodel->deactivateclub($clubid) )
                                    {
                                        $message['successful']=  "Club deactivated successfully!";

                                        echo json_encode($message);
                                    }else
                                        {
                                            $message['fail']=  "Club deactivation failed";
                                            echo json_encode($message);
                                        }
                }
    }

public function activateclub()
    {
         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $clubid=$this->input->post('id');
                    // $array=array('status'=>"1");


                     if ($this->mainmodel->activateclub($clubid))
                            {
                                $message['successful']=  "Club activated successfully!";

                                echo json_encode($message);
                            }else
                                {
                                    $message['fail']=  "Club activation failed";
                                    echo json_encode($message);
                                }
                    }
    }


public function deleteclubofficial()
    {
         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $pid=$this->input->post('id');
                    $array = array('successful' =>"Club official deleted successfully!",'fail'=>"Club official deletion failed");

                    $updatememberstable=array('nominated'=>0,'leadership'=>0,'roleID'=>NULL);

                    $result_1=$this->mainmodel->deleteclubofficial($pid);
                    $result_2=$this->mainmodel->updatememberstableonofficialdelete($pid,$updatememberstable);
                     if ($result_1 && $result_2)
                                    {
                                        $message['successful']=  $array;

                                        echo json_encode($message);
                                    }else
                                        {
                                            $message['fail']=  $array;
                                            echo json_encode($message);
                                        }
                                        redirect('index.php/Home/clubofficialreg');

                }
    }

public function disableclubofficial()
    {
         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $pid=$this->input->post('id');
                    $array = array('successful' =>"Club official updated successfully!",'fail'=>"Club official disable failed");

                    $updatememberstable=array('nominated'=>0,'leadership'=>0,'roleID'=>NULL);
                    $changeStatus=array('status'=>0);

                    $result_1=$this->mainmodel->disableclubofficial($pid,$changeStatus);
                    $result_2=$this->mainmodel->updatememberstableonofficialdelete($pid,$updatememberstable);
                     if ($result_2)
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

public function disableadmin()
    {
         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $id=$this->input->post('id');


                    $changeStatus=array('status'=>0);

                    $result=$this->mainmodel->disableadmin($id,$changeStatus);
                     if ($result)
                        {
                            $message['successful']=  "Admin Successfully deactivated";
                            echo json_encode($message);
                        }else
                            {
                                $message['fail']=  "Fail: Admin not deactivated";
                                echo json_encode($message);
                            }

                }
    }

//==============register club Official====================

public function clubofficialregistration()
{
      if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else
                {
                    //collect ajax-submitted data
                   $pid=$this->input->post('officialid');
                   $clubid=$this->input->post('club');
                   $roleid=$this->input->post('role');
                   $startdate=$this->input->post('startdate');
                   $enddate=$this->input->post('enddate');

                   $dateRegistered=date("Y-m-d H:i:s");


                   $password=md5('5trathm0re');



                   $officiallogin=array();

                   $this->db->select('suID');
                   $this->db->from('clubmembers');
                   $this->db->where('pID',$pid);
                   $result=$this->db->get();

                   foreach ($result->result() as $student)
                            {

                                $studentID=$student->suID;

                                 $clubofficiallogininfo=array(
                                        'clubID'=>$clubid,
                                        'studentID'=>$studentID,
                                        'password'=>$password,

                                    );
                            }

                   if($enddate=="")
                   {
                     //create an array of data to be saved into db
                        $cofficialinfo=array('pID' =>$pid ,
                                        'studentID'=>$studentID,
                                        'clubID'=>$clubid,
                                        'roleID'=>$roleid,
                                        'startDate'=>$startdate,
                                        'endDate'=>NULL,
                                        'dateRegistered'=>$dateRegistered

                                    );
                   }else {


                        //create an array of data to be saved into db
                        $cofficialinfo=array('pID' =>$pid ,
                                        'clubID'=>$clubid,
                                        'studentID'=>$studentID,
                                        'roleID'=>$roleid,
                                        'startDate'=>$startdate,
                                        'endDate'=>$enddate,
                                        'dateRegistered'=>$dateRegistered


                                    );
                    }

                    $updatememberstable=array('nominated'=>0,'leadership'=>1,'roleID'=>$roleid);
                     //set success messages array
                $array = array('successful' =>"Club Official Registered Successfully!",'fail'=>"Registration Unsuccessful.Duplicate entries",'null'=>"null entry");


                //check if required fields are empty
                if ($pid=="" || $clubid==""|| $roleid==""||$startdate=="")
                    {
                        $message['null'][]=  $array;//error message if required field is empty

                        echo json_encode($message);//return error message

                    }else//if all required fields are not null, proceed
                            {
                                //check if a club  official already has an active role in the same club
                                $this->db->select('*');
                                $this->db->from('officialsroles');
                                $this->db->where('pID',$pid);
                                $this->db->where('status',1);
                                $query = $this->db->get();
                                $num=$query->num_rows();

                                if($num>0)//if a club official with same ID already exists
                                   {

                                                $message['fail'][]=  $array;

                                                echo json_encode($message);//return fail


                                    }   else
                                            {
                                                $this->db->select('suID');
                                                $this->db->from('clubmembers');
                                                $this->db->where('pID',$pid);
                                                $result=$this->db->get_compiled_select();


                                                $this->db->select('*');
                                                $this->db->from('admin');
                                                $this->db->where("`staffID` IN ($result)", NULL, FALSE);

                                                $query = $this->db->get();
                                                $num=$query->num_rows();



                                                if($num>0)//check if the official is a clubs representative in student council. If so, dont register. Clubs representatives cannot have an active official role in another club.
                                                   {
                                                                $message['conflict'][]=  $array;

                                                                echo json_encode($message);//return fail

                                                    } else {

                                                                    //check if the official is a registered official in another club
                                                                    $this->db->select('*');
                                                                    $this->db->from('clubofficials');
                                                                    $this->db->where('studentID',$studentID);
                                                                    $query = $this->db->get();
                                                                    $num=$query->num_rows();
                                                                    if($num>0)
                                                                        {//if so only add another role details to roles table
                                                                            $result_1=$this->mainmodel->addnewofficialrole($cofficialinfo);
                                                                            $result_2=$this->mainmodel->updatememberstable($updatememberstable,$pid);

                                                                            if ($result_1 && $result_2)
                                                                                {
                                                                                    $message['successful'][]=  $array;

                                                                                    echo json_encode($message);//return success
                                                                                }else
                                                                                    {
                                                                                        $message['fail'][]=  $array;

                                                                                        echo json_encode($message);//return fail
                                                                                    }
                                                                        } else{
                                                                                    //pass array of data to model for saving
                                                                                    $result_1=$this->mainmodel->clubofficiallogininfo($clubofficiallogininfo);
                                                                                    $result_2=$this->mainmodel->addnewofficialrole($cofficialinfo);
                                                                                    $result_3=$this->mainmodel->updatememberstable($updatememberstable,$pid);

                                                                                    if ($result_1 && $result_2 && $result_3)
                                                                                        {
                                                                                            $message['successful'][]=  $array;

                                                                                            echo json_encode($message);//return success
                                                                                        }else
                                                                                            {
                                                                                                $message['fail'][]=  $array;

                                                                                                echo json_encode($message);//return fail
                                                                                            }
                                                                                }


                                                            }

                                            }

                }            }
}


function checkusername()
{
       $username = trim($this->input->get('term', TRUE));//cross-site scripting security

        $this->db->select('userName');
        $this->db->from('admin');
        $this->db->like('userName', $username);
        // $this->db->limit('5');
        $query = $this->db->get();

        if ($query->num_rows() > 0)
        {
            $data['response'] = 'true'; //If username exists set true
            // $data['message'] = array();

            foreach ($query->result() as $row)
            {
                $data['message'][] = "Username Already Exists"  ;

                // $data['message'][] = array(
                //     'label' => $row->userName,
                //     'value' => $row->userName,
                //     'user_id'  => $row->pID
                // );
            }
        }
        else
        {
            $data['response'] = 'false'; //Set false if user not valid
        }

        echo json_encode($data);
}


public function clubofficialupdating()
{
      if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                //collect ajax-submitted data
                   $pid=$this->input->post('officialid');
                   $clubid=$this->input->post('club');
                   $roleid=$this->input->post('role');
                   $startdate=$this->input->post('startdate');
                   $enddate=$this->input->post('enddate');
                   $dateUpdated=date("Y-m-d H:i:s");


                   if($enddate=="")
                        {
                            //create an array of data to be saved into db
                            $cofficialinfo=array('clubID'=>$clubid,
                                        'roleID'=>$roleid,
                                        'startDate'=>$startdate,
                                        'endDate'=>NULL,
                                        'dateUpdated'=>$dateUpdated

                                    );
                        }else {
                                //create an array of data to be saved into db
                                $cofficialinfo=array('clubID'=>$clubid,
                                        'roleID'=>$roleid,
                                        'startDate'=>$startdate,
                                        'endDate'=>$enddate,
                                        'dateUpdated'=>$dateUpdated

                                    );
                        }



                     //set success messages array
                $array = array('successful' =>"Club Official Info Updated Successfully!",'fail'=>"Updating Unsuccessful",'null'=>"null entry",'nochange'=>"No changes were made");


                //check if required fields are empty
                if ($roleid==""||$startdate=="")
                    {
                        $message['null'][]=  $array;//error message if required field is empty

                        echo json_encode($message);//return error message

                    }else//if all required fields are not null, proceed
                            {
                                 //pass array of data to model for saving
                                 $result=$this->mainmodel->updateclubofficial($cofficialinfo, $pid);
                                        if ($result)
                                            {
                                                $message['successful'][]=  $array;

                                                echo json_encode($message);//return success
                                            }else
                                                {
                                                    $message['nochange'][]=  $array;

                                                    echo json_encode($message);//return success
                                                }




                            }
            }
}



//======================list club officials==========================


public function clubofficialslist()
    {

      if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $list =$this->mainmodel->clubofficialslist();

                    $data = array();
                    $count=1;

                    foreach ($list as $officials)
                        {

                            $fullname=$officials['firstName']. " ". $officials['lastName'];
                            $data['data'][] = array('pID'=>$officials['pID'],'suID' => $officials['suID'],'fullName'=>$fullname, 'telNo'=>$officials['telNo'],'clubName'=>$officials['clubName'],'roleName'=>$officials['roleName'],'action'=>$officials['pID'],'count'=>$count);
                            $count=$count +1;
                        }

                    echo json_encode($data);
                }



    }

public function clubofficialsdropdownlist()
{
     if(!$this->session->userdata('clubhead_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $list = $this->mainmodel->clubofficialsdropdown();

                         $data=array();
                        foreach ($list->result() as $officials)
                            {

                                $data[$officials->pID]=$officials->firstName. " ". $officials->lastName;
                            }
                        $new=array_unique($data,SORT_STRING);
                        echo json_encode($new);
            }
}


public function viewclubofficialslist()
    {

         if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $clubID=$this->input->GET('clubID');

                    if($clubID=="All")
                    {

                    $list =$this->mainmodel->viewallclubofficialslist();

                    $data = array();
                    $count=1;

                    foreach ($list as $officials)
                        {
                            $fullname=$officials['firstName']. " ". $officials['lastName'];
                            $data['data'][] = array('pID'=>$officials['pID'],'suID' => $officials['suID'],'fullName'=>$fullname, 'telNo'=>$officials['telNo'],'courseName'=>$officials['courseID'],'roleName'=>$officials['roleName'],'action'=>$officials['pID'],'count'=>$count);
                            $count=$count +1;
                        }

                    echo json_encode($data);
                    }else
                        {

                            $list =$this->mainmodel->viewclubofficialslist($clubID);

                            $data = array();
                            $count=1;

                            foreach ($list as $officials)
                                {

                                    $fullname=$officials['firstName']. " ". $officials['lastName'];
                                    $data['data'][] = array('pID'=>$officials['pID'],'suID' => $officials['suID'],'fullName'=>$fullname, 'telNo'=>$officials['telNo'],'courseName'=>$officials['courseID'],'roleName'=>$officials['roleName'],'action'=>$officials['pID'],'count'=>$count);
                                    $count=$count +1;
                                }

                            echo json_encode($data);
                        }


                }



    }



//==============dropdown list of registered clubs====================

public function clubdropdownlist()
{
     if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    // $list=$this->data['clubs'] = $this->mainmodel->clubsdropdown();
                    $list = $this->mainmodel->clubsdropdown();
                         $data=array();
                        foreach ($list->result() as $clubs)
                            {
                                $data[$clubs->clubID]=$clubs->clubName;
                            }
                        $new=array_unique($data,SORT_STRING);
                        echo json_encode($new);
            }
}


//==============dropdown list of club roles====================

public function c_rolesdropdown()
{
     if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $list = $this->mainmodel->c_rolesdropdown();

                        $data=array();
                        foreach ($list->result() as $c_roles)
                            {
                                $data[$c_roles->roleID]=$c_roles->roleName;
                            }

                        $new=array_unique($data,SORT_STRING);
                        echo json_encode($new);

                }
}




public function clubspdf()
{
     if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->library('Pdf');
                    $list['clubs'] =$this->mainmodel->clubslist();

                    $this->load->view('admin/clubs/clubspdf',$list);
                }
}

public function inactiveclubspdf()
{
     if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->library('Pdf');
                    $list['clubs'] =$this->mainmodel->inactiveclubslist();

                    $this->load->view('admin/clubs/inactiveclubspdf',$list);
                }
}

public function clubofficialspdf()
{
     if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $this->load->library('Pdf');
                    $list['clubofficials'] =$this->mainmodel->clubofficialslist();

                    $this->load->view('admin/clubs/clubofficialspdf',$list);
                }
}

public function perclubofficialspdf()/*function prints pdf of club members of a particular club. Only for admin*/
{

    if(!($this->session->userdata('admin_login')||$this->session->userdata('crep_login')))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else
                {
                    $clubID=$this->input->get('clubID');
                    //  $sessdata=array();
                    // $sessdata = array('clubEmail' =>$clubID);
                    // $this->session->set_userdata($sessdata);
                    if($clubID=="All")/*prints pdf of members from all clubs*/
                    {
                         $this->load->library('Pdf');
                            $list['clubofficials'] =$this->mainmodel->clubofficialslist();/*removes duplicate members appearing in many clubs*/

                        $this->load->view('admin/clubs/clubofficialspdf',$list);
                    }else{

                            $this->load->library('Pdf');
                            $list['clubofficials'] =$this->mainmodel->perclubclubofficialslist($clubID);

                            $this->load->view('admin/clubs/clubofficialspdf',$list);
                    }
                }


}




public function adminregistration()
{
     if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else
                {
                    //collect ajax-submitted data
                       $staffid=$this->input->post('staffid');
                       $lastname=$this->input->post('lastname');
                       $firstname=$this->input->post('firstname');
                       $gender=$this->input->post('gender');
                       $phone=$this->input->post('phone');
                       $suemail=$this->input->post('emailadd');
                       $role=$this->input->post('role');
                       $username=$this->input->post('username');
                       $dateRegistered = date("Y-m-d H:i:s");

                      $defaultpass=md5($staffid.$lastname);


                        //create an array of data to be saved into db
                        $admininfo=array(
                                            'staffID'=>$staffid,
                                            'roleID'=>$role,
                                            'lastName'=>$lastname,
                                            'firstName'=>$firstname,
                                            'userName'=>$username,
                                            'gender'=>$gender,
                                            'phone'=>$phone,
                                            'suEmail'=>$suemail,
                                            'dateRegistered'=>$dateRegistered,
                                            'password'=>$defaultpass

                                        );



                    //check if required fields are empty
                    if ($staffid=="" ||$role=="" || $lastname=="" || $firstname=="" || $suemail==""|| $phone==""||$gender==""||$username=="")
                        {
                            $message['null'][]=  "null entry";//error message if required field is empty

                            echo json_encode($message);//return error message

                        }else//if all required fields are not null, proceed
                                {
                                     //check if the admin was earlier registered and is active

                                    $this->db->select('*');
                                    $this->db->from('admin');
                                    $this->db->where('staffID',$staffid);
                                    $this->db->where('status',1);
                                    $query = $this->db->get();
                                    $num=$query->num_rows();



                                    if($num>0)
                                       {//If the new member was earlier registered to the club and is active

                                                    $message['duplicate'][]=  "Duplicate entry";
                                                    echo json_encode($message);

                                        }   else
                                                {
                                                    $this->db->select('*');
                                                    $this->db->from('officialsroles');
                                                    $this->db->where('studentID',$staffid);
                                                    $this->db->where('status',1);
                                                    $query = $this->db->get();
                                                    $num=$query->num_rows();

                                                    if($num>0)
                                                       {//if the clubs rep is a current official of a club

                                                                    $message['activeofficial'][]=  "Active Official";
                                                                    echo json_encode($message);

                                                        } else{

                                                                //If the new admin was earlier registered but has been marked as disabled.
                                                                $this->db->select('*');
                                                                $this->db->from('admin');
                                                                $this->db->where('staffID',$staffid);
                                                                $this->db->where('status',0);
                                                                $query = $this->db->get();
                                                                $num=$query->num_rows();

                                                                if ($num>0)
                                                                {// If the admin exists but marked disabled, Ask superadmin to activate instead of registering him/her again
                                                                    $message['disabled'][]=  "Disbabled";
                                                                    echo json_encode($message);
                                                                } else {
                                                                        // If the admin doesn't exist proceed to register

                                                                            $result=$this->mainmodel->registeradmin($admininfo);

                                                                                    if ($result)
                                                                                        {
                                                                                            $message['successful'][]=  "Successful";

                                                                                            echo json_encode($message);//return success
                                                                                        }else
                                                                                            {
                                                                                                $message['error'][]=  "Error";

                                                                                                echo json_encode($message);//return success
                                                                                            }
                                                                        }
                                                        }


                                                }



                                }
                }
}




public function updateadmin()
{
     if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                //collect ajax-submitted data
                   $staffid=$this->input->post('staffid');
                   $lastname=$this->input->post('lastname');
                   $firstname=$this->input->post('firstname');
                   $gender=$this->input->post('gender');
                   $phone=$this->input->post('phone');
                   $suemail=$this->input->post('emailadd');
                   $role=$this->input->post('role');
                   $dateUpdated=date("Y-m-d H:i:s");

                    //create an array of data to be saved into db
                    $admininfo=array(
                                        'roleID'=>$role,
                                        'lastName'=>$lastname,
                                        'firstName'=>$firstname,
                                        'gender'=>$gender,
                                        'phone'=>$phone,
                                        'suEmail'=>$suemail,
                                        'updated'=>$dateUpdated

                                    );



                //check if required fields are empty
                if ($staffid=="" ||$role=="" || $lastname=="" || $firstname=="" || $suemail==""|| $phone==""||$gender=="")
                    {
                        $message['null'][]=  "null entry";//error message if required field is empty

                        echo json_encode($message);//return error message

                    }else//if all required fields are not null, proceed
                            {
                                $result=$this->mainmodel->updateadmin($admininfo,$staffid);

                                if ($result)
                                    {
                                        $message['successful'][]=  "Successful";
                                        echo json_encode($message);//return success
                                    }else
                                        {
                                            $message['nochange'][]=  "No changes were made";
                                            echo json_encode($message);//return success
                                        }
                            }

        }
}




public function getadmin()
    {
         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $id=$this->input->post('id');

                    $list =$this->mainmodel->editadmin($id);

                    $info=array();
                    foreach ($list as $admin)
                        {

                           $info= array('staffID'=>$admin['staffID'],'firstName' => $admin['firstName'],'lastName' => $admin['lastName'],'gender'=>$admin['gender'],'suEmail' => $admin['suEmail'],'telNo' => $admin['phone'],'roleName'=>$admin['roleName'],'roleID'=>$admin['roleID']);
                        }
                    echo json_encode($info);
                }


    }

public function admrolesdropdown()
{
     if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $list = $this->mainmodel->admrolesdropdown();

                        $data=array();
                        foreach ($list->result() as $admroles)
                            {
                                $data[$admroles->roleID]=$admroles->roleName;
                            }

                        $new=array_unique($data,SORT_STRING);
                        echo json_encode($new);

                }
}



public function deleteadmin()
    {
         if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                $adminid=$this->input->post('userID');

                 if ($this->mainmodel->deleteadmin($adminid)==true)
                        {
                            $message['successful']=  "Admin Deleted Successfully";

                            echo json_encode($message);
                        }else
                            {
                                $message['fail']= "Admin deletion failed";
                                echo json_encode($message);
                            }
                }
    }



public function adminlist()
    {
        if(!$this->session->userdata('admin_login'))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{

                    $list =$this->mainmodel->adminlist();

                    $data = array();
                    $count=1;

                    foreach ($list as $admin)
                        {

                            $fullname=$admin['firstName']. " ". $admin['lastName'];
                            $data['data'][] = array('staffID'=>$admin['staffID'],'fullName'=>$fullname, 'phone'=>$admin['phone'],'action'=>$admin['staffID'],'role'=>$admin['roleName'], 'emailAddress'=>$admin['suEmail'],'count'=>$count);
                            $count=$count +1;
                        }

                    echo json_encode($data);
                }

    }


public function club_constitutions()//admin club constitution views
    {

        if(!($this->session->userdata('admin_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $data = array('files'=>$this->mainmodel->getallconstitutions());
                $this->load->view('admin/clubs/club_constitutions',$data);
            }

    }

public function crep_clubconstitutions()//clubs rep club constitution views
    {

        if(!($this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $data = array('files'=>$this->mainmodel->getallconstitutions());
                $this->load->view('clubsrep/clubs/club_constitutions',$data);
            }

    }
public function club_histories()//admin club history views
    {

        if(!($this->session->userdata('admin_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $data = array('files'=>$this->mainmodel->getallclubhistories());
                $this->load->view('admin/clubs/club_histories',$data);
            }

    }
    public function crep_clubhistories()//clubs rep club history views
    {

        if(!($this->session->userdata('crep_login')))
            {
                     $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }else{
                    $data = array('files'=>$this->mainmodel->getallclubhistories());
                $this->load->view('clubsrep/clubs/club_histories',$data);
            }

    }
public function delete_constitution($filename = NULL)
    {
        if(!($this->session->userdata('admin_login')))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else
                {
                    $autoID=$this->input->get('constID');
                    // $query="SELECT clubID FROM club_constitutions WHERE autoID='$autoID'";
                    // $clubID=$this->db->query($query);

                    $const_details=$this->model->getconstitution($autoID);
                        $filename="";
                        foreach($const_details as $file)
                                {
                                    $filename=$file->file_name;
                                }


                    $this->db->where('autoID',$autoID);
                    $this->db->delete('club_constitutions');
                    $affected=$this->db->affected_rows();
                        if($affected>0)
                            {
                                $this->load->helper("file");
                                unlink('club_uploads/club_constitutions/'.$filename);

                                    $feedback = array('error'=>"Failed to delete Constitution",'success' => "The Constitution has been deleted successfully",'files'=>$this->mainmodel-> getallconstitutions());

                                             $this->session->set_flashdata('msg',$feedback);
                                            redirect(base_url('index.php/Home/club_constitutions'));
                            }
                }
    }

public function delete_clubhistory($filename = NULL)
    {
        if(!($this->session->userdata('admin_login')))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else
                {
                    $autoID=$this->input->get('histID');
                    $hist_details=$this->model->getclubhistory($autoID);
                        $filename="";
                        foreach($hist_details as $file)
                                {
                                    $filename=$file->file_name;
                                }

                    $this->db->where('autoID',$autoID);
                    $this->db->delete('club_histories');
                    $affected=$this->db->affected_rows();
                        if($affected>0)
                            {
                                $this->load->helper("file");
                                unlink('club_uploads/club_histories/'.$filename);

                                    $feedback = array('error'=>"Failed to delete Club History",'success' => "The History has been deleted successfully",'files'=>$this->mainmodel-> getallclubhistories());

                                             $this->session->set_flashdata('msg',$feedback);
                                            redirect(base_url('index.php/Home/club_histories'));
                            }
                }
    }
public function officialroles()
    {
        if(!($this->session->userdata('clubhead_login')))
            {
                      $data = array('profile'=>$this->mainmodel->clubProfile());
                      $this->load->view('login',$data);
            }
            else
                {
                    $suID=$this->session->userdata('suID');
                    $list = $this->mainmodel->officialroles($suID);

                         $data=array();
                        foreach ($list->result() as $roles)
                            {
                                $roleDescription=$roles->roleName."  of ".$roles->clubName;
                                $data[$roles->clubID]=$roleDescription;
                            }
                        echo json_encode($data);
                }

}

}
