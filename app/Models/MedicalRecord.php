<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'record_code',
        'visit_date',
        'symptoms',
        'diagnosis',
        'treatment_note',
        'follow_up_date',
        'note'
    ];

    protected $casts = [
        'visit_date' => 'date',
        'follow_up_date' => 'date',
    ];

    /**
     * Lấy bệnh nhân của hồ sơ này.
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Lấy các đơn thuốc của hồ sơ này.
     */
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
