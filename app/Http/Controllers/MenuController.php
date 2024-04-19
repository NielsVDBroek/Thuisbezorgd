<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
     public function main()
     {
         $menuItems = Menu::all();
         return view('home.main', compact('menuItems'));
     }
     
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
    $validatedData = $request->validate([
        'naam' => 'required|string|max:255',
        'beschrijving' => 'required|string',
        'prijs' => 'required|numeric|min:0',
        'categorie' => 'required|string|max:255',
        'afbeelding' => 'required|image|mimes:jpg,jpeg,png,bmp|max:1024',
    ]);

    $menuItem = new Menu();
    $menuItem->naam = $validatedData['naam'];
    $menuItem->beschrijving = $validatedData['beschrijving'];
    $menuItem->prijs = $validatedData['prijs'];
    $menuItem->categorie = $validatedData['categorie'];

    // Store the image using public disk and manually build the path
    $path = $request->afbeelding->store('menu_images', 'public');
    $menuItem->afbeelding = $path;  // Manually prepend 'app/public/'

    $menuItem->save();

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
    // Define validation rules
    $validatedData = $request->validate([
        'naam' => 'required|string|max:255',
        'beschrijving' => 'required|string',
        'prijs' => 'required|numeric|min:0',
        'categorie' => 'required|string|max:255',
        'afbeelding' => 'sometimes|image|mimes:jpg,jpeg,png,bmp|max:1024', // Make image upload optional
    ]);

    // Find the existing menu item
    $menuItem = Menu::findOrFail($id);

    // Update model with validated data
    $menuItem->naam = $validatedData['naam'];
    $menuItem->beschrijving = $validatedData['beschrijving'];
    $menuItem->prijs = $validatedData['prijs'];
    $menuItem->categorie = $validatedData['categorie'];

    // Handle the image file if it's present in the request
    if ($request->hasFile('afbeelding')) {
        // Delete old image if exists
        if ($menuItem->afbeelding && Storage::disk('public')->exists($menuItem->afbeelding)) {
            Storage::disk('public')->delete($menuItem->afbeelding);
        }

        // Store the new image
        $path = $request->afbeelding->store('menu_images', 'public');
        $menuItem->afbeelding = $path; // Store the relative path
    }

    // Save the updated menu item
    $menuItem->save();

    // Redirect after successful update
    return redirect()->route('menu.index')->with('success', 'Item updated successfully.');
}

/**
 * Remove the specified resource from storage.
 */
public function destroy($id)
{
    $item = Menu::findOrFail($id);

    // Delete the image if it exists
    if ($item->afbeelding && Storage::disk('public')->exists($item->afbeelding)) {
        Storage::disk('public')->delete($item->afbeelding);
    }

    $item->delete();

    return redirect()->route('menu.index')->with('success', 'Item deleted successfully');
}

public function search(Request $request)
{
    $query = $request->input('search');
    $menuItems = Menu::where('naam', 'like', '%' . $query . '%')
                    ->orWhere('beschrijving', 'like', '%' . $query . '%')
                    ->get();

    if ($menuItems->isEmpty()) {
        return response()->json('<div>No items found for: ' . ($query) . '</div>');
    }

    $html = '';
    foreach ($menuItems as $item) {
        $html .= '<div class="menu-item shadow-sm">'.
                 '<div class="menu-item-image-name-description">'.
                 '<div class="menu-item-image-container">'.
                 '<img src="' . asset('storage/' . $item->afbeelding) . '" alt="Menu Image">'.
                 '</div>'.
                 '<div class="menu-item-name-description">'.
                 '<div class="menu-item-name">' . $item->naam . '</div>'.
                 '<div class="menu-item-description">' . $item->beschrijving . '</div>'.
                 '</div>'.
                 '</div>'.
                 '<div class="menu-item-price">€' . $item->prijs . '</div>'.
                 '</div>';
    }

    return response()->json($html);
}


}
