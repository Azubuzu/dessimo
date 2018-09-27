<?php
	$bulletproof_upload_dir = "images/upload";
	$bulletproof_upload_dir_admin = "../images/upload";
	$bulletproof_size_min = 1;
	$bulletproof_size_max = 20000000;
	$bulletproof_accepted_format = array('jpeg', 'gif', 'png', 'bmp');


	//Used function for multiple upload.
	function reArrayFiles($file)
	{
	    $file_ary = array();
	    $file_count = count($file['name']);
	    $file_key = array_keys($file);
	    
	    for($i=0;$i<$file_count;$i++)
	    {
	        foreach($file_key as $val)
	        {
	            $file_ary[$i][$val] = $file[$val][$i];
	        }
	    }
	    return $file_ary;
	}
?>	