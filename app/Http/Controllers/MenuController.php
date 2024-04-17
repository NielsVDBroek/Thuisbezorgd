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
        'afbeelding' => 'required|image|mimes:jpg,jpeg,png,bmp|max:1024', // Always required
    ]);

    // Find the existing menu item
    $menuItem = Menu::findOrFail($id);

    // Update model with validated data, except for image
    $menuItem->naam = $validatedData['naam'];
    $menuItem->beschrijving = $validatedData['beschrijving'];
    $menuItem->prijs = $validatedData['prijs'];
    $menuItem->categorie = $validatedData['categorie'];

    // Handle the image file and store the new path
    // Delete old image if exists
    if ($menuItem->afbeelding) {
        $oldPath = str_replace('app/public/', '', $menuItem->afbeelding); // Remove the prepended path to get the relative storage path
        if (Storage::disk('public')->exists($oldPath)) {
            Storage::disk('public')->delete($oldPath);
        }
    }

    // Since image is always provided and required, store it directly on the public disk
    $path = $request->afbeelding->store('menu_images', 'public');
    $menuItem->afbeelding = 'app/public/' . $path; // Manually prepend 'app/public/'

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

    if ($item->afbeelding) {
        $oldPath = str_replace('app/public/', 'public/', $item->afbeelding); // Adjust the path if needed
        if (Storage::exists($oldPath)) {
            Storage::delete($oldPath);
        }
    }

    $item->delete();

    return redirect()->route('menu.index')->with('success', 'Item deleted successfully');
}

}
