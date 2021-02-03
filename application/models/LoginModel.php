<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name: LoginModel model
 * @author: Mokoro
 */
class LoginModel extends CI_Model
{
    private $ldap_config="";
    //initialization
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->ldap_config=$this->config->item('ldap_config');
    }

//============================user authentication================================

public  function ldapAuthenticate($ldapserver, $ldapport, $username, $password){
            $loggedin = false;
            //$server = "ldap://".$ldapserver;
           // $ldapconn = ldap_connect($server, $ldapport);

            if(intval($username)){
                $user = "STUDENTS\\".$username;
            }else{
                $user = "STRATHMORE\\".$username;
            }

            if ($ldapconn) {
                $ldapbind = @ldap_bind($ldapconn, $user , $password);
                if ($ldapbind) {
                    $loggedin = true;
                } else {
                    $loggedin = false;
                }
            }

            return $loggedin;

        }


public function validate_ldap_official($username,$password)
        {

                        $this->db->select('cm.firstName,cm.lastName,r.roleName,co.studentID');
                        $this->db->from('clubs c, clubofficials co,clubmembers cm,clubroles r');
                        $this->db->where('co.studentID=cm.suID');
                        $this->db->where('co.studentID', $username);
                        $this->db->where('co.password', $password);
                        $this->db->limit(1);
                        $query = $this->db->get();

                         if ($query->num_rows() >0)
                            {
                               return $query->result();

                            } else
                                    {
                                        return false;
                                    }



        }

public function validate_ldap_stdcouncil($username,$password)
        {

                       $this->db->select('*');
                        $this->db->from('admin');
                        $this->db->where('staffID', $username);
                        $this->db->where('password', $password);
                        $this->db->where('status', 1);
                        $this->db->limit(1);
                        $query = $this->db->get();
                         if ($query->num_rows() == 1)
                            {
                                return $query->result();

                            } else
                                    {
                                        return false;
                                    }


        }


public function validate_ldap_admin($username,$password)
        {

                        $this->db->select('*');
                        $this->db->from('admin');
                        $this->db->where('userName', $username);
                        $this->db->where('password', $password);
                        $this->db->where('status', 1);
                        $this->db->limit(1);
                        $query = $this->db->get();
                         if ($query->num_rows() == 1)
                            {
                                return $query->result();

                            } else
                                    {
                                        return false;
                                    }


        }

public function officialpwdchange($password,$suid)//change club password
    {
        $this->db->where('studentID',$suid);
        $query=$this->db->update('clubofficials',$password);
        $affected=$this->db->affected_rows();
             if($affected>0)
                    {
                        return true;

                    }else
                        {
                            return false;
                        }
    }

public function update_password($password,$adminID)//change admin password
    {
        $this->db->where('staffID',$adminID);
        $query=$this->db->update('admin',$password);
        $affected=$this->db->affected_rows();
             if($affected>0)
                    {
                        return true;

                    }else
                        {
                            return false;
                        }
    }



}
