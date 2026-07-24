<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    // Specifies the database table name
    protected $table = 'contacts';

    // Allows mass assignment for Contact::create($request->all())
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'message',
    ];
}