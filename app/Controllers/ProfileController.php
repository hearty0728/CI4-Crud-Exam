<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ProfileController extends BaseController
{

    public function show()
    {
        $username = session()->get('username');
        
        if (!$username) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $user = $this->ApplicationModel->getUser(username: $username);

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $data = array_merge($this->data, [
            'title' => 'My Profile',
            'user' => $user
        ]);

        return view('profile/show', $data);
    }

    public function edit()
    {
        $username = session()->get('username');
        
        if (!$username) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $user = $this->ApplicationModel->getUser(username: $username);

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $data = array_merge($this->data, [
            'title' => 'Edit Profile',
            'user' => $user
        ]);

        return view('profile/edit', $data);
    }

    public function update()
    {
        $username = session()->get('username');
        
        if (!$username) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $user = $this->ApplicationModel->getUser(username: $username);

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login');
        }

        $userId = $user['userID'];

        $rules = [
            'fullname' => 'required|min_length[3]|max_length[100]',
            'username' => "required|valid_email|is_unique[users.username,id,{$userId}]",
            'student_id' => 'permit_empty|max_length[20]',
            'course' => 'permit_empty|max_length[100]',
            'year_level' => 'permit_empty|integer|greater_than[0]|less_than[6]',
            'section' => 'permit_empty|max_length[50]',
            'phone' => 'permit_empty|max_length[20]',
            'address' => 'permit_empty|max_length[500]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $updateData = [
            'fullname' => $this->request->getPost('fullname'),
            'username' => $this->request->getPost('username'),
            'student_id' => $this->request->getPost('student_id'),
            'course' => $this->request->getPost('course'),
            'year_level' => $this->request->getPost('year_level'),
            'section' => $this->request->getPost('section'),
            'phone' => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address')
        ];

        $file = $this->request->getFile('profile_image');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $validationRules = [
                'profile_image' => 'uploaded[profile_image]|is_image[profile_image]|mime_in[profile_image,image/jpg,image/jpeg,image/png,image/webp]|max_size[profile_image,2048]'
            ];

            if (!$this->validate($validationRules)) {
                return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            if (!empty($user['profile_image'])) {
                $oldImagePath = FCPATH . 'uploads/profiles/' . $user['profile_image'];
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $ext = $file->getExtension();
            $newName = 'avatar_' . $userId . '_' . time() . '.' . $ext;
            $file->move(FCPATH . 'uploads/profiles/', $newName);
            $updateData['profile_image'] = $newName;
        }

        if ($this->ApplicationModel->updateProfile($userId, $updateData)) {
            session()->set('username', $updateData['username']);
            session()->setFlashdata('notif_success', 'Profile updated successfully!');
            return redirect()->to('/profile');
        }

        // Debug: Log the error
        log_message('error', 'Profile update failed for user ID: ' . $userId);
        log_message('error', 'Update data: ' . json_encode($updateData));
        log_message('error', 'Database error: ' . json_encode($this->db->error()));
        
        session()->setFlashdata('notif_error', 'Failed to update profile. Please check if all database columns exist.');
        return redirect()->back()->withInput();
    }
}
