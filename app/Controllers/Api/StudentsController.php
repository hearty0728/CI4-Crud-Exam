<?php

namespace App\Controllers\Api;

use App\Models\UserModel;

class StudentsController extends BaseApiController
{
    private UserModel $userModel;

    public function initController(
        \CodeIgniter\HTTP\RequestInterface $request,
        \CodeIgniter\HTTP\ResponseInterface $response,
        \Psr\Log\LoggerInterface $logger
    ): void {
        parent::initController($request, $response, $logger);
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can list students.');
        }

        $students = array_map([$this, 'sanitize'], $this->userModel->getStudents());
        return $this->ok($students);
    }

    public function show(int $id)
    {
        if (! $this->hasTeacherAccess()) {
            return $this->forbidden('Only teachers and admins can view student profiles.');
        }

        $student = $this->userModel->getStudentById($id);

        if (! $student) {
            return $this->notFound("Student #{$id} not found.");
        }

        return $this->ok($this->sanitize($student));
    }

    private function hasTeacherAccess(): bool
    {
        return $this->apiUser && in_array($this->apiUser['role_name'], ['teacher', 'admin'], true);
    }

    private function sanitize(array $row): array
    {
        unset($row['password']);
        return $row;
    }
}
