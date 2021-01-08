

<div class="col-md-12">
<h3>Latest Bidding</h3> 
<div id="scroll">
<ul>
<?php foreach($members as $m): ?>
<li>
<p><?php echo $m->first_name; ?>&nbsp; <?php echo $m->last_name; ?> &nbsp; bids on This 
<?php echo $m->property_title; ?>  &nbsp;in &nbsp;<?php echo $m->amount; ?></p>
</li>
<?php endforeach; ?>
</ul>
</div>
</div>
