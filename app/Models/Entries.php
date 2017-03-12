<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Support\Facades\DB;

class Entries extends Model
{
    /**
     * @var string The name of the table
     */
    protected $table = 'entries';

    public $incrementing = false;
    public $timestamps = false;

    protected $primaryKey = null;

    /**
     * @param $word
     * @return mixed
     */
    public function countWordOccurrences($word)
    {
        return self::where('word', $word)->count();
    }

    /**
     * @param $word
     * @return array
     */
    public function getDefinitions($word)
    {
        return self::where('word', $word)->get();
    }

    /**
     * @param $word
     * @return int
     */
    public function countWordsInFirstLetter($word)
    {
        return DB::select('select count(distinct(word)) as totalWords from entries where word like \''.$word{0}.'%\'')[0]->totalWords;
    }

    /**
     * @return int
     */
    public function countTotalWordsInDictionary()
    {
        return DB::select('select count(distinct(word)) as totalWords from entries')[0]->totalWords;
    }

    /**
     * @param $word
     * @return array
     */
    public function getOtherWordsDefinitionWithSameWord($word)
    {
        return DB::select('select word, wordtype,definition from entries where definition regexp \' '.$word.'[^a-zA-Z]\' order by word');
    }
}