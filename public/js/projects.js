'use strict';

$(document).ready(function(){
    //checkDocumentVisibility(checkLogin);//check document visibility in order to confirm blog's log in status
    
   // $("#userProjects").on('click', '.createProject', function(){
    $("#createProject").click(function(e){ 
        e.preventDefault();
        $("#userProjects").addClass('hidden');
        $("#createProjectDiv").removeClass('hidden');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $(".closeCreateProject").click(function(e){
        e.preventDefault();
        
        $("#userProjects").removeClass('hidden');
        $("#createProjectDiv").addClass('hidden');
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    $("#userProjects").on('click', '.editProject', function(){
        var blogId = $(this).attr('id').split('-')[1];
     //   alert(blogId);
        editBlog(blogId);
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    //handles the addition of new blog details .i.e. when "add blog" button is clicked   $("#addBlogSubmit").click(function(e){    ...$('#addBlogSubmit').on('click', 'div', function(e) {
       $("#addProjectSubmit").click(function(){ 
     //  	confirm("I am an alert box!");
        
        //reset all error msgs in case they are set
        changeInnerHTML(['titleErr', 'descErr'], "");
        
        var title = $("#title").val();
        var body = $("#desc").val();
        
        //ensure all required fields are filled
        if(!title || !desc ){
            !title ? changeInnerHTML('titleErr', "required") : "";
            !desc ? changeInnerHTML('descErr', "required") : "";
            
            return;
        }
        
        
        var images = document.getElementById('image').files;

        //set info to send to server
        var formInfo = new FormData();

        for (var i = 0; i < images.length; i++) {
            var file = images[i];

            // Add the file to the request.
            formInfo.append("images", file);
        }
        
        
        //add other info to the formInfo obj
        formInfo.append("title", title);
        formInfo.append("desc", desc);
        
        //display message telling blog action is being processed
        $("#fMsgIcon").attr('class', spinnerClass);
        $("#fMsg").html(" Processing...");
        
        //make ajax request if all is well
        $.ajax({
            method: "POST",
            url: appRoot+"blogs/add",
            data: formInfo,
            cache: false,
            processData: false,
            contentType: false
        }).done(function(returnedData){
                $("#fMsgIcon").removeClass();//remove spinner
                
                if(returnedData.status === 1){
                    $("#fMsg").css('color', 'green').html("Blog post added");
                    
                    //reset the form and close the modal
                    document.getElementById("addNewBlogForm").reset();
					
                    //reset the form and close the modal
                    setTimeout(function(){
                        $("#fMsg").html("");
                        $("#addNewBlogModal").modal('hide');
                    }, 2000);
                    
                    //reset all error msgs in case they are set
                    changeInnerHTML(['titleErr', 'bodyErr', 'authorErr'], "");
                    
                    //refresh blogs list table
                    lab_();                    
                }
                
                else{
                    //display error message returned
                    $("#fMsg").css('color', 'red').html(returnedData.msg);

                    //display individual error messages if applied
                    $("#titleErr").html(returnedData.blogname);
                    $("#bodyErr").html(returnedData.first_name);
                    $("#authorErr").html(returnedData.last_name);
                    $("#logoErr").html(returnedData.logo_error);
                }
            }).fail(function(){
                if(!navigator.onLine && (appRoot.search("localhost") > -1)){
                    $("#fMsg").css('color', 'red').text("Network error! Pls check your network connection");
                }
                
                else{
                    $("#fMsg").css('color', 'red').text("Unable to process your request at this time");
                }
            });
    });
    
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    //handles the updating of customer details update
    $("#editBlogSubmit").click(function(e){
        e.preventDefault();
        
        //reset all error msgs in case they are set
        changeInnerHTML(['titleEditErr', 'bodyEditErr', 'authorEditErr'], "");
        
        var title = $("#titleEdit").val();
        var body = $("#bodyEdit").val();
        var author = $("#authorEdit").val();
        var logo = document.getElementById('newLogo').files;
        var blogId = $("#blogId").val();
        
        //ensure all required fields are filled
        if(!title || !body || !author){
            !title ? changeInnerHTML('titleEditErr', "required") : "";
            !body ? changeInnerHTML('bodyEditErr', "required") : "";
            !author ? changeInnerHTML('authorEditErr', "required") : "";
                        
            return;
        }
        
        if(!blogId){
            displayFlashMsg("An error occured while trying to update blog's details", '', 'red', '');
            return;
        }
        
        var formInfo = new FormData();
        
        for(var i=0; i<logo.length; i++){
            var l = logo[i];
            
            formInfo.append('logo', l);
        }
        
        formInfo.append('title', title);
        formInfo.append('body', body);
        formInfo.append('author', author);
        formInfo.append('id', blogId);
        
        //display message telling blog action is being processed
        displayFlashMsg('Updating. Pls wait...', '', 'black', '');
        
        //make ajax request if all is well
        $.ajax({
            method: "POST",
            url: appRoot+"blogs/update",
            data: formInfo,
            cache: false,
            processData: false,
            contentType: false,
            success: function(returnedData){
                $("#fMsgEditIcon").removeClass();//remove spinner
                
                if(returnedData.status === 1){                    
                    changeFlashMsgContent(returnedData.msg, '', 'green', 2000);
                    
                    //reset all error msgs in case they are set
                    changeInnerHTML(['titleEditErr', 'bodyEditErr', 'authorEditErr'], "");
                    
                }
                
                else{
                    //display error message returned
                    $("#fMsgEdit").css('color', 'red').html(returnedData.msg);

                    //display individual error messages if applied
                    $("#titleEditErr").html(returnedData.title);
                    $("#bodyEditErr").html(returnedData.body);
                    $("#authorEditErr").html(returnedData.author);
                }
            },
            
            error: function(){
                if(!navigator.onLine){
                    $("#fMsgEdit").css('color', 'red').text("Network error! Please check your network connection");
                }
            }
        });
    });
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * To show modal to edit customer details
     * @param {type} id
     * @returns {undefined}
     */
    function editBlog(id){
        //show modal, get blog details and populate the form with it
        
        $("#allBlogs").addClass('hidden');
        $("#editBlogDiv").removeClass('hidden');
        $("#fMsgEditIcon").addClass(spinnerClass);
        $("#fMsgEdit").text("Fetching details...");
        
        $.ajax({
            type: "post",
            url: appRoot+"blogs/get_blog_det",
            data: {id:id},
            success: function(returnedData){
                if(returnedData.status === 1){
                    $("#titleEdit").val(returnedData.title);
                    $("#bodyEdit").val(returnedData.body);
                    $("#authorEdit").val(returnedData.author);
                    $("#logoEdit").attr('src', returnedData.logo);
                    $("#blogId").val(returnedData.id);
                    
                    $("#fMsgEdit").text("");
                    $("#fMsgEditIcon").removeClass();
                }
                
                else{
                    $("#fMsgEdit").text("Error fetching customer details");
                    $("#fMsgEditIcon").removeClass();
                }
            }
        });
    }


    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * lab_ = "Load all blogs"
     * @returns {undefined}
     */
    function lab_(url){
        var orderBy = $("#blogListSortBy").val().split("-")[0];
        var orderFormat = $("#blogListSortBy").val().split("-")[1];
        var limit = $("#blogListPerPage").val();
        
        $.ajax({
            method:'get',
            url: url ? url : appRoot+"blogs/lab_/",
            data: {orderBy:orderBy, orderFormat:orderFormat, limit:limit},
            
            success: function(returnedData){
                hideFlashMsg();
    			
                $("#allBlogs").html(returnedData.blogsTable);
            },
            
            error: function(){
                
            }
        });
    }

});