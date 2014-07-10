$(document).ready(function(){
	
	function ajaxAutocomplete(element){

		var searchid = $(element).val();
		var dataString = 'search='+ searchid;
		if(true)
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
	}

	$("#inputBusca270px").keyup(function()
	{ 
		ajaxAutocomplete($(this));
	});

	$("#inputBusca270px").focus(function()
	{ 
		ajaxAutocomplete($(this));
	});


	$("#result").on("click", function(e){

	    var $clicked = $(e.target);

	    var $name
	    
	    if($clicked.attr('class') == 'name'){
	    	$name = $clicked.html();
	    }else{
	    	$name = $clicked.find('.name').html();	
	    }

	    var decoded = $("#inputBusca270px").html($name).text();
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