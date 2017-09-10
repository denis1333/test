<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Film;
use App\Tag;
use App\TagtoFilm;

class HomeController extends Controller 
{
  public function showMainpage() // функция обрабатывающая гет запрос на главную страницу тут берется информация из бд: список фильмов, список тегов и сязанные с фильмами теги и передается во view
  {                     
    $films = Film::orderBy('title')->get();     
    $filmsAndTags = [];
    foreach ($films as $film) {
      array_push($filmsAndTags, ['film_id'=>$film->id, 'film_title' => $film->title, 'film_year' => $film->year, 'film_tags' => Film::find($film->id)->tags()->get()]);
    }
    foreach ($filmsAndTags as $i => $film) {
      $tagsarray = [];
      foreach ($film['film_tags'] as $j => $tag) {
        array_push($tagsarray, $tag['title']);
      }
      $filmsAndTags[$i]['film_tags'] = $tagsarray;
    }
    $tag = Tag::all();
    return view('mainpage', ['films' => $films, 'tags' => $tag, 'filmandtags' => $filmsAndTags]); 
  }

  public function delFilm(Request $request)
  {
    TagtoFilm::where('film_id', $request->input('film_id'))->delete();
    Film::where('id', $request->input('film_id'))->delete();
    return '200';
  }

  public function delTagGlobal(Request $request)//удаляет тег из бд
  {
    TagtoFilm::where('tag_id', $request->input('tag_id'))->delete();
    Tag::where('id', $request->input('tag_id'))->delete();
    return '200';
  }

}