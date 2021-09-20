<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voters extends Model
{
    use HasFactory;

    public function voter_data()
    {
        return $this->hasOne(Voter::class, 'voters_id');
    }
}
