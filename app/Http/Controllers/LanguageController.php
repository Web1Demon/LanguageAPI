<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    // Get all languages
    public function index()
    {
        return response()->json(Language::all());
    }

    // Get a single language
    public function show($id)
    {
        return response()->json(Language::findOrFail($id));
    }

    // Add a new language
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:languages,name',
            'native_name' => 'required',
        ]);
    
        $language = Language::create($request->all());
    
        return response()->json($language, 201);
    }

    // Update a language
    public function update(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $language->update($request->all());
    
        return response()->json($language);
    }
    
    public function destroy($id)
    {
        Language::destroy($id);
    
        return response()->json(['message' => 'Language deleted']);
    }
}

