<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'gifts_tour';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
