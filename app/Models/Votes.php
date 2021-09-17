<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    use HasFactory;

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }
    
    public function voter_data()
    {
        return $this->belongsTo(Voters::class, 'voters_id');
    }
    
}
