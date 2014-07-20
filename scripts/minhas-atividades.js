$('.deletar').click(function() {
	var confirmado = confirm("Tem certeza que quer deletar a atividade??");
	if(confirmado){

		//pega id da atividade.
		var tr = $(this).parent();
		var id = tr.attr('id');
		// alert(id);
		//usar o metodo post de ajax com 3 parametros
		// php, json, e funcao anonima que passa os dados.
		//acho que o json tá errado =s
		$.ajax({
			url: 'atividadescontent/deletar-atividades.php',
			type: 'post',
			dataType: 'html',
			data: {id : id},
			success: function(){
				showSuccess("Atividade Excluída com SUCESSO");
				$(tr).slideUp();
			}
		});
	}
	return false;
});

$('.editar').click(function() {

	var tr = $(this).parent();
	var id = tr.attr('id');
	loadContentTemp("editar-atividade-temp",id);

	return false;
});

$('.atividade, .quando-onde').click(function(e) {
	// var clicked = e.target;
	// clicked = $(clicked).attr('class');
	// if(clicked != 'editar-atividade' && clicked != 'deletar-atividade'){
		var id = $(this).parent().attr('id');
		// alert("valor: "+id);
		loadContentTemp("atividade_view",id);
	// }

});
