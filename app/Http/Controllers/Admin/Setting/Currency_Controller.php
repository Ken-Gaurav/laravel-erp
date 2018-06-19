<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Datatables;
use App\Models\Currency;
use DB;
use Illuminate\Support\Facades\Auth;

class Currency_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  
public function getIndex()
{
	return view('admin.setting.currency.currency_index');
}

public function getCreate()
{
     return view('admin.setting.currency.currency_form');
  
}

public function postSave(Request $request) {

        $currency = Auth::user();
        $validator = Currency::validator($request->all(), $request->get("currency_id", ''));
        
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("currency_id") == '') {
            $currency = new Currency();
        } else {
            $currency = Currency::findOrFail($request->get("currency_id"));
        }
        $currency->currency_code = $request->get("currency_code");
        $currency->currency_name = $request->get("currency_name");          
        $currency->price = $request->get("price");         
        $currency->status = $request->get("status");        
        $currency->save();
       return redirect(action('Admin\Setting\Currency_Controller@getIndex'))->with('success');
        
    }

    public function getEdit($currency = '') {
        $currency = Currency::findOrFail($currency);        
        return view('admin.setting.currency.currency_form', compact('currency', ''))->with('success');
    }

    public function getData()
    {
        return Datatables::of(Currency::all('*'))
        ->addColumn('currency_id', function ($currency) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $currency->currency_id . '"  value="' . $currency->currency_id . '">';
            })

       
            
            ->addColumn('status', function ($currency) {
                if ($currency->status == 1) {
                    return '<a data-id="'. $currency->currency_id . '" class="btn btn-xs btn-info btn-active"><i class="fa fa-check"></i> Active</a>';
                }
                else{

                	return '<a data-id="'. $currency->currency_id . '" class="btn btn-xs btn-danger btn-inactive"><i class="fa fa-times"></i> Inactive</a>';

                }
            })

            ->addColumn('action', function ($currency) {
                return '<a href="'. action('Admin\Setting\Currency_Controller@getEdit', [$currency->currency_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>';
                
            })
            ->make(true);
            
          
    }

        public function anyActiveall(Request $request) {

        $ids = $request->ids;
        $status = $request->get("status"); 
        Currency::whereIn('currency_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
         

    }
    
    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
        Currency::whereIn('currency_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);  

    }


}
