
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
						data: $("#editform").serialize(),
						success: function(data){
								showSuccess("Dados alterados com sucesso! =D");
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
				alert("HWERASDF 7X1");
				$("select[name='cidade']").html(data);
			},
			error: function(){
				alert('Erro ao carregar cidades');
			}
			});
	});
});