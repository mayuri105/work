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
	        	Labh Char
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
                 <h3 class="text-center">Please Select Date and Time For Appointment </h3>
                 <div class="spacer-30"></div>
                 <?php 
                    $attributes = array('class' => 'form-horizontal', 'id' => 'appointment','name'=>'sentMessage' );
                    echo form_open('appointment/scheduleAppointmentBidWinner', $attributes);  ?> 

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
                    </div></p>
                    <?php } ?>
                    <input type="hidden" name="property_id" id="property_id" value="<?php echo $this->input->get('id') ?>">
                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Appointment For  
                            <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <select class="form-control" id="appointment_for" name="appointment_for">
                                <option value="bid">Bid</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">Appointment Date  
                            <span class="required">*</span></label>
                            <div class="col-sm-8">
                                

                                <select class="form-control" id="appointment_date" name="appointment_date">
                                   <option value="">None</option>
                                    <?php for ($i=1; $i < 30; $i++) { 
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
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Appointment note  
                            </label>
                        <div class="col-sm-8">
                            
                            <textarea class="form-control " id="appointment_note" name="appointment_note"  ><?php echo set_value('appointment_note') ?></textarea>
                            
                        </div>
                    </div> 
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Book Appointment </button>
                    </div>  
                </form>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <div class="spacer-60"></div>
    </div>    
<?php echo Modules::run('footer/footer/index'); ?>

<script src="<?= site_url('front/views/themes/default'); ?>/assets/scripts/hzdatepicker.js"></script>
<script type="text/javascript" src="<?= site_url('front/views/themes/default') ?>/assets/scripts/jquery.timepicker.min.js"></script>
<script type="text/javascript" src="<?= site_url('front/views/themes/default') ?>/assets/scripts/bootstrap-datepicker.js"></script>

<script type="text/javascript">

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
</script>

</body>

</html>