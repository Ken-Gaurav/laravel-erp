<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'media';

    protected $fillable = [
        'media_title',
        'media_filename'        
    ];

    protected $primaryKey = 'media_id';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    /**
     * Get a validator for user.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public static function validator(array $data, $id = '')
    {
        return Validator::make($data, [
            'title' => 'required'
        ]);
    }
    public static function createThumbs($imgPath, $extension,$thumb_values='') {
        
        $thumbConfig = ['Icon' => '60x60','Thumbnail' => '360x220'];

        if($thumb_values != "" && $thumb_values != "null" ){
            $selected_thumb_arr = explode(",",$thumb_values);
            array_push($selected_thumb_arr,"Icon");
        }else{
            $selected_thumb_arr = ['Icon','Thumbnail'];
        }

        if(count($thumbConfig) > 0) {
            foreach ($thumbConfig as $dimensionName => $dimension) {
                if(in_array($dimensionName,$selected_thumb_arr)) {
                    $caseFilePath = str_replace("." . $extension, "_" . $dimensionName . "." . $extension, $imgPath);
                    $dimensionArr = explode("x", $dimension);
                    $width = (isset($dimensionArr[0]) && is_numeric($dimensionArr[0]) ? $dimensionArr[0] : null);
                    $height = (isset($dimensionArr[1]) && is_numeric($dimensionArr[1]) ? $dimensionArr[1] : null);
                    if ($width !== null && $height !== null) {
                        $image = \Intervention\Image\Facades\Image::make($imgPath);
                        if ($image->getWidth() > $image->getHeight()) {
                            $image->resize(null, $height, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        } else {
                            $image->resize($width, null, function ($constraint) {
                                $constraint->aspectRatio();
                            });
                        }
                        $image->resizeCanvas($width, $height, 'center', false, 'rgba(255, 255, 255, 0)');
                        $image->save($caseFilePath);
                    }
                }
             }
        }
    }
    public function getThumbName($thumb="") {
        if($thumb != '') {
            if($this->checkThumbImageExists($thumb)) {
                $fileNameArr = explode(".", $this->media_title);
                $extension = end($fileNameArr);
                $thumbName = str_replace(".".$extension, "_".$thumb.".".$extension, $this->media_title);
            } else {
                return url('uploads/overlay.png');
            }
		} else {
			$thumbName = $this->media_title;
		}
        return url('uploads/cms_media/'.$thumbName);
    }
    public function checkThumbImageExists($thumb){
        $fileNameArr = explode(".", $this->media_title);
        $extension = end($fileNameArr);
        $thumbName = str_replace(".".$extension, "_".$thumb.".".$extension, $this->media_title);

        if(file_exists(base_path("public/uploads/cms_media/".$thumbName)) && $thumbName != ""){
             return true;
        }

        return false;
    }
    
    public function getUrl() {
        return url('uploads/cms_media/'.$this->media_title);
    }
}
