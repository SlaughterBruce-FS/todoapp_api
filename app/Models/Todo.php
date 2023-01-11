<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

class Todo extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'type',
        'status',
        'description',
        'date'
    ];

    protected $dates = ['date'];

    public function setDateAttribute($value) {
        $this->attributes['date'] = Carbon::createFromFormat('d/m/ Y', $value);
    }

    // public function getDateAttribute() {
    //     return $this->date->format('d, m, Y');
    // }

}
