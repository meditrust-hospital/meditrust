<?php
class AuthController extends Controller
{
    public function login()
    {
        if (!empty($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/');
            exit;
        }
        $this->view('auth/login', ['pageJs'=>'auth.js']);
    }

    public function doLogin()
    {
        $token = $_POST['csrf_token'] ?? '';
        if (!csrf_verify($token)) {
            $this->json(['ok'=>false,'error'=>'Invalid CSRF token'], 403);
        }

        $email = trim($_POST['email'] ?? '');
        $password = (string)($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $this->json(['ok'=>false,'error'=>'Email and password are required'], 422);
        }

        $user = $this->model('UserModel')->findByEmail($email);
        if (!$user || !password_verify($password, $user['password_hash'] ?? '')) {
            $this->json(['ok'=>false,'error'=>'Invalid credentials'], 401);
        }

        $_SESSION['user_id'] = (int)$user['id'];
        $this->json(['ok'=>true,'redirect'=> BASE_URL . '/'], 200);
    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
