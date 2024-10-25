<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payout extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payout_date',
        'gross_salary',
        'retirement_contribution',
        'health_contribution',
        'risk_contribution',
        'unemployment_contribution',
        'total_contributions',
        'net_salary',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class, 'job_title_id');
    }

    
}
