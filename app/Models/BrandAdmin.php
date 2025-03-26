<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BrandAdmin extends Authenticatable
{
    use HasFactory;
     
    protected $fillable = ['brand_id', 'name', 'email', 'password'];

    protected $hidden = ['password'];

    public function brand()
    {
        return $this->belongsTo(brand::class);
    }
}