<?php
/*
 * File Upload CakePHP Component
 * 
 * @cakephp 2.x
 * @author      Sandip Ghadge
 * @version     1.1
 * 
 */
class FileUploadComponent extends Component {
	
	  
       // thumb=>array(width,height);
	   public $default_thumb =array(
	   		'small' =>array(25,  30),
	   		'medium' =>array(75, 90),
	   		'large' =>array(120, 150)
	   );
	  
	   public $deleted = false;
	    
	  /**Sets the upload dir for fileupload if dir is not present then will create new dir
	   * @author sandip Ghadge
	   * @return void
   	  */ 
	  
	 	function setUploadDir($file_path){
	    //	$dir = WWW_ROOT . $file_path . DS;
		 /*   if (!file_exists($dir)) {
				mkdir($dir, 0777, true);
			}
			*/
	    	Configure::write('upload_dir', $file_path);
	    	
	    }
	    
	/**
	 * doFileUpload method
	 * this function does generate unique file name, does the file upload and then creates thumbnail image in thub dir. 	   
	 * @author sandip
	 * @return void
	*/ 
	
		function doFileUpload($file_data,$file_path,$thumb_arr = array()){
			
			if($file_data['error']!=0){
	    		return false;
	    	}
	    	
	        $this->setUploadDir($file_path);
     	    $new_file_name = $this->generateUniqueFilename($file_data['name']);
     	       	    
     	    if($this->handleFileUpload($file_data,$new_file_name)){
				 $type=explode('/',$file_data['type']);
				if($type[0] == 'image'){
					
					$thumb_arr = array_merge($this->default_thumb,$thumb_arr);
					foreach ($thumb_arr as $thumb=>$dimension){
		    	  		$this->thumbnail($new_file_name,$thumb,$dimension[0],$dimension[1]);
			      	}
	      	
					//$this->thumbnail($new_file_name, 'small',  25,  30); // small thumbnail	
					//$this->thumbnail($new_file_name, 'medium', 75,  90); // small thumbnail	
	     	        //$this->thumbnail($new_file_name, 'large',  120, 150); // medium thumbnail	
	     	    }
     	    	return $new_file_name;
     	    }else{
     	      return false;	
     	    }
     	    	
      }
	    
		
	        
	    
	 /**
	 * generateUniqueFilename 
	 * this function does generate unique file name. 	   
	 * @author sandip
	 * @return void
	 * 
	*/ 
	    
	    
        function generateUniqueFilename($fileName){
			   
        	   $ext = trim(substr(strrchr($fileName,'.'),1)); 
               $new_name = trim(substr(md5(microtime()), 2, -5));
               $fileName = $new_name.'.'.$ext;
               $no=1;
               $newFileName = $fileName;
                while (file_exists(Configure::read('upload_dir').$newFileName)) {
                  $no++;
                  $newFileName = substr_replace($fileName, "_$no.", strrpos($fileName, "."), 1);
                }
             
               return $newFileName;
        }

		
	   /**
	    * function will move uploaded file to a dir.
	    *
	    * @param unknown_type $file_data
	    * @param unknown_type $fileName
	    * @return unknown
	    */
       function handleFileUpload($file_data, $fileName){
                if (is_uploaded_file($file_data['tmp_name']) && $file_data['error']==4){
                   return 'file_not_uploaded';
                }
                if (is_uploaded_file($file_data['tmp_name']) && $file_data['error']==0)
                  {
                  
                    if (move_uploaded_file($file_data['tmp_name'], Configure::read('upload_dir').$fileName)){
                        return TRUE;
                    }else{
                        return false;
                    }
                  }

       }
          
          
     /**
	 * function generate thumbnail images for uploaded image file  
	 * moves the uploaded file from tmp dir to upload dir. 	   
	 * @author sandip
	 * @return void
	 * @param string $inputFileName
     * @param string $thumb_size
     * @param int width
     * @param int height
	 * 
	*/
       
    function thumbnail($inputFileName, $thumb_size = 'small', $width = 46, $height = 60){
                     
		    $src = Configure::read('upload_dir').$inputFileName; 
		    $filename = explode('.',$inputFileName);
			$thname = $filename[0];
			
			$file_extension = substr($src, strrpos($src, '.')+1);
			
			switch(strtolower($file_extension)) {
			     case "gif":  $image = @imagecreatefromgif($src); break;
			     case "png":  $image = @imagecreatefrompng($src);break;
			     case "bmp":  $image = @imagecreatefromwbmp($src);break;
			     case "jpeg":
			     case "jpg":  $image = @imagecreatefromjpeg($src);break;
			}
			
			list($width_orig, $height_orig, $type, $attr) = @getimagesize($src);

			$tn = @imagecreatetruecolor($width, $height) ;
			
			@imagecopyresampled($tn, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
			$dir = Configure::read('upload_dir').'thumb' . DS . $thumb_size . DS; 
			if (!file_exists($dir)) {
				//umask(0777);
                $oldmask = umask(0);
                mkdir($dir, 0777, true);
                chmod($dir, 0755);
                umask($oldmask);

			}
			
			switch(strtolower($file_extension)) {
			     case "gif": imagegif($tn, $dir.$thname.'.'.$file_extension); break;
			     case "png": imagepng($tn, $dir.$thname.'.'.$file_extension,9); break;
			     case "bmp": imagewbmp($tn, $dir.$thname.'.'.$file_extension); break;
			     case "jpeg":
			     case "jpg": imagejpeg($tn, $dir.$thname.'.'.$file_extension,95); break;
			
			}
			
		
      }
      
      /**
       * create thumbail for existing image in dir structure
       *
       * @param string $file_name
       * @param string $path
       * @param array $thumb_arr
       */
      public function createThumb($file_name, $path, $thumb_arr = array(),$marge_with_default = true){
      	    Configure::write('upload_dir', $path);
      	    $this->thumbnail($file_name);
      	    
      	   // echo Configure::read('upload_dir'); exit;
      	   if($marge_with_default){
      	   	 $thumb_arr = array_merge($this->default_thumb,$thumb_arr);
      	   }else{
      	   	 $thumb_arr = $thumb_arr;
      	   }
      	    
      	    //print_r($thumb_arr); exit;
    	  	foreach ($thumb_arr as $thumb=>$dimension){
    	  		$this->thumbnail($file_name,$thumb,$dimension[0],$dimension[1]);
	      	}
      }
 
      
      
      /**
       * create thumbail for existing image in dir structure
       *
       * @param string $file_name
       * @param string $path
       * @param array $thumb_arr
       */
      public function createThumbNew($file_name, $path, $thumb_arr = array(),$marge_with_default = true){
      	    Configure::write('upload_dir', $path);
      	    $this->thumbnail($file_name);
      	    
      	   // echo Configure::read('upload_dir'); exit;
      	   if($marge_with_default){
      	   	 $thumb_arr = array_merge($this->default_thumb,$thumb_arr);
      	   }else{
      	   	 $thumb_arr = $thumb_arr;
      	   }
      	    
      	    //print_r($thumb_arr); exit;
    	  	foreach ($thumb_arr as $thumb=>$dimension){
    	  		$this->thumbnail($file_name,$thumb,$dimension[0],$dimension[1]);
	      	}
      }
 
      
      
      
  /**
   * deletes image and thumbail images
   *
   * @param unknown_type $file_name
   * @param unknown_type $file_path
   */
    public function removeFile($file_name,$file_path){
	      	//deletes thumbails file
	      	if(file_exists($file_path . $file_name)){
		  		$this->deleted = @unlink($file_path . $file_name);	
	      	}
	      	
	      	//deletes thumbails images
	      	foreach ($this->default_thumb as $thumb=>$dimensions){
	      		if(file_exists($file_path.'thumb' .DS. $thumb .DS. $file_name)){
		 			 @unlink($file_path.'thumb' . DS . $thumb . DS . $file_name);
	      		}	
	      	}
      	return $this->deleted;
     }
      		
    
   /**
   * will move file from source to destination
   *
   * @param string $file_source
   * @param string $file_destination
   */    
   public function moveFile($file_source, $file_destination){
     	if(copy($file_source, $file_destination)){
     		return true;
     	}else{
     		return false;
     	}
   }
}