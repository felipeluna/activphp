$(document).ready(function(){
	
	$("#inputBusca270px").keyup(function()
	{ 
		var searchid = $(this).val();
		var dataString = 'search='+ searchid;
		if(searchid!='')
		{
		    $.ajax({
		    type: "POST",
		    url: "busca_interesses.php",
		    data: dataString,
		    cache: false,
		    success: function(html){
			    	$("#result").html(html).show();
			    }
		    });
		}return false;    
	});

	$("#result").on("click", function(e){ 
	    var $clicked = $(e.target);
	    var $name = $clicked.find('.name').html();
	    var decoded = $("<div/>").html($name).text();
	    $('#inputBusca270px').val(decoded);
	});

	$(document).on("click", function(e) { 
		var $clicked = $(e.target);
		if (! $clicked.hasClass("search")){
		    $("#result").fadeOut(); 
    	}
	});

	$('#inputBusca270px').click(function(){
	    $("#result").fadeIn();
	});


});