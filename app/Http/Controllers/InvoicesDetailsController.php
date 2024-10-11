<?php

namespace App\Http\Controllers;

use App\Models\invoice_attachments;
use App\Models\Invoices;
use App\Models\invoices_details;
use App\Models\products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class InvoicesDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(invoices_details $invoices_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
     $ids = DB::table('notifications')->where('data->invoice_id',$id)->where('notifiable_id',auth()->user()->id)->pluck('id');
     DB::table('notifications')->where('id',$ids)->update(['read_at'=>now()]);
        // auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
        $invoices = Invoices::where('id',$id)->first();
        $details  = invoices_Details::where('id_Invoice',$id)->get();
        $attachments  = invoice_attachments::where('invoice_id',$id)->get();

        return view('invoices.details_invoice',compact('invoices','details','attachments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, invoices_details $invoices_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(invoices_details $invoices_details)
    {
        //
    }

    public function getproducts($id)
    {
        $product = products::where('section_id',$id)->pluck('Product_name','id');
        return json_encode($product);
    }

}
