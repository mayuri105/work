<!DOCTYPE html>
<html>

<head>
    <title>Save TakaTak</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/font.css"/>
    <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/font-awesome.css"/>
    <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/normalize.css"/>
    <!--css plugin-->
    <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/flexslider.css"/>
    <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/jquery.nouislider.css"/>
    <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/jquery.popupcommon.css"/>

    <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/style.css"/>
   
    <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/res-menu.css"/>
    <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/css/responsive.css"/>
   
   
   
   
   
   
    <link href="<?=site_url('front/views/themes/default');?>/asset/css/bootstrap.min.css" rel="stylesheet">

       
        <link href="<?=site_url('front/views/themes/default');?>/asset/css/custom.css" rel="stylesheet">

      
        <link rel="stylesheet" href="<?=site_url('front/views/themes/default');?>/asset/font-awesome-4.0.3/css/font-awesome.min.css">


       

      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
       
    
</head>


<body class="">

<div class="container-page">
    <div class="mp-pusher" id="mp-pusher">
        <?php echo Modules::run('header/header/index'); ?> 
        <?php echo Modules::run('menu/menu/index'); ?>
        <div class="grid_frame page-content">
            <div class="container_grid">
             <div class="container">
      <div class="row">
      <div class="col-md-12">
      <p style="text-align: center;
    font-size: 16px;
    font-weight: bold;
">Thank you for your interest in our services. Please provide the following information about your business needs to help us serve you better. This information will enable us to route your request to the appropriate person. You should receive a response within 48 hours.</p>
      </div>
      
      </div><br><br><br>
        <div class="row">

                 
                    <div class="col-md-8">
                        <h3>Contact Info</h3>
                        

                                                
                       
                        <div class="tabs">
                         
                           
                            <div class="tab-content">
                            <?php if($this->session->flashdata('success')){ ?>
                    <p>
                        <div class="alert alert-dismissable alert-success">
                        <i class="fa fa-warning"></i>
                            <?php 
                                echo $this->session->flashdata('success');
                             ?>
                        <div class="pull-right">
                            <i class="ti ti-close" class="close" data-dismiss="alert" aria-hidden="true"></i>&nbsp;
                        </div>
                    </div></p>
                    <?php } ?>
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
                                <div class="tab-pane active" id="contactUs">
                                    
                                  

<p><b>Fields marked by an asterisk ( *) are required fields.</b></p>
                                   <?php 
            $attributes = array('class' => 'form-contact', 'id' => 'contact','name' => 'contact');
            echo form_open('page/addcontact', $attributes);  ?>
                                
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <label>First name *</label>
                                                    <input type="text"  maxlength="100" class="form-control" name="fname" id="fname">
                                                </div>
                                                 <div class="col-md-6">
                                                    <label>Last name *</label>
                                                    <input type="text"   maxlength="100" class="form-control" name="lname" id="lname">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Your email address *</label>
                                                    <input type="email"  maxlength="100" class="form-control" name="email" id="email">
                                                </div>
                                                 <div class="col-md-6">
                                                    <label>Company/Organization*</label>
                                                     <input type="text"   maxlength="100" class="form-control" name="cname" id="cname">
                                                </div>
                                                 <div class="col-md-6">
                                                    <label>Select Inquiry Type*</label>
                                                    <select class="form-control" id="enquiry_type" name="enquiry_type">
                                                  <option value="" selected="selected">Please Select</option>
                                                  <option value="Request for Services">Request for Services</option>
                                                  <option value="Alliances">Alliances</option>
                                                
                                                  <option value="Investor Relations">Investor Relations</option>
                                                  <option value="Analyst Relations">Analyst Relations</option>
                                                  <option value="Media and Public Relations">Media and Public Relations</option>
                                                  <option value="Others">Others</option> </select>
                                                         
                                                </div>
                                                <div class="col-md-6">
                                                    <label>If others, please specify</label>
                                                     <input type="text"  maxlength="100" class="form-control" name="others" id="others">
                                                </div>
                                                
                                                
                                                 <div class="col-md-6">
                                                    <label>Country*</label>
                                                    <select class="form-control" id="sel1" name="country">
                                               <option value="" selected="selected">Select a Country</option><option value="Afghanistan">Afghanistan</option><option value="Albania">Albania</option><option value="Algeria">Algeria</option><option value="American Samoa">American Samoa</option><option value="Andorra">Andorra</option><option value="Angola">Angola</option><option value="Anguilla">Anguilla</option><option value="Argentina">Argentina</option><option value="Armenia">Armenia</option><option value="Aruba">Aruba</option><option value="Australia">Australia</option><option value="Austria">Austria</option><option value="Azerbaijan">Azerbaijan</option><option value="Bahamas">Bahamas</option><option value="Bahrain">Bahrain</option><option value="Bangladesh">Bangladesh</option><option value="Barbados">Barbados</option><option value="Belarus">Belarus</option><option value="Belgium">Belgium</option><option value="Belize">Belize</option><option value="Benin">Benin</option><option value="Bermuda">Bermuda</option><option value="Bhutan">Bhutan</option><option value="Bolivia">Bolivia</option><option value="Botswana">Botswana</option><option value="Bouvet Island">Bouvet Island</option><option value="Brazil">Brazil</option><option value="Brunei">Brunei</option><option value="Bulgaria">Bulgaria</option><option value="Burkina Faso">Burkina Faso</option><option value="Burundi">Burundi</option><option value="Cambodia">Cambodia</option><option value="Cameroon">Cameroon</option><option value="Canada">Canada</option><option value="Cape Verde">Cape Verde</option><option value="Cayman Islands">Cayman Islands</option><option value="Chad">Chad</option><option value="Chile">Chile</option><option value="China">China</option><option value="Colombia">Colombia</option><option value="Comoros">Comoros</option><option value="Congo">Congo</option><option value="Cook Islands">Cook Islands</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croatia</option><option value="Cuba">Cuba</option><option value="Cyprus">Cyprus</option><option value="Czech Republic">Czech Republic</option><option value="Denmark">Denmark</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="East Timor">East Timor</option><option value="Ecuador">Ecuador</option><option value="Egypt">Egypt</option><option value="El Salvador">El Salvador</option><option value="Eritrea">Eritrea</option><option value="Estonia">Estonia</option><option value="Ethiopia">Ethiopia</option><option value="Faroe Islands">Faroe Islands</option><option value="Fiji">Fiji</option><option value="Finland">Finland</option><option value="France">France</option><option value="French Guiana">French Guiana</option><option value="Gabon">Gabon</option><option value="Gambia">Gambia</option><option value="Georgia">Georgia</option><option value="Germany">Germany</option><option value="Ghana">Ghana</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Greece</option><option value="Greenland">Greenland</option><option value="Grenada">Grenada</option><option value="Guadeloupe">Guadeloupe</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guinea">Guinea</option><option value="Guinea-Bissau">Guinea-Bissau</option><option value="Guyana">Guyana</option><option value="Haiti">Haiti</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungary</option><option value="Iceland">Iceland</option><option value="India">India</option><option value="Indonesia">Indonesia</option><option value="Iran">Iran</option><option value="Iraq">Iraq</option><option value="Ireland">Ireland</option><option value="Israel">Israel</option><option value="Italy">Italy</option><option value="Jamaica">Jamaica</option><option value="Japan">Japan</option><option value="Jordan">Jordan</option><option value="Kazakhstan">Kazakhstan</option><option value="Kenya">Kenya</option><option value="Kiribati">Kiribati</option><option value="Korea">Korea</option><option value="Kuwait">Kuwait</option><option value="Kyrgyzstan">Kyrgyzstan</option><option value="Laos">Laos</option><option value="Latvia">Latvia</option><option value="Lebanon">Lebanon</option><option value="Lesotho">Lesotho</option><option value="Liberia">Liberia</option><option value="Libya">Libya</option><option value="Lithuania">Lithuania</option><option value="Luxembourg">Luxembourg</option><option value="Macau">Macau</option><option value="Macedonia">Macedonia</option><option value="Madagascar">Madagascar</option><option value="Malawi">Malawi</option><option value="Malaysia">Malaysia</option><option value="Maldives">Maldives</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Martinique">Martinique</option><option value="Mauritania">Mauritania</option><option value="Mauritius">Mauritius</option><option value="Mayotee">Mayotee</option><option value="Mexico">Mexico</option><option value="Micronesia">Micronesia</option><option value="Moldova">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongolia</option><option value="Montserrat">Montserrat</option><option value="Morocco">Morocco</option><option value="Mozambique">Mozambique</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namibia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Netherlands">Netherlands</option><option value="New Caledonia">New Caledonia</option><option value="New Zealand">New Zealand</option><option value="Nicaraqua">Nicaraqua</option><option value="Niger">Niger</option><option value="Nigeria">Nigeria</option><option value="Niue">Niue</option><option value="Norfolk Island">Norfolk Island</option><option value="Norway">Norway</option><option value="Oman">Oman</option><option value="Pakistan">Pakistan</option><option value="Palau">Palau</option><option value="Panama">Panama</option><option value="Papua New Guinea">Papua New Guinea</option><option value="Paraguay">Paraguay</option><option value="Peru">Peru</option><option value="Philippines">Philippines</option><option value="Pitcairn">Pitcairn</option><option value="Poland">Poland</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Qatar">Qatar</option><option value="Reunion">Reunion</option><option value="Romania">Romania</option><option value="Russia">Russia</option><option value="Rwanda">Rwanda</option><option value="Saint Lucia">Saint Lucia</option><option value="Samoa">Samoa</option><option value="San Marino">San Marino</option><option value="Saudi Arabia">Saudi Arabia</option><option value="Senegal">Senegal</option><option value="Seychelles">Seychelles</option><option value="Sierra Leone">Sierra Leone</option><option value="Singapore">Singapore</option><option value="Slovak Republic">Slovak Republic</option><option value="Slovenia">Slovenia</option><option value="Solomon Islands">Solomon Islands</option><option value="Somalia">Somalia</option><option value="South Africa">South Africa</option><option value="Spain">Spain</option><option value="Sri Lanka">Sri Lanka</option><option value="St. Helena">St. Helena</option><option value="Sudan">Sudan</option><option value="Suriname">Suriname</option><option value="Swaziland">Swaziland</option><option value="Sweden">Sweden</option><option value="Switzerland">Switzerland</option><option value="Syria">Syria</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajikistan</option><option value="Tanzania">Tanzania</option><option value="Thailand">Thailand</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Tunisia">Tunisia</option><option value="Turkey">Turkey</option><option value="Turkmenistan">Turkmenistan</option><option value="Tuvalu">Tuvalu</option><option value="Uganda">Uganda</option><option value="Ukraine">Ukraine</option><option value="United  States">United  States</option><option value="United Arab Emirates">United Arab Emirates</option><option value="United Kingdom">United Kingdom</option><option value="Uruguay">Uruguay</option><option value="USSR (former)">USSR (former)</option><option value="Uzbekistan">Uzbekistan</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnam</option><option value="Western Sahara">Western Sahara</option><option value="Yemen">Yemen</option><option value="Yugoslavia">Yugoslavia</option><option value="Zaire">Zaire</option><option value="Zambia">Zambia</option><option value="Zimbabwe">Zimbabwe</option> </select>
                                                         
                                                </div>
                                            <div class="col-md-6">
                                                    <label>Phone Number *</label>
                                                 
                                                  <input type="text"  class="form-control" name="phone" id="phone">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Industry you belong to*</label>
                                                    <select class="form-control" id="sel1" name="industry">
                                               <option value="" selected="selected">Please Select</option><option value="Consumer Business &amp; Transportation">Consumer Business &amp; Transportation</option><option value="Energy &amp; Resources">Energy &amp; Resources</option><option value="Financial Services">Financial Services</option><option value="Life Sciences &amp; Health care">Life Sciences &amp; Health care</option><option value="Manufacturing">Manufacturing</option><option value="Public Sector">Public Sector</option><option value="Real Estate">Real Estate</option><option value="Technology, Media &amp; Telecommunications">Technology, Media &amp; Telecommunications</option><option value="Others">Others</option> </select>
                                                </div>
                                     
                                            </div>
                                                                                  </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <label>Description of inquiry*</label>
                                                    <textarea maxlength="5000" rows="10" class="form-control" name="message" style="height: 138px;" ></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input type="submit" name="submit" value="Send Message" class="btn btn-lg btn-primary">
                                            </div>
                                        </div>
                                    </form>
                                  
                                    
                                </div>
                               

                            </div>
                           
                        </div>  
                                      

                    </div>
                

<div class="col-md-4 ">

                        <aside>
                            <h4 style="font-weight:bold;">CORPORATE OFFICE ADDRESS</h4>
                            <address>
                              <strong>Promethean Global Technologies</strong><br>
                              <i class="fa fa-map-marker"></i><strong>Address: </strong>202 , Aries Complex, OPP : Ram Krishna Chambers,BPC Road,<br>
                              <i class="fa fa-plane"></i><strong>City: </strong>Vadodara, Gujarat,390005.<br>
                              <i class="fa fa-phone"></i> <abbr title="Phone">P:</abbr>+91-0265-6542001<br>
                               <i class="fa fa-envelope"></i><strong></strong><a href="mailto:#"> info@prometheantech.com</a>
                            </address>

                          
                        </aside>

                        
               
                    </div>
                </div></div>
            </div>
        </div><br><br>
         <?php echo Modules::run('footer/footer/index'); ?> 
    </div>
</div>

  <script src="<?=site_url('front/views/themes/default');?>/asset/js/bootstrap.min.js"></script>


        <!-- LOOK THE DOCUMENTATION FOR MORE INFORMATIONS -->
        <script type="text/javascript">

            var revapi;

            jQuery(document).ready(function() {
                "use strict";
                revapi = jQuery('.tp-banner').revolution(
                        {
                            delay: 15000,
                            startwidth: 1200,
                            startheight: 278,
                            hideThumbs: 10,
                            fullWidth: "on"
                        });

            });	//ready

        </script>
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery.nouislider.js"></script>
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/jquery.popupcommon.js"></script>
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/html5lightbox.js"></script>

<!--//js for responsive menu-->
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/modernizr.custom.js"></script>
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/classie.js"></script>
<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/mlpushmenu.js"></script>

<script type="text/javascript" src="<?=site_url('front/views/themes/default');?>/asset/js/script.js"></script>
</body>

</html>