<?php

namespace App\Repositories\Language;

use App\Language;

class LanguageRepository
{
    protected $language;

    public function __construct(Language $language)
    {
        $this->language = $language;
    }

    public function create($attributes)
    {
        return $this->language::create($attributes);
    }

    public function all()
    {
        return $this->language::all();
    }

    public function find($id)
    {
        return $this->language::find($id);
    }

    public function update($id, array $attributes)
    {
        return $this->language::find($id)->update($attributes);
    }

    public function delete($id)
    {
        return $this->language::find($id)->delete();
    }
}
