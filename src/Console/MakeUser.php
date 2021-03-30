<?php

namespace Radiocubito\Wordful\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Radiocubito\Wordful\Wordful;

class MakeUser extends Command
{
    protected $signature = 'wordful:make-user';

    protected $description = 'Create a new user';

    protected $email;

    protected $name;

    protected $password;

    public function handle()
    {
        $this
            ->promptEmail()
            ->promptName()
            ->promptPassword()
            ->createUser();
    }

    protected function promptEmail()
    {
        $this->email = $this->ask('Email');

        if ($this->emailValidationFails()) {
            return $this->promptEmail();
        }

        return $this;
    }

    protected function promptName()
    {
        $this->name = $this->ask('Name', false);

        return $this;
    }

    protected function promptPassword()
    {
        $this->password = $this->secret('Password (Your input will be hidden)');

        return $this;
    }

    protected function createUser()
    {
        if ($this->emailValidationFails()) {
            return;
        }

        Wordful::userModel()::forceCreate([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->info('User created successfully.');
    }

    private function emailValidationFails()
    {
        if (! filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        if (Wordful::newUserModel()->where('email', $this->email)->exists()) {
            return true;
        }
    }
}
