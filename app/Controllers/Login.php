<?php

namespace App\Controllers;

use App\Models\NameModel;

class Login extends BaseController
{
    protected $nameModel;

    /**
     * @var list<string>
     */
    protected $helpers = ['form', 'url'];

    public function logout()
    {
        session()->remove('user');

        return redirect()->to(site_url('login'))->with('message', 'You have been signed out');
    }

    public function __construct()
    {
        $this->nameModel = new NameModel();
    }

    public function index()
    {
        if (session()->get('user') !== null) {
            return redirect()->to('/')->with('message', 'You are already signed in');
        }

        if ($this->request->getMethod() === 'post') {
            return $this->attempt();
        }

        return view('login', ['title' => 'Login']);
    }

    protected function attempt()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $back     = function () {
            return redirect()->back()->withInput();
        };

        if (! is_string($email) || $email === '' || ! is_string($password) || $password === '') {
            return $back()->with('error', 'Email and password are required');
        }

        $user = $this->nameModel->where('email', $email)->first();

        if ($user === null || ! password_verify($password, $user['password'])) {
            return $back()->with('error', 'Invalid email or password');
        }

        session()->set('user', [
            'id'    => (int) $user['id'],
            'email' => $user['email'],
        ]);

        return redirect()->to('/')->with('message', 'You are logged in');
    }
}
