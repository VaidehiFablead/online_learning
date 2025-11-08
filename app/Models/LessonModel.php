<?php

namespace App\Models;

use CodeIgniter\Model;

class LessonModel extends Model
{

    protected $table = 'lessons';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'course_id',
        'title',
        'content_type',
        'content_url',
        'created_at',
        'updated_at'
    ];
    protected $useTimestamps = true;
    protected $returnType = 'array';
}
