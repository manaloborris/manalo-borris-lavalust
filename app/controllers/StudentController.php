<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function login()
    {
        $this->call->view('student_login', [
            'page_title' => 'Login'
        ]);
    }

    public function loginSubmit()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $name = trim($_POST['name'] ?? '');

        if ($name === '') {
            $this->call->view('student_login', [
                'page_title' => 'Student Login',
                'error' => 'Please enter your name.'
            ]);
            return;
        }

        $_SESSION['student_access'] = true;
        $_SESSION['viewer_name'] = $name;
        $_SESSION['middleware_protection'] = false;
        redirect('student');
    }

    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $data = [
            'page_title' => 'Student Home',
            'viewer_name' => $_SESSION['viewer_name'] ?? 'Viewer',
            'protection_enabled' => !empty($_SESSION['middleware_protection']),
            'student' => [
                'student_id' => 'MCC2024-00160',
                'name' => 'Borris Manalo',
                'course' => 'BS Information Technology',
                'year' => '3rd Year',
                'section' => '3-F4',
                'email' => 'manaloborris153@gmail.com',
                'profile_picture' => 'profile_pic.jpg'
            ]
        ];

        $this->call->view('student_home', $data);
    }

    public function toggleProtection()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['viewer_name'])) {
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['enabled' => false, 'message' => 'Viewer session required.']);
            exit;
        }

        $_SESSION['middleware_protection'] = !($_SESSION['middleware_protection'] ?? false);

        header('Content-Type: application/json');
        echo json_encode([
            'enabled' => $_SESSION['middleware_protection'],
            'message' => $_SESSION['middleware_protection']
                ? 'Middleware protection is active.'
                : 'Middleware protection is off.'
        ]);
        exit;
    }

    public function profile()
    {
        $student = [
            'student_id' => 'MCC2024-00160',
            'name' => 'Borris Manalo',
            'course' => 'BS Information Technology',
            'year' => '3rd Year',
            'section' => '3-F4',
            'email' => 'manaloborris153@gmail.com',
            'address' => 'Canubing 2 Calapan City Oriental Mindoro, Philippines',
            'contact' => '+63 967 257 4818',
            'facebook' => 'https://www.facebook.com/share/1GuCZqnzuW/',
            'profile_picture' => 'profile_pic.jpg',
            'sports' => ['Athletics'],
            'specialties' => ['100m', 'Long Jump', 'Triple Jump', 'High Jump']
        ];

        $data = [
            'page_title' => 'Student Profile',
            'student' => $student
        ];

        $this->call->view('student_profile', $data);
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
        redirect('student/login');
    }
}
