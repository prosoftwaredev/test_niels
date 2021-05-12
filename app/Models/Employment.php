<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employment extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'middle_name',
        'address',
        'department_id',
        'state_id',
        'city_id',
        'country_id',
        'zip',
        'birth_date',
        'date_hired'
    ];

    protected $appends = ['country', 'state', 'city', 'department'];

    public function getCountryAttribute()
    {
        return $this->country()->first();
    }

    public function getStateAttribute()
    {
        return $this->state()->first();
    }

    public function getCityAttribute()
    {
        return $this->city()->first();
    }

    public function getDepartmentAttribute()
    {
        return $this->department()->first();
    }

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }

    public function State()
    {
        return $this->belongsTo(State::class);
    }

    public function City()
    {
        return $this->belongsTo(City::class);
    }

    public function Department()
    {
        return $this->belongsTo(Department::class);
    }
}
