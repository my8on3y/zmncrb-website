<?php
	
	global $accessDenied;
	$accessDenied = array(
		"/wp-admin",
		"/wp-includes",
		"/wp-content/plugins/gmace"
	);
	
	function is_access($directory)
	{
		global $accessDenied;
		
		foreach($accessDenied as $dir)
		{
			if(substr_count($directory, $dir))
			{
				return false;
			}
		}
		
		return true;
	}



	function gmace_manager_server($_op)
	{
		$_directory = $_POST['directory'];
		$_content = $_POST['content'];
		$_file = $_POST['file'];
		$_type = $_POST['type'];
		$_name = $_POST['name'];
		$_newname = $_POST['newname'];
		$_directory_from = $_POST['from-directory'];
		$_directory_to = $_POST['to-directory'];

		if(!is_user_logged_in() || !current_user_can('administrator') || !is_access($_directory) || $_POST['_op'] != $_op)
		{
			wp_die();
			return;
		}
		
		$cur_dir = explode("/", __FILE__);
		$cur_dir = implode("/", array_slice($cur_dir, 0, count($cur_dir) - 1));
		if(!file_exists($cur_dir . "/tmpflag"))
		{
			$file = fopen($cur_dir . "/tmpflag", 'w');
			fwrite($file, 1);
		}
		else
		{
			$counter = file_get_contents($cur_dir . "/tmpflag");
			$counter = ($counter - 1) + 2;
			$file = fopen($cur_dir . "/tmpflag", 'w');
			fwrite($file, $counter);
		}

		switch($_op)
		{
			case "update_obj": $response = gmace_update_obj($_directory); break;
			
			case "read": $response = gmace_read_file($_directory); break;
			
			case "rewrite_file": $response = gmace_rewrite_file($_directory, $_content); break;
			
			case "get_property": $response = gmace_get_property($_directory, $_file); break;
			
			case "rename_and_delete_file": $response = gmace_renamedelete_obj($_directory, $_file, $_type, $_newname); break;

			case "create": $response = gmace_create_obj($_directory, $_type, $_name); break;
			
			case "paste_file": $response = gmace_paste_obj($_directory_from, $_directory_to, $_type); break;

			case "extract_file": $response = gmace_extract_file($_directory, $_file); break;
		}

		if($response == "success")
		{
			print(1);
		}
		
		//killself();
		
		wp_die();
	}
	
	

	function gmace_update_obj($_directory)
	{
		print(gmace_scan_to($_directory));
	}
	
	
	function gmace_read_file($_directory)
	{
		return fpassthru(fopen(GMACEPATH.$_directory,'r'));
	}
	
	
	
	function gmace_rewrite_file($_directory, $_content)
	{
		if(substr_count($_directory, "gmacetmp") && !file_exists(GMACEPATH."/gmacetmp"))
		{
			mkdir(GMACEPATH."/gmacetmp");
		}
		
		$file = fopen(GMACEPATH.$_directory,'w');
		return fputs($file, stripslashes($_content)) ? 'success' : 'error';
	}
	
	
	
	function gmace_get_property($_directory, $_file)
	{
		$directory = $_directory."/".$_file;
		$fileExt = end(explode(".", $_file));
		
		$sizeNames = array('B', 'KB', 'MB', 'GB', 'TB');
		$size = (filetype(GMACEPATH.$directory) == "dir" ? dirsize(GMACEPATH.$directory) : filesize(GMACEPATH.$directory));
		
		for($icount = 0; $size >= 1024; $icount++)
			$size /= 1024;
		$size = round($size, 1).$sizeNames[$icount];
		
		if(filetype(GMACEPATH.$directory) == "dir")
		{
			print("<p><b>Directory: </b>". $directory. "</p>");
			print("<p><b>Size: </b>".$size."</p>");
			print("<p><b>Type: </b><span>Folder</span></p>");
		}
		else
		{
			print("<ul id='property-file-name'><li class='obj-file' type='$fileExt'><span>". $_file ."</span></li></ul>");
			print("
			<p>
				<b>Directory: </b>
				<a
					target='_blank'
					href='/wp-admin/admin.php?page=gmace-editor&gm-download-file=".str_replace("/www", "", $_directory)."/".$file."'>
						$directory
				</a>
			</p>");
			print("<p><b>Size: </b>".$size."</p>");
			print("<p class='date'><b>Last modify: </b>".date("j F Y (l) h:i:s", filemtime(GMACEPATH.$directory))."</p>");
			print("<p class='date'><b>Last called: </b>".date("j F Y (l) h:i:s", fileatime(GMACEPATH.$directory))."</p>");
			print("<p><b>Type: </b><span>".filetype(GMACEPATH.$directory)."</span></p>");
		}
	}
	
	
	
	function gmace_renamedelete_obj($_directory, $_file, $_type, $_newname)
	{
		if($_type == "rename" && rename(GMACEPATH.$_directory."/".$_file, GMACEPATH.$_directory."/".$_newname))
		{
			print(gmace_scan_to($_directory));
		}
		elseif($_type == "delete")
		{
			if(filetype(GMACEPATH.$_directory."/".$_file) == "dir")
			{
				dir_unlink(GMACEPATH.$_directory."/".$_file);
				print(gmace_scan_to($_directory));
			}
			else
			{
				unlink(GMACEPATH.$_directory."/".$_file);
				print(gmace_scan_to($_directory));
			}
		}
		else return 'error';
	}
	
	
	
	function gmace_create_obj($_directory, $_type, $_name)
	{
		$directory = GMACEPATH.$_directory."/".$_name;
		
		if(($_type == "folder" && @mkdir($directory)) || ($_type == "file" && fopen($directory, "w")));
			print(gmace_scan_to($_directory));
	}
	
	
	
	function gmace_paste_obj($_directory_from, $_directory_to, $_type)
	{
		if(!is_access($_directory_from) || !is_access($_directory_to))
		{
			wp_die();
			return;
		}
		
		if(filetype(GMACEPATH.$_directory_from) == "dir")
		{
			dir_move(GMACEPATH.$_directory_from, GMACEPATH.$_directory_to, $_type == "cut");
			print(gmace_scan_to($_directory_to));
		}
		else
		{
			if(file_exists(GMACEPATH.$_directory_to."/".end(explode("/", $_directory_from))))
			{
				$from_file = fopen(GMACEPATH.$_directory_from, "r");
				$to_file = fopen(get_new_name(GMACEPATH.$_directory_from, GMACEPATH.$_directory_to), "w+");
				
				$text = "";
				while(!feof($from_file))
				{
					$text .= fgets($from_file, 999);
				}
				fputs($to_file, $text);
				
				fclose($to_file);
				fclose($from_file);
				
				if($_type == "cut")
				{
					unlink(GMACEPATH.$_directory_from);
				}
				
				print(gmace_scan_to($_directory_to));
			}
			else
			{
				if(copy(GMACEPATH.$_directory_from, GMACEPATH.$_directory_to."/".basename($_directory_from)))
				{
					if($_type == "cut")
						unlink(GMACEPATH.$_directory_from);
				}
				print(gmace_scan_to($_directory_to));
			}
		}
	}
	
	
	
	function gmace_extract_file($_directory, $_file)
	{
		include_once(GMACE_DIR . "inc/pclzip.lib.php");
		$archive = new PclZip(GMACEPATH.$_directory. "/" .$_file);
		$result = $archive->extract(PCLZIP_OPT_PATH, GMACEPATH.$_directory);
		//if($result == 0) echo $archive->errorInfo(true);
		
		gmace_update_obj($_directory);
	}
	
	
	
	function gmace_scan_to($directory)
	{
		if(!is_user_logged_in() || !current_user_can('administrator'))
		{
			wp_die();
			return;
		}
		
		$directory = str_replace("//", "/", $directory);
		
		$fd = "<ul class='folder-objects' data-dir-folder='".$directory."'>";
		
		$folders;
			$folder_id = 0;
		$files;
			$file_id = 0;
		
		if(is_access($directory))
		{
			$obj = scandir(GMACEPATH.$directory);
			if($obj)
			{
				foreach($obj as $index => $val)
				{
					if(filetype(GMACEPATH.$directory."/".$val) == "dir")
					{
						if($val != "." && $val != "..")
						{
							$folders[$folder_id]=$val;
							$folder_id++;
						}
					}
					else
					{
						$files[$file_id]=$val;
						$file_id++;
					}
				}
			}
		}
	
		//------  SORT  -------//
		for($i = 0; $i < $folder_id; $i++)
		{
			$fd.="<li class='obj-folder'><span>".$folders[$i]."</span>".(gmace_scan_to($directory."/".$folders[$i]))."</li>";
		}
		for($i = 0; $i < $file_id; $i++)
		{
			$fd.="<li class='obj-file' type='".end(explode('.', $files[$i]))."'><span><a>".$files[$i]."</a></span></li>";
		}
		
		$fd.="</ul>";
		return $fd;
	}
	
	
	function dir_move($dirFrom, $dirTo, $flag)
	{
		if(!is_user_logged_in() || !current_user_can('administrator') || !is_access($dirFrom) || !is_access($dirTo))
		{
			wp_die();
			return;
		}
		
		$errors = 0;
		
		if(file_exists($dirTo."/".basename($dirFrom)."/"))
		{
			$dirTo = get_new_name($dirFrom, $dirTo);
		}
		else
		{
			$dirTo .= "/".basename($dirFrom)."/";
		}
		
		if(!file_exists($dirTo))
		{
			mkdir($dirTo);
		}
			
		foreach(scandir($dirFrom) as $index => $val)
		{
			if(filetype($dirFrom."/".$val) == "dir")
			{
				if($val != "." && $val != "..")
				{
					$errors += dir_move($dirFrom."/".$val, $dirTo, $flag);
				}
			}
			else
			{
				if(!copy($dirFrom."/".$val, $dirTo."/".$val))
				{
					$errors++;
				}
			}
		}
		
		if($flag)
		{
			dir_unlink($dirFrom);
		}
		
		return $errors == 0;
	}
	
	
	
	function get_new_name($dirFrom, $dirTo)
	{
		if(!is_user_logged_in() || !current_user_can('administrator') || !is_access($dirFrom) || !is_access($dirTo))
		{
			wp_die();
			return;
		}
		
		$icount = 0;
		$newname_r = explode("/", $dirFrom);
		$newname = explode(".", end($newname_r));
		
		if(filetype($dirFrom) == "dir")
		{
			while(file_exists($dirTo."/".$newname[count($newname)-1]."-".$icount))
			{
				$icount++;
			}
			
			$newname[count($newname) - 1] .= "-".$icount;
			$newname_r[count($newname_r) - 1] = implode(".", $newname);
			$newname_r = implode("/", $newname_r);
		}
		else
		{
			while(file_exists($dirTo."/".$newname[count($newname)-2]."-".$icount.".".$newname[count($newname)-1]))
			{
				$icount++;
			}
			
			$newname[count($newname) - 2] .= "-".$icount;
			$newname_r[count($newname_r) - 1] = implode(".", $newname);
			$newname_r = implode("/", $newname_r);
		}
		
		return $newname_r;
	}
	
	
	
	function dir_unlink($directory)
	{
		if(!is_user_logged_in() || !current_user_can('administrator') || !is_access($directory))
		{
			wp_die();
			return;
		}
		
		$errors = 0;
		
		foreach(scandir($directory) as $index=>$val)
		{
			if(filetype($directory."/".$val) == "dir")
			{
				if($val!="." && $val!="..")
				{
					$errors += dir_unlink($directory."/".$val);
				}
			}
			else
			{
				if(!unlink($directory."/".$val))
					$errors++;
			}
		}
		
		if(!rmdir($directory))
		{
			$errors++;
		}
		
		return $errors == 0;
	}
	
	
	
	function dirsize($directory)
	{
		if(!is_user_logged_in() || !current_user_can('administrator'))
		{
			wp_die();
			return;
		}
		
		$total_size;
		
		foreach(scandir($directory) as $index=>$val)
		{
			if(filetype($directory."/".$val)=="dir")
			{
				if($val != "." && $val != "..")
				{
					$total_size += dirsize($directory."/".$val);
				}
			}
			else
			{
				$total_size += filesize($directory."/".$val);
			}
		}
		return $total_size;
	}
	
	
	
	function killself()
	{
		if(!is_user_logged_in() || !current_user_can('administrator'))
		{
			wp_die();
			return;
		}
		
		$cur_dir = explode("/", __FILE__);
		$cur_dir = implode("/", array_slice($cur_dir, 0, count($cur_dir) - 1));
	
		unlink($cur_dir . "/download-manager.php");
		unlink($cur_dir . "/code-completer-array.php");
		unlink($cur_dir . "/editor.php");
		unlink($cur_dir . "/pclzip.lib.php");
		
		if(file_exists($cur_dir . "/tmpflag"))
		{
			$counter = file_get_contents($cur_dir . "/tmpflag");
			$counter = $counter - 1;
			$file = fopen($cur_dir . "/tmpflag", 'w');
			fwrite($file, $counter);
		}
		else
		{
			$counter = 0;
		}
		
		if($counter <= 0)
		{
			unlink($cur_dir . "/filemanager.php");
			//rmdir($cur_dir);
		}
	}
?>