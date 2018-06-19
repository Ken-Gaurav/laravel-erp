<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class admin_menu extends Model
{
	protected $table = 'admin_menu';
    protected $fillable = ['parent_id', 'title','route','icon','status','is_delete'];

	protected $primaryKey = 'admin_id';

    public function parent()
    {
        return $this->belongsTo('App\admin_menu', 'parent_id')->orderBy('title');
    }

    public function children()
    {
        return $this->hasMany('App\admin_menu', 'parent_id')->orderBy('title');
    }
    public static function tree() {

        return static::with(implode('.', array_fill(0, 100, 'children')))->where('parent_id', '=','0')->where('status',1)->orderBy('admin_id')->get();

    }
    public static function validator(array $data, $admin_id = '')
    {
        return Validator::make($data, []);
    }
    public function getOwnerName() {
        $owner = $this->owner;
        return $owner->admin_id.' '.$owner->title;
    }
}
