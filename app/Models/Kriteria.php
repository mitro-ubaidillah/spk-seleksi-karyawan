<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KriteriaParent;

class Kriteria extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kriteriaParent()
    {
       return $this->belongsTo(KriteriaParent::class, 'id_parent');
    }
}
