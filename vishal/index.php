<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="StyleSheet_Employee_CT.css" rel="stylesheet" type="text/css" />

<? include('titan.php');?>
</head>


    <div id="container">
    
        
        
            
            <div id="header_img">
            	<a><img src="canadiantire53ftcontainer800.jpg" width="100%" height="auto"/></a>
            	
            </div>
            
            <div  class="feed_box">
            	
            	  <?
				  $fileName="mell";
				  $date=currentDate();
				  $uploader=1;
				  $filePath="/text/";
				  
				$accessors = array(2, 3, 1);
				
				$personSawFileID=1;
				$filesName="headerBar.jpg";
				$modeOfAccess=1;
				
            	//updateFileSeenStatus($personSawFileID, $filesName, $modeOfAccess); 
				//addFile($fileName, $date, $uploader, $filePath, $accessors)
				//echo "After file is added<br />";
				deleteFile($fileName);
				//getAllFilesByUploader(1, NULL);
				//deleteFile(hello);
				//getAllFilesByUploader(1, NULL);
            	?>
            	
            	</div>
            
         	<div class="msg_bar"></div>    
            
            <div clss="login">
    
            </div> 
                    
                    
		
        
    </div>
<body >
	
	
	<table width='800px'>
		<tr><td height='600px'>&nbsp</td></tr>
	<tr><td align='center' valign='center'>	
		<br/>		<br/>		<br/>		<br/>		<br/>		<br/>
			      
		
		
		
	</td></tr>
	</table>
	

</body>
</html>
