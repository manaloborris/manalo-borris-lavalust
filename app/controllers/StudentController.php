<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller
{
    public function index()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION['student_access'] = true;

        $data = [
            'page_title' => 'Student Home',
            'student' => [
                'student_id' => 'MCC2024-00160',
                'name' => 'Borris Manalo',
                'course' => 'BS Information Technology',
                'year' => '3rd Year',
                'section' => '3-F4',
                'email' => 'manaloborris153@gmail.com'
            ]
        ];

        $this->call->view('student_home', $data);
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
            'skills' => ['Athletics', '100m', 'Long Jump', 'Triple Jump', 'High Jump'],
            'events' => ['100m', 'Long Jump', 'Triple Jump', 'High Jump']
        ];

        $data = [
            'page_title' => 'Student Profile',
            'student' => $student
        ];

        $this->call->view('student_profile', $data);
    }
}
