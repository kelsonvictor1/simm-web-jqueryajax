<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

	$("#FormSubmit").click(function (e) {
			e.preventDefault();
			if($("#contentText").val()==='')
			{
				alert("Please enter some text!");
				return false;
			}
		 	var myData = 'content_txt='+ $("#contentText").val(); 
			jQuery.ajax({
			type: "POST", 
			url: "response.php", 
			dataType:"text", 
			data:myData, 
			success:function(response){
				$("#responds").append(response);
				$("#contentText").val(''); 
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
			});
	});

	
	$("body").on("click", "#responds .del_button", function(e) {
		 e.returnValue = false;
		 var clickedID = this.id.split('-'); 
		 var DbNumberID = clickedID[1]; 
		 var myData = 'recordToDelete='+ DbNumberID; 
		 
			jQuery.ajax({
			type: "POST", 
			url: "response.php", 
			dataType:"text", 
			data:myData, 
			success:function(response){
				$('#item_'+DbNumberID).fadeOut("slow");
			},
			error:function (xhr, ajaxOptions, thrownError){
				
				alert(thrownError);
			}
			});
	});

});
</script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="content_wrapper">
<ul id="responds">
<?php
//include db configuration file
include_once("config.php");

//MySQL query
$Result = mysql_query("SELECT * FROM especialidade");

echo '<h1>Entidade Especialidade - jQuey/Ajax</h1>';

while($row = mysql_fetch_array($Result))
{
  echo '<li id="item_'.$row["id"].'">';
  echo '<div class="del_wrapper"><a href="#" class="del_button" id="del-'.$row["id"].'">';
  echo '<img src="images/icon_del.gif" border="0" />';
  echo '</a></div>';
  echo $row["nome"].'</li>';
}

//close db connection
mysql_close($connecDB);
?>
</ul>
    <div class="form_style">
    <textarea name="content_txt" id="contentText" cols="45" rows="5"></textarea>
    <button id="FormSubmit">Adicionar</button>
    </div>
</div>

</body>
</html>
