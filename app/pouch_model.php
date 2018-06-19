<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pouch_model extends Model
{
    protected $table='product_pouch_volume';
    protected $fillable = ['pouch_volume','abbreviation','status'];
    protected $primaryKey = 'pouch_volume_id';
}
