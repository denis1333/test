<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('FilmSeeder');
        $this->call('TagSeeder');
        $this->call('TagtoFilmSeeder');
    }

}

class FilmSeeder extends Seeder
{
	public function run(){
		DB::table('film')->insert(['title'=>'Остров проклятых', 'year'=>'2010']);
		DB::table('film')->insert(['title'=>'Оно', 'year'=>'2017']);
		DB::table('film')->insert(['title'=>'Служебный роман', 'year'=>'1977']);
		DB::table('film')->insert(['title'=>'Джентельмены удачи', 'year'=>'1971']);
		DB::table('film')->insert(['title'=>'Кингсмен', 'year'=>'2014']);
		DB::table('film')->insert(['title'=>'Побег из Шоушенка', 'year'=>'1994']);
	}
}

class TagSeeder extends Seeder
{
	public function run(){
		DB::table('tag')->insert(['title'=>'комедия']);
		DB::table('tag')->insert(['title'=>'триллер']);
		DB::table('tag')->insert(['title'=>'мелодрамма']);
		DB::table('tag')->insert(['title'=>'драмма']);
		DB::table('tag')->insert(['title'=>'криминал']);
	}
}

class TagtoFilmSeeder extends Seeder
{
	public function run(){
		DB::table('tagtofilm')->insert(['film_id'=>'1', 'tag_id'=>'2']);
		DB::table('tagtofilm')->insert(['film_id'=>'2', 'tag_id'=>'2']);
		DB::table('tagtofilm')->insert(['film_id'=>'3', 'tag_id'=>'3']);
		DB::table('tagtofilm')->insert(['film_id'=>'4', 'tag_id'=>'1']);
		DB::table('tagtofilm')->insert(['film_id'=>'5', 'tag_id'=>'1']);
		DB::table('tagtofilm')->insert(['film_id'=>'6', 'tag_id'=>'4']);
		DB::table('tagtofilm')->insert(['film_id'=>'6', 'tag_id'=>'5']);
	}
}