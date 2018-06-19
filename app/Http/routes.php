<?php

Route::get('/slitting_report', 'Admin\Production\Slitting_Controller@SlittingReport');


Route::get('/digital_printing_report', 'Admin\Production\Digital_PrintingContoller@digitalReport');

Route::get('/lamination_report/{lam_id}', 'Admin\Production\Lamination_Controller@getReportprint');
//Route::get('/lamination_report', 'Admin\Production\Slitting_Controller@SlittingReport');


/*Route::get('lamination_report', function () { 
    return view('lamination_report_print');
});*/  
	
Route::get('/', function () { 
    return view('auth/login');
});

Route::get('chk', function () { 
    return view('admin/checkall');
});

//Route::get('menuadd',array('as'=>'menuadd','uses'=>'admin_menu_controller@view'));

Route::get('myform/ajax/{id}',array('as'=>'menuadd.ajax','uses'=>'admin_menu_controller@myformAjax'));

Route::get('myform1/ajax/{id}',array('as'=>'menuadd.ajax','uses'=>'admin_menu_controller@myformAjax1'));
//Route::get('Menu','admin_menu_controller@getIndex');
//Route::get('menuadd','admin_menu_controller@view');
//Route::post('create','admin_menu_controller@insert');
Route::get('show','admin_menu_controller@view_show');
Route::get('typeahead-response',array('as'=>'typeahead.response','uses'=>'Admin\Production\Printing_Controller@typeahead'));

Route::group( ['prefix'=>'', 'as' => ''],function () {
 		
		Route::controller('Menu','admin_menu_controller');

 });

Route::get('searchajax', ['as'=>'searchajax','uses'=>'Admin\Production\Printing_Controller@getAutocomplete']);	
// Route::get('menuadd',array('as'=>'menuadd','uses'=>'admin_menu_controller@view'));

// Route::get('myform/ajax/{id}',array('as'=>'menuadd.ajax','uses'=>'admin_menu_controller@myformAjax'));

// Route::get('myform1/ajax/{id}',array('as'=>'menuadd.ajax','uses'=>'admin_menu_controller@myformAjax1'));

// Route::get('menu','admin_menu_controller@getIndex');
// Route::get('menuadd','admin_menu_controller@getView');
// Route::post('create','admin_menu_controller@insert');
// Route::get('show','admin_menu_controller@getShow');
// Route::get('edit','admin_menu_controller@getAnydata');

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/dashboard', 'HomeController@dash');


 Route::group(['namespace' => 'Admin\Production','middleware' => ['auth']], function () {
		Route::controller('Unit','Unit_Master_Controller');
        Route::controller('Production_process','Production_Process_Controller');
        Route::controller('Product_category','Product_Category_Controller');
        Route::controller('Machine_Master','Machine_Master_Controller');
        Route::controller('Product_item_info','product_item_info_controller');
        Route::controller('Product_Inward','Product_Inward_Controller');
        Route::controller('job','Job_Master_Controller');
        Route::controller('vender_info','Vender_Info_Controller');
        Route::controller('printing','Printing_Controller');
        Route::get('/roll/ajax/{id}',array('as'=>'add.ajax','uses'=>'Printing_Controller@getAjax'));
        Route::get('/get_operator/{id}',array('as'=>'add.ajax','uses'=>'Printing_Controller@getOperator'));
        Route::get('/job_name/ajax/{id}',array('as'=>'add.ajax','uses'=>'Printing_Controller@getJobname'));
        Route::controller('lamination','Lamination_Controller');
        
        //Route::get('lamination/create/{printing_id}/{job_id}','Lamination_Controller@getCreate')->name('lamination.create');
        //Route::get('/roll_lam/ajax/{id}',array('as'=>'add.ajax','uses'=>'Lamination_Controller@getAjax'));
        Route::controller('slitting','Slitting_Controller');
        Route::controller('digital_printing','Digital_PrintingContoller');
        Route::get('/digital/ajax/{id}',array('as'=>'add.ajax','uses'=>'Digital_PrintingContoller@getAjax'));
        
        //Route::controller('slitting_report','Slitting_Controller');
        // Route::get('job',array('as'=>'job','uses'=>'Job_Master_Controller@getCreate'));
        Route::get('/form/ajax/{id}',array('as'=>'add.ajax','uses'=>'Job_Master_Controller@getAjax'));
        Route::get('myform1/ajax/{id}',array('as'=>'add.ajax','uses'=>'Job_Master_Controller@getAjax1'));
        
        Route::controller('pouching','Pouching_Controller');

        
 });

 //Template
 Route::group(['namespace'=>'Admin\Template'], function () {
 		Route::controller('Template_Quantity','Template_QuantityController');
 		Route::controller('Template_Measurement','Template_MeasurementController');
 		Route::controller('Template_Volume','Template_VolumeController');
 });

  //user
 Route::group(['namespace'=>'Admin\User'], function () {
 		Route::controller('user_type','user_type_controller');
 });

 Route::group(['namespace'=>'Admin\Website'], function () {
 		Route::controller('websitedetails','Website_serverController');
 		
 });

 Route::group(['namespace'=>'Admin\SSLdetails'], function () {
 		Route::controller('ssldetails','SSLdetailsController');
 		
 });


//Setting
 Route::group(['namespace'=>'Admin\Setting'], function () {
 		Route::controller('currrency','Currency_Controller');
 		Route::controller('country','Country_Controller');
 		Route::controller('bank_detail','Bank_Detail_Controller');
 		Route::controller('taxation','Taxation_Controller');
 		Route::controller('courier','Courier_Controller');
 		Route::get('/form/ajax/{courier_zone_id}/{courier_id}',array('as'=>'add.ajax','uses'=>'Courier_Controller@getDataPrice'));
 		Route::get('/Myform/ajax/{courier_id}',array('as'=>'add.ajax','uses'=>'Courier_Controller@getDatazone'));
 		/*Route::get('/zoneform/ajax/{courier_zone_id}',array('as'=>'add.ajax','uses'=>'Courier_Controller@getHistory'));*/
 });

//product 

Route::group(['namespace' => 'Admin\Product'], function () {
	 	
 		Route::controller('product','product_controller');
 		Route::controller('productoption','ProductOptionController');
		Route::controller('colorcategory','ColorcategoryController');
		Route::controller('Ink_master','Ink_master_Controller');
		Route::controller('Ink_solvent','Ink_solventController');
		Route::controller('Printing_effect','Printing_effectController');
		Route::controller('Custom_ink_mul','Custom_ink_mulController');			
		Route::controller('pouchstyle','pouch_style_controller');
		Route::controller('productlayer','product_layer_controller');
		Route::controller('mailerbage','mailer_bag_controller');
		Route::controller('zipperprice','zipper_price_controller');	
		Route::controller('productpouch','product_pouch_controller');
		Route::controller('adhesive','AdhesiveController');
		Route::controller('adhesive_solvent','Adhesive_solvent_Controller');
		Route::controller('cpp_adhesive','CPP_adhesive_Controller');
		Route::controller('product_quantity','Product_QuantityController');
		Route::controller('roll_quantity','Roll_QuantityController');
		Route::controller('roll_profit_pricing','Roll_profit_price_Controller');
		Route::controller('roll_packing','Roll_packing_Controller');
		Route::controller('roll_transport','Roll_transport_Controller');
		Route::controller('roll_wastage','Roll_wastage_Controller');
		Route::controller('accessorie_price','Accessorie_PriceController');
		Route::controller('packing_pricing','Packing_PricingController');
		Route::controller('pouch_color','pouch_color_Controller');
		Route::controller('product_make','Product_MakeController');	
		Route::controller('cylinder','cylinder_vender_Controller');
		Route::controller('cylinder_currency','Cylinder_CurrencyController');
		Route::controller('cylinder_base','Cylinder_base_Controller');			
		Route::controller('tool_pricing','tool_pricing_controller');	
		Route::controller('storezo_details','StorezoDetailController');	
		Route::controller('transport_sea','Transport_SeaController');
		Route::controller('product_material','Product_MaterialController');	
		Route::controller('stock_wastage','Stock_WastageController');	
		Route::controller('spout','Spout_Controller');
		Route::controller('stock_profit_air','stock_price_by_Air_controller');
		Route::controller('size_master','Size_master_Controller');
		Route::controller('template_product_detail','Template_product_detail_Controller');
		Route::controller('spout_pouch','SpoutPouch_SizeController');
		Route::controller('stock_profit_sea','Stock_Profit_By_SeaController');
		Route::controller('view_size','View_sizeController');
		Route::controller('stock_profit_pickup','stock_profit_pickup_controller');
		Route::controller('profit_pricing','Profit_pricing_Controller');
		Route::controller('product_code','Product_Code_Controller');
		Route::controller('multi_quotation','MultiQuatationController');
		Route::get('material/ajax/{id}',array('as'=>'add.ajax','uses'=>'MultiQuatationController@getMaterial'));
		// Route::get('size/ajax/{id}',array('as'=>'add.ajax','uses'=>'Size_master_Controller@getRemove'));



	 });
//Route::get('/get', 'Admin\PouchCOntroller@index');
// Route::get('/productlayer','Product\ProductLayerController@p_layer');
// Route::get('/new_product','Product\ProductLayerController@newproduct');


