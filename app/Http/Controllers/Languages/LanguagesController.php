<?php

namespace App\Http\Controllers\Languages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Language\LanguageRequest;
use App\Services\Language\LanguageService;
use Illuminate\Http\Request;

class LanguagesController extends Controller
{
    protected $languageService;

    public function __construct(
        LanguageService $languageService
    ){
        $this->middleware(['auth']);

        $this->languageService = $languageService;
    }

    public function index()
    {
        $languages = $this->languageService->list();

        return view('languages.index', [
            'languages' => $languages,
        ]);
    }

    public function create()
    {
        return view('languages.create');
    }

    public function store(LanguageRequest $request, $locale)
    {
        $this->languageService->create($request);

        return redirect()->route('administration.languages')->with('status', 'L\'idioma s\'ha creat correctament');
    }

    public function edit($locale, $id)
    {
        $language = $this->languageService->read($id);

        return view('languages.edit', compact('language'));
    }


    public function update(LanguageRequest $request, $locale, $id)
    {
        $language = $this->languageService->update($request,$id);

        return redirect()->route('administration.languages')->with('status', 'L\'idioma s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id)
    {
        $this->languageService->delete($id);

        return back()->with(['status'=>'Eliminat correctament']);
    }
}
