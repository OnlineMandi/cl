

$(document).ready(function() {

    var ajaxloading  = false;
	$(document).on('click', ".attr-status", function () {
        var id = $(this).attr('data-id');
		var status_token = $(this).attr('data-status');
		var category_id = $(this).attr('data-category');
		var attr_type = $(this).attr('data-type');
		
        var current = $(this);
        var btn_text = current.html();
        if (typeof status_change_url !== 'undefined') {
            var status_url = status_change_url;
            // the variable is defined
        } else {
            var status_url = current_url;
        }
        if(ajaxloading==false){

            ajaxloading = true;
            current.html('<img src="'+baseurl+'/images/ajax-loader.gif">');
            $.post(status_url,{'id':id, 'status_token':status_token, 'category_id':category_id , 'attr_type':attr_type}, function(data){
                if(data.result==1){
                    if(data.action=="Active"){
                        current.removeClass('btn-danger').addClass('btn-success');
						current.attr('data-status', '1');
                    } else {
                        current.removeClass('btn-success').addClass('btn-danger');
						current.attr('data-status', '2');
                    }
                    current.html(data.action);
                } else {
                    current.html(btn_text);
                }
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?

                alert(thrownError); //alert with HTTP error


            });
            ajaxloading = false;
        }
    });
	$('.a_r , .status').bind('click', function() { 

        var id = $(this).attr('data-id');
        var field = $(this).attr('field');
		var controllers = $(this).attr('controller');
		var model = $(this).attr('model');
        var current = $(this);
        var btn_text = current.html();
		
		if(controllers == undefined){
			url = baseurl+"/"+controller;
		}else{
			url = baseurl+"/"+controllers;
		}
		if(field == undefined || field == ''){
			field = 'status';
		}		
		if(model == undefined || model == ''){
			model = null;
		}	
        if(ajaxloading==false){

            ajaxloading = true;
            current.html('<img src="'+baseurl+'/images/ajax-loader.gif">');
            $.post(url+"/update-any-status",{'id':id,'field':field,'status_token':1,'model':model}, function(data){
                if(data.result==1){
                   if(data.action=="Active"){
                        current.removeClass('btn-danger').addClass('btn-success');
                    } else {
                        current.removeClass('btn-success').addClass('btn-danger');
                    }
                    current.html(data.action);
                } else {
                    current.html(btn_text);
                }
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?

                alert(thrownError); //alert with HTTP error


            });
            ajaxloading = false;
        }
    });
	
	
    $(document).on('click', ".all_status", function () {
        var id = $(this).attr('data-id');
        var current = $(this);
        var controller = $(this).attr('controller');
        var btn_text = current.html();
        if(ajaxloading==false){

            ajaxloading = true;
            current.html('<img src="'+baseurl+'/images/ajax-loader.gif">');
            $.post(admin_url+"/"+controller+"/update-status",{'id':id}, function(data){
                if(data.result==1){
                    if(data.action=="Active"){
                        current.removeClass('btn-danger').addClass('btn-success');
                    } else {
                        current.removeClass('btn-success').addClass('btn-danger');
                    }
                    current.html(data.action);
                } else {
                    current.html(btn_text);
                }
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?

                alert(thrownError); //alert with HTTP error


            });
            ajaxloading = false;
        }
    });	
/*     $(document).on('click', ".status", function () {
        var id = $(this).attr('data-id');
        var current = $(this);
        var btn_text = current.html();
        if (typeof status_change_url !== 'undefined') {
            var status_url = status_change_url;
            // the variable is defined
        } else {
            var status_url = current_url;
        }
        if(ajaxloading==false){

            ajaxloading = true;
            current.html('<img src="'+baseurl+'/images/ajax-loader.gif">');
            $.post(status_url,{'id':id, 'status_token':1}, function(data){
                if(data.result==1){
                    if(data.action=="Active"){
                        current.removeClass('btn-danger').addClass('btn-success');
                    } else {
                        current.removeClass('btn-success').addClass('btn-danger');
                    }
                    current.html(data.action);
                } else {
                    current.html(btn_text);
                }
            }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?

                alert(thrownError); //alert with HTTP error


            });
            ajaxloading = false;
        }
    }); */
});