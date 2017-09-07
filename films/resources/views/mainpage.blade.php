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
    	<p><a class="addbtn btn btn-primary" href="/add">Добавить фильм или тег</a></p>
    	@foreach($tags as $tag)
	    	<table class="table table-bordered">
	    		<h3 class="tegTitle">{{$tag->title}}<span data-tagId={{$tag->id}} class="myremove glyphicon glyphicon-remove delTagGlobal"></span></h3>
	    		@foreach ($filmandtags as $film)
		    		@if (in_array($tag->title, $film['film_tags']))
			    	<tr data-tagId="{{$tag->id}}" data-filmId="{{$film['film_id']}}">
			    		<td class="col-md-3">{{$film['film_title']}}</td>
			    		<td class="col-md-3">
			    		@foreach ($film['film_tags'] as $t)
			    		<div class="badge badge-info">{{$t}}</div>
			    		@endforeach
			    		</td>
			    		<td class="col-md-3">{{$film['film_year']}}</td>
			    		<td class="col-md-3"><a href="editfilm/{{$film['film_id']}}" class="btn editbtn btn-primary">Изменить</a> <div class="delbtn btn btn-primary">Удалить</div></td>
			    	</tr>
			    	@endif
	    		@endforeach
	    	</table>
    	@endforeach
	</body>
<form style="display: none" method="GET" action="/" id="myform">
</html>