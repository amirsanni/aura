'use strict';

$(document).ready(function () {
    
    /**
     * When signup or log in buttons on the modal are clicked
     */
    $("#signUpClk, #loginClk").click(function(e){
        e.preventDefault();
        
        $("#signUpDiv, #logInDiv").toggleClass('hidden');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //When "Log in" on the menu bar is clicked
    $("#logInMenuClk").click(function(e){
        e.preventDefault();
        
        $("#logInDiv").removeClass('hidden');//show the log in form on the modal
        $("#signUpDiv").addClass('hidden');//hide the sign up form
        
        $("#signLogModal").modal('show');//show the modal
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //When "Sign up" on the menu bar is clicked
    /*
     * @deprecated
     */
    /*$("#signUpMenuClk").click(function(e){
        e.preventDefault();
        
        $("#logInDiv").addClass('hidden');//hide the log in form on the modal
        $("#signUpDiv").removeClass('hidden');//show the sign up form
        
        $("#signLogModal").modal('show');//show the modal
    });
    */

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Check to ensure the email and retype email fields are equal
    $("#emailDup").on('keyup change focusout focus focusin', function(){
        var orig = $("#emailOrig").val();
        var dup = $("#emailDup").val();
        
        if(dup !== orig){
            //show error
            $("#emailDupErr").addClass('fa');
            $("#emailDupErr").addClass('fa-times');
            $("#emailDupErr").removeClass('fa-check');
            $("#emailDupErr").css('color', 'red');
            $("#emailDupErr").html("");
        }
        
        else{
            //show success
            $("#emailDupErr").addClass('fa');
            $("#emailDupErr").addClass('fa-check');
            $("#emailDupErr").removeClass('fa-times');
            $("#emailDupErr").css('color', 'green');
            $("#emailDupErr").html("");
        }
    });
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Check to ensure the password and retype password fields are equal
    $("#pwordDup").on('keyup change focusout focus focusin', function(){
        var orig = $("#pwordOrig").val();
        var dup = $("#pwordDup").val();
        
        if(dup !== orig){
            //show error
            $("#pwordDupErr").addClass('fa');
            $("#pwordDupErr").addClass('fa-times');
            $("#pwordDupErr").removeClass('fa-check');
            $("#pwordDupErr").css('color', 'red');
            $("#pwordDupErr").html("");
        }
        
        else{
            //show success
            $("#pwordDupErr").addClass('fa');
            $("#pwordDupErr").addClass('fa-check');
            $("#pwordDupErr").removeClass('fa-times');
            $("#pwordDupErr").css('color', 'green');
            $("#pwordDupErr").html("");
        }
    });


    /* ==============================================
                SIGN UP FORM VALIDATION
    =============================================== */

    $("#signupSubmit").click(function(){
        //get all values)
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
		var username = $("#username").val();
		var mobile1 = $("#mobile_1").val();
        var emailOrig = $("#emailOrig").val();
        var emailDup = $("#emailDup").val();
        var pwordOrig = $("#pwordOrig").val();
        var pwordDup = $("#pwordDup").val();

        //ensure all fields are filled
        if(!firstName || !lastName || !username || !mobile1 || !emailOrig || !emailDup || !pwordOrig || !pwordDup){
            !firstName ? $("#firstNameErr").html("First name is required") : "";
            !lastName ? $("#lastNameErr").html("Last name is required") : "";
			!username ? $("#usernameErr").html("Username is required") : "";
			!mobile1 ? $("#mobile_1Err").html("Mobile Number is required") : "";
            !emailOrig ? $("#emailOrigErr").html("Please provide your e-mail address") : "";
            !emailDup ? $("#emailDupErr").html("Please retype your e-mail address") : "";
            !pwordOrig ? $("#pwordOrigErr").html("Enter your preferred password") : "";
            !pwordDup ? $("#pwordDupErr").html("Please retype your password") : "";

            return;
        }

        //ensure the two emails and passwords match
        if((emailOrig !== emailDup) || (pwordOrig !== pwordDup)){
            emailOrig !== emailDup ? $("#emailDupErr").html(" E-mails do not match") : "";

            pwordOrig !== pwordDup ? $("#pwordDupErr").html(" Passwords do not match") : "";

            return;
        }
		
		$("#signupFMsg").html("Processing...");

        //if all is well, make server req
        $.ajax({
            url: appRoot+"home/signup",
            method: "POST",
            data: {firstName:firstName, lastName:lastName, username:username, mobile_1:mobile1, emailOrig:emailOrig, emailDup:emailDup, 
					pwordOrig:pwordOrig, pwordDup:pwordDup}
        })
            .done(function(returnedData){
                if(returnedData.status === 1){
                    //reset form, hide modal and redirect to profile page
                    
                    //$("#signLogModal").modal('hide');
					$("#signupFMsg").html("Registration Completed. Please wait...");
					
					setTimeout(function(){location.reload();}, 1500);
                }

                else{
                    //show all errors
                    $("#firstNameErr").html(returnedData.firstName);
                    $("#lastNameErr").html(returnedData.lastName);
					$("#usernameErr").html(returnedData.username);
					$("#mobile_1Err").html(returnedData.mobile_1);
                    $("#emailOrigErr").html(returnedData.emailOrig);
                    $("#emailDupErr").html(returnedData.emailDup);
                    $("#pwordOrigErr").html(returnedData.pwordOrig);
                    $("#pwordDupErr").html(returnedData.pwordDup);
                }
            })
            
            .fail(function(){
                if(!navigator.onLine){
                    $("#signupFMsg").css('color', 'red').text("Network error! Pls check your network connection");
                }
            });
    });
    
    
    /* ==============================================
                LOG IN FORM VALIDATION
    =============================================== */
    
    $("#loginSubmit").click(function(e){
        e.preventDefault();
        
        //get values
        var emailLogIn = $("#emailLogIn").val();
        var logInPassword = $("#logInPassword").val();
        
        if(!emailLogIn || !logInPassword){
            !emailLogIn ? $("#emailLogInErr").html("Enter your e-mail") : "";
            !logInPassword ? $("#logInPasswordErr").html("Enter your password") : "";
            
            return;
        }
        
        $("#logInFMsg").css('color', 'black').html("Authenticating...");
        
        //if all is well, make server req
        $.ajax({
            url: appRoot+"home/login",
            method: "POST",
            data: {emailLogIn:emailLogIn, logInPassword:logInPassword}
        }).done(function(returnedData){
            if(returnedData.status === 1){
                $("#logInFMsg").css('color', 'black').html("Authenticated. Logging in...");
                
                //store email and password in local storage if "remMe" checkbox is checked
                if($("#remMe").prop("checked")){
                    setRemMeDetails(emailLogIn, logInPassword);
                }
                
                setTimeout(function(){
					location.reload()
				}, 500);
            }
            
            else{
                $("#logInFMsg").html(returnedData.msg);
            }
        }).fail(function(){
            $("#logInFMsg").html("Req failed");
        });
    });
});



/**
 * Save user's log in details to allow user to log in automatically on next visit
 * @param {type} email
 * @param {type} password
 * @returns {undefined}
 */
function setRemMeDetails(email, password){
    if(Modernizr.localstorage){
        try{
            localStorage['logInEmail'] = email;
            localStorage['logInPassword'] = password;
        }
        
        catch(exception){}
    }
    
    return "";
}