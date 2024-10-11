<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoiceReportController extends Controller
{
    

    public function index()
    {
        return view('reports.index');
    }
    
    public function search(Request $request)
    {
       
    $rdio = $request->rdio;       
       if ($rdio == 1) {
           if ($request->type && $request->start_at =='' && $request->end_at =='') {
              $invoices = Invoices::select('*')->where('Status','=',$request->type)->get();
              $type = $request->type;
              return view('reports.index',compact('type'))->withDetails($invoices);
           }
           else {
              
             $start_at = date($request->start_at);
             $end_at = date($request->end_at);
             $type = $request->type;
             
             $invoices = invoices::whereBetween('invoice_Date',[$start_at,$end_at])->where('Status','=',$request->type)->get();
             return view('reports.index',compact('type','start_at','end_at'))->withDetails($invoices);
             
           }
           
       } 
       else {
           
           $invoices = invoices::select('*')->where('invoice_number','=',$request->invoice_number)->get();
           return view('reports.index')->withDetails($invoices);
           
       }
   
       
        
       }

       
  
}

