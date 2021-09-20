<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    protected $table = 'candidate';

    public function votes()
    {
        return $this->hasMany(Votes::class, 'candidate_id');
    }
}
