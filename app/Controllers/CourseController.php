<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use CodeIgniter\HTTP\ResponseInterface;

class CourseController extends BaseController
{
    public function index()
    {
        return view('instructor/courses/index');
    }

    // Fetch all courses by logged-in instructor
    public function getCourses()
    {
        $courseModel = new CourseModel();
        $instructorId = session()->get('id');

        $courses = $courseModel->where('instructor_id', $instructorId)->findAll();

        return $this->response->setJSON($courses);
    }

    // Store new course (AJAX)
    public function store()
    {
        $courseModel = new CourseModel();
        $instructorId = session()->get('id');

        $data = [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'instructor_id' => $instructorId,
            'status' => 'active',
        ];

        $courseModel->insert($data);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Course added successfully!'
        ]);
    }

    // Delete course
    public function delete($id)
    {
        $courseModel = new CourseModel();
        $courseModel->delete($id);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Course deleted successfully!'
        ]);
    }
}
