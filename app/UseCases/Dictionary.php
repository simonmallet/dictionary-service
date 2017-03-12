<?php

namespace App\UseCases;

use Illuminate\Support\Facades\DB;
use App\Models\Entries;

class Dictionary
{
    /**
     * @param string $word
     * @return array|null
     */
    public function find($word)
    {
        $numEntries = Entries::where('word', $word)->count();
        if ($numEntries > 0) {
            $wordDefinitions = Entries::where('word', $word)->get();
            $totalWordsInFirstLetter = DB::select('select count(distinct(word)) as totalWords from entries where word like \''.$word{0}.'%\'');
            $totalWordsInDictionary = DB::select('select count(distinct(word)) as totalWords from entries');
            $wordInOtherDefinitions = DB::select('select word, wordtype,definition from entries where definition regexp \' '.$word.'[^a-zA-Z]\' order by word');

            return [
                'wordDefinitions' => $wordDefinitions,
                'statistics' => [
                    'totalWordsInFirstLetter' => $totalWordsInFirstLetter[0]->totalWords,
                    'totalWordsInDictionary' => $totalWordsInDictionary[0]->totalWords,
                    'wordUsedInOtherDefinitions' => $wordInOtherDefinitions
                ]
            ];
        }
        return;
    }
}
