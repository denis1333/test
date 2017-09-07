<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Film;
use App\Tag;
use App\TagtoFilm;

class MainController extends Controller 
{
  public function showmainpage() // функция обрабатывающая гет запрос на главную страницу тут берется информация из бд: список фильмов, список тегов и сязанные с фильмами теги и передается во view
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