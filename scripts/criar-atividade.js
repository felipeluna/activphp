$( document ).ready(function() {

	$("form[name='criar-atividade-form']").submit(function(){
		// 
		$.ajax({
			url: 'atividadescontent/cadastrar-atividade.php',
			type: 'POST',
			dataType: 'html',
			data: $(this).serialize(),
			success: function(data){
				data = data.trim();
				if(data == 'atividade.ok'){
					showSuccess("Atividade criada com sucesso! =D");
				}else{
					// alert(data);
					showError("Ops! Preenchidos os campos em vermelho.");
					
					data = JSON.parse(data);
					
					jQuery.each(data, function(key, val) {
						$('input[name='+key+']').addClass('input-error');
					  // $("#" + this).text("My id is " + this + ".");
					  // return (this != "four"); // will stop running to skip "five"
					});
				}
			},
			error: function(){
				showError("Ops! Ocorreu algum erro =/");
			}
			});

		return false;
	});
});