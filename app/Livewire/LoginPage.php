<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginPage extends Component
{
    public $email = '';
    public $password = '';
    public $errorMessage = '';

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:1',
        ]);

        $user = User::where('email', $this->email)->first();

        if ($user && Hash::check($this->password, $user->password)) {
            session(['authenticated' => true, 'auth_user_id' => $user->id, 'auth_user_name' => $user->name, 'auth_user_email' => $user->email]);
            return $this->redirect('/dashboard', navigate: false);
        }

        $this->errorMessage = 'Email atau password salah.';
        $this->password = '';
    }

    public function render()
    {
        return view('livewire.login-page');
    }
}
