<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $fillable = ['question', 'max_votes'];

    public function options()
    {
        return $this->hasMany(PollOption::class);
    }
}
