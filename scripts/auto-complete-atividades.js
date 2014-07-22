$(document).ready(function(){
	
$('#busca200px').submit(function(){
	//pega conteúdo da busca
	var searchid = $(this).find('#inputBusca270px').val();
	var filtro = $("select[name='filtro']").val();

	if(filtro == undefined){

		filtro = $("input[name='filtro']").val();
	}

	searchid = searchid.trim();

	if(searchid != ''){
		$(this).find('#inputBusca270px').removeClass('.error');
		$.ajax({
		    type: "POST",
		    url: "content-temp/search-result-temp.php",
		    data: {search: searchid, filtro: filtro},
		    dataType: 'html',
		    cache: false,
		    success: function(page){
		    		
		    		//carrega conteudo da pagina na div
			    	$('#content-temp').html(page);
			    	//exibe div com conteudo carregado
			    	$('#content-temp').fadeIn('fast');

			    	//oculta resultado do auto-complete
			    	$("#result").html("");
			    	$("#result").fadeOut(); 
			    },
			error: function(req, status, error) {
					alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
					}
	    });
	}else{
		$(this).find('#inputBusca270px').addClass('.error');
		showNotice('Digite algo para fazer a busca');
	}
	return false;
});


	function busca(searchFor){
		//pega conteúdo da busca
	var searchid = searchFor;
	var filtro = 'interesses';
	$.ajax({
	    type: "POST",
	    url: "content-temp/search-result-temp.php",
	    data: {search: searchid, filtro: filtro},
	    dataType: 'html',
	    cache: false,
	    success: function(page){
	    		
	    		//carrega conteudo da pagina na div
		    	$('#content-temp').html(page);
		    	//exibe div com conteudo carregado
		    	$('#content-temp').fadeIn('fast');

		    	//oculta resultado do auto-complete
		    	$("#result").html("");
		    	$("#result").fadeOut(); 
		    },
		error: function(req, status, error) {
				alert("Erro: "+req.responseText+"; Status: "+status+"; Error: "+error);
				}
	    });
	}

	function setclick(){
		$('.autocomplete-item, .search-item').click(function(){

			var $clicked = $(this);

		    var $name = $clicked.find('.name').html();
		    
		    var decoded = $("#inputBusca270px").html($name).text();
		    $('#inputBusca270px').val(decoded);
		    $("#content-temp").unload();

		    if($clicked.hasClass('pessoa-item')){
		    	id = $clicked.find('.idusuario').val();
				loadContentTemp('user-profile-temp', id);
		    }else if($clicked.hasClass('atividade-item')){
				id = $clicked.find('.idatividade').val();
				loadContentTemp('atividade_view', id);
				// alert('Atividade id: '+id);
				// loadContentTemp('user_profile', id);
		    }else if($clicked.hasClass('interesse-item')){
		    	id = $clicked.find('.idinteresse').val();
		    	busca(id);
		    }		    
		});
	}

	function ajaxAutocomplete(element){

		var searchid = $(element).val();
		var filtro = $("select[name='filtro']").val();

		if(filtro == undefined){
			filtro = $("input[name='filtro']").val();
		}
		// var jsondata = new Object();//"{'search' : '"+searchid+"' , 'filtro' : '"+filtro+"'}";
		// jsondata = jQuery.parseJSON(jsondata);
		// jsondata.search = searchid;
		// jsondata.filtro = filtro;
		// alert(jsondata.filtro);
		// jsondata = jQuery.parseJSON(jsondata);
		// jsondata = JSON.stringify(jsondata);
		
		    $.ajax({
		    type: "POST",
		    url: "submit/busca_autocomplete.php",
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