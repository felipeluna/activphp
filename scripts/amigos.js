$(document).ready(function(){


    $(".amigo").click(function(){
    	id = $(this).attr('id');
		loadContentTemp('user-profile-temp', id);
    }); 

    $('#tab-content').load('amigoscontent/meus-amigos.php');

});