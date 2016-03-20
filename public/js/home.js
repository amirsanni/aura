var appRoot = "http://localhost/aura/";

logUserIn();


/**
 * Automatically log user in if email and password exists in local storage
 * @returns {undefined}
 */
function logUserIn(){
    var email = localStorage['logInEmail'];
    var password = localStorage['logInPassword'];
    
    if(email && password){
        $.ajax({
            url: appRoot+"home/login",
            method: "POST",
            data: {emailLogIn:email, logInPassword:password}
        }).done(function(){
            location.href = appRoot+"projects";
        });
    }
}