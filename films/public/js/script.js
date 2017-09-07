$( document ).ready(function() {
var tagsarray = [];
	$.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

	$('.selectedTeg').click(function(){
		var newelem = $('.tags select').append(" <option class='tagoptions' value="+$(this).html()+">"+$(this).html()+"</option>");
		$(this).remove();
	});

	function addTeg (){
		var newelem = $('.tags').append('<div data-value="'+$('.tags select').val()+'" class="selectedTeg btn btn-primary">'+$('.tags select').val()+'</div>');
		$('.tags option[value="'+$('.tags select').val()+'"]').remove();
		$('.selectedTeg').last().click(function(){
			var newelem = $('.tags select').append(" <option class='tagoptions' value="+$(this).html()+">"+$(this).html()+"</option>");
			$(this).remove();
		});
	}
	$('.tags select').change(addTeg);
	$('.addTodb').click(function(){
		var title = $('.title input[name=title]').val();
		var year = $('input[name=year]').val();
		var tags = $('.tags div');
		for (var i = 0 ; i< tags.length; i++){
			var x = $('.selectedTeg').last().html();
			var v = x;
			tagsarray.push(v);
			$('.selectedTeg').last().remove();
		}
		$.post('/add',{outTitle: title, outYear: year, outTag: tagsarray}).done(function(data,status){
			$('#myform').submit();
		});

	});

	$('.addTagdb').click(function(){
		var newTag = $('input[name=newTag]').val();
		$('input[name=newTag]').val('');
		$.post('/addTag',{newTag: newTag}).done(function(data,status){
			if (data == "exist"){
					if($('[data-value="'+newTag+'"]').length == 0){
					var newelem = $('.tags').append('<div data-value="'+newTag+'" class="selectedTeg btn btn-primary">'+newTag+'</div>');				
					$('.selectedTeg').last().click(function(){
						var newelem = $('.tags select').append(" <option class='tagoptions' value="+$(this).html()+">"+$(this).html()+"</option>");
						$(this).remove();
					});
					$('option[value='+newTag+']').remove()
				}
			}
			else{	
				$('option').remove();
				var select = $('select');
				select.append('<option class="tagoptions" value="">Выбирите тег</option>');
				for(var i=0; i<data.length;i++){
					select.append(" <option class='tagoptions' value='"+data[i]['title']+"'>"+data[i]['title']+"</option>")
				}
			}
		});
	});

	$('.delbtn').click(function(){
		var filmId = $(this).parent().parent().data('filmid');
		$.post('/delFilm',{film_id: filmId}).done(function(data,status){
			console.log(data);
			$('#myform').submit();
		})
	});

	$('.delTagGlobal').click(function(){
		var tagId = $(this).data('tagid');
		$.post('/delTagGlobal',{tag_id: tagId}).done(function(data,status){
			$('#myform').submit();
		});
	});

	$('.editbtnfinal').click(function(){
		var title = $('.title input[name=title]').val();
		var year = $('input[name=year]').val();
		var tags = $('.tags div');
		for (var i = 0 ; i< tags.length; i++){
			var x = $('.selectedTeg').last().html();
			var v = x;
			tagsarray.push(v);
			$('.selectedTeg').last().remove();
		}
		var id = $('tr').data('filmid');
		$.post('/editfilm',{outTitle: title, outYear: year, outTag: tagsarray, outId: id}).done(function(data,status){
			$('#myform').submit();
		});
	});
})