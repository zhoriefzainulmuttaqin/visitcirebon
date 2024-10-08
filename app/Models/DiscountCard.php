<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DiscountCard extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'discount_cards';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
}
