<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response;
use App\UseCases\Dictionary as DictionaryUseCase;

class Dictionary extends Controller
{
    /** @var DictionaryUseCase */
    private $dictionary;

    /**
     * Dictionary constructor.
     * @param DictionaryUseCase $dictionary
     */
    public function __construct(DictionaryUseCase $dictionary)
    {
        $this->dictionary = $dictionary;
    }

    /**
     * @param string $word
     * @return string json
     */
    public function __invoke($word)
    {
        $data = $this->dictionary->find($word);

        if (!is_null($data)) {
            return Response::json($data);
        }

        return Response::json(['No record found.']);
    }
}