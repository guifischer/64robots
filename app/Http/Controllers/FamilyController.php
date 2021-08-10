<?php

namespace App\Http\Controllers;

use App\Http\Requests\FamilyRequest;
use App\Models\Family;

class FamilyController extends Controller
{
    public function list()
    {
        return Family::all();
    }
 
    public function get($id)
    {
        return Family::with(["husband", "wife", "children"])->find($id);
    }

    public function create(FamilyRequest $request)
    {
        return Family::create($request->all());
    }

    public function update(FamilyRequest $request, $id)
    {
        $family = Family::findOrFail($id);
        $family->update($request->all());

        return $family;
    }

    public function delete($id)
    {
        $family = Family::findOrFail($id);
        return $family->delete();
    }
}
