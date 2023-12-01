<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\BidRequestDataTable;
use App\Models\BidRequest;



class BidrequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BidRequestDataTable $dataTable)
    {
        return $dataTable->render('admin.bidrequest.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function updateStatus(Request $request)
    {
        $bidRequestId = $request->input('bid_request_id');
        $status = $request->input('status');

        $bidRequest = BidRequest::find($bidRequestId);

        if (!$bidRequest) {
            return response()->json(['success' => false, 'message' => 'Bid Request not found']);
        }
        $bidRequest->status = ($status == 1) ? true : false;
        $bidRequest->save();

      

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }
}
