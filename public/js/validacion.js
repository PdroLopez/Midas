function validacion(){
    var pw1 = document.getElementById("inputPassword1"); 
    var pw2 = document.getElementById("inputPassword2"); 
    if(pw1.value != null){
        if(pw1.value == pw2.value){
            ;
            if (document.getElementById("buton")!=null) {
                document.getElementById("buton").style.display = 'block';
            }
            var pw2 = document.getElementById("inputPassword2").style.borderColor = '#47a447'; 
        }
        else{
            if (document.getElementById("buton")!=null) {
                document.getElementById("buton").style.display = 'none';
            }
            var pw2 = document.getElementById("inputPassword2").style.borderColor = '#d2322d'; 

        }
    }
}