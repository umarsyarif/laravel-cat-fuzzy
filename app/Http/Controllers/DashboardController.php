<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data = $this->getData(Auth::user()->role);
        return view('dashboard', $data);
    }

    private function getData(UserRoles $role) : array {
        $data = [
            'studentsCount' => Student::count(),
            'questionsCount' => Question::count(),
            'activeExamsCount' => Exam::where('is_active', 1)->count(),
        ];
        if ($role == UserRoles::Student){
            $data = [
                'exams' => Exam::with(['students' => fn($q) =>
                                $q->where('student_id', Auth::user()->student->id)
                                ])->active()->get()
            ];
        }
        return $data;
    }
}
