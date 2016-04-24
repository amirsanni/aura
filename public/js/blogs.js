'use strict';

$(document).ready(function(){
	
    $(".loadComments").click(function(){
		var showCommentsElem = $(this);
		
        var postId = $(this).attr('id').split("-")[1];
		
        if(postId){
			console.log(postId);
            $("#showCommentsHere").html("<i class='"+spinnerClass+"'></i> Fetching Comments").removeClass("hidden");
            
            $.ajax({
                url: appRoot+"blog/gpc",
                method: "GET",
                data: {pid:postId}
            }).done(function(returnedData){
                if(returnedData.status === 1){
                    $("#showCommentsHere").html(returnedData.c);
					
					//hide "show comments" text
					$(showCommentsElem).addClass("hidden");
                }
                
                else{
                    $("#showCommentsHere").html("No comments found");
                }
            }).fail(function(){
                
            });
        }
		
		else{
			console.log("No ID");
		}
    });
});