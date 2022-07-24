$(document).ready(function(){
    /* Admin Registration Form */
	var DOMAIN = "http://localhost/PROJECTS_FOR_JOB/MY-INVENTORY-MANAGEMENT-SYSTEM/public_html";
        $("#register_form").on("submit",function(){
            var status = false;
            var name = $("#username");
            var email = $("#email");
            var pass1 = $("#password1");
            var pass2 = $("#password2");
            var type = $("#usertype");
            //rizwan@gmail.com
            var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
            if(name.val() == "" || name.val().length < 6){
                name.addClass("border-danger");
                $("#u_error").html("<span class='text-danger'>Please Enter Name and Name should be more than 6 char</span>");
                status = false;
            }else{
                name.removeClass("border-danger");
                $("#u_error").html("");
                status = true;
            }
            if(!e_patt.test(email.val())){
                email.addClass("border-danger");
                $("#e_error").html("<span class='text-danger'>Please Enter Valid Email Address</span>");
                status = false;
            }else{
                email.removeClass("border-danger");
                $("#e_error").html("");
                status = true;
            }
            if(pass1.val() == "" || pass1.val().length < 9){
                pass1.addClass("border-danger");
                $("#p1_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
                status = false;
            }else{
                pass1.removeClass("border-danger");
                $("#p1_error").html("");
                status = true;
            }
            if(pass2.val() == "" || pass2.val().length < 9){
                pass2.addClass("border-danger");
                $("#p2_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
                status = false;
            }else{
                pass2.removeClass("border-danger");
                $("#p2_error").html("");
                status = true;
            }
            if(type.val() == ""){
                type.addClass("border-danger");
                $("#t_error").html("<span class='text-danger'>Please Enter more than 9 digit password</span>");
                status = false;
            }else{
                type.removeClass("border-danger");
                $("#t_error").html("");
                status = true;
            }
            if ((pass1.val() == pass2.val()) && status == true) {
                $(".overlay").show();
                $.ajax({
                    url : DOMAIN+"/includes/process.php",
                    method : "POST",
                    data : $("#register_form").serialize(),
                    success : function(data){
                        if (data == "EMAIL_ALREADY_EXISTS") {
                            $(".overlay").hide();
                            alert("It seems like you email is already used");
                        }else if(data == "SOME_ERROR"){
                            $(".overlay").hide();
                            alert("Something Wrong");
                        }else{
                            $(".overlay").hide();
                            window.location.href = encodeURI(DOMAIN+"/index.php?msg=You are registered Now you can login");
                        }
                    }
                })
            }else{
                pass2.addClass("border-danger");
                $("#p2_error").html("<span class='text-danger'>Password is not matched</span>");
                status = true;
            }
        })
    
        // For Login Part
        $("#form_login").on("submit",function(){
            var email = $("#log_email");
            var pass = $("#log_password");
            var status = false;
            if (email.val() == ""){
                email.addClass("border-danger");
                $("#e_error").html("<span class='text-danger'>Please Enter Email Address</span>");
                status = false;
            }else{
                email.removeClass("border-danger");
                $("#e_error").html("");
                status = true;
            }
            if (pass.val() == ""){
                pass.addClass("border-danger");
                $("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
                status = false;
            }else{
                pass.removeClass("border-danger");
                $("#p_error").html("");
                status = true;
            }
            if (status) {
                $(".overlay").show();
                $.ajax({
                    url : DOMAIN+"/includes/process.php",
                    method : "POST",
                    data : $("#form_login").serialize(),
                    success : function(data){
                        if (data == "NOT_REGISTERD") {
                            $(".overlay").hide();
                            email.addClass("border-danger");
                            $("#e_error").html("<span class='text-danger'>It seems like you are not registered</span>");
                        }else if(data == "PASSWORD_NOT_MATCHED"){
                            $(".overlay").hide();
                            pass.addClass("border-danger");
                            $("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
                            status = false;
                        }else{
                            $(".overlay").hide();
                            console.log(data);
                            window.location.href = DOMAIN+"/dashboard.php";
                        }
                    }
                })
            }
        })
  
    // /* Fetch Category Data */
    fetch_category();
	function fetch_category(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getCategory:1},
			success : function(data){
				var root = "<option value='0'>Root</option>";
				var choose = "<option value=''>Choose Category</option>";
				$("#parent_cat").html(root+data);
				$("#select_cat").html(choose+data);
			}
		})
	}

    /* Fetch Branding data  */
    Fetch_brand();
function  Fetch_brand() {
    $.ajax({
        url : DOMAIN+"/includes/process.php",
			method : "POST",
            data:{Brand_cat:1},
            success:function(response){
                var choose = "<option value=''>Choose Brand</option>";
                $('#select_brand').html(choose+response);
            }
    })
}
      /* add Category Here */
  $('#category_form').on('submit',function(){
    if ($('#category_name').val() == "") {
        $('#category_name').addClass("border-danger");
        $("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
    }else{
        $.ajax({
            method:"POST",
            url:DOMAIN+"/includes/process.php",
            data:$('#category_form').serialize(),
            success: function (response) {
                if (response == "Category_added") {
                    $('#category_name').removeClass("border-danger");
                    $("#cat_error").html("<span class='text-success'>Category successfully added</span>");
                    $('#category_name').val("");
                    fetch_category();
                }else{
                    alert(response)
                }
            }
        })
    }
  })

  /* Add Brand to database */
  $('#brand_form').on('submit',function(){
    if ($('#brand_name').val() == "") {
        $('#brand_name').addClass('border-danger')
        $('#error').html("<span class='text-danger'>Please Enter Category Name</span>");
    }else{
        $.ajax({
            method:"POST",
            url:DOMAIN+"/includes/process.php",
            data:$('#brand_form').serialize(),
            success: function (response) {
                if (response == "Brand_added") {
                    $('#brand_name').removeClass('border-danger')
                    $('#error').html("<span class='text-success'>Successfully Brand added</span>");
                    $('#brand_name').val();
                   
                }else{
                    alert(response);
                }
            }
        })
    }
  })

  /* ADD Products with full details into database */

  $('#product_form').on("submit", function(){
    if ($("#product_name").val() == "" || $("#select_cat").val() == "" || $("#select_brand").val() == "" || $("#product_price").val() == "" || $("#product_qty").val() == "") {
        alert("Sorry,All inputs must be filled");
    }
    else{
        $.ajax({
            method:"POST",
            url:DOMAIN+"/includes/process.php",
            data:$('#product_form').serialize(),
            success: function(response){
                if (response == "Product_added") {
                    alert("Data inserted Successfully");
                    $("#product_name").val("");
						$("#select_cat").val("");
						$("#select_brand").val("");
						$("#product_price").val("");
						$("#product_qty").val("");
                }else{
                    alert(response);
                }
            }
        })
    }
  })

})