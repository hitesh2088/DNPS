//JQeruy validatiob for Registration form 
$(document).ready(function(){
    //datepicker
    $('#dob').datepicker();
    
    //username check ajax code
    $('#username').blur(function() {
        $('#username').siblings().empty();
        $.post('checkuser',{ 
            username : $('#username').val()
        }, function(data){
            if(data == 1){
                $('#username').after("<p style='color:red'>User Name Already Exists!</p>");
            }
        });
    });
    
    //click action
    $('#submit').click(function(){   
        var pattern = /^[A-Za-z\s]*$/ ;
        //username
        if ($('#username').val() === ""){
            $('#username').after("<p style='color:red'>User Name Required!</p>");
            return false;
        }else {
            $('#username').siblings().remove();
        }
        if ($('#username').val().charAt(0) === " "){
             $('#username').after("<p style='color:red'>First letter can't be space!</p>");
            return false;
        }else {
            $('#username').siblings().remove();
        }
        //fullname
        if ($('#fullname').val() === ""){
            $('#fullname').after("<p style='color:red'>Full Name Required!</p>");
            return false;
        }else {
            $('#fullname').siblings().remove();
        }
        if ($('#fullname').val().charAt(0) === " "){
            $('#fullname').after("<p style='color:red'>First letter can't be space!</p>");
            return false;
        }else {
            $('#fullname').siblings().remove();
        }
        if (!$('#fullname').val().match(pattern)){
            $('#fullname').after("<p style='color:red'> No Special Characters Allowed!</p>");
            return false;
        }else {
            $('#fullname').siblings().remove();
        }
        //fathersname
        if ($('#fathersname').val() === ""){
            $('#fathersname').after("<p style='color:red'>Full Name Required!</p>");
            return false;
        }else {
            $('#fathersname').siblings().remove();
        }
        if ($('#fathersname').val().charAt(0) === " "){
            $('#fathersname').after("<p style='color:red'>First letter can't be space!</p>");
            return false;
        }else {
            $('#fathersname').siblings().remove();
        }
        if (!$('#fathersname').val().match(pattern)){
            $('#fathersname').after("<p style='color:red'> No Special Characters Allowed!</p>");
            return false;
        }else {
            $('#fathersname').siblings().remove();
        }
        
        //gender
        if ($('input[name=gender]:checked').length<=0){
            alert(dsa);
            $('#gender').after("<p style='color:red'>Gender Required!</p>");
            return false;
        }else {
            $('#gender').siblings().remove();
        }
        
        //dob
        if ($('#dob').val() === ""){
            $('#dob').after("<p style='color:red'>Date Of Birth Required!</p>");
            return false;
        }else {
            $('#dob').siblings().remove();
        }
        
        //email
        if ($('#email').val() === ""){
            $('#email').after("<p style='color:red'>Email Required!</p>");
            return false;
        }else {
            $('#email').siblings().remove();
        }
        //password
        if ($('#password').val() === ""){
            $('#password').after("<p style='color:red'>Password Required!</p>");
            return false;
        }else {
            $('#password').siblings().remove();
        }
        //rpassword
        if ($('#rpassword').val() === ""){
            $('#rpassword').after("<p style='color:red'>Re-type Password!</p>");
            return false;
        }else {
            $('#rpassword').siblings().remove();
        }
        //password checking
        if ($('#password').val() === $('#rpassword').val()){
            $('#password').after("<p style='color:red'>Password And Re-type Does Not Match!</p>");
            return false;
        }else {
            $('#password').siblings().remove();
        }
    }); 
});

//JQeruy validation for login form 
$(document).ready(function(){
    $('#login').click(function()
    {
        if ($('#currentuser').val() === ""){
            $('#currentuser').after("<p style='color:red'>Invalid User Name!</p>");
            return false;
        }else {
            $('#currentuser').siblings().remove();
        }
        if ($('#password').val() === ""){
            $('#password').after("<p style='color:red'>Invalid Password!</p>");
            return false;
        }else {
            $('#password').siblings().remove();
        }
    });    
});
