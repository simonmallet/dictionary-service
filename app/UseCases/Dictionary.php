<?php

namespace App\UseCases;

use App\Models\Entries;

class Dictionary
{
    /**
     * @var Entries
     */
    private $entries;

    /**
     * @param Entries $dbEntries
     */
    public function __construct(Entries $dbEntries)
    {
        $this->entries = $dbEntries;
    }

    /**
     * @param string $word
     * @return array|null
     */
    public function find($word)
    {
        $numEntries = $this->entries->countWordOccurrences($word);
        if ($numEntries > 0) {
            $wordDefinitions = $this->entries->getDefinitions($word);
            $totalWordsInFirstLetter = $this->entries->countWordsInFirstLetter($word);
            $totalWordsInDictionary = $this->entries->countTotalWordsInDictionary();
            $wordInOtherDefinitions =$this->entries->getOtherWordsDefinitionWithSameWord($word);

            return [
                'wordDefinitions' => $wordDefinitions,
                'statistics' => [
                    'totalWordsInFirstLetter' => $totalWordsInFirstLetter,
                    'totalWordsInDictionary' => $totalWordsInDictionary,
                    'wordUsedInOtherDefinitions' => $wordInOtherDefinitions
                ]
            ];
        }
        return;
    }
}
