<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $item = Item::find($request->item_id);

        if ($item->total_stock > 0) {
            $item->decrement('total_stock');

            Loan::create([
                'user_id' => Auth::id() ?? 1, // Fallback to 1 for simplicity/testing if not auth
                'item_id' => $item->id,
                'loan_date' => now(),
            ]);

            return back()->with('success', 'Berhasil meminjam barang!');
        }

        return back()->with('error', 'Stok habis!');
    }
}
