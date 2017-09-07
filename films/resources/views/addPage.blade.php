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
	    	<tr>
	    		<td class="title"><input type="text" name="title" placeholder="Название"></td>
	    		<td class="year" pattern="[0-9]"><input type="number" name="year" placeholder="Год выпуска"></td>
	    		<td class="tags">
	    			<select>
	    			 <option class="tagoptions" value="">Выбирите тег</option>
	    			@foreach ($tags as $tag)
					  <option class="tagoptions" value="{{$tag->title}}">{{$tag->title}}</option>
					@endforeach
					</select>
				</td>
	    	</tr>
    	</table>
    	<div class="newTeg">
    	<input type="text" name="newTag" placeholder="Добавить новый тег">
    	<div class="addTagdb btn btn-primary" href="">Добавить</div>
    	</div>
    	<p><div class="addbtn addTodb btn btn-primary" href="">Добавить фильм</div></p>
	</body>
<form style="display: none" method="GET" action="/" id="myform">
</form>
</html>