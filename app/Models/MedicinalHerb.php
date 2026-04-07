<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicinalHerb extends Model
{
    use HasFactory;

    protected $fillable = [
        'herb_code',
        'name',
        'unit',
        'quantity_in_stock',
        'expiry_date',
        'origin',
        'note',
        'status',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'quantity_in_stock' => 'decimal:2',
    ];

    public function prescriptionItems()
    {
        return $this->hasMany(PrescriptionItem::class);
    }
}
