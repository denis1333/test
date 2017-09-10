<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Film;
use App\Tag;
use App\TagtoFilm;

class AddFilmAndTagController extends Controller 
{
	public function showAddPage() // функция обрабатывающая гет запрос на страницу добавления фильмов
	  {
	    $tag = Tag::all();
	    return view('addPage', ['tags'=>$tag]);
	  }
	public function addFilm(Request $request)// метод получает со страницы добавления фильма информацию о новом фильме и добавляет его в бд
	  {                                      
	    $film = new Film;
	    $film->title = $request->input('outTitle');
	    $film->year = $request->input("outYear");
	    $film->save();
	    $film = Film::where('title',$request->input('outTitle'))->get(); 
	    $tags = $request->input('outTag');
	    foreach ($tags as $key => $value) {
	      $tag = Tag::where('title', $value)->get();
	      $tagtofilm = new TagtoFilm;
	      $tagtofilm->film_id = $film[0]->id;
	      $tagtofilm->tag_id = $tag[0]->id;
	      $tagtofilm->save();
	    }
	    return '200';
	  }

	  public function addTag(Request $request)//получает со страницы добавления фильма название нового тега, если он уже существует, то отсылает соответствующее сообщение, иначе отсылает полный список тегов вместе с добавленным
	  {
	    $newTagTitle = strtolower($request->input('newTag'));
	    $exsitingTag = Tag::where('title', $newTagTitle)->get();
	    $newTag = new Tag;
	    $newTag->title = $request->input('newTag');
	    $newTag->save();
	    $allTags = Tag::all();
	    if (count($exsitingTag) == 0) 
	    {
	      return $allTags;
	    }
	    else
	    {
	      return 'exist';
	    }
	  }
}