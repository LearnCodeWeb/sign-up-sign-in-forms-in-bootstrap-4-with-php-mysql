$(function(){
	var images=[
		'https://images.pexels.com/photos/1558732/pexels-photo-1558732.jpeg',
		'https://images.pexels.com/photos/1287075/pexels-photo-1287075.jpeg',
		'https://images.pexels.com/photos/326055/pexels-photo-326055.jpeg'
	];
	setInterval(function(){
		var url	=	images[Math.floor(Math.random() * images.length)];
		$("body").css({'background':'url('+url+') no-repeat center center fixed','background-size':'cover cover','body':'100vh'});
	},5000);
	
	$('[data-toggle="tooltip"]').tooltip();
	
});
function formValidate(formId,formMsg){
	var flag	=	0;
	$(formId).find('[data-required]').each(function(){
		if($(this).val()===""){
			$(this).addClass('is-invalid');
			flag	=	1;
		}else{
			$(this).removeClass('is-invalid');
			$(this).addClass('is-valid');
			$(formMsg).html('');
		}
	});
	if(flag==1){
	    $(formMsg).html('<div class="text-danger"><i class="fa fa-exclamation-circle"></i> Asterisk fields are mandatory! </div>');
		return false;
	}
	
	$(".overlay").show();
	$(".overlay").html('<div class="text-light"><span class="spinner-grow spinner-grow-sm" role="status"></span> Please wait...!</div>');
	setTimeout(function(){$(".overlay").hide()},800);
	$.ajax({
		type:'POST',
		url:'ajax/action-form.php',
		data:$(formId).serialize(),
		success: function(data){
			setTimeout(function(){$(".overlay").hide()},800);
			var a	=	 data.split('|***|');
			if(a[1]==1){
				$(formMsg).html(a[0]);
				if(typeof(a[2]) != "undefined" && a[2] !== null) {
					setTimeout(function(){window.location.href=""+a[2]},800);
				}
			}else{
				$(formMsg).html(a[0]);
			}
		}
	});
	
}