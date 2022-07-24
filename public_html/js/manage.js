$(document).ready(function(){
	var DOMAIN = "http://localhost/PROJECTS_FOR_JOB/MY-INVENTORY-MANAGEMENT-SYSTEM/public_html";

	//Mange Category
	manageCategory(1);
	function manageCategory(pn){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {manageCategory:1,pageno:pn},
			success : function(data){
				$("#get_category").html(data);		
			}
		})
	}
})