<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Bank_Details;
use Illuminate\Support\Facades\Auth;
use Datatables;

class Bank_Detail_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
 public function getIndex()
    {
        return view('admin.setting.Bank_Detail.index');
    }

    public function getCreate()
    {
        $currency= Currency::pluck('currency_code','currency_id')->toArray();
        return view('admin.setting.Bank_Detail.form',compact('currency'));
    }

    public function postSave(Request $request) {

        $bank = Auth::user();
        $validator = Bank_Details::validator($request->all(), $request->get("bank_detail_id", ''));
               
        if($validator->fails()) {            
            return redirect()->back()
                ->withErrors($validator->getMessageBag())
                ->withInput($request->all());
        }
      
        if($request->get("bank_detail_id") == '') {
            $bank = new Bank_Details();
        } else {
            $bank = Bank_Details::findOrFail($request->get("bank_detail_id"));
        }
      	$bank->bank_accnt = $request->get("bank_accnt",'');
        $bank->benefry_add = $request->get("benefry_add",'');
        $bank->accnt_no = $request->get("accnt_no",'');
        $bank->benefry_bank_name = $request->get("benefry_bank_name",'');
        $bank->benefry_bank_add = $request->get("benefry_bank_add",'');
        $bank->swift_cd_hsbc = $request->get("swift_cd_hsbc",'');
        $bank->micr_code = $request->get("micr_code",'');
        $bank->bank_code = $request->get("bank_code",'');
        $bank->branch_code = $request->get("branch_code",'');
        $bank->intery_bank_name = $request->get("intery_bank_name",'');
        $bank->hsbc_accnt_intery_bank = $request->get("hsbc_accnt_intery_bank",'');
        $bank->swift_cd_intery_bank = $request->get("swift_cd_intery_bank",'');
        $bank->intery_aba_rout_no = $request->get("intery_aba_rout_no",'');
        $bank->curr_code = $request->get("curr_code",'');
        $bank->clabe = $request->get("clabe",'');
        $bank->bsb = $request->get("bsb",'');
        $bank->swift_code = $request->get("swift_code",'');
        $bank->status = $request->get("status",'');
        $bank->save();
       //print_r($bank);die;
        return redirect(action('Admin\Setting\Bank_Detail_Controller@getIndex'))->with('success');

    }

    public function getAnydata(Request $request) {
        $test=Bank_Details::join('currency','currency.currency_id','=','bank_detail.curr_code')->select('bank_detail.*','currency.currency_code')->where('bank_detail.is_delete','0')->get();
        return Datatables::of($test)
            ->addColumn('bank_detail_id', function ($bank) {
                return ' <input type="checkbox" class="sub_chk" name="post[]" data-id="' . $bank->bank_detail_id . '"  value="' . $bank->bank_detail_id . '">';
            })

            ->addColumn('action', function ($bank) {
                return '<a href="'. action('Admin\Setting\Bank_Detail_Controller@getEdit', [$bank->bank_detail_id]) .'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i> Edit</a>&nbsp;' .
                '<a  href="'. action('Admin\Setting\Bank_Detail_Controller@getDelete', [$bank->bank_detail_id]) .'" data-id="'. $bank->bank_detail_id . '" class="btn btn-xs btn-danger btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->addColumn('status', function ($bank) {
                if ($bank->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $bank->bank_detail_id . '" id="' . $bank->bank_detail_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $bank->bank_detail_id . '" data-id="' . $bank->bank_detail_id . '" status-id="' . $bank->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $bank->bank_detail_id . '" id="' . $bank->bank_detail_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $bank->bank_detail_id . '" data-id="' . $bank->bank_detail_id . '" status-id="' . $bank->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
            })
            ->make(true);
    }

    public function getEdit($bank = '')
    {
        $currency= Currency::pluck('currency_code','currency_id')->toArray();
        $bank = Bank_Details::findOrFail($bank);
        

        return view('admin.setting.Bank_Detail.form', compact('bank','currency', ''))->with('success');
    }

    public function getDelete($bank) {
        try
        {   
           $bank = Bank_Details::findOrFail($bank)->update(['is_delete'=>1]);
            //print_r($bank);
            return redirect(action('Admin\Setting\Bank_Detail_Controller@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }


    public function getRemove(Request $request) 
    {
         try
        {
            $ids = $request->ids;       
            $del=Bank_Details::whereIn('bank_detail_id',explode(",",$ids))->update(['is_delete' => 1]);
            //$del->delete();
            return response()->json(['success'=>"Products Deleted successfully."]);
            //return redirect(action('Admin\Product\ColorcategoryController@getIndex'))->with('success');
           
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }

           
    }

   public function anyStatus(Request $request) {
         $bank = Bank_Details::findOrFail($request->get("bank_detail_id"));
         $bank->bank_detail_id = $request->get("bank_detail_id");
         $bank->status = $request->get("status");
         $bank->save();
         return response()->json(['success'=>"Status change  successfully."]);
        //return redirect(action('Admin\Product\bankController@getIndex'))->with('success');      

    }

    public function anyActiveall(Request $request) {

        $ids = $request->ids;
        $status = $request->get("status"); 
         Bank_Details::whereIn('bank_detail_id',explode(",",$ids))->update(['status' => $status]);

         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\bankController@getIndex'))->with('success');      

    }

    public function anyInactiveall(Request $request) {
        
        $ids = $request->ids;
        $status = $request->get("status"); 
         Bank_Details::whereIn('bank_detail_id',explode(",",$ids))->update(['status' => $status]);       
         return response()->json(['success'=>"Status change  successfully."]);
       //return redirect(action('Admin\Product\bankController@getIndex'))->with('success');      

    }

}
