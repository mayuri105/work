
<p>
                           <input type="text" class="contact2-textbox" placeholder="StartDate*" name="txtDateStart" id="date1"  /> <input type="text" class="contact2-textbox" placeholder=" End Date*" name="txtDateEnd" id="date2"  />
                           </p>
                            <script>
  $(function() {
    $( "#date1" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"yy-mm-dd"
  });
  });
 
  </script>
   <script>
  $(function() {
    $( "#date2" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"yy-mm-dd"
  });
  });
 
  </script>