$('.deletar-atividade').click(function() {
	if(confirm("Tem certeza que quer deletar a atividade??")){

		//pega id da atividade.
		var tr = $(this).parent().parent();
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
				$(tr).slideUp("normal");
			}
		});
	}
	return false;
});

$('.editar-atividade').click(function() {

	var tr = $(this).parent().parent();
	var id = tr.attr('id');
	loadContentTemp("editar-atividade-temp",id);

});
