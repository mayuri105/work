<?php

function smarty_function_html_pager($params, &$smarty){

	extract($params);

	$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
	$base_url = $path_parts["basename"] . "?" . substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'],"&start")===false?strlen($_SERVER['QUERY_STRING']):strpos($_SERVER['QUERY_STRING'],"&start"));
	$total_pages = ceil($num_items/$per_page);

	if ( $total_pages == 1 )
		return '';

	$on_page = floor($start_item / $per_page) + 1;
	
	$page_string = '';
	if ( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;
		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url. "&amp;start=" . ( ( $i - 1 ) * $per_page )  . '\';document.forms[0].submit();" >' . $i . '</a>';
			if ( $i <  $init_page_max )
				$page_string .= ' ';
		}

		if ( $on_page > 1  && $on_page < $total_pages )
		{
			$page_string .= ( $on_page > 5 ) ? ' ... ' : ', ';
			$init_page_min = ( $on_page > 4 ) ? $on_page : 5;
			$init_page_max = ( $on_page < $total_pages - 4 ) ? $on_page : $total_pages - 4;

			for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
			{
				$page_string .= ($i == $on_page) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page )  . '\'; document.forms[0].submit();">' . $i . '</a>';
				if ( $i <  $init_page_max + 1 )
					$page_string .= ' ';
			}
			$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
		}
		else
			$page_string .= ' ... ';

		for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>'  : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if( $i <  $total_pages )
				$page_string .= " ";
		}
	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $per_page ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if ( $i <  $total_pages )
					$page_string .= " ";
		}
	}

	$page_string = "&nbsp;&nbsp;". $page_string. "&nbsp;&nbsp;";

	if ( $add_prevnext_text )
	{
		if ( $on_page > 1 )
			$page_string = '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . '&amp;start=0\'; document.forms[0].submit();"><img src="'. $image_path. 'p_first.gif" border=0></a>&nbsp;'
						.  '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . '&amp;start=' . ( ( $on_page - 2 ) * $per_page ) . '\'; document.forms[0].submit();"><img src="'. $image_path. 'p_prev.gif" border=0></a>'
						. $page_string;
		else
			$page_string = '<img src="'. $image_path.'p_first_d.gif" border=0>&nbsp;' 
						.  '<img src="'. $image_path.'p_prev_d.gif" border=0>' 
						. $page_string;

		if ( $on_page < $total_pages )
			$page_string .= '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . '&amp;start=' . ( $on_page * $per_page ) . '\'; document.forms[0].submit();"><img src="'. $image_path. 'p_next.gif" border=0></a>&nbsp;'
						.  '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . '&amp;start=' . ( ($total_pages-1) * $per_page ) . '\'; document.forms[0].submit();"><img src="'. $image_path. 'p_last.gif" border=0></a>';
		else
			$page_string .= '<img src="'. $image_path. 'p_next_d.gif" border=0>&nbsp;'
						 .  '<img src="'. $image_path. 'p_last_d.gif" border=0>';
	}

	echo $page_string;
}

?>
