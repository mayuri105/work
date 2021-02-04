<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$Site_Title} :: Admin Login</title>
<meta name="keywords" content="{$Meta_Keyword}"/>
<meta name="description" content="{$Meta_Description}"/>
	
	<link href="{$Templates_CSS}style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="{$Templates_CSS}ddsmoothmenu.css" />
	<script language="javascript" type="text/javascript">
		var img_path = '{$Templates_Image}';
		var site_root = '{$Site_Root}';
		var current_page = '{$smarty.server.PHP_SELF}';
		var Site_Root_Front = '{$Site_Root_Front}';
	</script>
	
	<script language="javascript" src="{$Templates_JS}validate.js"></script>
	<script language="javascript" src="{$Templates_JS}functions.js"></script>
	<script type="text/javascript" src="{$Templates_JS}jquery.min.js"></script>
	<script language="javascript" src="{$Templates_JS}ddsmoothmenu.js"></script>
	
    {section name=FileName loop=$JavaScript}
    <script language="javascript" src="{$Templates_JS}{$JavaScript[FileName]}"></script>
	{/section}
	
<script type="text/javascript">
	ddsmoothmenu.init({ldelim}
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
{rdelim})
</script>

<!--<script type="text/javascript" src="{$Templates_JS}jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="{$Templates_JS}jquery-ui-1.7.1.custom.min.js"></script>

<script type="text/javascript">
  // When the document is ready set up our sortable with it's inherant function(s)
  $(document).ready(function() {ldelim}
    $("#test-list").sortable({ldelim}
      handle : '.handle',
      update : function () {ldelim}
		  var order = $('#test-list').sortable('serialize');
		 url	=	"{$smarty.server.PHP_SELF}?"+order+"&Action=Order";
		
  		$("#info").load(url);
      {rdelim}
    {rdelim});
{rdelim});
</script>-->

<!--<script language="javascript" src="{$Templates_JS}jquery-1.7.1.min.js"></script>
<script language="javascript" src="{$Templates_JS}interface-1.2.js"></script>
<script language="javascript" src="{$Templates_JS}inestedsortable.js"></script>
-->
<!--<script type="text/javascript">
jQuery( function($) {ldelim}

$('#test-list').NestedSortable(
	{ldelim}
		accept: 'page-item1',
		noNestingClass: "no-nesting",
		opacity: 0.8,
		helperclass: 'helper',
		onChange: function(serialized) {ldelim}
		alert(serialized[0].hash);
		url	=	"{$smarty.server.PHP_SELF}?"+serialized[0].hash+"&Action=Order";
		
  		$("#info").load(url);
			/*$('#info')
			.html("This can be passed as parameter to a GET or POST request: <br/>" + serialized[0].hash);*/
		{rdelim},
		autoScroll: true,
		handle: '.sort-handle'
	{rdelim}
);
	
{rdelim});
</script>-->
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr style="background-color:#2250A5;">
    <td valign="top" id="header">{include file="$T_Header"}
	</td>
	</tr>
  {if $Admin_Id}
  <tr>
    <td class="menubg" valign="top">
	{include file="$T_Menu"}
</td>
  </tr>
  {/if}
  <tr>
    <td>{include file="$T_Body"}</td>
  </tr>
</table>
</body>
</html>
