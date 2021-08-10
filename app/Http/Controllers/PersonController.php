<?php

namespace App\Http\Controllers;

use App\Http\Requests\PersonRequest;
use App\Http\Requests\RelateFamilyRequest;
use App\Models\Person;

class PersonController extends Controller
{
    public function list()
    {
        return Person::all();
    }
 
    public function get($id)
    {
        return Person::with("family")->find($id);
    }

    public function create(PersonRequest $request)
    {
        return Person::create($request->all());
    }

    public function update(PersonRequest $request, $id)
    {
        $person = Person::findOrFail($id);
        $person->update($request->all());

        return $person;
    }
    
    public function relateFamily(RelateFamilyRequest $request, $id)
    {
        $person = Person::findOrFail($id);
        return $person->relateFamily($request);
    }

    public function delete($id)
    {
        $person = Person::findOrFail($id);
        return $person->delete();
    }
}
