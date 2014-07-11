
// $("#editform").on('submit', function(){
// 	var that = $(this),
// 	url = that.attr('action'),
// 	method = that.attr('method'),
// 	data = {};

// 	that.find('name').each(function(index, value){
// 		var that = $(this),
// 		name = that.attr('name'),
// 		value = that.val();
		
// 		data[name] = value;
// 	});
	
// 	console.log(data);

// 	return false;
// });
$(function(){
			$("#editform").submit(function(){
				$.ajax({
						url: 'edit_submit.php',
						type: 'POST',
						encoding:"UTF-8",
						data: $("#editform").serialize(),
						dataType: 'json',
						success: function(data){
								showSuccess("Dados alterados com sucesso! =D");
								$(".info .nome").html(data.nome);
								$(".info .cidade").html(data.cidade);
							},
						error: function(data){
							showError('Erro>>>>>>>>>>>>>>>>>>>>>>>>>>>>>: '.data);	
						},
						ajaxError: function(){
							showError('Ops! Ocorreu algum erro =(');
						}
					}
				);

				return false;
			});
	});

$( document ).ready(function() {

	$("select[name='uf']").change(function(){
		// 
		$.ajax({
			url: 'loadcidades.php',
			type: 'POST',
			data: $("select[name='uf']").serialize(),
			success: function(data){
				$("select[name='cidade']").html(data);
			},
			error: function(){
				alert('Erro ao carregar cidades');
			}
			});

		return false;
	});
});