<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CourseModel;
use CodeIgniter\HTTP\ResponseInterface;

class CourseController extends BaseController
{
    public function index()
    {
        $courseModel = new CourseModel();
        $data['courses'] = $courseModel->findAll();
        return view('courses/index', $data);
    }

    public function create()
    {
        return view('courses/create');
    }

    public function store()
    {
        $courseModel = new CourseModel();

        $file = $this->request->getFile('thumbnail');
        $thumbnailName = null;
        if ($file && $file->isValid()) {
            $thumbnailName = $file->getRandomName();
            $file->move('uploads/courses', $thumbnailName);
        }

        $courseModel->insert([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'instructor_id' => session()->get('id'),
            'status' => 'active',
            'thumbnail' => $thumbnailName
        ]);

        return redirect()->to(base_url('courses'))->with('success', 'Course created successfully!');
    }

    public function edit($id)
    {
        $courseModel = new CourseModel();
        $data['course'] = $courseModel->find($id);
        return view('courses/edit', $data);
    }

    public function update($id)
    {
        $courseModel = new CourseModel();

        $file = $this->request->getFile('thumbnail');
        $thumbnailName = $this->request->getPost('old_thumbnail');

        if ($file && $file->isValid()) {
            $thumbnailName = $file->getRandomName();
            $file->move('uploads/courses', $thumbnailName);
        }

        $courseModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'price' => $this->request->getPost('price'),
            'thumbnail' => $thumbnailName
        ]);

        return redirect()->to(base_url('courses'))->with('success', 'Course updated successfully!');
    }

    public function delete($id)
    {
        $courseModel = new CourseModel();
        $courseModel->delete($id);
        return redirect()->to(base_url('courses'))->with('success', 'Course deleted successfully!');
    }
}
