

   $(document).ready(function () 

   {
    
            $("#clubofficialslist").dataTable().fnDestroy();//destroy the table and recreate it for every refresh


                    var table=$('#clubofficialslist').DataTable({

                    //ajax script to retrieve data club officials from db
                    "ajax": {
                    "url":"<?php echo base_url('home/clubofficialslist'); ?>",
                    "type":"POST",
                    "dataType":"json"},
                    "columns": [
                    { "data": "count",responsivePriority: 1 },//define column widths
                    { "data": "suID" ,responsivePriority: 4},
                    { "data": "fullName",responsivePriority: 2 },
                    { "data": "telNo" },
                    { "data": "clubName" },
                    { "data": "roleName" ,responsivePriority: 3},
                    { "data": "action" }],


                    //aoColumnDefs This array allows you to target a specific column, multiple columns, or all columns, using the aTargets property of each object in the array
                    "aoColumnDefs": [
                    {"bSortable":false, "aTargets": [0], "orderable": false},
                      {"aTargets": [6],//the target column ie 7th column
                      "orderable": false,
                      "mData": "action",

                      "mRender": function ( data, type, full ) 
                      {
                        
                        return ' <span data-placement="top" data-toggle="tooltip" title="Delete this official?"><button class="btn btn-danger btn-xs" data-title="Delete"   id="delete" onclick="deleteclubofficial(this);" value="'+data+'"><span class="glyphicon glyphicon-trash" ></span></button></span> &nbsp;                                                                                                           <span data-placement="top" data-toggle="tooltip" title="Edit this official?"><button class="btn btn-primary btn-xs" data-title="Edit" onclick="editcofficial(this);" id="edit" value="'+data+'"><span class="glyphicon glyphicon-pencil"></span></button></span>&nbsp;                                                                                                                                                                                                                        <span data-placement="top" data-toggle="tooltip" title="View Profile"><button class="btn btn-xs" data-title="View Profile" onclick="c_o_view(this);" id="View" value="'+data+'"><span class="glyphicon glyphicon-eye-open"></span></button></span>&nbsp;                                                                                                                                                                                                                                            <span data-placement="top" data-toggle="tooltip" title="Disable"><a  class="btn  btn-xs" data-title="Deactivate" data-toggle="modal" onclick="deactivate(this);" value="'+data+'"><span class="fa fa-user-times"></span></a></span>';

                      }

                        
                    },
                       
                    ],
                    order:[[ 1, 'asc' ]]//order first column:ascending

                });


              //prevent first column (counter) from being re-ordered when other fields are sorted
              table.on( 'order.dt search.dt', function () 
                 {
                    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) 
                    {
                        cell.innerHTML = i+1;
                    } );
                } ).draw();

                
                table.ajax.reload( null, false ); // reload the datatable 
             

             
  
    });




//=======================================================================================

$(function(){
    $( "#submit").one('click', function(event)
        {
        
            event.preventDefault();//prevent auto submit data
            
            //assign input values to variables for posting
           var suid= $("#addclubofficial #clubofficialreg input[name=suid]").val();
           var lastname= $("#addclubofficial #clubofficialreg input[name=lastname]").val();
           var firstname= $("#addclubofficial #clubofficialreg input[name=firstname]").val();
           var gender= $("#addclubofficial #clubofficialreg input[name=gender]:checked").val();
           var phone= $("#addclubofficial #clubofficialreg input[name=phone]").val();
           var suemail= $("#addclubofficial #clubofficialreg input[name=suemail]").val();
           var club= $("#addclubofficial #clubofficialreg #club").val();
           var role= $("#addclubofficial #clubofficialreg #role").val();
           var startdate= $("#addclubofficial #clubofficialreg input[name=startdate]").val();
           var enddate= $("#addclubofficial #clubofficialreg input[name=enddate]").val();

            
            var table=$('#clubofficialslist').DataTable();//define the datatable for refresh on registering


            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('home/clubofficialregistration')?>",
                    data:{ suid:suid,lastname:lastname,firstname:firstname,gender:gender,phone:phone,suemail:suemail,club:club,role:role,startdate:startdate,enddate:enddate},
                    dataType:'json',

                    success:function(data)
                    {
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#addclubofficial #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#addclubofficial #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubofficial #success").slideUp(500);
                                });

                            // //then toggle the input modal form.
                            //  $("#addclubofficial ").fadeTo(2000, 500).slideUp(500, function(){
                            //     $("#addclubofficial ").modal('toggle');
                            //     });

                        //the rest applies as above

                        }else if (data.fail)
                        {
                            $('#addclubofficial #fail').show();
                            $("#addclubofficial #fail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubofficial #fail").slideUp(500);
                                });
                            // $("#addclubofficial ").fadeTo(2000, 500).slideUp(500, function(){
                            //     $("#addclubofficial ").modal('toggle');
                            //     });
                        }else if (data.null)
                        {
                            $('#addclubofficial #null').show();
                            $("#addclubofficial #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#addclubofficial #null").slideUp(500);
                                });
                            // $("#addclubofficial ").fadeTo(2000, 200).slideUp(500, function(){
                            //     $("#addclubofficial ").modal('toggle');
                            //     });
                        }

                        
                        table.ajax.reload( null, false ); // reload the datatable on registration


                    }
                });
             
        });

    });



$(function(){
    $( "#update").one('click', function(event)
        {
        
            event.preventDefault();//prevent auto submit data


            
            //assign input values to variables for posting
           var suid= $("#editclubofficial #editclubofficialreg input[name=suid]").val();
           var lastname= $("#editclubofficial #editclubofficialreg input[name=lastname]").val();
           var firstname= $("#editclubofficial #editclubofficialreg input[name=firstname]").val();
           var gender= $("#editclubofficial #editclubofficialreg input[name=gender]:checked").val();
           var phone= $("#editclubofficial #editclubofficialreg input[name=phone]").val();
           var suemail= $("#editclubofficial #editclubofficialreg input[name=suemail]").val();
           var club= $("#editclubofficial #editclubofficialreg #club").val();
           var role= $("#editclubofficial #editclubofficialreg #role").val();
           var startdate= $("#editclubofficial #editclubofficialreg input[name=startdate]").val();
           var enddate= $("#editclubofficial #editclubofficialreg input[name=enddate]").val();
           var pid= $("#editclubofficial #editclubofficialreg input[name=pid]").val();

            
            var table=$('#clubofficialslist').DataTable();//define the datatable for refreshing


            $.ajax(//ajax script to post the data without page refresh
                {
                    type:"post",
                    url: "<?php echo base_url('home/clubofficialupdating')?>",
                    data:{pid:pid, suid:suid,lastname:lastname,firstname:firstname,gender:gender,phone:phone,suemail:suemail,club:club,role:role,startdate:startdate,enddate:enddate},
                    dataType:'json',

                    success:function(data)
                    {
                        //get json encoded feedback upon submission and respond appropriately
                       if (data.successful)
                        {
                            //if success is returned upon submission, show the success notification
                            $('#editclubofficial #success').show();
                            //fade away the notification after 2000 milliseconds
                            $("#editclubofficial #success").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclubofficial #success").slideUp(500);
                                });
                            //then toggle the input modal form.
                             $("#editclubofficial ").fadeTo(2000, 200).slideUp(500, function(){
                                $("#editclubofficial ").modal('toggle');
                                });
                             table.ajax.reload( null, false ); // reload the datatable on registration

                        //the rest applies as above

                        }else if (data.nochange)
                        {
                            $('#editclubofficial #nochange').show();
                            $("#editclubofficial #nochange").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclubofficial #nochange").slideUp(500);
                                });
                            $("#editclubofficial ").fadeTo(2000, 200).slideUp(500, function(){
                                $("#editclubofficial ").modal('toggle');
                                });
                        }else if (data.null)
                        {
                            $('#editclubofficial #null').show();
                            $("#editclubofficial #null").fadeTo(2000, 500).slideUp(500, function(){
                                $("#editclubofficial #null").slideUp(500);
                                });
                            $("#editclubofficial ").fadeTo(2000, 200).slideUp(500, function(){
                                $("#editclubofficial ").modal('toggle');
                                });
                        }  

                    }
                });
              
        });

    });


function editcofficial(objButton)
{
    event.preventDefault();//prevent auto submit data

    var id=objButton.value;
 
     
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>home/editclubofficial",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {

                        $('#editclubofficial #editclubofficialreg input[name=suid]').val(data.suID);
                        $('#editclubofficial #editclubofficialreg input[name=firstname]').val(data.firstName);
                        $('#editclubofficial #editclubofficialreg input[name=lastname]').val(data.lastName);
                        $('#editclubofficial #editclubofficialreg input[name=suemail]').val(data.suEmail);
                        $('#editclubofficial #editclubofficialreg input[name=phone]').val(data.telNo);
                        $('#editclubofficial #editclubofficialreg input[name=startdate]').val(data.startDate);
                        $('#editclubofficial #editclubofficialreg input[name=enddate]').val(data.endDate);
                        $('#editclubofficial #editclubofficialreg input[name=pid]').val(data.pID);


                        $('#editclubofficial #editclubofficialreg #club').empty();
                        
                        var clubID=data.clubID;
                        var clubName=data.clubName;
                        var opt = $('<option />');
                            opt.val(clubID);
                            opt.text(clubName);

                        $('#editclubofficial #editclubofficialreg #club').append(opt);


                        $('#editclubofficial #editclubofficialreg #role').empty();
                        
                        var roleID=data.roleID;
                        var roleName=data.roleName;
                        var opt = $('<option />');
                            opt.val(roleID);
                            opt.text(roleName);

                        $('#editclubofficial #editclubofficialreg #role').append(opt);


                        
                        var gender=data.gender;
                        if (gender=="Male")
                        {
                              $('#editclubofficial #editclubofficialreg input[name=gender]')[0].checked=true;
                        }else if (gender=="Female") {
                              $('#editclubofficial #editclubofficialreg input[name=gender]')[1].checked=true;
                        }else 
                        {
                              $('#editclubofficial #editclubofficialreg input[name=gender]')[0].checked=false;
                              $('#editclubofficial #editclubofficialreg input[name=gender]')[1].checked=false;
                        }

                        $('#editclubofficial').modal('toggle');

                        //automatically click on the inputs for smooth dropdown lists
                        $('#editclubofficial #editclubofficialreg #club').click();
                        $('#editclubofficial #editclubofficialreg #role').click();
                    }
                });


}




$( "#editclubofficial #editclubofficialreg #club").one('click',function(event)
        {

         
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>home/clubdropdownlist",
                    dataType:'json',

                    success:function(data)
                    {


                        
                         //populate the clubs dropdown list on edit
                         $.each(data,function(clubID,clubName)
                            {

                                var opt = $('<option />').empty(); 

                                opt.val(clubID);
                                opt.text(clubName);

                                $('#editclubofficialreg #club').append(opt);

                            });

                        //this code removes duplicates from the list above
                        
                        var seen = {};
                        jQuery('#editclubofficialreg #club').children().each(function() 
                        {
                            var txt = jQuery(this).clone().wrap('<select>').parent().html();
                            if (seen[txt]) {
                                jQuery(this).remove();
                            } else {
                                seen[txt] = true;
                            }
                        });


                    }

                });



});



$( "#editclubofficial #editclubofficialreg #role").one('click', function(event)
        {

         
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>home/c_rolesdropdown",
                    dataType:'json',

                    success:function(data)
                    {
                       //populate the clubs dropdown list on edit
                         $.each(data,function(roleID,roleName)
                            {


                                var opt = $('<option />').empty(); 

                                opt.val(roleID);
                                opt.text(roleName);

                                $('#editclubofficialreg #role').append(opt);


                                 

                            });
                                    

                        //this code removes duplicates from the list above
                        var seen = {};
                        jQuery('#editclubofficialreg #role').children().each(function() 
                        {
                            var txt = jQuery(this).clone().wrap('<select>').parent().html();
                            if (seen[txt]) {
                                jQuery(this).remove();
                            } else {
                                seen[txt] = true;
                            }

                        }); 

                    }

            });



});


//=======================club dropdown list on registration form toggle view=========================

$( "#regmodal").one('click', function(event)
        {
            event.preventDefault();//prevent auto submit data
         
     
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>home/clubdropdownlist",
                    dataType:'json',

                    success:function(data)
                    {

                         $.each(data,function(clubID,clubName)
                            {
                               //assign values to dropdown list
                                var opt = $('<option />'); 

                                opt.val(clubID);
                                opt.text(clubName);
                                $('#clubofficialreg #club').append(opt);

                                    //sort the dropdown list 
                                    var options = $('#clubofficialreg #club option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });


                                    //this code removes duplicates from the list above
                                    var seen = {};
                                    jQuery('#clubofficialreg #club').children().each(function() 
                                    {
                                        var txt = jQuery(this).clone().wrap('<select>').parent().html();
                                        if (seen[txt]) {
                                            jQuery(this).remove();
                                        } else {
                                            seen[txt] = true;
                                        }

                                    }); 
                            });

                    }
                });


});


$( "#regmodal").one('click',function(event)
        {
            event.preventDefault();//prevent auto submit data
         
     
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>home/c_rolesdropdown",
                    dataType:'json',

                    success:function(data)
                    {

                         $.each(data,function(roleID,roleName)
                            {
                                //assign role values to dropdown list 
                                var opt = $('<option />'); 

                                opt.val(roleID);
                                opt.text(roleName);
                                $('#clubofficialreg #role').append(opt);


                                //sort the roles dropdown list 
                                var options = $('#clubofficialreg #role option');
                                    var arr = options.map(function(_, o) { return { t: $(o).text(), v: o.value }; }).get();
                                    arr.sort(function(o1, o2) { return o1.t > o2.t ? 1 : o1.t < o2.t ? -1 : 0; });
                                    options.each(function(i, o) {
                                      o.value = arr[i].v;
                                      $(o).text(arr[i].t);
                                    });

                               //this code removes duplicates from the list above
                                var seen = {};
                                jQuery('#clubofficialreg #role').children().each(function() 
                                {
                                    var txt = jQuery(this).clone().wrap('<select>').parent().html();
                                    if (seen[txt]) {
                                        jQuery(this).remove();
                                    } else {
                                        seen[txt] = true;
                                    }

                                }); 

                            });

                    }
                });


});




function deleteclubofficial(objButton)
{

            event.preventDefault();//prevent auto submit data

            // $('#deleteclubofficial').modal('toggle');
            
            var table=$('#clubofficialslist').DataTable();//define the datatble for refreshing


            $( "#deleteclubofficialconfirm").one('click',function(event)
        {
            var id=objButton.value;
            
            
            $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>home/deleteclubofficial",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {

                        if (data.successful)
                        {
                            $('#deleteclubofficial #deletesuccess ').show();
                            $("#deleteclubofficial #deletesuccess").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deleteclubofficial #deletesuccess").slideUp(500);
                                });

                             $("#deleteclubofficial ").fadeTo(2000, 200).slideUp(500, function(){
                                $("#deleteclubofficial ").modal('toggle');
                                });

                        }else if (data.fail)
                        {
                            $('#deleteclubofficial #deletefail').show();
                            $("#deleteclubofficial #deletefail").fadeTo(2000, 500).slideUp(500, function(){
                                $("#deleteclubofficial #deletefail").slideUp(500);
                                });
                        }

                    table.ajax.reload( null, false ); // reload the datatable on delete

                        
                    }

                });



        });
    

}




function c_o_view(objButton)
{
    event.preventDefault();//prevent auto submit data

    var id=objButton.value;
 
     
     $.ajax(
                {
                    type:"post",
                    url: "<?php echo base_url(); ?>home/editclubofficial",
                    data:{ id:id},
                    dataType:'json',

                    success:function(data)
                    {

                        $('#viewclubofficial #fullname').text(data.firstName+' '+data.lastName);
                        $('#viewclubofficial #suid').text(data.suID);
                        $('#viewclubofficial #phone').text(data.telNo);
                        $('#viewclubofficial #clubname').text(data.clubName);
                        $('#viewclubofficial #rolename').text(data.roleName);
                        $('#viewclubofficial #gender').text(data.gender);
                        $('#viewclubofficial #suemail').text(data.suEmail);
                        $('#viewclubofficial #dateregistered').text(data.dateRegistered);
                        $('#viewclubofficial #lastupdated').text(data.lastUpdated);

                        if(data.startDate=="")
                        {
                            $('#viewclubofficial #startdate').text(data.startDate+'____')
                        }else
                        {
                            $('#viewclubofficial #startdate').text(data.startDate)
                        }

                        $('#viewclubofficial').modal('toggle');

                        
                    }
                });


}



//to refresh the page
$( "#refresh").click( function(event)
        {
            window.setTimeout(function(){location.reload()},1)

        });

