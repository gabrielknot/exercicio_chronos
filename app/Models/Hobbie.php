<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobbie extends Model
{
    use HasFactory;
    protected $table = "hobbies";
    protected $primaryKey = "id";

    public function clientes(){
        return $this->belongsTo(Cliente::class);
    }
}
