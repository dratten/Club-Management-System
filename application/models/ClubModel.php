<?php

//the Club Model Contains most of the functionalities of the Club Heads Section.

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @name: ClubModel model
 * @author: Stephen Mokoro: 78581
 */
class ClubModel extends CI_Model
{
    //initialization
    function __construct()
	    {
	        parent::__construct();
	        $this->load->database();
	    }

//===============================list of club members list ===============================
public function clubmemberslist($clubID=NULL)
	    {
	        $this->db->select('cm.*,co.courseName,c.clubName');
	        $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
	        $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.clubID',$clubID);
            $this->db->where('cm.status',1);
            $this->db->where('cm.membership',1);
	        $this->db->where('cm.deletionStatus',0);

            $this->db->order_by('firstName');

			return $this->db->get()->result_array();

	    }
public function nonclubmemberslist($clubID=NULL)//those who attend events but are not registered club members
        {
            $this->db->select('cm.*,co.courseName,c.clubName');
            $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
            $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.clubID',$clubID);
            $this->db->where('cm.status',0);
            $this->db->where('cm.membership',0);
            $this->db->where('cm.joinRequest',1);

            $this->db->order_by('firstName');

            return $this->db->get()->result_array();

        }
public function joinrequestslist($clubID=NULL)
        {
            $this->db->select('cm.*,co.courseName,c.clubName');
            $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
            $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.clubID',$clubID);
            $this->db->where('cm.joinRequest',1);
            $this->db->where('cm.status',0);
            $this->db->where('cm.membership',0);
            $this->db->where('cm.deletionStatus',0);

            $this->db->order_by('firstName');

            return $this->db->get()->result_array();

        }
public function viewclubmember($pid=NULL)
        {
            $this->db->select('cm.*,co.courseName,c.clubName');
            $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
            $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.pID',$pid);
            $this->db->where('cm.deletionStatus',0);

            $this->db->order_by('firstName');

            return $this->db->get()->result_array();

        }

    public function legibleclubmemberslist($clubID)
        {
            $this->db->select('cm.*,co.courseName,c.clubName');
            $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
            $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.clubID',$clubID);
            $this->db->where('cm.status',1);
            $this->db->where('cm.membership',1);
            $this->db->where('cm.deletionStatus',0);
            $this->db->where('cm.nominated',0);
            $this->db->where('cm.leadership',0);


            $this->db->order_by('firstName');

            return $this->db->get()->result_array();

        }
public function officialnomination($studentPID,$studentInfo)
{
    $clubID=$this->session->userdata('clubEmail');

    $this->db->where('clubID',$clubID);
    $this->db->where('pID',$studentPID);
    $query=$this->db->update('clubmembers',$studentInfo);
    $affected=$this->db->affected_rows();
             if($affected>0)
                    {
                        return true;

                    }else
                        {
                            return false;
                        }
}
public function officialunnomination($studentPID,$studentInfo)
{
    $clubID=$this->session->userdata('clubEmail');

    $this->db->where('clubID',$clubID);
    $this->db->where('pID',$studentPID);
    $query=$this->db->update('clubmembers',$studentInfo);
    $affected=$this->db->affected_rows();
             if($affected>0)
                    {
                        return true;

                    }else
                        {
                            return false;
                        }
}

public function nominatedclubmemberslist($clubID)
        {
            $this->db->select('cm.*,co.courseName,c.clubName');
            $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
            $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.clubID',$clubID);
            $this->db->where('cm.status',1);
            $this->db->where('cm.membership',1);
            $this->db->where('cm.deletionStatus',0);
            $this->db->where('cm.nominated',1);

            $this->db->order_by('firstName');

            return $this->db->get()->result_array();

        }
    public function registeredclubmemberslist($clubID)
        {
            $this->db->select('cm.*,co.courseID,c.clubName');
            $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
            $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.clubID',$clubID);
            $this->db->where('cm.status',1);
            $this->db->where('cm.membership',1);
            $this->db->where('cm.payment',1);
            $this->db->where('cm.deletionStatus',0);
            $this->db->order_by('cm.firstName');

            return $this->db->get()->result_array();

        }
public function allclubmemberslist()
        {
            $this->db->select('cm.*,co.courseID,c.clubName');
            $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
            $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.membership',1);
            $this->db->where('cm.status',1);
            $this->db->where('cm.deletionStatus',0);
            $this->db->order_by('c.clubName');
            return $this->db->get()->result_array();

        }
public function allclubmemberslistnoduplicates()
        {
            $this->db->select('cm.*,co.courseID,c.clubName');
            $this->db->from('clubmembers cm,courses co,clubs c');
            $this->db->where('cm.courseID=co.courseID ');
            $this->db->where('cm.clubID=c.clubID ');
            $this->db->where('cm.membership',1);
            $this->db->where('cm.status',1);
            $this->db->where('cm.deletionStatus',0);
            $this->db->group_by('cm.suID');//prevents a member who is in more than two clubs from
            $this->db->order_by('c.clubName');
            return $this->db->get()->result_array();

        }
public function coursedropdown()
{
    $this->db->select('courseID');
    $this->db->from('courses');
    $result=$this->db->get();
    return $result;

}



public function editclubmember($id=NULL)
    {
            $this->db->select('*');
            $this->db->from('clubmembers ');
            $this->db->where('pID', $id);
            return $this->db->get()->result_array();
    }


public function updateclubmember($clubmemberinfo, $pid)
	{
		$this->db->where('pID',$pid);
        $query=$this->db->update('clubmembers',$clubmemberinfo);

        $affected=$this->db->affected_rows();

            if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
	}
public function updatenonclubmember($nonclubmemberinfo, $pid)
    {
        $this->db->where('pID',$pid);
        $query=$this->db->update('clubmembers',$nonclubmemberinfo);

        $affected=$this->db->affected_rows();

            if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
    }

// $this->dbforge->add_key('key_id', TRUE);
// $this->dbforge->add_key('user_id', TRUE);


public function registerclubmember($clubmemberinfo=NULL)
        {
            if($this->db->insert('clubmembers',$clubmemberinfo))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }

public function registernonclubmember($nonclubmemberinfo=NULL)
        {
            if($this->db->insert('clubmembers',$nonclubmemberinfo))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }

public function viewmemberlist($pid,$clubid)
    {

            $this->db->select('cm.*,c.courseName');
            $this->db->from('clubmembers cm,courses c');
            $this->db->where('cm.pID',$pid);
            $this->db->where('cm.clubID',$clubid);
            $this->db->where('cm.courseID=c.courseID ');

            return $this->db->get()->result_array();

    }

public function deleteclubmember($pid,$updates)
 {
        $this->db->where('pID',$pid);
        $query=$this->db->update('clubmembers',$updates);

        $affected=$this->db->affected_rows();

            if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
 }

 public function approverequest($pid,$updates)
 {
        $this->db->where('pID',$pid);
        $query=$this->db->update('clubmembers',$updates);

        $affected=$this->db->affected_rows();

            if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
 }

public function deletenonclubmember($pid=NULL)
 {

    $this->db->where('pID',$pid);
    $this->db->delete('clubmembers');
    $affected=$this->db->affected_rows();
        if($affected>0)
            {
                return true;

            }else
                 {
                    return false;
                 }
 }

 public function undeleteclubmember($suid,$clubid,$updates)
 {
        $this->db->where('suID',$suid);
        $this->db->where('clubID',$clubid);
        $query=$this->db->update('clubmembers',$updates);

        $affected=$this->db->affected_rows();

            if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
 }

public function checkmeetingexists($clubid=NULL,$meetingdate=NULL,$meetingvenue=NULL,$start=NULL,$end=NULL)
    {
        $this->db->select('*');
        $this->db->where('clubID',$clubid);
        $this->db->where('meetingVenue',$meetingvenue);
        $this->db->where('meetingDate',$meetingdate);
        $this->db->where('startTime',$start);
        $this->db->where('endTime',$end);
        $this->db->from('meetinginfo');
        $query=$this->db->get();
        if ($query->num_rows() >0)
                    {
                        return true;

                    } else
                        {
                            return false;
                        }
    }
public function meetinginfosave($meetinginfo=NULL)
        {
            if($this->db->insert('meetinginfo',$meetinginfo))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }

public function meetingupdate($meetinginfo,$meetingpid)
    {
        $this->db->where('autoID',$meetingpid);
        $query=$this->db->update('meetinginfo',$meetinginfo);
        $affected=$this->db->affected_rows();

            if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
    }
public function getmeetinginfo($pid=NULL)
    {
            $this->db->select('minfo.*,cm.firstName,cm.lastName');
            $this->db->from('meetinginfo minfo, clubmembers cm');
            $this->db->where('minfo.autoID', $pid);
            $this->db->where('minfo.takingMinutes=cm.pID');
            return $this->db->get()->result_array();
    }

public function deletemeeting($meetingID=NULL,$deleted=NULL)
    {
        $this->db->where('autoID',$meetingID);
        $query=$this->db->update('meetinginfo',$deleted);

        $affected=$this->db->affected_rows();

            if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
    }
public function meetingattendanceinfosave($attendanceinfo=NULL)
        {
            if($this->db->insert('meetingattendance',$attendanceinfo))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }



public function eventattendanceinfosave($attendanceinfo=NULL)
        {
            if($this->db->insert('eventattendance',$attendanceinfo))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }



public function meetingslist($clubID)
        {
            if($clubID==="All")
                {
                    // $this->db->distinct();
                    $this->db->select('meeting.*,cm.firstName,cm.lastName,c.clubName');
                    $this->db->from('clubmembers cm,meetinginfo meeting,clubs c');
                    $this->db->where('cm.pID=meeting.takingMinutes');
                    $this->db->where('c.clubID=meeting.clubID');
                    $this->db->where('meeting.deleted=0');
                    return $this->db->get()->result_array();
                }else
                    {
                        // $this->db->distinct();
                        $this->db->select('meeting.*,cm.firstName,cm.lastName,c.clubName');
                        $this->db->from('clubmembers cm,meetinginfo meeting,clubs c');
                        $this->db->where('cm.pID=meeting.takingMinutes');
                        $this->db->where('c.clubID=meeting.clubID');
                        $this->db->where('meeting.clubID',$clubID);
                        $this->db->where('meeting.deleted=0');
                        return $this->db->get()->result_array();
                    }


        }

public function nullattendancemeetingsdropdown($clubID=NULL)
    {

        $this->db->select('matt.meetingID');
        $this->db->from('meetingattendance matt, meetinginfo minfo');
        $this->db->where('matt.meetingID=minfo.autoID');
        $result=$this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->from('meetinginfo');
        $this->db->where("`autoID` NOT IN ($result)", NULL, FALSE);
        $this->db->where('clubID',$clubID);
        $this->db->where('deleted',0);

        $result=$this->db->get();
        return $result;
    }


public function withattendancemeetingsdropdown($clubID=NULL)
    {

        $this->db->select('matt.meetingID');
        $this->db->from('meetingattendance matt, meetinginfo minfo');
        $this->db->where('matt.meetingID=minfo.autoID');
        $result=$this->db->get_compiled_select();

        $this->db->select('*');
        $this->db->from('meetinginfo');
        $this->db->where("`autoID` IN ($result)", NULL, FALSE);
        $this->db->where('clubID',$clubID);
        $this->db->where('deleted',0);

        $result=$this->db->get();
        return $result;
    }

public function meetingswithoutminutesdropdown($clubID=NULL)
    {
        $this->db->select('*');
        $this->db->from('meetinginfo');
        $this->db->where('autoID NOT IN (select meetingID from club_minutes)',NULL,FALSE);
        $this->db->where('deleted',0);
        $this->db->where('clubID',$clubID);

        $result=$this->db->get();
        return $result;
    }

public function meetingswithminutesdropdown($clubID=NULL)
    {

        $this->db->select(' min.*,minfo.*');
        $this->db->from(' meetinginfo minfo, minutes min');
        $this->db->where('minfo.autoID=min.meetingID');
        $this->db->where('minfo.clubID',$clubID);
        $this->db->where('min.deleted',0);
        $this->db->where('minfo.deleted',0);
        $result=$this->db->get();
        return $result;
    }



public function meetingsdropdown($clubID=NULL)
    {

        $this->db->select('*');
        $this->db->from('meetinginfo');
        $this->db->where('clubID',$clubID);
        $this->db->where('deleted',0);

        $result=$this->db->get();
        return $result;
    }
 public function perclubminutes($clubID=NULL)
    {
        $this->db->select('min.*,meeting.*');
        $this->db->from('club_minutes min,meetinginfo meeting');
        $this->db->where('min.clubID',$clubID);
        $this->db->where('min.meetingID=meeting.autoID');

        return $this->db->get()->result_array();

    }

    public function perclubuploads($clubID=NULL)
       {
           $this->db->select('upload.*');
           $this->db->from('club_uploads upload');
           $this->db->where('upload.clubID',$clubID);


           return $this->db->get()->result_array();

       }
public function meetingattendancelist($meetingID)
        {
            $this->db->select('matt.*,cm.firstName,cm.lastName');
            $this->db->from('meetingattendance matt, clubmembers cm');

            $this->db->where('matt.meetingID',$meetingID);

            $this->db->where('cm.status',1);
            $this->db->where('cm.deletionStatus',0);

            $this->db->where('cm.clubID=matt.clubID');
            $this->db->where('cm.pID=matt.pID');


            return $this->db->get()->result_array();

        }
public function eventattendancelist($eventID)
        {
            $this->db->select('eventatt.*,cm.firstName,cm.lastName');
            $this->db->from('eventattendance eventatt, clubmembers cm');

            $this->db->where('eventatt.eventID',$eventID);

            $this->db->where('cm.deletionStatus',0);

            $this->db->where('cm.clubID=eventatt.clubID');
            $this->db->where('cm.pID=eventatt.pID');


            return $this->db->get()->result_array();

        }
public function eventsdropdown($clubID)
    {
       $this->db->select('*');
        $this->db->from('eventinfo');
        $this->db->where('clubID',$clubID);
        $this->db->where("`autoID` NOT IN (SELECT eventID FROM eventattendance where inattendance=0)", NULL, FALSE);
        $this->db->where('deleted',0);
        $result=$this->db->get();
        return $result;
    }
public function eventsinattendancedropdown($clubID)
    {
       $this->db->select('*');
        $this->db->from('eventinfo');
        $this->db->where('clubID',$clubID);
        $this->db->where("`autoID` NOT IN (SELECT eventID FROM eventattendance where inattendance=1)", NULL, FALSE);
        $this->db->where('deleted',0);
        $result=$this->db->get();
        return $result;
    }
public function eventswithoutreport($clubID)
    {
       $this->db->select('*');
        $this->db->from('eventinfo');
        $this->db->where('clubID',$clubID);
        $this->db->where("`autoID` NOT IN (SELECT eventID FROM event_reports)", NULL, FALSE);
        $this->db->where('deleted',0);
        $result=$this->db->get();
        return $result;
    }
public function geteventinfo($pid=NULL)
    {
            $this->db->select('*');
            $this->db->from('eventinfo');
            $this->db->where('autoID', $pid);
            return $this->db->get()->result_array();
    }

public function meeting($meetingID=NULL)
{

        $this->db->select('*');
        $this->db->from('meetinginfo');
        $this->db->where('autoID',$meetingID);
        $result=$this->db->get();
        return $result;

}



public function getclubminutes($clubID=NULL)
    {
        $this->db->select('min.*,meeting.*');
        $this->db->from('club_minutes min,meetinginfo meeting');
        $this->db->where('min.clubID',$clubID);
        $this->db->where('min.meetingID=meeting.autoID');
        return $this->db->get()->result();
    }


public function checkeventexists($clubid=NULL,$eventdate=NULL,$eventvenue=NULL,$start=NULL,$end=NULL)
    {
        $this->db->select('*');
        $this->db->where('clubID',$clubid);
        $this->db->where('eventVenue',$eventvenue);
        $this->db->where('eventDate',$eventdate);
        $this->db->where('startTime',$start);
        $this->db->where('endTime',$end);
        $this->db->from('eventinfo');
        $query=$this->db->get();
        if ($query->num_rows() >0)
                    {
                        return true;

                    } else
                        {
                            return false;
                        }
    }
public function getalleventreports($clubID=NULL)
    {
        $this->db->select('er.*,event.*');
        $this->db->from('event_reports er,eventinfo event');
        $this->db->where('er.eventID=event.autoID');

        return $this->db->get()->result();
    }
public function geteventreports($clubID=NULL)
    {
        $this->db->select('er.*,event.*');
        $this->db->from('event_reports er,eventinfo event');
        $this->db->where('er.clubID',$clubID);
        $this->db->where('er.eventID=event.autoID');
        return $this->db->get()->result();

    }
public function perclubeventreports($clubID=NULL)
    {
        $this->db->select('er.*,event.*');
        $this->db->from('event_reports er,eventinfo event');
        $this->db->where('er.clubID',$clubID);
        $this->db->where('er.eventID=event.autoID');

        return $this->db->get()->result_array();

    }
public function eventslist($clubID)
        {
            if($clubID==="All")
            {
                $this->db->distinct();
                $this->db->select('e.*,c.clubName');
                $this->db->from('eventinfo e,clubs c');
                $this->db->where('e.clubID=c.clubID');
                $this->db->where('e.deleted',0);
                return $this->db->get()->result_array();
            }else
                {
                    $this->db->distinct();
                    $this->db->select('*');
                    $this->db->from('eventinfo');
                    $this->db->where('clubID',$clubID);
                    $this->db->where('deleted',0);
                    return $this->db->get()->result_array();
                }



        }
public function event($eventid=NULL)
{
        $this->db->select('*');
        $this->db->from('eventinfo');
        $this->db->where('autoID',$eventid);
        $result=$this->db->get();
        return $result;
}


public function newreport($contents=NULL)
        {
            if($this->db->insert('eventreport',$contents))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }


public function eventinfosave($eventinfo=NULL)
        {
            if($this->db->insert('eventinfo',$eventinfo))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }
public function eventinfoupdate($eventinfo,$eventpid)
    {
        $this->db->where('autoID',$eventpid);
        $query=$this->db->update('eventinfo',$eventinfo);
        $affected=$this->db->affected_rows();

            if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
    }
public function deleteevent($eventID=NULL,$deleted=NULL)
    {
        $this->db->where('autoID',$eventID);
        $query=$this->db->update('eventinfo',$deleted);

        $affected=$this->db->affected_rows();

            if($affected>0)
                {
                    return true;

                }else
                    {
                        return false;
                    }
    }
public function insertconstinfo($file_info=NULL)
    {
        if($this->db->insert('club_constitutions',$file_info))
                {
                    return true;
                }
            else
                {
                    return false;
                }
    }
public function getconstitutions($clubID=NULL)
    {
        $this->db->select('*');
        $this->db->from('club_constitutions');
        $this->db->where('clubID',$clubID);
        return $this->db->get()->result();
    }

public function getuploads($clubID)
    {
        $this->db->select('*');
        $this->db->from('club_uploads');
        $this->db->where('clubID',$clubID);
        return $this->db->get()->result();
    }


public function getconstitution($autoID=NULL)
    {
        $this->db->select('*');
        $this->db->from('club_constitutions');
        $this->db->where('autoID',$autoID);
        return $this->db->get()->result();
    }
public function getclubhistories($clubID=NULL)
    {
        $this->db->select('*');
        $this->db->from('club_histories');
        $this->db->where('clubID',$clubID);
        return $this->db->get()->result();
    }

public function getclubhistory($autoID=NULL)
    {
        $this->db->select('*');
        $this->db->from('club_histories');
        $this->db->where('autoID',$autoID);
        return $this->db->get()->result();
    }
public function addclubexpenditure($expenseinfo=NULL)
        {
            if($this->db->insert('club_expenditures',$expenseinfo))
                {
                    return true;
                }
            else
                {
                    return false;
                }
        }
public function checkexpenseexists($clubid=NULL,$datespent=NULL,$unitname=NULL,$unitscount=NULL,$description=NULL)
    {
        $this->db->select('*');
        $this->db->where('clubID',$clubid);
        $this->db->where('dateSpent',$datespent);
        $this->db->where('unitName',$unitname);
        $this->db->where('unitsCount',$unitscount);
        $this->db->where('description',$description);
        $this->db->from('club_expenditures');
        $query=$this->db->get();
        if ($query->num_rows() >0)
                    {
                        return true;

                    } else
                        {
                            return false;
                        }
    }

public function expenditureslist($clubID=NULL)
        {
            if($clubID==="All")
                {
                    // $this->db->distinct();
                    $this->db->select('clubexp.*,cm.firstName,cm.lastName,c.clubName');
                    $this->db->from('clubmembers cm,club_expenditures clubexp,clubs c');
                    $this->db->where('cm.pID=clubexp.studentPID');
                    $this->db->where('c.clubID=clubexp.clubID');
                    $this->db->where('clubexp.deleted=0');
                    return $this->db->get()->result_array();
                }else
                    {
                        // $this->db->distinct();
                        $this->db->select('clubexp.*,cm.firstName,cm.lastName,c.clubName');
                        $this->db->from('clubmembers cm,club_expenditures clubexp,clubs c');
                        $this->db->where('cm.pID=clubexp.studentPID');
                        $this->db->where('clubexp.clubID=c.clubID');
                        $this->db->where('clubexp.clubID',$clubID);
                        $this->db->where('clubexp.deleted=0');
                        return $this->db->get()->result_array();
                    }

        }

public function getexpenditure($pid=NULL)
    {
            $this->db->select('clubexp.*,cm.firstName,cm.lastName,c.clubName');
            $this->db->from('clubmembers cm,club_expenditures clubexp,clubs c');
            $this->db->where('cm.pID=clubexp.studentPID');
            $this->db->where('clubexp.clubID=c.clubID');
            $this->db->where('clubexp.autoID',$pid);
            $this->db->where('clubexp.deleted=0');
            return $this->db->get()->result_array();
    }

public function clubexpenditureupdate($expenseupdateinfo, $pid)
    {
        $this->db->where('autoID',$pid);
        $query=$this->db->update('club_expenditures',$expenseupdateinfo);

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
