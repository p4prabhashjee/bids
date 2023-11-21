<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\BidvalueDataTable;
use App\Models\Bidvalue;


class BidvalueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BidvalueDataTable $dataTable)
    {
        return $dataTable->render('admin.bidvalues.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bidvalues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'min_price' => 'required|numeric',
            'max_price' => 'required|numeric',
            'percentage' => 'required|numeric',
            'status' => 'required|boolean',
        ]);
    
        // Validate that min_price is greater than max_price of the previous bid value
        $previousMaxPrice = Bidvalue::max('max_price');
    
        if ($request->input('min_price') <= $previousMaxPrice) {
            return redirect()->back()->withErrors(['min_price' => 'The minimum price must be greater than the maximum price of the previous bid value.']);
        }
    
        $bidvalue = Bidvalue::create($request->all());
    
        return redirect()->route('admin.bidvalues.index')->with('success', 'BidValue created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bidvalue $bidvalue)
    {
        return view('admin.bidvalues.edit', compact('bidvalue'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bidvalue $bidvalue)
    {
        $data = $request->validate([
            'min_price' => 'required',
            'max_price' => 'required',
            'percentage' => 'required',
            'status' => 'required|boolean', 
        ]);

        $data = Bidvalue::max('max_price');
    
        if ($request->input('min_price') <= $data) {
            return redirect()->back()->withErrors(['min_price' => 'The minimum price must be greater than the maximum price of the previous bid value.']);
        }

        $bidvalue->update($data);
        
        return redirect()->route('admin.bidvalues.index')->with('success', 'bidvalue updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bidvalue $bidvalue)
    {
        $bidvalue->delete();
        return redirect()->route('admin.bidvalues.index')->with('success', 'bidvalue deleted successfully');
    }


}
