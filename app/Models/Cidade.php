<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    use HasFactory;
    protected $table = "cidades";
    protected $primaryKey = "id";

    public function estado(){
        return $this->belongsTo(Estado::class, "estado_id", "id");
    }
}
