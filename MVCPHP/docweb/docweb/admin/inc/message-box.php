<?php if($_SESSION['message'])
{
	?><script>alert('<?=$_SESSION['message']?>');</script>
<?php $_SESSION['message']=""; } ?>