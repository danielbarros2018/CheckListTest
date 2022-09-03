<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';

    protected $fillable = [
        "email",
    ];

    public function cakes()
    {
        return $this->belongsToMany(Cake::class, 'cake_email', 'email_id', 'cake_id');
    }
}
