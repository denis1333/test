<html>
 	<head>
 		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 		<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/style.css')}}">
	  	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap.css')}}">
	  	<link rel="stylesheet" type="text/css" href="{{ URL::asset('css/bootstrap-theme.css')}}">
	  	<script type="text/javascript" src="{{ URL::asset('js//jquery-3.2.1.min.js')}}"></script>
	  	<script type="text/javascript" src="{{ URL::asset('js/bootstrap.js')}}"></script>
	  	<script type="text/javascript" src="{{ URL::asset('js/app.js')}}"></script>
	  	<script type="text/javascript" src="{{ URL::asset('js/script.js')}}"></script>
	  	<meta name="csrf-token" content="{{ csrf_token() }}">
	  	<meta charset="utf-8">
 	</head>
 	<body>
 	<table class="table table-bordered">
	    	<tr data-filmId="{{$film['film_id']}}">
	    		<td class="title"><input type="text" name="title" placeholder="Название" value="{{$film['film_title']}}"></td>
	    		<td class="year" pattern="[0-9]"><input type="number" name="year" placeholder="Год выпуска" value="{{$film['film_year']}}"></td>
	    		<td class="tags">
	    		@foreach ($film['film_tags'] as $tag)
	    			<div data-value="{{$tag}}" class="selectedTeg btn btn-primary">{{$tag}}</div>
	    		@endforeach
	    			<select>
	    			 <option class="tagoptions" value="">Выбирите тег</option>
	    			@foreach ($tags as $tag)
					  <option class="tagoptions" value="{{$tag}}">{{$tag}}</option>
					@endforeach
					</select>
				</td>
	    	</tr>
    	</table>
    	<p><div class="editbtnfinal btn btn-primary" href="">Изменить</div></p>
	</body>
<form style="display: none" method="GET" action="/" id="myform">
</html>