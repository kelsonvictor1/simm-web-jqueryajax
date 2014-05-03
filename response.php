<?php
include_once("config.php");

if(isset($_POST["content_txt"]) && strlen($_POST["content_txt"])>0) 
{		$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
	
		if(mysql_query("INSERT INTO especialidade(nome) VALUES('".$contentToSave."')"))
	{
		
		  $my_id = mysql_insert_id(); 
		  echo '<li id="item_'.$my_id.'">';
		  echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$my_id.'">';
		  echo '<img src="images/icon_del.gif" border="0" />';
		  echo '</a></div>';
		  echo $contentToSave.'</li>';
		  mysql_close($connecDB); 

	}else{
		
				header('HTTP/1.1 500 Looks like mysql error, could not insert record!');
		exit();
	}

}
elseif(isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"]))
{	
	$idToDelete = filter_var($_POST["recordToDelete"],FILTER_SANITIZE_NUMBER_INT); 
	
if(!mysql_query("DELETE FROM especialidade WHERE id=".$idToDelete))
	{    
			header('HTTP/1.1 500 Could not delete record!');
		exit();
	}
	mysql_close($connecDB); 
}
else
{
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
?>