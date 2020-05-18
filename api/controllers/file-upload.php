<?php

  $filename = $_FILES['file']['name'];
  $destination = "../../files/".$_POST['type_roster']."/". $filename;
  
  if(move_uploaded_file( $_FILES['file']['tmp_name'] , $destination )) 
	echo "success ";
  else
  	echo "failure";

?>