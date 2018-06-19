<?php

namespace App\Http\Controllers\Admin\Product;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\Blogs;
use App\Models\DataType;
use Datatables;
use App\Models\File;
use Illuminate\Support\Facades\Input;

class MediaController extends Controller
{
    public function getIndex() {

        return view('admin.media.form');
    }
    public function getBlogdetails($blog){
        $blogdetails = Blogs::where('blog_id', $blog)->get();       
        return view('view.home', compact('blogdetails','blog_id'));
    }

    public function anyData() {
        return Datatables::of(Media::all('*'))
            ->addColumn('media_title', function($cmsMedia){
                return '<img class="img-responsive" src="'.$cmsMedia->getThumbName('Icon').'" />';
            })
            ->addColumn('action', function ($cmsMedia) {
                return '<a  href="'. action('Admin\MediaController@getDelete',[$cmsMedia->media_id]) . '" data-id="'. $cmsMedia->media_id . '" class="btn btn-xs btn-primary btn-delete"><i class="fa fa-trash"></i> Delete</a>';
            })
            ->make(true);
    }
    
    public function getDelete($id='') {
        try {            
            $cmsMedia = Media::findOrFail($id);            
            $cmsMedia->delete();            
            return redirect(action('Admin\MediaController@getIndex'))->with('success');
        } catch (\Exception $ex) {
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function getEditMedia($id='') {
        $cmsMedia = Media::findOrFail($id);        
        $thumbConfig = config('insights-portal.image_resize_dimensions');
        return view('admin.media.form', compact('cmsMedia','thumbConfig'));
    }

    public function postUploadMedia(Request $request) {    	
        $arrResponse = [];
        $file = Input::file('file');        
        $is_process = (boolean)$request->get('is_process');
        $thumb_values = $request->get("thumbvalues");
        if($file->isValid()) {
            $destinationPath = public_path().'/uploads/cms_media';
            $filename = $file->getClientOriginalName();
            if($file->move($destinationPath, $filename)){
                $cmsMedia = Media::create([
                    'media_title' => $filename,
                    'media_filename' => $filename,                   
                    
                ]);
                $originalFilePath = $destinationPath . '/' . $filename;
                Media::createThumbs($originalFilePath, $file->getClientOriginalExtension());
                $arrResponse[0]['name'] = $file->getClientOriginalName();
            }
        }
        return \Response::json(array(
            'success' => 200,
            'files' => $arrResponse
        ));
    }
    public function postDeleteMediaByName(Request $request)
    {
        try {
            $file_name = $request->get("file_name");
            $destinationPath = public_path().'/uploads/cms_media/';
            $cmsMedia = Media::where("name",$file_name)->first();
            $fileName = $cmsMedia->name;
            $extension = pathinfo($destinationPath.$fileName, PATHINFO_EXTENSION);
            $cmsMedia->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $ex) {
            return response()->json(['success' => trans('dashboard.media_delete_success')]);
        }
    }

    public function getDataMediaModalOrig(Request $request) {     
        $process_flag = ($request->get("process_flag")) ? $request->get("process_flag") : 0;        
        return Datatables::of(Media::all())
            ->addColumn('media_title', function($cmsMedia){
                return '<img class="img-responsive" src="'.$cmsMedia->getThumbName('Icon').'" />';
            })
            ->addColumn('action', function ($cmsMedia) {
                $thumbConfig = config('insights-portal.image_resize_dimensions');
                $strBtn  = '<div class="btn-group">';
                $strBtn .= '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" aria-expanded="false">'.trans('dashboard.select').'<span class="caret"></span></button>';
                $strBtn .= '<ul class="dropdown-menu">';
                $strBtn .= '<li><a href="#" class="select-media-option" data-title="'.$cmsMedia->media_title.'" data-id="'.$cmsMedia->media_id.'" data-url="'.url('uploads/cms_media/'.$cmsMedia->media_title).'">'.trans('dashboard.original').'</a></li>';
                $strBtn .= '</ul></div>';
                return $strBtn;
            })
            ->make(true);
    }

    public function anyDataMediaModal(Request $request) {
        return Datatables::of(Media::all())
            ->addColumn('media_title', function($cmsMedia){
                return '<img class="img-responsive" src="'.$cmsMedia->getThumbName('Icon').'" />';
            })
            ->addColumn('action', function ($cmsMedia) {
                $thumbConfig = config('insights-portal.image_resize_dimensions');
                $strBtn  = '<div class="btn-group">';
                $strBtn .= '<button data-toggle="dropdown" class="btn btn-primary dropdown-toggle select-media-option" data-title="'.$cmsMedia->media_title.'" data-id="'.$cmsMedia->media_id.'" data-url="'.url('uploads/cms_media/'.$cmsMedia->media_title).'"  aria-expanded="false">'.trans('dashboard.select').'</button>';
                $strBtn .= '<ul class="dropdown-menu">';
                if($cmsMedia->is_process) {
                    foreach($thumbConfig as $dimensionName => $dimension) {
                        $file_check = $cmsMedia->checkThumbImageExists($dimensionName);
                        if ($file_check) {
                            $strBtn .= '<li><a href="#" class="select-media-option" data-title="' . $cmsMedia->media_title . '" data-id="' . $cmsMedia->media_id . '" data-url="' . $cmsMedia->getThumbName($dimensionName) . '">' . $dimensionName . ' (' . $dimension . ')</a></li>';
                        }
                    }
                    $strBtn .= '<li class="divider"></li>';
                }
                // $strBtn .= '<li><a href="#" class="select-media-option" data-title="'.$cmsMedia->media_title.'" data-id="'.$cmsMedia->id.'" data-url="'.url('uploads/cms_media/'.$cmsMedia->media_title).'">'.trans('dashboard.original').'</a></li>';
                $strBtn .= '</ul></div>';
                return $strBtn;
            })
            ->make(true);
    }
    public function getMedia(Request $request) {
    $arrResponse = [];     
        $fileList = Media::all();
        $thumbConfig = config('insights-portal.image_resize_dimensions');
        if(count($fileList) > 0) {
            $cnt = 0;
            foreach($fileList as $file) {
                $arrResponse[$cnt]['name'] = $file->media_title;
                $thumbCount = 0;
                if($file->is_process) {
                    foreach($thumbConfig as $dimensionName => $dimension) {
                        $file_check = $file->checkThumbImageExists($dimensionName);
                        if($file_check){
                            $arrResponse[$cnt]['options'][$thumbCount]['name'] = $dimensionName."<br/>(".$dimension.")";
                            $arrResponse[$cnt]['options'][$thumbCount]['url'] = $file->getThumbName($dimensionName);
                            $thumbCount++;
                        }
                    }
                } else {
                        $arrResponse[$cnt]['options'][$thumbCount]['name'] = "Icon<br/>(60*60)";
                        $arrResponse[$cnt]['options'][$thumbCount]['url'] = $file->getThumbName("Icon");
                        $thumbCount++;
                }
                $arrResponse[$cnt]['options'][$thumbCount]['name'] = trans('dashboard.original');
                $arrResponse[$cnt]['options'][$thumbCount]['url'] = url('uploads/cms_media/'.$file->media_title);
                $cnt++;
            }
        }
        return \Response::json(array(
            'success' => 200,
            'files' => $arrResponse
        ));
    }
}
