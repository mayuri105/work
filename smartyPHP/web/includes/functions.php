<?php
function readFileContent($filename)
{
	if(!file_exists($filename))
		return "File does not exists !!";
	$fd = fopen ($filename, "r"); 
	$contents = fread ($fd, filesize($filename)); 
	fclose ($fd); 
	return $contents;
}
#====================================================================================================
#	Function Name		:	writeFileContent
#----------------------------------------------------------------------------------------------------
function writeFileContent($filename, $contents)
{
	$fd = fopen ($filename, "w+"); 
	$ret = fwrite($fd, $contents, strlen($contents)); 
	fclose ($fd); 
	return $ret;
}

function formatDate($dateValue, $formate='d-M-Y')
{
	ereg ("([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})", $dateValue, $datePart);
	return makeDate($datePart[3], $datePart[2], $datePart[1], $formate);
}

function makeDate($intDay, $intMonth, $intYear, $formate='d-M-Y')
{
	return date ($formate, mktime (0,0,0,$intMonth, $intDay, $intYear));
}


#	Function Name		:	getDBAccess
function getDBAccess($dbfileName, $moduleName='')
{
	global $physical_path;
	return ($physical_path['DB_Access']. ($moduleName!=''?strtolower($moduleName). '/':''). $dbfileName);
}


#====================================================================================================
#	Function Name		:	fillArrayCombo
#----------------------------------------------------------------------------------------------------
function fillArrayCombo($arrName, $selected='')
{
	$strHTML = "";
	reset($arrName);
    while(list($key,$val) = each($arrName))
    {
    	$strHTML .= "<option value=\"". $key. "\"";
    	if($selected == $key)
        	$strHTML .= " selected ";
		$strHTML .= ">".$val. "</option>";
    }
	return $strHTML;
}
#====================================================================================================
#	Function Name		:	fillDbCombo
#----------------------------------------------------------------------------------------------------
function fillDbCombo($arrName, $key, $val, $selected='')
{
 	global $db;
	$strHTML = "";
	$i = 0;
    while($i < $db->num_rows())
    {
		$db->next_record();
    	$strHTML .= "<option value=\"". $db->f($key). "\"";
		if($selected == $db->f($key))
        	$strHTML .= " selected ";
		if(is_array($val))
			$strHTML .= ">".$db->f($val[0])." ".$db->f($val[1])." </option>";
		else
			$strHTML .= ">".$db->f($val). "</option>";
		$i++;
	}
	$db->free();
	
	return $strHTML;
}

function fillDbComboMultiple($arrName, $key, $val, $selected='')
{
 	global $db;
	$strHTML = "";
	$i = 0;
	$mul_selected = explode(":",$selected);
    while($i < $db->num_rows())
    {
		$db->next_record();
    	$strHTML .= "<option value=\"". $db->f($key). "\"";
		foreach($mul_selected as $keys=>$vals)
		{
			if($vals == $db->f($key))
				$strHTML .= " selected ";
		}
			$strHTML .= ">".$db->f($val). "</option>";
		$i++;
	}
	$db->free();
	return $strHTML;
}

#====================================================================================================
#	Function Name		:	fileUpload
#----------------------------------------------------------------------------------------------------
function fileUpload($File, $Upload_Type, $Dir_Path='')
{
	global $physical_path;
    $retVal 	= '';
    $destPath   = '';
    $destFile   = '';
	
	if(is_array($File))
    {
		switch($Upload_Type)
		{
			case BLOG:
	            $destPath = $physical_path['Blog'];
	            break;
			case UPLOAD:
	            $destPath = $physical_path['Upload'];
	            break;			
			case PAGE:
	            $destPath = $physical_path['Page'];
	            break;	            
			default:
	            $destPath = $Dir_Path."/";
	            break;
	    }
		$destFile 	= getUniqueFilePrefix(). strtolower(ereg_replace("[^[:alnum:].]", "", $File['name']));
		$retVal 	= move_uploaded_file($File['tmp_name'], $destPath. $destFile);
		@chmod($destPath. $destFile, 0744);
	
	    if($retVal)
			return $destFile;
        else
        	return '';
    }
    else
    {
    	return '';
    }
}

#====================================================================================================
#	Function Name		:	get Unique FileP refix
#----------------------------------------------------------------------------------------------------

function getUniqueFilePrefix()
{
    list($usec, $sec) = explode(" ",microtime());
	list($trash, $usec) = explode(".",$usec);
    return (date("YmdHis").substr(($sec + $usec), -10).'_');
}


#====================================================================================================
#	Function Name	:   getUniqueKey
#----------------------------------------------------------------------------------------------------
function getUniqueKey()
{
	return (mktime (date('G'),date('i'),date('s'),date('m'),date('d'),date('Y')));
}	

function recursive_remove_directory($directory, $empty=FALSE)
{
	// if the path has a slash at the end we remove it here
	if(substr($directory,-1) == '/')
	{
		$directory = substr($directory,0,-1);
	}
	if(!file_exists($directory) || !is_dir($directory))
	{
		// ... we return false and exit the function
		return FALSE;
		// ... if the path is not readable
	}
	elseif(!is_readable($directory))
	{
		// ... we return false and exit the function
		return FALSE;
		// ... else if the path is readable
	}
	else
	{
		// we open the directory
		$handle = opendir($directory);
		// and scan through the items inside
		while (FALSE !== ($item = readdir($handle)))
		{
			// if the filepointer is not the current directory
			// or the parent directory
			if($item != '.' && $item != '..')
			{
				// we build the new path to delete
				$path = $directory.'/'.$item;
				// if the new path is a directory
				if(is_dir($path)) 
				{
					// we call this function with the new path
					recursive_remove_directory($path);
					// if the new path is a file
				}
				else
				{
					// we remove the file
					unlink($path);
				}
			}
		}
		// close the directory
		closedir($handle);
		// if the option to empty is not set to true
		if($empty == FALSE)
		{
			// try to delete the now empty directory
			if(!rmdir($directory))
			{
				// return false if not possible
				return FALSE;
			}
		}

		// return success
		return TRUE;
	}
}


#====================================================================================================
#	Function Name	:   RandomPassword
#====================================================================================================

function RandomPassword($num_letters) 
{ 
	$array = array( 
					 "a","b","c","d","e","f","g","h","i","j","k","l", 
					 "m","n","o","p","q","r","s","t","u","v","w","x","y", 
					  "z","1","2","3","4","5","6","7","8","9" 
					 ); 
	$uppercased = 3; 
	mt_srand ((double)microtime()*1000000); 
	for($i=0; $i<$num_letters; $i++) 
		$pass .= $array[mt_rand(0, (count($array) - 1))]; 

	for($i=1; $i<strlen($pass); $i++) 
	{ 
		if(substr($pass, $i, 1) == substr($pass, $i-1, 1)) 
			$pass = substr($pass, 0, $i) . substr($pass, $i+1); 
	} 
	for($i=0; $i<strlen($pass); $i++) 
	{ 
		if(mt_rand(0, $uppercased) == 0) 
			$pass = substr($pass,0,$i) . strtoupper(substr($pass, $i,1)) . 
			substr($pass, $i+1); 
	} 
	$pass = substr($pass, 0, $num_letters); 
	return($pass); 
}

////////////////////////////////////////////////////////
/////// function for paginations
///////////////////////////////////////////////////////

#====================================================================================================
#	Function Name		:	showPagination
#----------------------------------------------------------------------------------------------------
function showPagination($num_items, $add_prevnext_text = TRUE)
{
	global $lang;
	$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
	$base_url = $path_parts["basename"] . "?" . substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'],"&start")===false?strlen($_SERVER['QUERY_STRING']):strpos($_SERVER['QUERY_STRING'],"&start"));
	$total_pages = ceil($num_items/$_SESSION['page_size']);
	
	if ( $total_pages == 1 )
		return '';
	$on_page = floor($_SESSION['start_record'] / $_SESSION['page_size']) + 1;
	$page_string = '';
	if ( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;
		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="'. $base_url. "&amp;start=" . ( ( $i - 1 ) * $_SESSION['page_size'] )  . '" >' . $i . '</a>';
//				$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url. "&amp;start=" . ( ( $i - 1 ) * $_SESSION['page_size'] )  . '\';document.forms[0].submit();" >' . $i . '</a>';
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
				$page_string .= ($i == $on_page) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="'. $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['page_size'] )  . '" >' . $i . '</a>';
//					$page_string .= ($i == $on_page) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['page_size'] )  . '\'; document.forms[0].submit();">' . $i . '</a>';
				if ( $i <  $init_page_max + 1 )
					$page_string .= ' ';
			}
			$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
		}
		else
			$page_string .= ' ... ';

		for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>'  : '<a class=pageLink href="' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['page_size'] ) . '">' . $i . '</a>';
//				$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>'  : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if( $i <  $total_pages )
				$page_string .= " ";
		}
	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['page_size'] ) . '">' . $i . '</a>';
//				$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if ( $i <  $total_pages )
					$page_string .= " ";
		}
	}
	if ( $add_prevnext_text )
	{
		if ( $on_page > 1 )
//				$page_string = ' <a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $on_page - 2 ) * $_SESSION['page_size'] ) . '\'; document.forms[0].submit();">' . "Previous" . '</a>&nbsp;&nbsp;' . $page_string;
			$page_string = ' <a class=pageLink href="' . $base_url . "&amp;start=" . ( ( $on_page - 2 ) * $_SESSION['page_size'] ) . '">' . "Previous" . '</a>&nbsp;&nbsp;' . $page_string;
		else
			$page_string = '&nbsp;<font class="disabledText">Previous</font>&nbsp;' . $page_string;
		if ( $on_page < $total_pages )
//				$page_string .= '&nbsp;&nbsp;<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( $on_page * $_SESSION['page_size'] ) . '\';document.forms[0].submit();">' . "Next" . '</a>';
			$page_string .= '&nbsp;&nbsp;<a class=pageLink href="' . $base_url . "&amp;start=" . ( $on_page * $_SESSION['page_size'] ) . '">' . "Next" . '</a>';
		else
			$page_string .= '&nbsp;<font class="disabledText">Next</font>&nbsp;';
	}
	return $page_string;
}

/////////////////////////////////////////////
function showPaginationUser($num_items, $add_prevnext_text = TRUE)
{
	global $lang;
	$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
	$base_url = $path_parts["basename"] . "?" . substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'],"&start")===false?strlen($_SERVER['QUERY_STRING']):strpos($_SERVER['QUERY_STRING'],"&start"));
	$total_pages = ceil($num_items/$_SESSION['user_page_size']);
	
	if ( $total_pages == 1 )

		return '';

	$on_page = floor($_SESSION['start_record'] / $_SESSION['user_page_size']) + 1;
	$page_string = '<span class="sorting-pagination">';
	if ( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;
		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="'. $base_url. "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '" >' . $i . '</a>';
//				$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url. "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '\';document.forms[0].submit();" >' . $i . '</a>';
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
				$page_string .= ($i == $on_page) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="'. $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '" >' . $i . '</a>';
//					$page_string .= ($i == $on_page) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '\'; document.forms[0].submit();">' . $i . '</a>';
				if ( $i <  $init_page_max + 1 )
					$page_string .= ' ';
			}
			$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
		}
		else
			$page_string .= ' ... ';

		for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>'  : '<a class=pageLink href="' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '">' . $i . '</a>';
//				$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>'  : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if( $i <  $total_pages )
				$page_string .= " ";
		}

	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '">' . $i . '</a>';
//				$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if ( $i <  $total_pages )
					$page_string .= " ";
		}
	}
	
	if ( $add_prevnext_text )
	{
		if ( $on_page > 1 )
//				$page_string = ' <a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $on_page - 2 ) * $_SESSION['user_page_size'] ) . '\'; document.forms[0].submit();">' . "Previous" . '</a>&nbsp;&nbsp;' . $page_string;
			$page_string = ' <a class=blue-link href="' . $base_url . "&amp;start=" . ( ( $on_page - 2 ) * $_SESSION['user_page_size'] ) . '">' . "Prev" . '</a>&nbsp;&nbsp;' . $page_string .'</span>';
		else
			$page_string = '&nbsp;<font class="grey-link">Prev</font>&nbsp;' . $page_string.'</span>';
		if ( $on_page < $total_pages )
//				$page_string .= '&nbsp;&nbsp;<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( $on_page * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . "Next" . '</a>';
			$page_string .= '&nbsp;&nbsp;<a class=blue-link href="' . $base_url . "&amp;start=" . ( $on_page * $_SESSION['user_page_size'] ) . '">' . "Next" . '</a>';
		else
			$page_string .= '&nbsp;<font class="grey-link">Next</font>&nbsp;';
	}
	return $page_string.'';
}
function showPaginationUserHt($num_items,$link_name,$add_prevnext_text = TRUE)
{
	global $lang;
	$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
	
	/*echo substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'],"cat_link=")+3,strpos($_SERVER['QUERY_STRING'],"&")-(strpos($_SERVER['QUERY_STRING'],"cat_link=")+3));
	die;*/
	
	//$base_url = $path_parts["basename"] . "?" . substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'],"&start")===false?strlen($_SERVER['QUERY_STRING']):strpos($_SERVER['QUERY_STRING'],"&start"));
	$base_url = $link_name;// . substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'],"cat_link=")+3,strpos($_SERVER['QUERY_STRING'],"&")-(strpos($_SERVER['QUERY_STRING'],"cat_link=")+3));
	
	$total_pages = ceil($num_items/$_SESSION['user_page_size']);
	if( $total_pages == 1 )
			return '';
	$on_page = floor($_SESSION['start_record'] / $_SESSION['user_page_size']) + 1;
	$page_string = '';
	if( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;
		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="'. $base_url. "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '.html" >' . $i . '</a>';
			//$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url. "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '\';document.forms[0].submit();" >' . $i . '</a>';
			if ( $i <  $init_page_max )
				$page_string .= ' ';
		}
		if( $on_page > 1  && $on_page < $total_pages )
		{
			$page_string .= ( $on_page > 5 ) ? ' ... ' : ', ';
			$init_page_min = ( $on_page > 4 ) ? $on_page : 5;
			$init_page_max = ( $on_page < $total_pages - 4 ) ? $on_page : $total_pages - 4;
			for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
			{
				$page_string .= ($i == $on_page) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="'. $base_url . "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '.html" >' . $i . '</a>';
				//$page_string .= ($i == $on_page) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '\'; document.forms[0].submit();">' . $i . '</a>';
				if( $i <  $init_page_max + 1 )
					$page_string .= ' ';
			}
			$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
		}
		else
			$page_string .= ' ... ';
		for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>'  : '<a class=pageLink href="' . $base_url . "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '.html">' . $i . '</a>';
			//$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>'  : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if( $i <  $total_pages )
				$page_string .= " ";
		}
	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="' . $base_url . "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '.html">' . $i . '</a>';
			//$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if ( $i <  $total_pages )
				$page_string .= " ";
		}
	}
	if( $add_prevnext_text )
	{
		if( $on_page > 1 )
			//$page_string = ' <a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $on_page - 2 ) * $_SESSION['user_page_size'] ) . '\'; document.forms[0].submit();">' . "Previous" . '</a>&nbsp;&nbsp;' . $page_string;
			$page_string = ' <a class=pageLink href="' . $base_url . "_" . ( ( $on_page - 2 ) * $_SESSION['user_page_size'] ) . '.html">' . "Previous" . '</a>&nbsp;&nbsp;' . $page_string;
		else
			$page_string = '&nbsp;<font class="disabledText">Previous</font>&nbsp;' . $page_string;
		if( $on_page < $total_pages )
			//$page_string .= '&nbsp;&nbsp;<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( $on_page * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . "Next" . '</a>';
			$page_string .= '&nbsp;&nbsp;<a class=pageLink href="' . $base_url . "_" . ( $on_page * $_SESSION['user_page_size'] ) . '.html">' . "Next" . '</a>';
		else
			$page_string .= '&nbsp;<font class="disabledText">Next</font>&nbsp;';
	}
	return $page_string;
}
///////////////////////////////////////
function showPaginationUserHtWithoutNumber($num_items,$link_name,$add_prevnext_text = TRUE)
{
	global $lang;
	$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
	
	/*echo substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'],"cat_link=")+3,strpos($_SERVER['QUERY_STRING'],"&")-(strpos($_SERVER['QUERY_STRING'],"cat_link=")+3));
	die;*/
	
	//$base_url = $path_parts["basename"] . "?" . substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'],"&start")===false?strlen($_SERVER['QUERY_STRING']):strpos($_SERVER['QUERY_STRING'],"&start"));
	$base_url = $link_name;// . substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'],"cat_link=")+3,strpos($_SERVER['QUERY_STRING'],"&")-(strpos($_SERVER['QUERY_STRING'],"cat_link=")+3));
	
	$total_pages = ceil($num_items/$_SESSION['user_page_size']);
	if( $total_pages == 1 )
			return '';
	$on_page = floor($_SESSION['start_record'] / $_SESSION['user_page_size']) + 1;
	$page_string = '';
	if( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;
		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="'. $base_url. "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '.html" >' . $i . '</a>';
			//$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url. "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '\';document.forms[0].submit();" >' . $i . '</a>';
			if ( $i <  $init_page_max )
				$page_string .= ' ';
		}
		if( $on_page > 1  && $on_page < $total_pages )
		{
			$page_string .= ( $on_page > 5 ) ? ' ... ' : ', ';
			$init_page_min = ( $on_page > 4 ) ? $on_page : 5;
			$init_page_max = ( $on_page < $total_pages - 4 ) ? $on_page : $total_pages - 4;
			for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
			{
				$page_string .= ($i == $on_page) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="'. $base_url . "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '.html" >' . $i . '</a>';
				//$page_string .= ($i == $on_page) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '\'; document.forms[0].submit();">' . $i . '</a>';
				if( $i <  $init_page_max + 1 )
					$page_string .= ' ';
			}
			$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
		}
		else
			$page_string .= ' ... ';
		for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>'  : '<a class=pageLink href="' . $base_url . "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '.html">' . $i . '</a>';
			//$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>'  : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if( $i <  $total_pages )
				$page_string .= " ";
		}
	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="' . $base_url . "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '.html">' . $i . '</a>';
			//$page_string .= ( $i == $on_page ) ? '<font class=selsort>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if ( $i <  $total_pages )
				$page_string .= " ";
		}
	}
	if( $add_prevnext_text )
	{
		if( $on_page > 1 )
			//$page_string = ' <a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $on_page - 2 ) * $_SESSION['user_page_size'] ) . '\'; document.forms[0].submit();">' . "Previous" . '</a>&nbsp;&nbsp;' . $page_string;
			$page_string = ' <a class="prv" href="' . $base_url . "_" . ( ( $on_page - 2 ) * $_SESSION['user_page_size'] ) . '.html">' . "&nbsp;" . '</a>&nbsp;&nbsp;' ;
		else
			$page_string = '&nbsp;&nbsp;' ;
		if( $on_page < $total_pages )
			//$page_string .= '&nbsp;&nbsp;<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( $on_page * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . "Next" . '</a>';
			$page_string .= '&nbsp;&nbsp;<a class=nxt href="' . $base_url . "_" . ( $on_page * $_SESSION['user_page_size'] ) . '.html">' . "&nbsp;" . '</a>';
		else
			$page_string .= '&nbsp;&nbsp;';
	}
	return $page_string;
}
function showPaginationUserHtWithoutHTML($num_items,$link_name,$add_prevnext_text = TRUE)
{
	global $lang;
	$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
	
	/*echo substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'],"cat_link=")+3,strpos($_SERVER['QUERY_STRING'],"&")-(strpos($_SERVER['QUERY_STRING'],"cat_link=")+3));
	die;*/
	
	//$base_url = $path_parts["basename"] . "?" . substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'],"&start")===false?strlen($_SERVER['QUERY_STRING']):strpos($_SERVER['QUERY_STRING'],"&start"));
	$base_url = $link_name;// . substr($_SERVER['QUERY_STRING'],strpos($_SERVER['QUERY_STRING'],"cat_link=")+3,strpos($_SERVER['QUERY_STRING'],"&")-(strpos($_SERVER['QUERY_STRING'],"cat_link=")+3));
	
	$total_pages = ceil($num_items/$_SESSION['user_page_size']);
	if( $total_pages == 1 )
			return '';
	$on_page = floor($_SESSION['start_record'] / $_SESSION['user_page_size']) + 1;
	$page_string = '';
	if( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;
		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="'. $base_url. "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '" >' . $i . '</a>';
			//$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url. "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '\';document.forms[0].submit();" >' . $i . '</a>';
			if ( $i <  $init_page_max )
				$page_string .= ' ';
		}
		if( $on_page > 1  && $on_page < $total_pages )
		{
			$page_string .= ( $on_page > 5 ) ? ' ... ' : ', ';
			$init_page_min = ( $on_page > 4 ) ? $on_page : 5;
			$init_page_max = ( $on_page < $total_pages - 4 ) ? $on_page : $total_pages - 4;
			for($i = $init_page_min - 1; $i < $init_page_max + 2; $i++)
			{
				$page_string .= ($i == $on_page) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="'. $base_url . "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '" >' . $i . '</a>';
				//$page_string .= ($i == $on_page) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] )  . '\'; document.forms[0].submit();">' . $i . '</a>';
				if( $i <  $init_page_max + 1 )
					$page_string .= ' ';
			}
			$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
		}
		else
			$page_string .= ' ... ';
		for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>'  : '<a class=pageLink href="' . $base_url . "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '">' . $i . '</a>';
			//$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>'  : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if( $i <  $total_pages )
				$page_string .= " ";
		}
	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="' . $base_url . "_" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '">' . $i . '</a>';
			//$page_string .= ( $i == $on_page ) ? '<font class=activePage>' . $i . '</font>' : '<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $i - 1 ) * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . $i . '</a>';
			if ( $i <  $total_pages )
				$page_string .= " ";
		}
	}
	if( $add_prevnext_text )
	{
		if( $on_page > 1 )
			//$page_string = ' <a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( ( $on_page - 2 ) * $_SESSION['user_page_size'] ) . '\'; document.forms[0].submit();">' . "Previous" . '</a>&nbsp;&nbsp;' . $page_string;
			$page_string = ' <a class=pageLink href="' . $base_url . "_" . ( ( $on_page - 2 ) * $_SESSION['user_page_size'] ) . '">' . "Previous" . '</a>&nbsp;&nbsp;' . $page_string;
		else
			$page_string = '&nbsp;<font class="disabledText">Previous</font>&nbsp;' . $page_string;
		if( $on_page < $total_pages )
			//$page_string .= '&nbsp;&nbsp;<a class=pageLink href="javascript: document.forms[0].action=\'' . $base_url . "&amp;start=" . ( $on_page * $_SESSION['user_page_size'] ) . '\';document.forms[0].submit();">' . "Next" . '</a>';
			$page_string .= '&nbsp;&nbsp;<a class=pageLink href="' . $base_url . "_" . ( $on_page * $_SESSION['user_page_size'] ) . '">' . "Next" . '</a>';
		else
			$page_string .= '&nbsp;<font class="disabledText">Next</font>&nbsp;';
	}
	return $page_string;
}
function showPaginationClubNews($num_items, $add_prevnext_text = TRUE)
{
	global $lang;
	$path_parts = pathinfo($_SERVER['SCRIPT_FILENAME']);
	$base_url = $path_parts["basename"] . "?" . substr($_SERVER['QUERY_STRING'], 0, strpos($_SERVER['QUERY_STRING'],"&start")===false?strlen($_SERVER['QUERY_STRING']):strpos($_SERVER['QUERY_STRING'],"&start"));
	$total_pages = ceil($num_items/2);
	
	if ( $total_pages == 1 )

		return '';

	$on_page = floor($_SESSION['start_record'] / 2) + 1;
	$page_string = '';
	if ( $total_pages > 10 )
	{
		$init_page_max = ( $total_pages > 3 ) ? 3 : $total_pages;
		for($i = 1; $i < $init_page_max + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<li class="active"><a href="#">' . $i . '</li></a>' : '<li><a href="'. $base_url. "&amp;start=" . ( ( $i - 1 ) * 2 )  . '" >' . $i . '</a></li>';
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
				$page_string .= ($i == $on_page) ? '<li class="active"><a href="#">' . $i . '</a></li>' : '<li><a href="'. $base_url . "&amp;start=" . ( ( $i - 1 ) * 2 )  . '" >' . $i . '</a></li>';
				if ( $i <  $init_page_max + 1 )
					$page_string .= ' ';
			}
			$page_string .= ( $on_page < $total_pages - 4 ) ? ' ... ' : ', ';
		}
		else
			$page_string .= ' ... ';

		for($i = $total_pages - 2; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<li class="active"><a href="#">' . $i . '</a></li>'  : '<li><a href="' . $base_url . "&amp;start=" . ( ( $i - 1 ) * 2 ) . '">' . $i . '</a></li>';
			if( $i <  $total_pages )
				$page_string .= " ";
		}

	}
	else
	{
		for($i = 1; $i < $total_pages + 1; $i++)
		{
			$page_string .= ( $i == $on_page ) ? '<li class="active"><a href="#">' . $i . '</a></li>' : '<li><a href="' . $base_url . "&amp;start=" . ( ( $i - 1 ) * 2 ) . '">' . $i . '</a></li>';
			if ( $i <  $total_pages )
					$page_string .= " ";
		}
	}
	
	if ( $add_prevnext_text )
	{
		if ( $on_page > 1 )
			$page_string = '<li><a href="' . $base_url . "&amp;start=" . ( ( $on_page - 2 ) * 2 ) . '">' . "Prev" . '</a></li>' . $page_string .'';
		else
			$page_string = '<li><a href="#">Prev</a></li>' . $page_string.'';
		if ( $on_page < $total_pages )
			$page_string .= '<li><a href="' . $base_url . "&amp;start=" . ( $on_page * 2 ) . '">' . "Next" . '</a></li>';
		else
			$page_string .= '<li><a href="#">Next</a></li>';
	}
	return '<div class="pagination"><ul>'.$page_string.'</ul></div>';
}

	
function link_replace($string,$replace_with)
{
	$arr_wildchar = array("`","~","!","%","^","*","(",")","{","}"," ",":", );
	if (!in_array($string, $arr_wildchar)) 
	{
		$new_string = str_replace($arr_wildchar, $replace_with, $string);
	}
	return $new_string;
}

function CheckLinkInHtaccess($html_link)
{
	global $physical_path;
	// read file and store in one array
	$i = 0;
	
	$fd = fopen ($physical_path['Site_Root'] . ".htaccess", "r"); 
	
	while (!feof ($fd)) 
	{ 
		$buffer[$i] = fgets($fd, 4096); 
		$i++;
	} 
	fclose ($fd); 

	// check for link line by line
	foreach($buffer as $key => $val)
	{
		list($a,$b) = explode("^",$val);
		list($c) = explode(".",$b);
		$new = substr($c,0,-1);
		if($new == $html_link)
		{
			$flag[$key] = 0;
		}
		else
		{
			$flag[$key] = 1;
		}
	}
/*	echo "<pre>";
	print_r ($flag);
	echo "</pre>";die;*/
	return ($flag);
}


function WriteLinkInHtaccess($html_link,$replaced_link)
{
//		$replaced_link = page.php?pid=1
	global $physical_path;

	$file_contents = readFileContent($physical_path['Site_Root'] . ".htaccess");
	$new_link	=	'RewriteRule ^'.$html_link.'\.html$ '.$replaced_link."\n";		
	$new_file_contents = $file_contents . $new_link;
	writeFileContent($physical_path['Site_Root'].".htaccess", $new_file_contents);	
}
	
function DeleteLinkInHtaccess($html_link,$delete_link)
{
//		$replaced_link = page.php?pid=1
	global $physical_path;

	$i = 0;
	$fd = fopen ($physical_path['Site_Root'] . ".htaccess", "r"); 
	while (!feof ($fd)) 
	{ 
		$buffer[$i] = fgets($fd, 4096); 
		$i++;
	} 
	fclose ($fd); 
	$del_link	=	'RewriteRule ^'.$html_link.'\.html$ '.$delete_link."\n";	
	
	$file_content = "";
	foreach($buffer as $key => $val)
	{
		if(trim($val) == trim($del_link))
		{
			
		}
		else
		{
			$file_content = $file_content.$val;
		}
	}
	writeFileContent($physical_path['Site_Root'].".htaccess", $file_content);

}

function getUniqueCategoryLink($table_name, $field_name, $field_id, $field_link, $cat_name, $action, $cat_id="")
{
	global $db;
	
	$arr_spchar = array("`","~","!","%","^","*","(",")","{","}","[","]","&","$","#","@",":","_","/","\\","+",",",".","?","'",'"');
	$str = str_replace($arr_spchar,"", $cat_name);
	$new_string = strtolower($str);
	
	$new_string1 = str_replace(" ","-", $new_string);
	$final_string = str_replace("--","-", $new_string1);

	if($action == 'add')
	{
		$sql = " SELECT * FROM ".$table_name." WHERE ".$field_link." like '".$final_string."%' ";
		$db->query($sql);
		$rscnt = $db->num_rows();
		$i = $rscnt;
		while($db->next_record())
		{	
			$db_catlink = $db->f($field_link);
			if($db_catlink == $final_string)
			{
				$final_string = $db_catlink."-".$i;
			}
			$i++;
		}
	}		
	if($action == 'edit')
	{
		$sql1 = " SELECT * FROM ".$table_name." WHERE ".$field_id." = '".$cat_id."' ";
		$db->query($sql1);
		$db->next_record();
		$db_cat_name = $db->f($field_name);
		if($db_cat_name != $cat_name)
		{
			$sql = " SELECT * FROM ".$table_name." WHERE ".$field_link." like '".$final_string."%' AND ".$field_id." <> '".$cat_id."' ";
			$db->query($sql);
			$rscnt = $db->num_rows();
			$i = $rscnt;
			while($db->next_record())
			{	
				$db_catlink = $db->f($field_link);
				if($db_catlink == $final_string)
				{
					$final_string = $db_catlink."-".$i;
				}
				$i++;
			}	
		} else
		{
			$final_string = $db->f($field_link);
		}
	}
 	return $final_string;
}

function CheckPageLink($html_link)
{
	$arr_spchar = array("`","~","!","%","^","*","(",")","{","}","[","]","&","$","#","@",":","_","/","\\","+",",",".","?");
	$str = str_replace($arr_spchar,"-", $html_link);
	$new_string = strtolower($str);
	
	$new_string1 = str_replace(" ","-", $new_string);
	$final_string = str_replace("--","-", $new_string1);
	return $final_string;
}

function getUniqueActivationCode()
{
    list($usec, $sec) = explode(" ",microtime());
	list($trash, $usec) = explode(".",$usec);
    return (date("YmdHis").substr(($sec + $usec), -10));
}

function CheckFileType($type)
{
	if($type=='gif'||$type=='png'||$type=='jpg'||$type=='jpeg'||$type=='bmp')
	{
		$type='IMAGE';
	}
	else
	{
		$type='FILE';
	}
	return $type;
}

	#====================================================================================================
	#	Function Name	:   IsLinkValid($table_name,$cat_link,$cat_link_val)
	#----------------------------------------------------------------------------------------------------
	function IsLinkValid($table_name,$cat_link,$cat_link_val,$status=0)
	{
		global $db;
		$sql= " SELECT count(*) as cnt FROM ".$table_name
			 ." WHERE ".$cat_link."= '".$cat_link_val."'"; 
		
		if($status == '1')
		{
			$sql .= " AND status = '1'";
		}
		
		
		$db->query($sql);
		$db->next_record();
		if($db->f("cnt") == 0)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}	
	
	function getMenuLinkPath($menu_id,$i=0)
{
	global $db,$db1;
	$sql = " SELECT * FROM ".MENU_MASTER. " WHERE menu_id = '".$menu_id."'";
	$db->query($sql);
	$rscnt = $db->num_rows();
	if($rscnt > 0)
	{
		$db->next_record();
		$navigation = getMenuLinkPath($db->f('parent_id'),$i+1);
		if($i != 0)
		{
			$sql1 = " SELECT * FROM ".MENU_MASTER. " WHERE menu_id = '".$menu_id."'";
			$db1->query($sql1);
			$db1->next_record();
			$navigation .= ' : <a href="menu.php?parent_id='.$menu_id.'" class="actionLink"><strong>'.$db1->f('menu_title').'</strong></a>';
		}
		else
		{
			$sql1 = " SELECT * FROM ".MENU_MASTER. " WHERE menu_id = '".$menu_id."'";
			$db1->query($sql1);
			$db1->next_record();
			$navigation .= ' : '.$db1->f('menu_title').'';
		}
	}
	else
	{
		if($i != 0)
			$navigation = '<a href="menu.php?parent_id=0" class="actionLink"><strong>Path</strong></a>';
	}
 	return $navigation;
}

function Admin_Get_Menu($menu_id,$path)
{
	global $db;
	$i = 0;
	$arry = array();
	
	if($path != '')
		$path_new = $path . "_";
	else
		$path_new = $path;
	
	
	$sql="SELECT * FROM ".MENU_MASTER." WHERE parent_id=".$menu_id." AND status = '1' ORDER BY disp_order";
	//$sql="SELECT * FROM ".MENU_MASTER." WHERE parent_id=".$menu_id." AND status = '1' ORDER BY disp_order";
	
	$db->query($sql);
	while($db->next_record())
	{
		$arry[$i]['parent_id'] 	= $db->f('parent_id');
		$arry[$i]['menu_id'] 	= $db->f('menu_id');
		$arry[$i]['menu_title'] = $db->f('menu_title');
		$arry[$i]['menu_url'] 	= $db->f('menu_url');
		$arry[$i]['path']		= $path_new . $db->f('menu_id');
		$i++;
	} 
	return $arry;
}

function Admin_GetMenuTree($menu_id=0, $str='', $path = '')
{
	$mstr = '';
	$menus = Admin_Get_Menu($menu_id, $path);
	//print_r($menus);
	$cnt = count($menus);
	if($cnt > 0)
	{
		$mstr .= "<ul>";
		for($i = 0; $i < $cnt; $i++)
		{			
		   	if(count(Admin_Get_Menu($menus[$i]['menu_id'], $menus[$i]['path'])) > 0)
		  	{
				$mstr .="<li><a href='".$menus[$i]['menu_url']."'>".$menus[$i]['menu_title']."</a>";
				$mstr .= Admin_GetMenuTree($menus[$i]['menu_id'],$str, $menus[$i]['path']) . "</li>";
			}
			else
			{
				$mstr .="<li><a href='".$menus[$i]['menu_url']."'>".$menus[$i]['menu_title']."</a>";
				$mstr .= Admin_GetMenuTree($menus[$i]['menu_id'],$str, $menus[$i]['path']) ."</li>";
			}
		}

		$mstr.= "</ul>";
	}
	return($mstr);
}
	
	function GetFrontMenu($menu_id=0, $path = '', $site_root_for_menu,$left_right,$currrent_url)
	{
		$mstr 	= '';
		$menu 	= GetSubMenu($menu_id, $path,$left_right);
		$cnt 	= count($menu);
		if($cnt > 0)
		{
			if($left_right==1)
				$mstr .= '<ul class="leftmenu">';
			elseif($left_right==2)
				$mstr .= '<ul class="rightmenu">';
				
			for($i = 0; $i < $cnt; $i++)
			{	
				if($currrent_url==$menu[$i]['menu_url'])
				{
					$class		=	'class="current select"';
				}
				else
				{
					$class	=	'';
				}
				
				if($menu[$i]['menu_url']=='#')
				{
					if($menu_id == 0)
					{
						$mstr .= "<li><a href='".$menu[$i]['menu_url']."' ".$class."><span>".$menu[$i]['menu_title']."</span></a>";
					}
					else
					{
						$mstr .= "<li><a href='".$menu[$i]['menu_url']."' ".$class.">".$menu[$i]['menu_title']."</a>";
					}
				}
				else
				{
					if($menu_id == 0)
					{
						$mstr .= "<li><a href='".$site_root_for_menu.$menu[$i]['menu_url']."' ".$class."><span>".$menu[$i]['menu_title']."</span></a>";
					}
					else
					{
						$mstr .= "<li><a href='".$site_root_for_menu.$menu[$i]['menu_url']."' ".$class.">".$menu[$i]['menu_title']."</a>";
					}
				}
				//$mstr .= GetFrontMenu($menu[$i]['menu_id'], $menu[$i]['path'], $site_root_for_menu,$left_right,$currrent_url)."</li>";
			}
			$mstr .= "</ul>";
		}
		return($mstr);
	}
	
	function GetSubMenu($menu_id, $path,$left_right)
	{
		global $db;
		$i = 0;
		$arry = array();
		if($path != '')
			$bs_path_new = $path . "_";
		else
			$bs_path_new = $path;
			
		$sql = "SELECT * FROM " . FRONT_MENU_MASTER . " WHERE parent_id = " . $menu_id . " AND status = '1' AND left_right='".$left_right."' ORDER BY disp_order ASC";
		$db->query($sql);
		while ($db->next_record()) 
		{
			$arry[$i]['parent_id'] 	= $db->f('parent_id');
			$arry[$i]['menu_id'] 	= $db->f('menu_id');
			$arry[$i]['menu_title'] = $db->f('menu_title');
			$arry[$i]['menu_url'] 	= $db->f('menu_url');
			$arry[$i]['path']		= $bs_path_new . $db->f('menu_id');
			$i++;
		} 
		return $arry;
	}
	

function getMenuImage_Front()
{
	global $db,$db1;
//	print_r($path_parts);
	$remaining_url = explode(INSTALL_DIR,$_SERVER['REQUEST_URI']);
 	$sql = "SELECT * FROM ". FRONT_MENU_MASTER." WHERE menu_url = '".$remaining_url[1]."' AND status=1 ";
	$db->query($sql);
	$db->next_record();
	if($db->f('banner_image') == "")
	{
		$sql2 = "SELECT * FROM ". FRONT_MENU_MASTER." WHERE menu_id = '".$db->f('parent_id')."'  AND status=1 ";
		$db1->query($sql2);
		$db1->next_record();
		if($db1->f('banner_image') == "")
		{
			return 0;
		}
		else
		{
			return ($db1->f('banner_image'));
		}
	}
	else
	{
		return ($db->f('banner_image'));
	}
}
function getMenu($menu_id)
{
	global $db1;
	$i = 0;
	$arry = array();
	$sql = "SELECT * FROM ".FRONT_MENU_MASTER." WHERE menu_id ='" . $menu_id . "' AND status = '1' ORDER BY disp_order";
	$db1->query($sql);
	$db1->next_record();
	$arry['menu_id']	= $db1->f('menu_id');
	$arry['parent_id']	= $db1->f('parent_id');
	$arry['menu_title']	= $db1->f('menu_title');
	$arry['menu_url']	= $db1->f('menu_url');
	 
	return $arry;
}
function getBreadcrumb_Front()
{
	global $db,$virtual_path;
	$flag=0;
	$remaining_url = explode(INSTALL_DIR,$_SERVER['REQUEST_URI']);
	$sql	=	"SELECT * FROM ".FRONT_MENU_MASTER." WHERE menu_url='".$remaining_url[1]."' AND status=1";
	//echo $sql;die;
	$db->query($sql);
	$db->next_record();
	$menu_path	=	$db->f('path');
	$currentTitle	=	$db->f('menu_title');
	$currentURL	=	$db->f('menu_url');
	if($menu_path=='')
	{
		$db->free();
		$currentURL='';
		$remaining_url = explode(INSTALL_DIR,$_SERVER['HTTP_REFERER']);
		$sql	=	"SELECT * FROM ".FRONT_MENU_MASTER." WHERE menu_url='".$remaining_url[1]."' AND status=1";
		//echo $sql;die;
		$db->query($sql);
		$db->next_record();
		$menu_path	=	$db->f('path');
		$currentTitle	=	$db->f('menu_title');
		$currentURL	=	$db->f('menu_url');
		//echo $currentURL;die;
		$flag=1;
	}
	$pathArray = explode('/',$menu_path);
	//print_r ($menu_path);die;
	$breadcrumb='';
	$temp = array();
	for($i=0;$i<count($pathArray);$i++)
	{
		if($pathArray[$i]==0)
		{
			$breadcrumb	.=	'<a href="'.$virtual_path['Site_Root'].'index.php">Video Production</a>';
		}
		else
		{
			$temp	=	getMenu($pathArray[$i]);
			/*echo "<pre>";
			print_r ($temp);
			echo "</pre>";die;*/
			$title	=	'';
			$breadcrumb	.=	'&nbsp;&gt;&nbsp;';
			if($temp['menu_title']=='Services')
			{
				$title	=	'Video Production Services';
			}
			else if($temp['menu_title']=='Testimonials')
			{
				$title	=	'Client Testimonials';
			}
			else
			{
				$title	=	$temp['menu_title'];
			}
			
			if($temp['menu_url']=='#')
			{
				$breadcrumb	.= '<a href="'.$temp['menu_url'].'">'.$title.'</a>';
			}
			else
			{
				$breadcrumb	.= '<a href="'.$virtual_path['Site_Root'].$temp['menu_url'].'">'.$title.'</a>';
			}
		}
	}
	
	if($flag==1)
	{
		if($currentURL!='#')
		{
			$breadcrumb	.=	'&nbsp;&gt;&nbsp;<a href="'.$virtual_path['Site_Root'].$currentURL.'">'.$currentTitle.'</a>';
		}
		else
		{
			$breadcrumb	.=	'&nbsp;&gt;&nbsp;<a href="'.$currentURL.'">'.$currentTitle.'</a>';
		}
	}
	else
	{
		$breadcrumb	.=	'&nbsp;&gt;&nbsp;'.$currentTitle;
	}
	return $breadcrumb;
	
}
function getCategoryLinkPath($category_id,$i=0)
{
	global $db,$db1;
	$sql = " SELECT * FROM ".CATEGORY_MASTER
		 . " WHERE cat_id = '".$category_id."'";
	$db->query($sql);
	$rscnt = $db->num_rows();
	if($rscnt > 0)
	{
		$db->next_record();
		$navigation = getCategoryLinkPath($db->f('cat_parent_id'),$i+1);
		if($i != 0)
		{
			$sql1 = " SELECT * FROM ".CATEGORY_MASTER
				 . " WHERE cat_id = '".$category_id."'";
			$db1->query($sql1);
			$db1->next_record();
			$navigation .= ' :: <a href="category.php?cat_parent_id='.$category_id.'" class="actionLink"><strong>'.$db1->f('cat_name').'</strong></a>';
		}
		else
		{
			$sql1 = " SELECT * FROM ".CATEGORY_MASTER
				 . " WHERE cat_id = '".$category_id."'";
			$db1->query($sql1);
			$db1->next_record();
			$navigation .= ' :: '.$db1->f('cat_name').'';
		}
	}
	else
	{
		if($i != 0)
			$navigation = '<a href="category.php?cat_parent_id=0" class="actionLink"><strong>Path</strong></a>';
	}
 	return $navigation;
}

function get_menu($menu_id)
{
	global $db1, $virtual_path;
	$i = 0;
	$arry = array();
	$sql = "SELECT * FROM ".MENU_MASTER
		." WHERE parent_id ='" . $menu_id . "' "
		." ORDER BY disp_order";
	$db1->query($sql);
	while ($i < $db1->num_rows()) 
	{
		$db1->next_record();
		$arry[$i]['parent_id'] 	= $db1->f('parent_id');
		$arry[$i]['menu_id'] 	= $db1->f('menu_id');
		$arry[$i]['menu_title'] = $db1->f('menu_title');
		$arry[$i]['menu_url'] 	= $db1->f('menu_url');
		if($db1->f('status') == 1)
		{
         	$arry[$i]['status'] = '<a href="JavaScript: ToggleStatus_Click(\''.$db1->f('menu_id').'\', \'0\');" class="actionLink">Hide</a>';
		}
		else
		{
         	$arry[$i]['status'] = '<a href="JavaScript: ToggleStatus_Click(\''.$db1->f('menu_id').'\', \'1\');" class="actionLink">Show</a>';
		}
		$arry[$i]['edit'] 		= '<img src="'.$virtual_path['Site_Root'].'templates/images/icon-edit.gif" class="imgAction" title="Edit" onClick="JavaScript: Edit_Click('.$db1->f('menu_id').');">';
		$arry[$i]['delete']		= '<img src="'.$virtual_path['Site_Root'].'templates/images/icon-delete.gif" class="imgAction" title="Delete" onClick="JavaScript: Delete_Click('.$db1->f('menu_id').');">';
		$i++;
	} 
 return $arry;
}

function GetMenuTree($menu_id=0, $line='', $cnt1='')
{
	$menu = get_menu($menu_id);
	$cnt = count($menu);
	if($cnt)
	{
		for($i=0; $i < $cnt; $i++)
		{			
			$str1 .= "<li id='listItem_".$menu[$i]['menu_id']."' class='odd'>
						<table width='100%'>
							<tr id='row_".$menu[$i]['menu_id']."' class='odd'>
								<td align='center'><input class='stdCheckBox' type='checkbox' name='menus[]' value='".$menu[$i]['menu_id']."'></td>
								<td>" . $line . ' '.$menu[$i]['menu_title']."</td>
								<td align='center'>".$menu[$i]['menu_url']."</td>
								<td align='center'>".$menu[$i]['status']."</td>
								<td align='center'>".$menu[$i]['edit']."</td>
								<td align='center'>".$menu[$i]['delete']."</td>
							</tr>
						</table>
					 </li>
					 ";
			$str1 .= GetMenuTree($menu[$i]['menu_id'],$line.'&nbsp;&nbsp;&nbsp;', $cnt1);
		}
	}
	return($str1); 
}
	
	function getMenuPath($menuId)
	{
		global $db1;
		$sql = " SELECT * FROM ".MENU_MASTER." WHERE menu_id  = '".$menuId."'";
		$rs = $db1->query($sql);
		$db1->next_record();
		return ($db1->f('path'));
	}
	
	function TotalPage()
	{
		global $db;
		$sql = "SELECT COUNT(*) AS CNT FROM ".PAGE_MASTER;
		$db->query($sql);
		$db->next_record();
		return ($db->f('CNT'));
	}
	
	function TotalEvents()
	{
		global $db;
		$sql = "SELECT COUNT(*) AS CNT FROM ".EVENTS_MASTER;
		$db->query($sql);
		$db->next_record();
		return ($db->f('CNT'));
	}
	
	function TotalBlogs()
	{
		global $db;
		$sql = "SELECT COUNT(*) AS CNT FROM ".BLOG_POST;
		$db->query($sql);
		$db->next_record();
		return ($db->f('CNT'));
	}
	
	function TotalBlogComments()
	{
		global $db;
		$sql = "SELECT COUNT(*) AS CNT FROM ".BLOG_COMMENTS;
		$db->query($sql);
		$db->next_record();
		return ($db->f('CNT'));
	}
?>
