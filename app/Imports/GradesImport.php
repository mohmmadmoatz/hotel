<?php

namespace App\Imports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class GradesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $stage;
    protected $year;

    public function __construct($stage,$year)
    {
        $this->stage = $stage;
        $this->year = $year;
    }

    public function model(array $row)
    {

        // fetch the student id from the studnet name

        $student_id = \App\Models\Student::where('student_id', $row['student_id'])->first();

        // fetch the matrial id from the matrial name

        $matrial_id = \App\Models\Matrial::where('name_ar', $row['subject'])->first();


        if($student_id){
            $student_id = $student_id->id;
        } else {
            $student_id = 0;
        }

        if($matrial_id){
            $matrial_id = $matrial_id->id;
        } else {
            $matrial_id = 0;
        }

        // insert student_id, matrial_id, stage_id, year in the grade table

        return new Grade([
            'student_id' => $student_id,
            'matrial_id' => $matrial_id,
            'stage_id' => $this->stage,
            'year' => $this->year,
            'quest_grade'=>$row['quest_grade'],
            'first_degree'=>$row['first_attempt'],
            'second_degree'=>$row['second_attempt'],
            'final_grade'=>$row['final_grade'],
            'rating'=>$row['rating']
        ]);
    }
}
