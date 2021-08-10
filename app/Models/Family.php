<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'husband_id', 'wife_id',
    ];

    /*
     * Relations
     */

    public function husband()
    {
        return $this->belongsTo(Person::class);
    }

    public function wife()
    {
        return $this->belongsTo(Person::class);
    }

    public function children()
    {
        return $this->hasMany(Person::class, "child_from_family_id")->with("family");
    }
}
