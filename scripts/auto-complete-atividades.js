function loadContentTemp(pageTemp, p_id){
	

   $.ajax({
	    type: "POST",
	    url: "content-temp/"+pageTemp+".php",
	    data: {id: p_id},
	    dataType: 'html',
	    cache: false,
	    success: function(page){
		    	$('#content-temp').html(page);
		    },
		error: function(req, status, error) {
				alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
				}
	});

	$('#content-temp').fadeIn('fast');
}

$(document).ready(function(){
	
	function setclick(){
		$('.autocomplete-item').click(function(){

			var $clicked = $(this);

		    var $name = $clicked.find('.name').html();
		    
		    var decoded = $("#inputBusca270px").html($name).text();
		    $('#inputBusca270px').val(decoded);

		    if($clicked.hasClass('pessoa-item')){
		    	id = $clicked.find('.idusuario').val();
				loadContentTemp('user_profile', id);
		    }else if($clicked.hasClass('atividade-item')){
				id = $clicked.find('.idatividade').val();
				alert('Atividade id: '+id);
				// loadContentTemp('user_profile', id);
		    }else if($clicked.hasClass('interesse-item')){
		    	id = $clicked.find('.idinteresse').val();
		    	alert('Interesse id: '+id);
		    }		    
		});
	}

	function ajaxAutocomplete(element){

		var searchid = $(element).val();
		var filtro = $("select[name='filtro']").val();
		// var jsondata = new Object();//"{'search' : '"+searchid+"' , 'filtro' : '"+filtro+"'}";
		// jsondata = jQuery.parseJSON(jsondata);
		// jsondata.search = searchid;
		// jsondata.filtro = filtro;
		// alert(jsondata.filtro);
		// jsondata = jQuery.parseJSON(jsondata);
		// jsondata = JSON.stringify(jsondata);
		
		    $.ajax({
		    type: "POST",
		    url: "busca_interesses.php",
		    data: {search: searchid, filtro: filtro},
		    dataType: 'html',
		    cache: false,
		    success: function(html){
			    	$("#result").html(html).show();
			    	setclick();
			    },
			error: function(req, status, error) {
					alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
   				}
		    });
		return false;
	}

	$("#inputBusca270px").keyup(function()
	{ 
		ajaxAutocomplete($(this));
	});

	$("#inputBusca270px").focus(function()
	{ 
		var filtro = $("select[name='filtro']").val();

		if(filtro == 'atividades'){
			ajaxAutocomplete($(this));
		}
	});



	// $("#result .autocomplete-item").on("click", function(e){

	//     var $clicked = $(e.target);

	//     var $name;
	    
	//     if($clicked.attr('class') == 'name'){
	//     	$name = $clicked.html();
	//     	$clicked = $clicked.parent();
	//     }else{
	//     	$name = $clicked.find('.name').html();	
	//     }

	//     var decoded = $("#inputBusca270px").html($name).text();
	//     $('#inputBusca270px').val(decoded);

	//     id = $clicked.find('.idusuario');
	//     alert("id: "+id);
	//     //teste

	// 	if(id){
	// 		loadContentTemp('user_profile', id);
	// 	}else{
	// 		loadContentTemp('atividade_view', id);
	// 	}
	    
	// });

	$(document).on("click", function(e) { 

		var $clicked = $(e.target);

		if (! $clicked.hasClass("search")){
			$("#result").html("");
		    $("#result").fadeOut(); 
    	}
	});

	$('#inputBusca270px').click(function(){
	    $("#result").fadeIn();
	});


});