<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = false;//set tgian
    protected $fillable=['info_name','info_map','info_logo'];
    protected $primaryKey='info_id';
    protected $table= 'tbl_infomation';

}
