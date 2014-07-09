$(function(){
	


// $.validator.addMethod('onlyletters', function (value) { 
//     return /([A-Za-z])/.test(value); 
// }, 'Apenas letras');


	$('#cadastroForm').validate({
		rules:{
			username: {
				required: true
			},
			email: {
				required: true

			},
			pass1: {
				required: true
				
			},
			pass2: {
				required: true

			}
		},
		success: function(element){
			element.remove();
		}

	});

});