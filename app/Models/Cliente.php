<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";
    protected $primaryKey = "id";

    public function cidade(){        
        return $this->belongsTo(Cidade::class, "cidade_id");
    }

    public function hobbies(){        
        return $this->belongsToMany(Hobbie::class);
    }
}
