<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Alphabet Success ::  Home</title>

<!--Css
============================================================-->
<link href="{$Templates_CSS}reset.css" rel="stylesheet" type="text/css" />
<link href="{$Templates_CSS}style.css" rel="stylesheet" type="text/css" />
<link href="{$Templates_CSS}developer.css" rel="stylesheet" type="text/css" />
<link href="{$Templates_CSS}media-query.css" rel="stylesheet" type="text/css" />

<!--Google-Fonts
============================================================-->
<link href='http://fonts.googleapis.com/css?family=Quattrocento+Sans' rel='stylesheet' type='text/css'>
<!--font-family: 'Quattrocento Sans', sans-serif;-->
<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,700,800,600' rel='stylesheet' type='text/css'>
<!--font-family: 'Raleway', sans-serif;-->
<link href="{$Templates_CSS}bootstrap.css" rel="stylesheet" type="text/css">
<link href="{$Templates_Image}favicon.ico" rel="shortcut icon" type="image/x-icon" />

<!-- Js-menu
====================================================== -->
<!--<script type="text/javascript" src="{$Templates_JS}bootstrap.js"></script>
<script type="text/javascript" src="{$Templates_JS}bootstrap.min.js"></script>-->
<script src="{$Templates_JS}jquery.js"></script>
<script src="{$Templates_JS}bootstrap-dropdown.js"></script>
<script src="{$Templates_JS}bootstrap-collapse.js"></script> 
<script src="{$Templates_JS}validate.js"></script>
{literal}
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5292dd9860dfa741"></script>
{/literal}
<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="{$Templates_JS}respond.min.js"></script>
{section name=FileName loop=$JavaScript}
	<script language="javascript" src="{$Templates_JS}{$JavaScript[FileName]}"></script>
{/section}
</head>
<body>
<div class="main-page">
	<header>
		{include file="$T_Header"}
	</header>
    <div class="clear"></div>
    <div class="page-container">
    	<div class="author-section">
        	<div class="author-img-main">
            	<div class="authur-img"><img src="{$Templates_Image}author.jpg" alt="" /></div>
                <div class="img-shade"><img src="{$Templates_Image}shade-btm-img.png" alt="" /></div>
                <div class="author-name">Tim Fargo - Author</div>
            </div>
            <div class="author-discription">
            	<h1>Alphabet <span>Success</span></h1>
                <div class="clear"></div>
                <p><strong>Alphabet Success</strong>  - Keeping it Simple. The essence of a journey Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit,</p>
                <div class="clear"></div>
                <div class="comunity-col">
                	<h3>Follow me</h3>
                	<a href="#" class="fb" target="_blank"></a>
                    <a href="#" class="gplus" target="_blank"></a>
                    <a href="#" class="twitt" target="_blank"></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
            <div class="contain-hm-main">
            	{include file="$T_Body"}
					
				{if $isIndex == 1}
					<div class="contend-hm-in-side-r">
						{include file="$T_Right"}
					</div>
				{else}
					<div class="side-right"><img src="{$img_path}{$image}" alt="" /></div>
				{/if}
            </div>
    </div>
</div>
</body>
</html>
