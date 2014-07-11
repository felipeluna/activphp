$(document).ready(function(){
	
	function ajaxAutocomplete(element){

		var searchid = $(element).val();
		var filtro = $("select[name='filtro']").val();
		var jsondata = new Object();//"{'search' : '"+searchid+"' , 'filtro' : '"+filtro+"'}";
		// jsondata = jQuery.parseJSON(jsondata);
		// jsondata.search = searchid;
		// jsondata.filtro = filtro;
		// alert(jsondata.filtro);
		// jsondata = jQuery.parseJSON(jsondata);
		// jsondata = JSON.stringify(jsondata);
		
		if(true)
		{
		    $.ajax({
		    type: "POST",
		    url: "busca_interesses.php",
		    data: {search: searchid, filtro: filtro},
		    dataType: 'html',
		    cache: false,
		    success: function(html){
			    	$("#result").html(html).show();
			    },
			error: function(req, status, error) {
					alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
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
		var filtro = $("select[name='filtro']").val();
		// alert(filtro);
		if(filtro == 'atividades'){
			ajaxAutocomplete($(this));
		}
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