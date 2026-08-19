<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentMiddleware
{
    public function handle(Closure $next)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['viewer_name'])) {
            redirect('student/login');
            return;
        }

        if (!empty($_SESSION['middleware_protection'])) {
            redirect('student');
            return;
        }

        return $next();
    }
}
