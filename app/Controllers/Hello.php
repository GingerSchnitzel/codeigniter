<?php

namespace App\Controllers;

use App\Models\NameModel;

class Hello extends BaseController
{
    protected $nameModel;

    /**
     * @var list<string>
     */
    protected $helpers = ['form', 'url'];

    public function __construct()
    {
        $this->nameModel = new NameModel();
    }

    public function index($name = 'World')
    {
        $data['name'] = $name;
        $data['names'] = $this->nameModel->findAll();
        return view('hello_world', $data);
    }

    /**
     * Create a name row. Expects first_name, last_name, email, password (GET or POST).
     * If POST includes redirect=1 (from the hello form), redirects back to hello with a flash message.
     * Passwords are stored hashed; plain password is never sent back in old() (see view).
     */
    public function add()
    {
        $useRedirect   = $this->request->getPost('redirect') === '1';
        $returnSegment = (string) ($this->request->getPost('return_segment') ?? 'World');

        $first    = $this->request->getVar('first_name');
        $last     = $this->request->getVar('last_name');
        $email    = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $backToHello = function () use ($returnSegment) {
            return redirect()->to(site_url('hello/' . rawurlencode($returnSegment !== '' ? $returnSegment : 'World')));
        };

        $errMsg = null;
        if ($first === null || $first === '' || $last === null || $last === '' || $email === null || $email === '' || $password === null || $password === '') {
            $errMsg = 'first_name, last_name, email, and password are required';
        } elseif (is_string($email) && (strlen($email) > 100 || filter_var($email, FILTER_VALIDATE_EMAIL) === false)) {
            $errMsg = 'email must be a valid address (max 100 characters)';
        } elseif (is_string($password) && strlen($password) > 255) {
            $errMsg = 'password must be at most 255 characters';
        }

        if ($errMsg !== null) {
            if ($useRedirect) {
                return $backToHello()->withInput()->with('error', $errMsg);
            }

            return $this->response->setStatusCode(400)->setJSON([
                'ok'      => false,
                'message' => $errMsg,
            ]);
        }

        $id = $this->nameModel->insert([
            'first_name' => $first,
            'last_name'  => $last,
            'email'      => is_string($email) ? $email : '',
            'password'   => password_hash((string) $password, PASSWORD_DEFAULT),
        ]);

        if ($id === false) {
            if ($useRedirect) {
                $msg = 'Failed to save';
                $err = $this->nameModel->errors();
                if ($err !== []) {
                    $msg .= ': ' . implode(' ', $err);
                }

                return $backToHello()->with('error', $msg);
            }

            return $this->response->setStatusCode(500)->setJSON([
                'ok'     => false,
                'message' => 'Failed to save',
                'errors' => $this->nameModel->errors(),
            ]);
        }

        if ($useRedirect) {
            return $backToHello()->with('message', 'Name added');
        }

        return $this->response->setJSON([
            'ok' => true,
            'id' => (int) $id,
        ]);
    }
}
