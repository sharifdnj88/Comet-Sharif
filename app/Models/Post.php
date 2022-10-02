<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function categorypost()
    {
        return $this -> belongsToMany(Categorypost::class);
    }

    public function tag()
    {
        return $this -> belongsToMany(Tag::class);
    }

    public function author()
    {
      return  $this ->  belongsTo(admin::class, 'admin_id', 'id');
    }

}
