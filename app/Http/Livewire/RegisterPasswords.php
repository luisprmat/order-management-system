<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;

class RegisterPasswords extends Component
{
    public string $password = '';

    public string $passwordConfirmation = '';

    public function generatePassword(): void
    {
        $this->setPasswords(Str::password(12));
    }

    private function setPasswords($value): void
    {
        $this->password = $value;
        $this->passwordConfirmation = $value;
    }

    public function render()
    {
        return view('livewire.register-passwords');
    }
}
