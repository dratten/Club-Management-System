<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name: MainModel model
 * @author: Mokoro
 */
class MainModel extends CI_Model
{
    //initialization
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

//===============================club registration===============================
 public function registerclub($clubinfo=NULL) 
        {
            if($this->db->insert('clubs',$clubinfo))
                {
                    $this->db->select('*');
                    $this->db->from('clubs');
                    return $this->db->get()->result();
                    
                }
                 else
                {
                    return false;
                }
        }

public function clubProfile()
{
    $this->db->select('*');
    $this->db->from('clubs');
    return $this->db->get()->result();
}

public function showevents()
{
    $this->db->select('*');
    $this->db->from('eventinfo');
    return $this->db->get()->result();
}
//===============================club deletion===============================

public function deleteclub($clubid=NULL)
 {
   
    $this->db->where('clubID',$clubid);
    $this->db->delete('clubs');
    $affected=$this->db->affected_rows();
        if($affected>0)
            {
                return true;

            }else
                 {
                    return false;
                 }
 }

public function deletemeeting($meetingid=NULL)
 {
   
    $this->db->where('autoID',$meetingid);
    $this->db->delete('meetinginfo');
    $affected=$this->db->affected_rows();
        if($affected>0)
            {
                return true;

            }else
                 {
                    return false;
                 }
 }

public function deactivateclub($clubid=NULL)
 {
   
    // $query="UPDATE clubs SET status='0' WHERE clubID='$clubid'";

    // if($this->db->query($query))
    // $this->db->update('clubs',array('status'=>'0'));
    // $affected=$this->db->affected_rows();
    //     if($affected>0)

  $this->db->limit(1);
    $this->db->set('status', 0); //value that used to update column  
    $this->db->where('clubID', $clubid); //which row want to upgrade  
    if($this->db->update('clubs'))
            {
                return true;

            }else
                 {
                    return false;
                 }
 }

public function activateclub($clubid=NULL)
 {
   
  

    // if($this->db->query("UPDATE clubs SET status='1' WHERE clubID='$clubid'"))
    //         {
    //             return true;

    //         }else
    //              {
    //                 return false;
    //              }
    $this->db->limit(1);
    $this->db->set('status', 1); //value that used to update column  
    $this->db->where('clubID', $clubid); //which row want to upgrade  
    if($this->db->update('clubs'))
            {
                return true;

            }else
                 {
                    return false;
                 }
 }
 
 public function deleteclubofficial($pid=NULL)
 {
   
    $this->db->where('studentID',$pid);
    $this->db->delete('clubofficials');
    $affected=$this->db->affected_rows();
        if($affected>0)
            {
                return true;

            }else
                 {
                    return false;
                 }
 }
public function disableclubofficial($pid=NULL,$changeStatus=NULL)
 {
    $this->db->where('studentID',$pid);
    $this->db->update('clubofficials',$changeStatus);
    $affected=$this->db->affected_rows();
        if($affected>0)
            {
                return true;

            }else
                 {
                    return false;
                 }
 }
public function updatememberstableonofficialdelete($pid=NULL,$updatememberstable=NULL)
 {
   
    $this->db->where('studentID',$pid);
    $this->db->update('clubmembers',$updatememberstable);
    $affected=$this->db->affected_rows();
        if($affected>0)
            {
                return true;

            }else
                 {
                    return false;
                 }
 }

//===============================list of clubs===============================

public function clubslist()
{

                $this->db->select('*');
                $this->db->from('clubs');
                $this->db->where('status',1);
                $this->db->order_by('clubName');
                return $this->db->get()->result_array();

}

public function inactiveclubslist()
{

                $this->db->select('*');
                $this->db->from('clubs');
                $this->db->where('status',0);
                $this->db->order_by('clubName');
                return $this->db->get()->result_array();

}

//===============================edit clubs info===============================

public function editclub($id)
            {

                $this->db->select('*');
                $this->db->from('clubs');
                $this->db->where('clubID',$id);
                $this->db->where('status',1);
                $this->db->order_by('clubName','asc');
                return $this->db->get()->result_array();
            }



//===============================updating club info===============================

public function updateclub($clubid, $clubinfo)
            {

                $this->db->where('clubID',$clubid);
                $query=$this->db->update('clubs',$clubinfo);
                $affected=$this->db->affected_rows();
                if($affected>0)
                    {
                        return true;

                    }else
                    {
                        return false;
                    }
            }

//===============================updating club official info===============================


public function updateclubofficial($cofficialinfo, $pid)
            {

                $this->db->where('pID',$pid);
                $this->db->where('status',1);
                $query=$this->db->update('officialsroles',$cofficialinfo);
                $affected=$this->db->affected_rows();
                if($affected>0)
                    {
                        return true;

                    }else
                    {
                        return false;
                    }
            }



//===============================list of club officials ===============================


public function clubofficialslist()
    {

            $this->db->select('cm.*,c.clubName,r.roleName');
            $this->db->from('clubs c,clubroles r,clubmembers cm,officialsroles or');
            $this->db->where('or.clubID=c.clubID ');
            $this->db->where('cm.pID=or.pID ');
            $this->db->where('or.status',1);
            $this->db->where('or.roleID=r.roleID ');
            $this->db->order_by('clubName','asc');

            return $this->db->get()->result_array();
            
    }
public function perclubclubofficialslist($clubID=NULL)
    {

            $this->db->select('cm.*,c.clubName,r.roleName');
            $this->db->from('officialsroles o,clubs c,clubroles r,clubmembers cm');
            $this->db->where('o.clubID',$clubID);
            $this->db->where('o.clubID=c.clubID ');
            $this->db->where('cm.pID=o.pID ');
            $this->db->where('o.status',1);
            $this->db->where('o.roleID=r.roleID ');
            $this->db->order_by('clubName','asc');

            return $this->db->get()->result_array();
            
    }
public function viewclubofficialslist($clubID)
    {
            $this->db->distinct();
            $this->db->select('cm.*,r.roleName,cs.courseID ');
            $this->db->from('officialsroles o,clubs c,clubroles r,clubmembers cm,courses cs');
            $this->db->where('o.clubID',$clubID);
            $this->db->where('o.clubID=cm.clubID');
            $this->db->where('cm.courseID=cs.courseID');
            $this->db->where('o.pID=cm.pID ');
            $this->db->where('o.status',1);//has not been marked as outgoing by dean
            $this->db->where('cm.status',1);//has not been marked as inactive in the club by clubhead
            $this->db->where('o.roleID=r.roleID ');
            $this->db->order_by('suID','asc');

            return $this->db->get()->result_array();
            
    }

public function viewallclubofficialslist()
    {
            $this->db->distinct();
            $this->db->select('cm.*,r.roleName,cs.courseID ');
            $this->db->from('officialsroles o,clubs c,clubroles r,clubmembers cm,courses cs');
            $this->db->where('o.clubID=cm.clubID');
            $this->db->where('cm.courseID=cs.courseID');
            $this->db->where('o.pID=cm.pID ');
            $this->db->where('o.status',1);//has not been marked as outgoing by dean
            $this->db->where('cm.status',1);//has not been marked as inactive in the club by clubhead
            $this->db->where('o.roleID=r.roleID ');
            $this->db->order_by('suID','asc');

            return $this->db->get()->result_array();
            
    }
public function getclubofficial($id)
    {
            $this->db->select('cm.*,or.*,r.roleName, c.clubName');
            $this->db->from('clubroles r, clubs c,clubmembers cm,officialsroles or');
            $this->db->where('or.pID=cm.pID');
            $this->db->where('or.pID',$id);
            $this->db->where('or.roleID=r.roleID');
            $this->db->where('or.clubID=c.clubID');
            return $this->db->get()->result_array();
    }




public function c_o_viewlist($id)
    {

            $this->db->select('o.*,c.clubName,r.roleName');
            $this->db->from('clubofficials o,clubs c,clubroles r');
            $this->db->where('o.pID',$id);
            $this->db->where('o.status',1);
            $this->db->where('o.clubID=c.clubID ');
            $this->db->where('o.roleID=r.roleID ');

            return $this->db->get()->result_array();
            
    }


public function adminlist()
    {

            $this->db->select('a.*,r.roleName');
            $this->db->from('admin a,adminroles r');
            $this->db->where('a.status',1);
            $this->db->where('a.roleID=r.roleID ');

            return $this->db->get()->result_array();
            
    }

public function viewadmin($adminid)
    {

            $this->db->select('a.*,r.roleName');
            $this->db->from('admin a,adminroles r');
            $this->db->where('a.status',1);
            $this->db->where('a.staffID',$adminid);
            $this->db->where('a.roleID=r.roleID ');

            return $this->db->get()->result_array();
            
    }
public function viewcrep($crepid)
    {

            $this->db->select('a.*,r.roleName');
            $this->db->from('admin a,adminroles r');
            $this->db->where('a.status',1);
            $this->db->where('a.staffID',$crepid);
            $this->db->where('a.roleID=r.roleID ');

            return $this->db->get()->result_array();
            
    }
public function viewclub($clubid)
{

                $this->db->select('*');
                $this->db->from('clubs');
                $this->db->where('status',1);
                $this->db->where('clubID',$clubid);
                $this->db->order_by('clubName');
                return $this->db->get()->result_array();

}




public function clubsdropdown()
{
    $this->db->select('*');
    $this->db->from('clubs');
    $this->db->order_by("clubName","asc");
    $result=$this->db->get();
    return $result;

}

public function clubofficialsdropdown()
{
    $clubID=$this->session->userdata('clubEmail');
    $this->db->select('or.*,cm.firstName,cm.lastName');
    $this->db->from('officialsroles or,clubmembers cm');
    $this->db->where('or.clubID=cm.clubID');
    $this->db->where('or.pID=cm.pID');
    $this->db->where('or.clubID',$clubID);
    // $this->db->order_by("pID","asc");
    $result=$this->db->get();
    return $result;

}
public  function officialsnominees($clubID=NULL)
{
    $this->db->select('*');
    $this->db->from('clubmembers');
    $this->db->where('clubID',$clubID);
    // $this->db->where('leadership!=',"1");
    $this->db->where('status',1);
    $this->db->where('deletionStatus',0);
    $this->db->where('nominated',1);
    // $this->db->order_by("pID","asc");
    $result=$this->db->get();
    return $result;

}


// public function officialsnominees($clubID=NULL);
// {
    // $this->db->select('*');
    // $this->db->from('clubmembers');
    // $this->db->where('clubID',$clubID);
    // $this->db->where('leadership!=',"1");
    // $this->db->where('status',1);
    // $this->db->where('deletionStatus',0);
    // $this->db->where('nominated',1);
    // // $this->db->order_by("pID","asc");
    // $result=$this->db->get();
    // return $result;

// }



public function c_rolesdropdown()
{
    $this->db->select('*');
    $this->db->from('clubroles');
    $this->db->order_by("roleName","asc");
    $result=$this->db->get();
    return $result;

}


public function clubofficiallogininfo($clubofficiallogininfo=NULL) 
        {
            if($this->db->insert('clubofficials',$clubofficiallogininfo))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }
public function addnewofficialrole($cofficialinfo=NULL) 
        {
            if($this->db->insert('officialsroles',$cofficialinfo))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }


public function updatememberstable($updatememberstable=NULL,$pid=NULL) 
        {
            $this->db->where('pID',$pid);
            $query=$this->db->update('clubmembers',$updatememberstable);
            $affected=$this->db->affected_rows();
             if($affected>0)
                    {
                        return true;

                    }else
                        {
                            return false;
                        }
        }



// public function clubofficialslist()
//     {

//             $this->db->select('o.*,c.clubName,r.roleName');
//             $this->db->from('clubofficials o,clubs c,clubroles r');
//             $this->db->where('o.clubID=c.clubID ');
//             $this->db->where('o.status',1);
//             $this->db->where('o.roleID=r.roleID ');
//             $this->db->order_by('clubName','asc');

//             return $this->db->get()->result_array();
            
//     }




public function registeradmin($admininfo=NULL)
    {
        if($this->db->insert('admin',$admininfo))
                {
                    return true;
                    
                }
                 else
                    {
                        return false;
                    }
    }

public function updateadmin($admininfo=NULL,$staffid=NULL)
    {
        $this->db->where('staffID',$staffid);
        $query=$this->db->update('admin',$admininfo);
        $affected=$this->db->affected_rows();
             if($affected>0)
                    {
                        return true;

                    }else
                        {
                            return false;
                        }
    }
public function editadmin($id=NULL)
    {
            $this->db->select('adm.*,r.roleName');
            $this->db->from('admin adm,adminroles r');
            $this->db->where('adm.roleID=r.roleID');
            $this->db->where('adm.staffID',$id);
            return $this->db->get()->result_array();
    }
public function disableadmin($id,$changeStatus)
    {
        $this->db->where('staffID',$id);
        $query=$this->db->update('admin',$changeStatus);
        $affected=$this->db->affected_rows();
             if($affected>0)
                    {
                        return true;

                    }else
                        {
                            return false;
                        }
    }

public function admrolesdropdown()
{
    $this->db->select('*');
    $this->db->from('adminroles');
    $this->db->order_by("roleName","asc");
    $result=$this->db->get();
    return $result;

}

public function deleteadmin($adminid=NULL)
 {
   
    $this->db->where('staffID',$adminid);
    $this->db->delete('admin');
    $affected=$this->db->affected_rows();
        if($affected>0)
            {
                return true;

            }else
                 {
                    return false;
                 }
 }

//===============================list of club members list ===============================


    public function clubmemberslist($clubID)
        {
            $this->db->select('cm.*,co.courseName,c.clubName');
            $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
            $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.clubID',$clubID);
            $this->db->where('cm.status',1);
            $this->db->where('cm.deletionStatus',0);
            return $this->db->get()->result_array();
                
        }
public function getallconstitutions()
    {
        $this->db->select('cs.*,clubs.clubName');
        $this->db->from('club_constitutions cs, clubs clubs');
        $this->db->where('cs.clubID=clubs.clubID');
        return $this->db->get()->result();
    }

public function getallclubhistories()
    {
        $this->db->select('ch.*,clubs.clubName');
        $this->db->from('club_histories ch, clubs clubs');
        $this->db->where('ch.clubID=clubs.clubID');
        return $this->db->get()->result();
    }


public function officialroles($suID)
    {
        $this->db->select('or.*,clubs.clubName,cr.roleName');
        $this->db->from('officialsroles or, clubs clubs, clubroles cr');
        $this->db->where('or.clubID=clubs.clubID');
        $this->db->where('or.roleID=cr.roleID');
        $this->db->where('or.studentID',$suID);
        $result=$this->db->get();
        return $result;
    }




//close db connection
function __destruct() 
        {
            $this->db->close();
        }


            





}

?>


