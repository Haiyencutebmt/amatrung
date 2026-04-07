<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrescriptionItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'medicinal_herb_id',
        'unit',
        'quantity',
        'instruction',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
    ];

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }

    public function herb()
    {
        return $this->belongsTo(MedicinalHerb::class, 'medicinal_herb_id');
    }
}
