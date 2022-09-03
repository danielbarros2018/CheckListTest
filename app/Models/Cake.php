<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    use HasFactory;

    protected $table = 'cakes';

    protected $fillable = [
        "nome",
        "peso",
        "valor",
        "quantidade",
    ];

    public function emails()
    {
        return $this->belongsToMany(Email::class, 'cake_email', 'cake_id', 'email_id');
    }
}
