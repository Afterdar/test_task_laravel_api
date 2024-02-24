<?php

declare(strict_types=1);

namespace App\Services\Notions\Database\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notions extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'title',
        'content',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
