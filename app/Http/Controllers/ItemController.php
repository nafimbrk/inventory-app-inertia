<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\StockCard;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return inertia('Items/Index', [
            'items' => $items
        ]);
    }

    public function add()
    {
        return inertia('Items/Add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer|digits_between:1,6',
            'unit' => 'required|string|max:100'
        ]);

        Item::create($request->all());

        return redirect()->route('items.index')->with('success', 'item created successfully');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);

        // return gettype($item);

        return inertia('Items/Edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:100'
        ]);

        $item = Item::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('items.index')->with('success', 'item updated successfully');
    }

    public function editStock($id)
    {
        $item = Item::findOrFail($id);

        return inertia('Items/EditStock', [
            'item' => $item
        ]);
    }

    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|integer|digits_between:1,6',
            'note' => 'required|in:in,out'
        ]);

        $item = Item::findOrFail($id);

        if ($request->note === 'in') {
            $item->increment('qty', $request->qty);
        } else if ($request->note === 'out') {
            if ($item->qty < $request->qty) {
                return redirect()->route('items.index')->with('error', 'stock out');
            }
            $item->decrement('qty', $request->qty);
        }

        StockCard::create([
            'item_id' => $item->id,
            'qty' => $request->qty,
            'note' => $request->note,
            'description' => $request->description
        ]);

        return redirect()->route('items.index')->with('success', 'item stock updated successfully');
    }

    public function viewStockCard($id)
    {
        $item = Item::findOrFail($id)->loadMissing('stockCards');

        return inertia('Items/StockCard', [
            'item' => $item
        ]);
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        $item->delete();

        return redirect()->route('items.index')->with('success', 'item stock deleted successfully');
    }
}
