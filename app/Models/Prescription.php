<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'prescription_code',
        'prescribed_date',
        'general_note',
        'usage_instruction',
        'status',
    ];

    protected $casts = [
        'prescribed_date' => 'date',
    ];

    /**
     * Lấy hồ sơ bệnh án của đơn thuốc này.
     */
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
