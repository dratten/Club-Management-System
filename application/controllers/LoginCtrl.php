<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name LoginCtrl.php
 * @Mokoro
 */

//controller to login users
class LoginCtrl extends CI_Controller
{

    //constructor to initialize variables and load tools
    function __construct()

    {
        parent::__construct();
        $this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
        $this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
        $this->output->set_header('Pragma: no-cache');

        $this->load->model("LoginModel", "login");
        $this->load->model("MainModel", "mainmodel");

    }

public function login()
    {
       //$db = mysqli_connect('localhost','dalzai','mykhailnava1','cms')
                //or die('Error connecting to MySQL server.');

        //$this->cas->force_auth();//calling CAS for authentication
        //$user = $this->cas->user();//calling the array with username from CAS and assignin it to the variable $user - @smokoro
        //lower case
        //$username = strtolower($user->userlogin);
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $result = $this->login->validate_ldap_official($username,$password);//clubofficial
        $result3 = $this->login->validate_ldap_stdcouncil($username,$password);//clubofficial//student council (student)
        //$result2 = $this->login->validate_ldap_admin($username);//admin*/
        $result2 = $this->login->validate_ldap_admin($username,$password);//admin
        
        /*$sql = "SELECT * FROM admin WHERE userName LIKE".$username.";";
        $sql = mysqli_query($db,$sql);
        while ($row = mysqli_fetch_array($sql)) 
                        {
                            $id = $row['staffID'];
                            $fname = $row['firstName'];
                            $sname = $row['secondName'];
                            $role = $row['roleID']
                            $pass = $row['password'];
                        }
            $fullName = $fname."&nbsp;".$sname;
            if($password == $pass)
            {
                 $sessdata=array();
                 if($roleID==1||$roleID==2)
                    {
                         $sessdata = array('adminName' =>$fullName,'adminID'=>$id,'admin_login'=>TRUE);
                        $this->session->set_userdata($sessdata);
                        echo "success";
                        $redirectLink="Home/admin";
                    }
            }
            redirect($redirectLink);*/
            
            if($result&&!$result3)
                {
                    //take the returned data and create a session for it.
                    foreach ($result as $row)
                            {
                                $fullName=$row->firstName." ".$row->lastName;
                                $studentID=$row->studentID;

                                $sessdata=array();
                                $sessdata = array('officialName' =>$fullName,'suID'=>$studentID,'clubhead_login'=>TRUE);
                                $this->session->set_userdata($sessdata);

                            }
                            redirect('index.php/ClubController/rolespage');
                }else if($result2)
                {
                    //take the returned data and create a session for it (adminName and adminID).
                    foreach ($result2 as $row)
                            {
                                $fullName=$row->firstName."&nbsp;".$row->lastName;
                                $userID=$row->staffID;
                                $roleID=$row->roleID;
                                $sessdata=array();

                                if($roleID==1||$roleID==2)
                                    {
                                       $sessdata = array('adminName' =>$fullName,'adminID'=>$userID,'admin_login'=>TRUE);
                                        $this->session->set_userdata($sessdata);
                                        //$this->load->view('admin/admin');
                                        $redirectLink="index.php/Home/admin";
                                   }

                            }
                            redirect($redirectLink);
                }else if($result3&&!$result)
                    {
                        //take the returned data and create a session for it (adminName and adminID) for clubs representative-student council.
                        foreach ($result3 as $row)
                                {
                                    $fullName=$row->firstName."&nbsp;".$row->lastName;
                                    $userID=$row->staffID;
                                    $roleID=$row->roleID;
                                    $sessdata=array();

                                           $sessdata = array('crepName' =>$fullName,'crepID'=>$userID,'crep_login'=>TRUE);
                                            $this->session->set_userdata($sessdata);

                                }
                                redirect('index.php/Home/crep');
                    }else if($result3 && $result)
                    {
                        //if the student council member has an active role in any club then prevent access. Not allowed to be clubs rep and club official.

                        $_SESSION['msg'] = array('error' => "Login failed",'success'=>'');

                            redirect('index.php/Home/crep');

                    }else
                        {
                          $_SESSION['msg'] = array('error' => "Wrong credentials. Please try again",'success'=>'');
                                // $this->cas->logout();
                                redirect(base_url('index.php/Home'));

                        }


       }
public function usertype()
    {

        $clubID= $this->input->post('clubid');
        $clubsess=$this->session->userdata('clubEmail');

        if($clubID=="")
                {
                    // $this->load->view('clubheads/roleselect');
                    redirect('ClubController/rolespage');
                }else if($clubID !=="") {
                            $this->session->set_userdata('clubEmail', $clubID);

                            $this->db->limit(1);
                            $this->db->select('*');
                            $this->db->from('clubs');
                            $this->db->where('clubID',$clubID);
                            $result=$this->db->get()->result();

                            $clubName="";
                            foreach ($result as $club)
                                    {
                                        $clubName=$club->clubName;
                                        $this->session->set_userdata('clubName', $clubName);

                                    }

                            redirect('index.php/ClubController/clubpage');

                            // $this->load->view('clubheads/clubmemberreg');
                        }

        if($clubsess!=="" && $clubID=="")
            {
                redirect('index.php/ClubController/rolespage');
            }

    }

public function logoutadmin()
    {
        $this->session->unset_userdata('fullName');
        $this->session->unset_userdata('admin_login');
        $this->session->unset_userdata('suID');

        $data = array('profile'=>$this->mainmodel->clubProfile());

        //$this->cas->logout($url = ''); // Log out of CAS @lkasera
        redirect('index.php/Home/index');
    }

public function logoutclub()
    {
        $this->session->unset_userdata('clubName');
        $this->session->unset_userdata('clubEmail');
        $this->session->unset_userdata('clubhead_login');
        $this->session->unset_userdata('officialName');
        // $data = array('profile'=>$this->mainmodel->clubProfile());
        // $this->load->view('login',$data);
        redirect('index.php/Home/index');
        //$this->cas->logout($url = ''); // Log out of CAS @lkasera
        //redirect(base_url(('Home')));
}
    
}
?>
