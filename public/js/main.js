'use strict';

var appRoot = "http://localhost/aura/";

$(document).ready(function(){
    
    //for popover
    $('[data-toggle="popover"]').popover();
    
    
    //for tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    
    //To validate form fields
    $('form').on('change focusout', '.checkField', function(){
        
        //set the id of the span any error will be displayed
        //It's usually the id of the form field plus the string "Err"
        var errSpan = "#"+$(this).attr('id')+"Err";
        
        if($(this).val()){
            $(errSpan).html('');
        }

        else{
            $(errSpan).html('required');
        }
    });
    
    
    $("#logout").click(function(){
        $.ajax({
            url: appRoot+"logout",
            method: "GET"
        }).done(function(){
            location.reload();
        });
    });
    
});


/**
 * Change the class name of elements
 * @param {type} elementId
 * @param {type} newClassName
 * @returns {String}
 */
function changeClassName(elementId, newClassName){
    
    //just change value if it's a single element
    if(typeof(elementId) === "string"){
        $("#"+elementId).attr('class', newClassName);
    }
    
    //loop through if it's an array
    else{
        var i;
    
        for(i in elementId){
            $("#"+elementId[i]).attr('class', newClassName);
        }
    }
    return "";
}


/**
 * Change the innerHTML of elements
 * @param {type} elementId
 * @param {type} newValue
 * @returns {String}
 */
function changeInnerHTML(elementId, newValue){
    //just change value if it's a single element
    if(typeof(elementId) === "string"){
        $("#"+elementId).html(newValue);
    }
    
    //loop through if it's an array
    else{
        var i;
    
        for(i in elementId){
            $("#"+elementId[i]).html(newValue);
        }
    }
    
    
    return "";
}


/**
 * Change the value of elements
 * @param {type} elementId
 * @param {type} newValue
 * @returns {String}
 */
function changeElementValue(elementId, newValue){
    
    //just change value if it's a single element i.e. if elementId passed to function is not an array
    if(typeof(elementId) === "string"){
		$("#"+elementId).val(newValue);
    }
    
    //loop through if it's an array
    else{
        var i;
    
        for(i in elementId){
			$("#"+elementId[i]).val(newValue);
        }
    }
    return "";
}


/**
 * 
 * @param {type} pageName
 * @returns {undefined}
 */
function loadPage(urlToLoad){
    $.ajax({
        type: "GET",
        url: appRoot+urlToLoad,
        success: function(returnedData){
            document.getElementById('pageContent').innerHTML = returnedData.pageContent;
            document.getElementById('pageTitle').innerHTML = returnedData.pageTitle;
            //window.history.pushState("", "", "");
        }
    });
}



/**
 * Checks if changes are made to a form
 * credits to Craig Buckler "http://www.sitepoint.com/javascript-form-change-checker/"
 * @param {type} form
 * @returns {Array|formChanges.changed}
 */
function formChanges(form) {
    if (typeof(form) === "string"){
        form = document.getElementById(form);
    }
    
    if (!form || !form.nodeName || form.nodeName.toLowerCase() !== "form"){
        return null;
    }
    
    var changed = [], n, c, def, o, ol, opt;
    
    for (var e = 0, el = form.elements.length; e < el; e++) {
        n = form.elements[e];
        c = false;
        
        switch (n.nodeName.toLowerCase()) {

            // select boxes
            case "select":
                def = 0;
                
                for (o = 0, ol = n.options.length; o < ol; o++) {
                    opt = n.options[o];
                    c = c || (opt.selected !== opt.defaultSelected);
                    if (opt.defaultSelected){
                        def = o;
                    }
                }
                
                if (c && !n.multiple){
                    c = (def !== n.selectedIndex);
                }
                break;
                
            //input/textarea
            case "textarea":
            case "input":

                switch (n.type.toLowerCase()) {
                    case "checkbox":
                    case "radio":
                    
                    // checkbox / radio
                    c = (n.checked !== n.defaultChecked);
                    break;
                    
                    default:
                    // standard values
                    c = (n.value !== n.defaultValue);
                    break;
                }
                
                break;
        }

        if (c){
            changed.push(n);
        }
    }
    
    
    //return true or false based on the length of variable "changed"
    if(changed.length > 0){
        return true;
    }
    
    else{
        return false;
    }
}


/**
 * Function to handle the display of messages
 * @param {type} msg
 * @param {type} iconClassName
 * @param {type} color
 * @param {type} time
 * @returns {undefined}
 */
function displayFlashMsg(msg, iconClassName, color, time){
    changeClassName('flashMsgIcon', iconClassName);//set spinner class name
    $("#flashMsg").css('color', color);//change font color
    changeInnerHTML('flashMsg', msg);//set message to display
    $("#flashMsgModal").modal('show');//display modal
    
    //hide the modal after a specified time if time is specified
    if(time){
        setTimeout(function(){$("#flashMsgModal").modal('hide');}, time);
    }
}


/**
 * 
 * @returns {undefined}
 */
function hideFlashMsg(){
    changeClassName('flashMsgIcon', "");//set spinner class name
    $("#flashMsg").css('color', '');//change font color
    changeInnerHTML('flashMsg', "");//set message to display
    $("#flashMsgModal").modal('hide');//hide modal
}


/**
 * Change message being displayed and hide the modal if time is set
 * @param {type} msg
 * @param {type} iconClassName
 * @param {type} color
 * @param {type} time
 * @returns {undefined}
 */
function changeFlashMsgContent(msg, iconClassName, color, time){
    changeClassName('flashMsgIcon', iconClassName);//set spinner class name
    $("#flashMsg").css('color', color);//change font color
    changeInnerHTML('flashMsg', msg);//set message to display
    
    //hide the modal after a specified time if time is specified
    if(time){
        setTimeout(function(){$("#flashMsgModal").modal('hide');}, time);
    }
}



/**
 * To ensure only numbers are allowed as input
 * @param {type} value
 * @param {type} elementId
 * @returns {undefined}
 */
function numOnly(value, elementId){
    $("#"+elementId).val(value.replace(/\D+/g, ""));
}


/**
 * ensure field is properly filled
 * @param {type} value
 * @param {type} errorElementId
 * @returns {undefined}
 * @deprecated v1.0.0
 */
function checkField(value, errorElementId){
    if(value){
        $("#"+errorElementId).html('');
    }
    
    else{
        $("#"+errorElementId).html('required');
    }
}



/**
 * 
 * @param {type} length
 * @returns {String}
 */
function randomString(length){
    var rand = Math.random().toString(36).slice(2).substring(0, length);
    
    return rand;
}



function scrollToDiv(divElem){
    $('html, body').animate({
        scrollTop: $(divElem).offset().top
    }, 1000);
}