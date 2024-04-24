<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $stage;

    public function __construct($stage)
    {
        $this->stage = $stage;
    }

    public function model(array $row)
    {
        return new Student([
            'student_id' => $row['id'],
            'name'=>$row['name'],
            'email'=>$row['email'],
            'status'=>$row['status'],
            'gender'=>$row['gender'],
            'accept_type'=>$row['accept_type'],
            'stage_id'=>$this->stage

        ]);
    }
}
