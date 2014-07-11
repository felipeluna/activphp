function loadContentTemp(pageTemp, p_id){
	

   $.ajax({
	    type: "POST",
	    url: "content-temp/search_result.php",
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


	$("#result").on("click", function(e){

	    var $clicked = $(e.target);

	    var $name;
	    
	    if($clicked.attr('class') == 'name'){
	    	$name = $clicked.html();
	    }else{
	    	$name = $clicked.find('.name').html();	
	    }

	    id = $clicked.find('.idusuarios').val();

	    var decoded = $("#inputBusca270px").html($name).text();
	    $('#inputBusca270px').val(decoded);

	    alert("id: "+id);
	    //teste


	    loadContentTemp('search_result', id);
	});

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