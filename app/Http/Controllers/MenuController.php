<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menuItems = Menu::all();
        return view('menu.index', compact('menuItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define validation rules
        $rules = [
            'naam' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'prijs' => 'required|numeric|min:0',
            'categorie' => 'required|string|max:255',
            'afbeelding' => 'nullable|image|mimes:jpg,jpeg,png,bmp|max:2048', // 2MB max size
        ];
    
        // Validate the incoming request data
        $validatedData = $request->validate($rules);
    
        // Create a new menu item using the validated data
        $menuItem = new Menu();
        $menuItem->naam = $validatedData['naam'];
        $menuItem->beschrijving = $validatedData['beschrijving'];
        $menuItem->prijs = $validatedData['prijs'];
        $menuItem->categorie = $validatedData['categorie'];
        
        if ($request->hasFile('afbeelding')) {
            $path = $request->afbeelding->store('public/menu_images');
            $menuItem->afbeelding = $path;

        }
        
        $menuItem->save();
    
        // Redirect to a page or return a response
        return redirect()->route('menu.index')->with('success', 'Menu item added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $item = Menu::find($id);

        return view('menu.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = Menu::findOrFail($id); // Fetches the item with error handling
        return view('menu.edit', compact('item')); // Returns a view with the item data
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate input
        $rules = [
            'naam' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'prijs' => 'required|numeric|min:0',
            'categorie' => 'required|string|max:255',
            'afbeelding' => 'nullable|image|mimes:jpg,jpeg,png,bmp|max:2048', // 2MB max size
        ];

        $validatedData = $request->validate($rules);

        // Find the item
        $item = Menu::find($id);
        if (!$item) {
            return redirect()->route('menu.index')->with('error', 'Item not found.');
        }

        // Update fields
        $menuItem = Menu::find($id);
        $menuItem->naam = $validatedData['naam'];
        $menuItem->beschrijving = $validatedData['beschrijving'];
        $menuItem->prijs = $validatedData['prijs'];
        $menuItem->categorie = $validatedData['categorie'];
        
        if ($request->hasFile('afbeelding')) {
            $path = $request->afbeelding->store('public/menu_images');
            $menuItem->afbeelding = $path;

        }

        // Save the changes
        try {
            $menuItem->save();
        } catch (\Exception $e) {
            return back()->withErrors('Failed to update item: ' . $e->getMessage());
        }

        return redirect()->route('menu.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $item = Menu::find($id);
        $item->delete();

        return redirect()->route('menu.index')
            ->with('success', 'Item deleted successfully');
    }
}
