<!DOCTYPE html>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title><?php echo $title ?></title>
   	<?php echo Modules::run('header/header/css') ?>
    <link href="<?= site_url('front/views/themes/default'); ?>/assets/stylesheets/hzdatepicker.css" rel="stylesheet">
    <link href="<?= site_url('front/views/themes/default'); ?>/assets/stylesheets/jquery.timepicker.css" rel="stylesheet">
    <link href="<?= site_url('front/views/themes/default'); ?>/assets/stylesheets/bootstrap-datepicker.css" rel="stylesheet">
    
    <meta itemprop="title" content="<?php echo $meta_titles ?> ">
    <meta itemprop="description" content="<?php echo $meta_descriptions ?>">
    <meta itemprop="keywords" content="<?php echo $meta_keywords ?>">
</head>
<body>
   
<?php echo Modules::run('header/header/index'); ?>

	<!-- Header Stat Banner -->
	<header id="banner" class="stat_bann">
	<div class="bannr_sec">
	    <img src="<?= site_url('front/views/themes/default'); ?>/assets/images/banner_5.jpg" alt="Banner">
	        <h1 class="main_titl">
	        	Labh char
	        </h1>
	        <!-- <h4 class="sub_titl">
	            Wes Anderson American Apparel
	        </h4> -->
   </div>
</header>	
<div class="spacer-60"></div>
    <div class="container">
        <!-- Pricing Section -->
        <section id="pricg_sec">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                 <h3 class="text-center">Account Details</h3>
                 
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-9 bhoechie-tab-container">
                        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-3 bhoechie-tab-menu">
                          <div class="list-group">
                            <a href="#" class="list-group-item active text-center">
                              <h4 class="glyphicon glyphicon-plane"></h4><br/>Appointment
                            </a>
                            <a href="#" class="list-group-item text-center">
                              <h4 class="glyphicon glyphicon-road"></h4><br/>Package Detail
                            </a>
                            <a href="#" class="list-group-item text-center">
                              <h4 class="glyphicon glyphicon-user"></h4><br/>Profile 
                            </a>
                            <a href="#" class="list-group-item text-center">
                              <h4 class="fa fa-key"></h4><br/>Change Password 
                            </a>
                          </div>
                        </div>

                    <?php if($this->session->flashdata('error')){ ?>
                        <p>
                            <div class="alert alert-dismissable alert-danger">
                                <i class="fa fa-warning"></i>
                                    <?php 
                                        echo $this->session->flashdata('error');
                                     ?>
                                <div class="pull-right">
                                    <i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
                                </div>
                            </div>
                        </p>
                    <?php } ?>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 bhoechie-tab">
                         
                            <div class="bhoechie-tab-content active">
                                  <h4 class="text-center">Appointment Details</h4>
                                <center>
                                    <div class="text-center table-responsive">
                                            <table  class="table table-bordered">

                                                <thead>
                                                  <tr>
                                                    <th> Date</th>
                                                    <th> Time Slot</th>
                                                    <th>Appointment For</th>
                                                    <th> Status</th>
                                                    <th> Action</th>
                                                    
                                                  </tr>
                                                </thead>
                                                <tbody>

                                                <?php foreach ($appointment as $a): ?>
                                                
                                                      <tr class="<?php echo colorcode($a->asname) ?>">
                                                        <td> <?php echo date('d-m-Y',strtotime($a->appointment_date)) ?></td>
                                                        <td><?php echo date('g:i:a',strtotime($a->start_time)).'-'.date('g:i:a',strtotime($a->end_time)) ?></td>
                                                        <td><?php echo $a->appointment_for ?></td>
                                                        <td> <?php echo $a->asname ?></td>
                                                        
                                                        <td>
                                                        <?php if($a->asname != 'close' && $a->asname != 'on hold'  && $a->asname  != 'cancle'): ?>
                                                            <button onclick="edit('<?php echo $a->appointment_id; ?>')"  data-toggle="modal" data-target="#myModal" class="btn btn-primary">Reschedule</button>
                                                            <!-- <button class="btn btn-primary">Close</button> -->
                                                        <?php endif; ?>

                                                        </td>
                                                        
                                                      </tr>
                                                <?php endforeach ?>  
                                                </tbody>
                                      </table>
                                    </div>
                                </center>
                            </div>
                            
                            <div class="bhoechie-tab-content">
                                 <h4 class="text-center">Package Details</h4>

                                <center>

                                    <div class="text-center table-responsive">
                                            <table  class="table table-bordered">

                                                <thead>
                                                  <tr>
                                                    <th> Package Name</th>
                                                    <th>Package Category</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    
                                                  </tr>
                                                </thead>
                                                <tbody>

                                                <?php foreach ($package as $p): ?>
                                                      <tr class="<?php ?>">
                                                        <td><?php echo $p->package_name ?></td>
                                                        <td><?php echo $p->package_category_name ?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($p->package_start_date)) ?></td>
                                                        <td><?php echo date('d-m-Y',strtotime($p->package_end_date)) ?></td>                
                                                        
                                                      </tr>
                                                <?php endforeach ?>  
                                                </tbody>
                                      </table>
                                    </div>
                                </center>
                            </div>
                
                            
                            <div class="bhoechie-tab-content">
                                 <h4 class="text-center">Profile Details</h4>
                                <center>

                                    <?php 
                                    $attributes = array('class' => 'form-horizontal', 'id' => 'updateprofile','name'=>'sentMessage' );
                                    echo form_open('account/updateprofile', $attributes);  ?> 
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">First name:</label>
                                        <div class="col-lg-8">
                                          <input class="form-control" required name = "first_name"  type="text" value="<?php echo $customer->first_name ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Last name:</label>
                                        <div class="col-lg-8">
                                          <input class="form-control"    name = "last_name" type="text" value="<?php echo $customer->last_name ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Email:</label>
                                        <div class="col-lg-8">
                                          <input class="form-control" required  name = "email" type="email" value="<?php echo $customer->email ?>">
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Phone:</label>
                                        <div class="col-lg-8">
                                          <input class="form-control"  required name = "phone"  type="number" value="<?php echo $customer->phone ?>">
                                        </div>
                                    </div> 
                                    <div class="modal-footer">
                                     <button type="submit" class="btn btn-primary updateprofile" >Update Profile  </button>

                                  </div>

                                    </form>
                                </center>
                            </div>
                            <div class="bhoechie-tab-content">
                                 <h4 class="text-center">Change Password</h4>
                                <center>

                                    <?php 
                                    $attributes = array('class' => 'form-horizontal', 'id' => 'changepw','name'=>'sentMessage' );
                                    echo form_open('account/changepw', $attributes);  ?> 
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Old Password</label>
                                        <div class="col-lg-8">
                                          <input class="form-control" required name = "oldpassword"  type="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">New Password:</label>
                                        <div class="col-lg-8">
                                          <input class="form-control"  required name = "password" type="password" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Confirm Password:</label>
                                        <div class="col-lg-8">
                                          <input class="form-control" required  name = "confpassword" type="password" value="">
                                        </div>
                                    </div>    
                                    
                                    <div class="modal-footer">
                                     <button type="submit" class="btn btn-primary changepw" >Update Password  </button>

                                  </div>

                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
              </div>
            </div>
            <!-- /.row -->
        </section>
        <div class="spacer-60"></div>
    </div>    
<?php echo Modules::run('footer/footer/index'); ?>

<!-- <button type="button" class="btn btn-info btn-lg" >Open Modal</button>
 -->
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Appointment Reschedule</h4>
      </div>
      <div class="modal-body">
        <?php 
            $attributes = array('class' => 'form-horizontal', 'id' => 'appointment','name'=>'sentMessage' );
            echo form_open('appointment/rescheduleAppointment', $attributes);  ?> 
            <input type="hidden" id="appointment_id" name="appointment_id">
            <div class="form-group">
                <label class="col-sm-4 control-label">Appointment Date  
                    <span class="required">*</span></label>
                    <div class="col-sm-8">
                        

                        <select class="form-control" id="appointment_date" name="appointment_date">
                           <option value="">None</option>
                            <?php for ($i=0; $i < 30; $i++) { 
                            $day = date('m/d/Y',strtotime('+' . $i . 'day'));
                            $d = date('w', strtotime($day));

                            if(in_array($d,$open_day)):
                            ?>
                            <option  value="<?php echo date('m/d/Y',strtotime('+' . $i . 'day')) ?>">
                                <?php echo date('l  d/m/Y',strtotime('+' . $i . ' day')) ?>
                            </option>

                            <?php endif; 
                                }
                            ?>
                        </select>
                    </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label">Appointment Time  
                    <span class="required">*</span>
                </label>
                <div class="col-sm-8">
                    <select class="form-control" id="appointment_time" name="appointment_time">
                        
                    </select>
                </div>
            </div>
                   
      </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary">Reschedule  </button>

        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
/* create datepicker */
$(document).ready(function() {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});

function edit(ids){
        var data = {
            id : ids
        };
        $.ajax({
            url : "<?php echo site_url('appointment/getAppointmentDet') ?>",
            type: "get",
            dataType: "json",
            data: data,
            success:function(data){
                  $('#appointment_id').val(data.appointment_id);  
            }
        });
        
    }
$('#appointment_date').change(function(){
    var date = $(this).val();
    var data = {
            date : date
        };
        $.ajax({
            url : "<?php echo site_url('appointment/getTimeSlotAvailable') ?>",
            type: "get",
            dataType: "json",
            data: data,
            success:function(data){
                var timeslot = $('#appointment_time');
                timeslot.html('<option value="">None</option>'); 
                var html = '';
                 for (var i = data.length - 1; i >= 0; i--) {
                        console.log()
                        html +='<option value="'+data[i].ts_id+'">'+data[i].start_time+'-'+data[i].end_time+'</option>';
                  };         
                  timeslot.append(html);           
            }
        });
});

  $('.updateprofile').click(function(e){
        e.preventDefault()
        var form = $('#updateprofile');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
               // window.location.reload();
            };
            showMessage(response.Type,response.Message);
          }
        });
    });
  $('.changepw').click(function(e){
        e.preventDefault()
        var form = $('#changepw');
        $.ajax({
          type: "POST",
          url: form.attr( 'action' ),
          data: form.serialize(),
          success: function( response ) {
            if (response.n) {
               // window.location.reload();
            };
            showMessage(response.Type,response.Message);
          }
        });
    });
</script>

</body>

</html>