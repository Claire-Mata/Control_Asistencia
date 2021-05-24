$(document).ready(function(){
    $("#btn").click(function(){
        var email= $("#name").val();
        var password= $("#password").val();
        if(email == ""){
        alert("Por favor ingrese el usuario");    
            return false;
        }
        if(password == ""){
        alert("Por favor ingrese la contraseña"); 
            return false;
        }
    });
})