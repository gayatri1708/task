<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    //
    protected $fillable = [
        'first_name', 'last_name'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
