<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Film;
use App\Tag;
use App\TagtoFilm;

class EditFilmController extends Controller 
{
	public function editFilmPage($id)//обабатывает гет запрос на страницу изменения фильма
	  {
	    $tags = Tag::all();
	    $film = Film::find($id);
	    $filmsAndTags = ['film_id'=>$film->id, 'film_title' => $film->title, 'film_year' => $film->year, 'film_tags' => Film::find($film->id)->tags()->get()];
	      $tagsarray = [];
	      foreach ($filmsAndTags['film_tags'] as $j => $tag) {
	        array_push($tagsarray, $tag['title']);
	      }
	      $filmsAndTags['film_tags'] = $tagsarray;
	      $tagsarray = [];
	      foreach ($tags as $key => $value) {
	        array_push($tagsarray, $value->title);
	      }
	      $tags = array_diff($tagsarray, $filmsAndTags['film_tags']);
	    return view('editFilmPage', ['film'=> $filmsAndTags, 'tags' => $tags]); 
	  }

  	public function editFilmPageSave(Request $request)// принимает запрос со страницы изменения фильма и сохраняет изменения в бд
	  {
	    $tags = $request->input('outTag');
	    $tagsid = [];
	    foreach ($tags as $key => $value) {
	      $tag = Tag::where('title', $value)->get();
	      array_push($tagsid, $tag[0]->id);
	    }
	    $film = Film::find($request->input('outId'));
	    $film->title = $request->input('outTitle');
	    $film->year = $request->input('outYear');
	    $film->save();
	    TagtoFilm::where('film_id', $film->id)->delete();
	    foreach ($tagsid as $key => $value) {
	      $tagtofilm = new TagtoFilm;
	      $tagtofilm->film_id = $film->id;
	      $tagtofilm->tag_id = $value;
	      $tagtofilm->save();
	    }
	    return '200';
	  }
}