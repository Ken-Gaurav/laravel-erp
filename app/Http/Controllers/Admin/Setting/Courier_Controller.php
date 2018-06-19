<?php

namespace App\Http\Controllers\Admin\Setting;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Courier_Model;
use App\Models\Country;
use App\Models\Courier_Zone;
use App\Models\Courier_Zone_Country;
use App\Models\Courier_Price_History;
use App\Models\Courier_Zone_Price;
use DB;
use Datatables;

class Courier_Controller extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	public function getIndex()
	{	
		$courier = Courier_Model::all("*");
		return view('admin.setting.Courier.courier_index',compact("courier"));
	}

	public function getCreate()
	{
		return view('admin.setting.Courier.courier_form');
	}

	public function postSave(Request $request)
	{
		$courier = Auth::user();
		$validator = Courier_Model::validator($request->all(), $request->get("courier_id",''));
		
		if($validator->fails()){
			return redirect()->back()
			->withErrors($validator->getMeassageBag())
			->withInput($request->all());
		}

		if($request->get("courier_id") == '')
		{
			$courier = new Courier_Model();
		}
		else
		{
			$courier = Courier_Model::findorFail($request->get("courier_id"));
		}

		$courier->courier_name = $request->get("courier_name");
		$courier->contact_person = $request->get("contact_person");
		$courier->email = $request->get("email");
		$courier->telephone = $request->get("telephone");
		$courier->fuel_surcharge = $request->get("fuel_surcharge");
		$courier->service_tax = $request->get("service_tax");
		$courier->handling_charge = $request->get("handling_charge");
		$courier->status = $request->get("status");
		
		/*$test = $courier->courier_id;
		$zone = new Courier_Zone();
		$zone->courier_id = $test;*/

		$courier->save();

		return redirect(action('Admin\Setting\Courier_Controller@getIndex'))->with('success');

	}

	public function getData()
	{	
		//$courier = Courier_Model::where('is_delete','0')->get();

		return Datatables::of(Courier_Model::all("*"))	
		->addColumn('courier_id', function ($courier){
			return '<input type="checkbox" class="sub_chk" data-id="'.$courier->courier_id.'" value="'.$courier->courier_id.'">';
		})

		->addColumn('status', function ($courier){
			if ($courier->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $courier->courier_id . '" id="' . $courier->courier_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $courier->courier_id . '" data-id="' . $courier->courier_id . '" status-id="' . $courier->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $courier->courier_id . '" id="' . $courier->courier_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $courier->courier_id . '" data-id="' . $courier->courier_id . '" status-id="' . $courier->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
		})

		->addColumn('contact_person', function ($courier){
			return '<td><b>Contact Person:</b>&nbsp;'.strtoupper($courier->contact_person).'</td><br><b>Contact Email:&nbsp;</b><td>'.$courier->email.'</td><br><b>Contact Telephone:&nbsp;</b><td>'.$courier->telephone.'</td>';

		})
		
		->addColumn('action', function ($courier){
			return '<a href="'.action('Admin\Setting\Courier_Controller@getEdit',[$courier->courier_id]).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i>Edit</a>&nbsp;'
				.'<a href="'.action('Admin\Setting\Courier_Controller@getIndex1',[$courier->courier_id]).'" class="btn btn-success">Zone</a>';
		})

		->make('true');
	}

	public function getEdit($courier = '')
	{
		$courier = Courier_Model::findorFail($courier);
		return view('admin.setting.Courier.courier_form',compact("courier"));		
	}

	public function anyStatus(Request $request)
	{
		$courier = Courier_Model::findorFail($request->get("courier_id"));
		$courier->courier_id = $request->get("courier_id");
		$courier->status = $request->get("status");
		$courier->save();

		return response()->json(['success'=>"Status Change Successfully."]);		
	}

	public function getDelete(Request $request)
	{
		try
		{
			$courier = Courier_Model::findorFail($courier)->update(['is_delete'=>1])->save();

			return redirect(action('Admin\Setting\Courier_Controller@getIndex'))->with('success');
		}
		catch(\Exception $ex){
			return response()->json(['error' => $ex->getMeassage()]);
		}
	}

	public function getRemove(Request $request)
	{
		try
        {
            $ids = $request->ids;       
            $del=Courier_Model::whereIn('courier_id',explode(",",$ids));
            $del->delete();
            return response()->json(['success'=>"Courier Deleted successfully."]);

        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }   
	}

	public function anyActiveall(Request $request)
	{
		$ids = $request->ids;
		$status = $request->get("status");

		Courier_Model::whereIn('courier_id',explode(",", $ids))->update(['status' => $status]);

		return response()->json(['success'=>"Status Change Successfully."]);
	}

	public function anyInactiveall(Request $request)
	{
		$ids = $request->ids;
		$status = $request->get("status");

		Courier_Model::whereIn('courier_id',explode(",", $ids))->update(['status' => $status]);

		return response()->json(['success'=>"Status Change Successfully."]);
	}

	//Zone List Function

	public function getIndex1($courier = '')
	{

		//$zone = Courier_Zone::all("*");
		$courier = Courier_Model::findorFail($courier);
		//print_r($courier);die;
		return view('admin.setting.Courier.zone_index',compact("courier"));
	}

	public function getZone($courier = '')
	{

		$courier = Courier_Model::findorFail($courier);
		$country = Country::all("*");
		//$zone = Courier_Zone::all("*");
		//print_r($country);die;
		return view('admin.setting.Courier.zone_form',compact('country','courier',''));
	}

	public function postSavedata(Request $request)
	{
		$zone = Auth::user();
		$validator = Courier_Zone::validator($request->all(), $request->get("courier_zone_id",''));
		
		if($validator->fails()){
			return redirect()->back()
			->withErrors($validator->getMeassageBag())
			->withInput($request->all());
		}

		if($request->get("courier_zone_id") == '')
		{
			$zone = new Courier_Zone();
		}
		else
		{
			$zone = Courier_Zone::findorFail($request->get("courier_zone_id"));
		}

		$zone->zone = $request->get("zone");
		$zone->country_id = implode($request->get("country_id"),'|');
		$zone->courier_id = $request->get("courier_id");
		$zone->status = $request->get("status");

		//print_r($zone);die();
		$zone->save();

		/*$test = $zone->courier_zone_id;

		if($request->get("courier_zone_country_id") == '') {
            $thk = new Courier_Zone_Country();
        } else {
            $thk = Courier_Zone_Country::findOrFail($request->get("courier_zone_country_id"));
        }

		$thk->courier_id = $request->get("courier_id");
		$thk->courier_zone_id = $zone->courier_zone_id;
        $thk->country_id = implode($request->get("country_id"),'|');
        $thk->status = $request->get("status");

        $thk->save();*/

        //print_r($z_price);die;
		return redirect(action('Admin\Setting\Courier_Controller@getIndex1',[$zone->courier_id]))->with('success');
		
	}
	
	public function getDatazone($courier_id ='')
	{
		// $zone = Courier_Price_History::findOrFail($request->get("courier_id"));
		//print_r($courier_id);die();	
		//$test1 = Courier_Zone::where('is_delete','0')->get();
		/*$test = Courier_Zone::leftjoin('country','country.country_id','=','courier_zone.courier_zone_id')->select(['courier_zone.*','courier_price_history.*','country.*'])->get();*/
		/*$test1 = Courier_Price_History::leftjoin('courier_zone','courier_zone.courier_zone_id','=','courier_price_history
			.courier_price_history_id')->select(['courier_price_history.*','courier_zone.courier_zone_id'])->get();*/
		
			$testdata=Courier_Zone::leftjoin('courier','courier.courier_id','=','courier_zone.courier_id')
		->leftjoin('courier_price_history','courier_price_history.courier_zone_id','=','courier_zone.courier_zone_id')
		->select(['courier_zone.*','courier_price_history.courier_price_history_id','courier_price_history.value','courier_price_history.increment_decrement','courier_price_history.created_at','courier.courier_id','courier.courier_name'])
		->where([['courier.courier_id','=',$courier_id],['courier_zone.courier_id','=',$courier_id]])
		->MAX('courier_price_history.courier_price_history_id')
		->orWhere('courier_price_history.courier_id','=',$courier_id)
		->groupBy('courier_zone.courier_zone_id')
		->orderBy('courier_price_history.courier_price_history_id','desc')->get();		
		

		
		//$test2 = Courier_Zone::leftjoin('courier_price_history','courier_price_history.courier_price_history_id','=','courier_zone.courier_zone_id')->select(['courier_zone.*','courier_price_history.courier_price_history_id','courier_price_history.value','courier_price_history.increment_decrement','courier_price_history.created_at'])->get();

		return Datatables::of($testdata)	
		->addColumn('courier_zone_id', function ($zone){
			return '<input type="checkbox" class="sub_chk" data-id="'.$zone->courier_zone_id.'" name="checkboxlist" value="'.$zone->courier_zone_id.'">';
		})

		->addColumn('status', function ($zone){
			if ($zone->status == 1) {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $zone->courier_zone_id . '" id="' . $zone->courier_zone_id . '" checked >
                                    <label id="ac" class="onoffswitch-label" for="' . $zone->courier_zone_id . '" data-id="' . $zone->courier_zone_id . '" status-id="' . $zone->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                } else {
                    return '<div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox"  class="onoffswitch-checkbox" data-id="' . $zone->courier_zone_id . '" id="' . $zone->courier_zone_id . '" >
                                    <label id="ac" class="onoffswitch-label" for="' . $zone->v . '" data-id="' . $zone->courier_zone_id . '" status-id="' . $zone->status . '">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>';
                }
		})

		->addColumn('value', function ($zone){
			if(isset($zone) && !empty($zone)){
				if($zone->increment_decrement == '1')
				{
					return '<td>Incremented <b>Value</b>:'.$zone->value.'</td><br><td>On Date ['.date('F d, Y', strtotime($zone->created_at)) .']</td>';
				}
				elseif($zone->increment_decrement == '0')
				{
					return '<td>Decremented <b>Value</b>:'.$zone->value.'</td><br><td>On Date ['.date('F d, Y', strtotime($zone->created_at)) .']</td>';	
				}
				else
				{
					return '';
				}
			}
			
		})

		->addColumn('action', function ($zone){
			return '<a href="'.action('Admin\Setting\Courier_Controller@getEditzone',[$zone->courier_zone_id]).'" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i>Edit</a>&nbsp;'
				.'<a href="'.action('Admin\Setting\Courier_Controller@getHistory',[$zone->courier_id,$zone->courier_zone_id]).'" class="btn btn-xs btn-success">View History</a>&nbsp;';
		})
		
		->make('true');

	}

	public function getHistory($courier = '',$zone = '')
	{
		$courier = Courier_Model::findorFail($courier);
		$zone = Courier_Zone::findOrFail($zone);
		
		$history = Courier_Price_History::where('courier_id','=',$courier->courier_id)->where('courier_zone_id','=',$zone->courier_zone_id)->get();
		//print_r($histor);die();
		return view('admin.setting.Courier.zone_history',compact('history','courier','zone'));
	}

	public function postSavePrice(Request $request)
	{
		$z_price = Auth::user();
		$validator = Courier_Price_History::validator($request->all(), $request->get("courier_price_history_id",''));

		if($validator->fails()){
			return redirect()->back()
			->withErrors($validator->getMeassageBag())
			->withInput($request->all());
		}

		if($request->get("courier_price_history_id",'') == '')
		{
			$z_price = new Courier_Price_History();
			// print_r($z_price);die();
		}
		else
		{
			$z_price = Courier_Price_History::findOrFail($request->get("courier_price_history_id"));
		}

		//$test = $zone->courier_zone_id;
		//print_r($zone);die();
		$z_price->courier_id = $request->get("courier_id");
		$z_price->courier_zone_id = $request->get("courier_zone_id");
		$z_price->value = $request->get("value");
		$z_price->increment_decrement = $request->get("increment_decrement");

		// print_r($z_price);die();

		$z_price->save();

		return redirect(action('Admin\Setting\Courier_Controller@getIndex1',[$z_price->courier_id]))->with('success');
		
	}

	public function getEditzone($zone = '')
	{
		$zone = Courier_Zone::join('courier','courier.courier_id','=','courier_zone.courier_id')->select('courier.courier_id','courier_zone.*')->findorFail($zone);
		$courier = Courier_Model::all("*");
		$country = Country::all("*");
		 //print_r($thk);die();
		return view('admin.setting.Courier.zone_form',compact('zone','courier','country'));
	} 

	public function anyStatuszone(Request $request)
	{
		$zone = courier_zone::findorFail($request->get("courier_zone_id"));
		$zone->courier_zone_id = $request->get("courier_zone_id");
		$zone->status = $request->get("status");
		$zone->save();

		return response()->json(['success'=>"Status Change Successfully."]);
	}

	public function getRemovezone(Request $request)
	{
		try{
			$ids = $request->ids;
			$del = courier_zone::whereIn('courier_zone_id',explode(",", $ids));
			$del->delete();
			return response()->json(['success'=>"Zone Deleted Successfully."]);
		}
		catch(\Exception $ex){
			return response()->json(['error'=>$ex->getMessage()]);
		}
	}

	public function anyActiveallzone(Request $request)
	{
		$ids = $request->ids;
        $status = $request->get("status"); 
        DB::table("courier_zone")->whereIn('courier_zone_id',explode(",",$ids))->update(['status' => $status]);
       
        return response()->json(['success'=>"Status Change Successfully."]); 
	}

	public function anyInactiveallzone(Request $request)
	{
		$ids = $request->ids;
		$status = $request->get("status");
		DB::table("courier_zone")->whereIn('courier_zone_id',explode(",", $ids))->update(['status' => $status]);

		return response()->json(['success'=>"Status Change Successfully."]);
	}

	//Zone Price 

	public function postSaveCoun(Request $request)
	{
		$from_p = Auth::user();
		$validator = Courier_Zone_Price::validator($request->all(), $request->get("courier_zone_price_id",''));

		if($validator->fails()){
			return redirect()->back()
			->withErrors($validator->getMeassageBag())
			->withInput($request->all());
		}

		if($request->get("courier_zone_price_id") == '')
		{
			$from_p = new Courier_Zone_Price();
		}
		else
		{
			$from_p = Courier_Zone_Price::findOrFail($request->get("courier_zone_price_id"));
		}

		//$test = $zone->courier_zone_id;
		//print_r($zone);die();
		//$from_p->courier_zone_price_id = $request->get("courier_zone_price_id");
		$from_p->courier_id = $request->get("courier_id");
		$from_p->courier_zone_id = $request->get("courier_zone_id");
		$from_p->from_kg = $request->get("from_kg");
		$from_p->to_kg = $request->get("to_kg");
		$from_p->price = $request->get("price");
		
		
		$from_p->save();

		return redirect(action('Admin\Setting\Courier_Controller@getEditzone',$from_p->courier_zone_id))->with('success');
		
		//print_r($from_p);die();
	}

	public function getDataPrice($courier_zone_id,$courier_id)
	{
		//$deals = Courier_Zone_Price::leftjoin('courier_zone','courier_zone.courier_zone_id','=','courier_zone_price.courier_zone_price_id')->select('courier_zone.courier_zone_id','courier_zone.courier_id','courier_zone_price.*');
		$getdataprice=Courier_Zone_Price::join('courier_zone','courier_zone.courier_zone_id','=','courier_zone_price.courier_zone_id')->where([['courier_zone.courier_zone_id','=',$courier_zone_id],['courier_zone.courier_id','=',$courier_id]])->get();
	  //dd($getdataprice);
		
		return Datatables::of($getdataprice)
		->addColumn('courier_zone_price_id', function ($from_p){
			return '<input type="checkbox" class="sub_chk" data-id="'.$from_p->courier_zone_price_id.'" name="checkboxlist" value="'.$from_p->courier_zone_price_id.'">';
		})

		->addColumn('action', function ($from_p){
			return '<a onclick="getprice('.$from_p->courier_zone_price_id.','.$from_p->from_kg.','.$from_p->to_kg.','.$from_p->price.')" class="btn btn-xs btn-primary"><i class="fa fa-pencil-square-o"></i>Edit</a>&nbsp;&nbsp;&nbsp;'
				.'<a href="'. action('Admin\Setting\Courier_Controller@getDeletePrice', [$from_p->courier_zone_price_id]) .'" data-id="'. $from_p->courier_zone_price_id . '" class="btn btn-xs btn-danger">Delete</a>';
		})
		
		->make('true');


	}

	public function getDeletePrice($from_p) 
    {
        try
        {
            $from_p = Courier_Zone_Price::findOrFail($from_p);
            $from_p->delete();
            //return view('admin.setting.Courier.zone_form');

            return redirect(action('Admin\Setting\Courier_Controller@getEditzone',$from_p->courier_zone_id))->with('success');
        } 
        catch (\Exception $ex)
        {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

}
