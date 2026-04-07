<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'full_name',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'note',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * Tính tuổi từ ngày sinh
     */
    public function getAgeAttribute(): ?int
    {
        return $this->date_of_birth?->age;
    }

    /**
     * Giới tính hiển thị tiếng Việt
     */
    public function getGenderLabelAttribute(): string
    {
        return match ($this->gender) {
            'male'   => 'Nam',
            'female' => 'Nữ',
            'other'  => 'Khác',
            default  => '—',
        };
    }
}
