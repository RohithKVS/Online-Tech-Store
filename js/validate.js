$(document).ready(function(){

  $("#email").blur(function(){
    var message="";
    var email=$("#email").val();
    $.ajax({
      url: 'check_email.php',
      type: 'post',
      data: {
        'email' : email
      },
      success: function(response){
        if (response == "Email already exists" ) {
          $("#result").html(response);
        }
        else
        {
          $("#result").html("");
        }
      }
      });
  });

  $("#submit").click(function(e){
      var message="";
      var first_name=$("#first_name").val();
      var last_name=$("#last_name").val();
      var email=$("#email").val();
      var password=$("#pass").val();
      var conf_pass=$("#conf_pass").val();
      var line_1=$("#line_1").val();
      var city=$("#city").val();
      var state=$("#state").val();
      var zipcode=$("#zipcode").val();
      var country=$("#country").val();
      
      var phone=$("#phone").val();
      var passlength=password.length;
      var regex=/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
      var passregex=/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
      //validate if all fields are filled
      
      if(first_name=="" || last_name=="" || email=="" || password=="" || conf_pass=="" || line_1=="" || city=="" || state=="" || zipcode=="" || country=="" || phone=="")
      {
        message="All the fields are mandatory";
      }
      else if(!regex.test(email))
      {
        message="Please enter a valid email id";
      }
      else if(!passregex.test(password))
       {
        message="Invalid Password.<br><br>Password should contain:<ul><li>Atlest 8 characters</li><li>Atleast 1 numeric character</li><li>Atleast 1 lower case letter</li><li>Atleast 1 upper case letter</li><li>Atleat 1 special character</li></ul>";
       }
      else if(password!=conf_pass)
       {
        message="Passwords do not match";
       }
      else if(phone.length<10)
       {
        message="Phone Number should be 10 digits";
       }
       if(message!="")
       {
        e.preventDefault();
       }
       $("#result").html(message);
    });

  $("#submit_edit").click(function(e){
      var message="";
      var first_name=$("#first_name").val();
      var last_name=$("#last_name").val();
      var line_1=$("#line_1").val();
      var city=$("#city").val();
      var state=$("#state").val();
      var zipcode=$("#zipcode").val();
      var country=$("#country").val();
      
      var phone=$("#phone").val();
      var regex=/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
      if(first_name=="" || last_name=="" || line_1=="" || city=="" || state=="" || zipcode=="" || country=="" || phone=="")
      {
        message="All the fields are mandatory";
      }
      else if(phone.length<10)
       {
        message="Phone Number should be 10 digits";
       }
       if(message!="")
       {
        e.preventDefault();
       }
       $("#result").html(message);
    });
  $("#submit_change_password").click(function(e){
      var message="";
      var password=$("#new_pass").val();
      var conf_pass=$("#conf_new_pass").val();
      var passlength=password.length;
      var passregex=/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
      //validate if all fields are filled
      
      if(password=="" || conf_pass=="")
      {
        message="All the fields are mandatory";
      }
      else if(!passregex.test(password))
       {
        message="Invalid Password.<br><br>Password should contain:<ul><li>Atlest 8 characters</li><li>Atleast 1 numeric character</li><li>Atleast 1 lower case letter</li><li>Atleast 1 upper case letter</li><li>Atleat 1 special character</li></ul>";
       }
      else if(password!=conf_pass)
       {
        message="Passwords do not match";
       }
       if(message!="")
       {
        e.preventDefault();
       }
       $("#result").html(message);
    });
  
  $("#submit_forgot_password").click(function(e){
      var message="";
      var password=$("#pass").val();
      var conf_pass=$("#conf_pass").val();
      var passlength=password.length;
      var passregex=/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[^\w\s]).{8,}$/;
      //validate if all fields are filled
      
      if(password=="" || conf_pass=="")
      {
        message="All the fields are mandatory";
      }
      else if(!passregex.test(password))
       {
        message="Invalid Password.<br><br>Password should contain:<ul><li>Atlest 8 characters</li><li>Atleast 1 numeric character</li><li>Atleast 1 lower case letter</li><li>Atleast 1 upper case letter</li><li>Atleat 1 special character</li></ul>";
       }
      else if(password!=conf_pass)
       {
        message="Passwords do not match";
       }
       if(message!="")
       {
        e.preventDefault();
       }
       $("#result").html(message);
    });

});