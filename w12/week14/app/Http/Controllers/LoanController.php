<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanController extends Controller
{   

    public function index(){
        $items = Item::all();
        $loans = auth()->user()->loans()->with('item')->where('status', 'borrowed')->get();
        
        return view('items.index', compact('items', 'loans'));
    }

    public function store(Request $request, Item $item){
        if ($item->stock <= 0) return back();

        DB::transaction (function () use ($item){
            
            $item->decrement('stock');

            auth()->user()->loans()->create([
                'item_id' => $item->id,
                'status' => 'borrowed'
            ]);

        });

        return back()->with('success', 'Berhasil meminjam!');
    }
    
    public function update(Loan $loan){
        
        if($loan->status == 'returned') return back();

         DB::transaction (function () use ($loan){

            $item = Item::find($loan->item_id);
            
            if ($item) {
                $item->increment('stock');
            }

            $loan->update([
                'status' => 'returned',
                'return_date' => now()
            ]);
         });

        return back()->with('success', 'Barang berhasil dikembalikan!');
    }
}
