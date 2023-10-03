<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\Exam;
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
        $data = [];
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
