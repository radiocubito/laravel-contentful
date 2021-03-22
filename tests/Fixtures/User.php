<?php

namespace Radiocubito\Wordful\Tests\Fixtures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Radiocubito\Wordful\Database\Factories\UserFactory;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $guarded = [];

    protected static function newFactory()
    {
        return UserFactory::new();
    }
}
