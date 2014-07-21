$(document).ready(function(){


    $(".amigo").click(function(){
    	id = $(this).attr('id');
		loadContentTemp('user-profile-temp', id);
    }); 

});