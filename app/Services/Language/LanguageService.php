<?php
namespace App\Services\Language;

use App\Http\Requests\Language\LanguageRequest;
use App\Repositories\Language\LanguageRepository;

class LanguageService
{
    protected $language;

    public function __construct(LanguageRepository $language)
    {
        $this->language = $language;
    }

    public function list()
    {
        return $this->language->all();
    }

    public function create(LanguageRequest $request)
    {
        $attributes = $request->all();

        return $this->language->create($attributes);
    }

    public function read($id)
    {
        return $this->language->find($id);
    }

    public function update(LanguageRequest $request, $id)
    {
        $attributes = $request->all();

        return $this->language->update($id, $attributes);
    }

    public function delete($id)
    {
        return $this->language->delete($id);
    }

}
