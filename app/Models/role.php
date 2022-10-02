<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    use HasFactory;
    protected $guarded =[];
    
    /**
     * Get Role User
     */
    public function user()
    {
       return $this -> hasMany( admin::class, 'role_id', 'id' );
    }

}
