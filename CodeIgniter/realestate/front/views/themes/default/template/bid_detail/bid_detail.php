<table class="table">
                                   <th>Date Time</th>
                                   <th>Property Image</th>  
                                   <th>Property</th> 
                                   
                                   <th>Base Price </th> 
                                   <th>Last Price</th> 
                                   <th>Person</th> 
                                   <?php foreach($allbid as $b): ?>

                                   <tr>
                                    
                                    <td><?php echo $b->date_time; ?> </td> 
                                     <td> <a href="<?php echo site_url('bid/property/'.$b->property_slug.'') ?>" ><img src="<?php echo getuploadpath().'property/'.$b->feature_image; ?>" hight="50" width="70"></a></td>
                                    <td><a href="<?php echo site_url('bid/property/'.$b->property_slug.'') ?>" ><?php echo $b->property_title; ?></a></td>
                                     
                                    <td><?php echo $b->cost; ?></td> 
                                    <td><?php echo $b->amount; ?></td>  
                                    <td><?php echo $b->first_name; ?>&nbsp; <?php echo $b->last_name; ?> </td> 
                                    

                                   </tr>
                                   <?php endforeach; ?>
                                </table>
<style>
tr:nth-child(1) {
    background-color:#EF7351;
    color:#FFF;

}
tr:nth-child(2) {
    background-color:#FFF;
    color:green;
     text-decoration: blink;
     
     animation: blink 1s linear infinite;
}
@-webkit-keyframes blink {
    50% { background: rgba(144,238,144,1);
            
     }
}
</style>
