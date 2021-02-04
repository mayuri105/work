<?php

#====================================================================================================
#	File Name	:	thumbnail.php
#----------------------------------------------------------------------------------------------------
#
#	Purpose		: 	Define a thumbnail class that can be used to create the thumbnail
#					of the image.
#					Autodetect file extension : .jpg/jpeg, .gif, .png and .wbmp
#					GD support : 2
#
#	Author		: 	Dinesh Sailor <ask4dinesh@rediffmail.com>
#	Created		: 	03-June-2003
#
#	Version		: 	1.0
#
#	How To		:
#					$thumb=new thumbnail();                 // initiate the thumbnail generator and set the gd version
#					$thumb->image($filename);               // set the image file
#					$thumb->size_width(100);                // set width for thumbnail, or
#					$thumb->size_height(300);               // set height for thumbnail, or
#					$thumb->size_auto(200);                 // set the biggest width or height for thumbnail
#					$thumb->jpeg_quality(75);               // [OPTIONAL] set quality for jpeg only (0 - 100) (worst - best), default = 75
#					$thumb->show();                         // show your thumbnail directly in browser, or
#					$thumb->get();                          // get your thumbnail as filename, or
#					$thumb->save("./thumb_img");        	// save your thumbnail to specified file
#
#====================================================================================================

class thumbnail
{
	var $img;
    var $gd_version;

	function thumbnail()
	{
    	// Check the gd version
    	$this->gd_version = $this->check_gd();
    }

   	function show()
    {
    	// Create thumb and show the images
    	$this->create(true);
    }

	function get()
	{
    	// Create thumb and return the file name
    	return $this->create(false);
	}

	function get1()
	{
    	// Create thumb and return the file name
    	return $this->create1(false);
	}

	function get2()
	{
    	// Create thumb and return the file name
    	return $this->create2(false);
	}


	function save($save="")
	{
		//Save thumb
		if (empty($save)) $save=strtolower("./". $this->img["dirname"]. "/thumb_". $this->img["basename"]);

        // Create the thumb and save into file
        return $this->create($dispay=false, $save);
	}

	function check_gd()
    {

	    $gd_version=1;

	    ob_start();

	    phpinfo(8);
	    $phpinfo=ob_get_contents();

	    ob_end_clean();

	    $phpinfo=strip_tags($phpinfo);
	    $phpinfo=stristr($phpinfo,"gd version");
	    $phpinfo=stristr($phpinfo,"version");

	    preg_match('/\d/',$phpinfo,$gd);

	    if ($gd[0]=='2'){$gd_version=2;}

	    return $gd_version;
	}

    function image($imgfile)
    {
        // Check for file existance
	    if (!file_exists($imgfile))
        {
	        $this->img["error"] = "The file $imgfile does not exist";
	        // echo $this->img["error"];
            return;
        }

        //detect image extension, name and dirname
		$this->img=pathinfo($imgfile);

        switch(strtoupper($this->img["extension"]))
        {
			// JPG, JPEG
        	case "JPG":
			case "JPEG":
	            $this->img["extension"]="JPEG";
	            $this->img["src"] = @ImageCreateFromJPEG ($imgfile);
				break;

			//PNG
			case "PNG":
	            $this->img["extension"]="PNG";
	            $this->img["src"] = @ImageCreateFromPNG($imgfile);
				break;

			//GIF
			case "GIF":
	            $this->img["extension"]="GIF";
	            $this->img["src"] = @ImageCreateFromGIF($imgfile);
				break;

			//WBMP
			case "WBMP":
	            $this->img["extension"]="WBMP";
	            @$this->img["src"] = ImageCreateFromWBMP($imgfile);
				break;

			//DEFAULT
            default:
                $this->img["error"] = "Not Supported File !!";
	            // echo $this->img["error"];
	            return;
        }

		// Height and width of image
		@$this->img["width"] = ImageSX($this->img["src"]);
		@$this->img["height"] = ImageSY($this->img["src"]);

		//default quality jpeg
		$this->img["quality"]=75;
	}

    function src_width()
    {
    	return $this->img['width'];
    }

    function src_height()
    {
    	return $this->img['height'];
    }

	function size_height($size=100)
	{
		//height
    	$this->img["height_thumb"]=$size;
    	@$this->img["width_thumb"] = ($this->img["height_thumb"]/$this->img["height"])*$this->img["width"];
	}

	function size_width($size=100)
	{
		//width
		$this->img["width_thumb"]=$size;
    	@$this->img["height_thumb"] = ($this->img["width_thumb"]/$this->img["width"])*$this->img["height"];
	}

	function size_auto($size=100)
	{
		//size
		if ($this->img["width"]>=$this->img["height"]) {
    		$this->img["width_thumb"]=$size;
    		@$this->img["height_thumb"] = ($this->img["width_thumb"]/$this->img["width"])*$this->img["height"];
		} else {
	    	$this->img["height_thumb"]=$size;
    		@$this->img["width_thumb"] = ($this->img["height_thumb"]/$this->img["height"])*$this->img["width"];
 		}
	}

	function size_fix($width, $height)
	{
		$this->img["width_thumb"]	=	$width;
    	$this->img["height_thumb"]	=	$height;
	}

	function jpeg_quality($quality=75)
	{
		//jpeg quality
		$this->img["quality"]=$quality;
	}

	function create($dispay=true, $save="")
	{
    	if(isset($this->img["error"]))	return;
		//Show thumb
        if($dispay)
			@header("Content-Type: image/".$this->img["extension"]);

   		//Save thumb
    	if($save == "")
	        $tmpimg = $this->img["dirname"]. "/thumb_". $this->img["basename"];
        else
			$tmpimg = $save. ".". strtolower($this->img["extension"]);
			
        // Create destinatin image and 
		// Copies a rectangular portion of src image to des image and smoothly interpolating pixel values 
		if($this->gd_version == 2)
		{
			$this->img["des"] = ImageCreateTrueColor($this->img["width_thumb"],$this->img["height_thumb"]);
			@ImageCopyResampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"], $this->img["height_thumb"], $this->img["width"], $this->img["height"]);
		}
        else
		{
			$this->img["des"] = ImageCreate($this->img["width_thumb"],$this->img["height_thumb"]);
			@ImageCopyResized ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"], $this->img["height_thumb"], $this->img["width"], $this->img["height"]);
		}

        // Display the image directly in browser
        if($dispay)
        {
	        switch(strtoupper($this->img["extension"]))
	        {
	            // JPG, JPEG
	            case "JPG":
	            case "JPEG":
	                imageJPEG($this->img["des"],"",$this->img["quality"]);
	                break;

	            //PNG
	            case "PNG":
	                imagePNG($this->img["des"]);
	                break;

	            //GIF
	            case "GIF":
	                imageGIF($this->img["des"]);
	                break;

	            //WBMP
	            case "WBMP":
	                imageWBMP($this->img["des"]);
	                break;

	            //DEFAULT
	            default:
	                $this->img["error"] = "Not Supported File !!";
	                // echo $this->img["error"];
	                return;
	        }
        }
		// Save the image into file
        else
        {
	        switch(strtoupper($this->img["extension"]))
	        {
	            // JPG, JPEG
	            case "JPG":
	            case "JPEG":
	                imageJPEG($this->img["des"], $tmpimg, $this->img["quality"]);
	                break;

	            //PNG
	            case "PNG":
	                imagePNG($this->img["des"], $tmpimg);
	                break;

	            //GIF
	            case "GIF":
	                imageGIF($this->img["des"], $tmpimg);
	                break;

	            //WBMP
	            case "WBMP":
	                imageWBMP($this->img["des"], $tmpimg);
	                break;

	            //DEFAULT
	            default:
	                $this->img["error"] = "Not Supported File !!";
	                // echo $this->img["error"];
	                return;
	        }

            return $tmpimg;
        }
	}

//thumb 1	
	function create1($dispay=true, $save="")
	{
    	if(isset($this->img["error"]))	return;
		//Show thumb
        if($dispay)
			@header("Content-Type: image/".$this->img["extension"]);

   		//Save thumb
    	if($save == "")
	        $tmpimg = $this->img["dirname"]. "/big_thumb_". $this->img["basename"];
        else
			$tmpimg = $save. ".". strtolower($this->img["extension"]);
			
        // Create destinatin image and 
		// Copies a rectangular portion of src image to des image and smoothly interpolating pixel values 
		if($this->gd_version == 2)
		{
			$this->img["des"] = ImageCreateTrueColor($this->img["width_thumb"],$this->img["height_thumb"]);
			@ImageCopyResampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"], $this->img["height_thumb"], $this->img["width"], $this->img["height"]);
		}
        else
		{
			$this->img["des"] = ImageCreate($this->img["width_thumb"],$this->img["height_thumb"]);
			@ImageCopyResized ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"], $this->img["height_thumb"], $this->img["width"], $this->img["height"]);
		}

        // Display the image directly in browser
        if($dispay)
        {
	        switch(strtoupper($this->img["extension"]))
	        {
	            // JPG, JPEG
	            case "JPG":
	            case "JPEG":
	                imageJPEG($this->img["des"],"",$this->img["quality"]);
	                break;

	            //PNG
	            case "PNG":
	                imagePNG($this->img["des"]);
	                break;

	            //GIF
	            case "GIF":
	                imageGIF($this->img["des"]);
	                break;

	            //WBMP
	            case "WBMP":
	                imageWBMP($this->img["des"]);
	                break;

	            //DEFAULT
	            default:
	                $this->img["error"] = "Not Supported File !!";
	                // echo $this->img["error"];
	                return;
	        }
        }
		// Save the image into file
        else
        {
	        switch(strtoupper($this->img["extension"]))
	        {
	            // JPG, JPEG
	            case "JPG":
	            case "JPEG":
	                imageJPEG($this->img["des"], $tmpimg, $this->img["quality"]);
	                break;

	            //PNG
	            case "PNG":
	                imagePNG($this->img["des"], $tmpimg);
	                break;

	            //GIF
	            case "GIF":
	                imageGIF($this->img["des"], $tmpimg);
	                break;

	            //WBMP
	            case "WBMP":
	                imageWBMP($this->img["des"], $tmpimg);
	                break;

	            //DEFAULT
	            default:
	                $this->img["error"] = "Not Supported File !!";
	                // echo $this->img["error"];
	                return;
	        }

            return $tmpimg;
        }
	}
	
//thumb 2	
	function create2($dispay=true, $save="")
	{
    	if(isset($this->img["error"]))	return;
		//Show thumb
        if($dispay)
			@header("Content-Type: image/".$this->img["extension"]);

   		//Save thumb
    	if($save == "")
	        $tmpimg = $this->img["dirname"]. "/small_thumb_". $this->img["basename"];
        else
			$tmpimg = $save. ".". strtolower($this->img["extension"]);
			
        // Create destinatin image and 
		// Copies a rectangular portion of src image to des image and smoothly interpolating pixel values 
		if($this->gd_version == 2)
		{
			$this->img["des"] = ImageCreateTrueColor($this->img["width_thumb"],$this->img["height_thumb"]);
			@ImageCopyResampled ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"], $this->img["height_thumb"], $this->img["width"], $this->img["height"]);
		}
        else
		{
			$this->img["des"] = ImageCreate($this->img["width_thumb"],$this->img["height_thumb"]);
			@ImageCopyResized ($this->img["des"], $this->img["src"], 0, 0, 0, 0, $this->img["width_thumb"], $this->img["height_thumb"], $this->img["width"], $this->img["height"]);
		}

        // Display the image directly in browser
        if($dispay)
        {
	        switch(strtoupper($this->img["extension"]))
	        {
	            // JPG, JPEG
	            case "JPG":
	            case "JPEG":
	                imageJPEG($this->img["des"],"",$this->img["quality"]);
	                break;

	            //PNG
	            case "PNG":
	                imagePNG($this->img["des"]);
	                break;

	            //GIF
	            case "GIF":
	                imageGIF($this->img["des"]);
	                break;

	            //WBMP
	            case "WBMP":
	                imageWBMP($this->img["des"]);
	                break;

	            //DEFAULT
	            default:
	                $this->img["error"] = "Not Supported File !!";
	                // echo $this->img["error"];
	                return;
	        }
        }
		// Save the image into file
        else
        {
	        switch(strtoupper($this->img["extension"]))
	        {
	            // JPG, JPEG
	            case "JPG":
	            case "JPEG":
	                imageJPEG($this->img["des"], $tmpimg, $this->img["quality"]);
	                break;

	            //PNG
	            case "PNG":
	                imagePNG($this->img["des"], $tmpimg);
	                break;

	            //GIF
	            case "GIF":
	                imageGIF($this->img["des"], $tmpimg);
	                break;

	            //WBMP
	            case "WBMP":
	                imageWBMP($this->img["des"], $tmpimg);
	                break;

	            //DEFAULT
	            default:
	                $this->img["error"] = "Not Supported File !!";
	                // echo $this->img["error"];
	                return;
	        }

            return $tmpimg;
        }
	}
}
?>