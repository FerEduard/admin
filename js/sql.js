$(document).ready(function(){
	$("#limpiar").click(function(){ $("#forma")[0].reset(); });
	
	$("#guardar").click(function(){	
		var array = {tabla : $("#forma").attr("name")};
		//En caso de actualizar
		if(!isEmpty()){
			array["UP"] = "S";
			$(".df").each(function(key, value) {
				array["(id)"+ $(this).attr("id")] = $(this).val();
			});
		}
		
		$(".frm").each(function() {
			array[$(this).attr("name")] = $(this).val();
        });
			
		$.ajax({
			data: array,
			type: "POST",
			dataType: "json",
			url: "class/op.php",
		})
		 .done(function( data, textStatus, jqXHR ) {
			if (typeof data.mensaje !== 'undefined') {
				$("#cuerpo-mensaje").html(data.mensaje);
				$('#mensaje').modal('show');
				
				if (typeof data.ok == 'undefined') {
					$("#forma")[0].reset();
					return;
				}
			}
			 
			 $.each(data, function(key, value){
				 $(".df").each(function() {
					 if($(this).attr("id") == key){
					 	$(this).val(value);
					 }
				});
			 });
		 })
		 .fail(function( jqXHR, textStatus, errorThrown ) {
			 if ( console && console.log ) {
				 console.log( "La solicitud a fallado: " +  textStatus);
			 }
		});
	});
	
	$(".df").focusout(function(){
		var array = {tabla : $("#forma").attr("name")};
		var vacios = false;
		
		$(".df").each(function() {
			array[$(this).attr("name")] = $(this).val();
			if($(this).val() == ''){
				vacios = true;
			}
        });
		
		
		if(vacios){
			return;
		}
		
		$.ajax({
			data: array,
			type: "POST",
			dataType: "json",
			url: "class/find.php",
		})
		 .done(function( data, textStatus, jqXHR ) {
			if (typeof data.mensaje !== 'undefined') {
				$("#forma")[0].reset();
				$("#cuerpo-mensaje").html(data.mensaje);
				$('#mensaje').modal('show');
				return;
			}
			
			 $.each(data, function(key, value){
				 $(".frm").each(function() {
					 if($(this).attr("id") == key){
					 	$(this).val(value);
					 }
				});
			 });
		 })
		 .fail(function( jqXHR, textStatus, errorThrown ) {
			 $("#forma")[0].reset();
		});
	});
	
	function isEmpty(){
		var vacios = false;
		$(".df").each(function() {
			if($(this).val() == ''){
				vacios = true;
			}
        });	
		return vacios;
	}
});