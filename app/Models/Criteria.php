<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\SubCriteria;

class Criteria extends Model
{
    use HasFactory;

    protected $fillable = [
        'criteria_code',
        'criteria_name'
    ];

    public function hasSubcriteria()
    {
        return $this->hasMany(SubCriteria::class, 'criteria_id', 'id');
    }
}
