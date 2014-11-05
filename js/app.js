$(document).ready(function(){

});

$(window).resize(function(){
	//resize_np();
});

function resize_np(){
	
}

var tot_x = new BigNumber("1");
var tot_y = new BigNumber("1");

var z = new BigNumber("2");
var c = new BigNumber("5");

var n = 1;

$(function(){
	$('.tab').on('click',function(e){
		e.preventDefault();
		$(".block_content").hide();
		$(".tab").removeClass('tab_used');
		$($(this).attr('href')).show('fast');
		$(this).addClass('tab_used');
	});
	$('#block_mouse').on('mousemove',function(e){
		//e.preventDefault();
		if(String(tot_x).length < 128){
			var x = e.pageX - $(this).offset().left + 1;
			x = Math.round(Math.abs(x));
			tot_x.set(tot_x.multiply(x));
		}
		if(String(tot_y).length < 128){
			var y = e.pageY - $(this).offset().top + 1;
			y = Math.round(Math.abs(y));	
			tot_y.set(tot_y.multiply(y));
		}
		
		if(String(tot_x).length < 128 ||String(tot_y).length < 128){
			var percento = (String(tot_x).length + String(tot_y).length) * 100 / 256;
			$(".progress_show").width($("#new_key_progress").width() / 100 * percento);
			$('#block_new_key').html(tot_x + ' ' + tot_y);
			//n++;
		}else{
			$(".progress_show").width($("#new_key_progress").width());
			$("#new_key_button").show('fast');
		}
		//alert(String(tot_y).length);
	});
	/*$('#block_mouse').on('mousemove',function(e){
		//e.preventDefault();
		if(n <= 100){
			var x = e.pageX - $(this).offset().left + 1;
			x = Math.round(Math.abs(x));
			var y = e.pageY - $(this).offset().top + 1;
			y = Math.round(Math.abs(y));

			tot_x.set(tot_x.multiply(x));
			tot_y.set(tot_y.multiply(y));

			$(".progress_show").width($("#new_key_progress").width() / 100 * n);
			$('#block_new_key').html(tot_x + ' ' + tot_y);

			n++;
		}else{
			$(".progress_show").width($("#new_key_progress").width());
			$("#new_key_button").show('fast');
		}
	});*/

	$('#new_key_button').on('click',function(e){
		e.preventDefault();
		var key = {'x':String(tot_x), 'y':String(tot_y)};
		var key_s = JSON.stringify(key);
		$('#block_new_key').val(key_s);
		$('#block_new_key, #new_key_copy, #new_key_download').show('fast');
	});

	$('#new_key_copy').on('click',function(e){
		e.preventDefault();
		document.getElementById('block_new_key').select();
		//window.clipboardData.setData("Text",$("#block_new_key").val());
	});

	$('#new_key_download').on('click',function(e){
		e.preventDefault();
		$("#form_new_key").submit();
	});

	$('#enc_button').on('click',function(e){
		e.preventDefault();
		$("#enc_form").submit();
	});
	$('#dec_button').on('click',function(e){
		e.preventDefault();
		$("#dec_form").submit();
	});
	
});

