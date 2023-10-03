<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;
use App\Models\ExamStudent;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'exams' => Exam::with('students')->get()
        ];
        return view('exam.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        return view('exam.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamRequest $request)
    {
        try {
            Exam::create($request->validated());

            return redirect()->back()->with(['success' => 'Ujian baru berhasil ditambahkan']);
        }

        catch (Exception $e) {
            return redirect()->back()->with(['failed' => 'Data telah ada atau tidak sesuai silahkan dicek kembali']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $data = [];
        $user = Auth::user();
        if ($user->role == UserRoles::Student){
            $examStudent = ExamStudent::with('questions')->firstOrCreate([
                'student_id' => $user->student->id,
                'exam_id' => $exam->id
            ], [
                'started_at' => now()
            ]);
            // cek if exam ended
            $nextQuestion = $examStudent->getNextQuestion();
            $data = [
                'exam' => $exam,
                'result' => $examStudent,
                'examStudentQuestion' => $nextQuestion,
                'question' => $nextQuestion?->question,
            ];
            // return $data;
            return view('exam.student-show', $data);
        }
        return view('exam.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $data = [
            'exam' => $exam
        ];
        return view('exam.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamRequest $request, Exam $exam)
    {
        try {
            $exam->update($request->validated());

            return redirect()->back()->with(['success' => 'Data ujian berhasil diubah']);
        }

        catch (Exception $e) {
            return redirect()->back()->with(['failed' => 'Data ujian tidak berhasil diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        if (!$exam) {
            return redirect()->route('exam.index')->with(['failed' => 'Soal tidak berhasil dihapus']);
        }

        $exam->delete();
        return redirect()->route('exam.index')->with(['success' => 'Soal berhasil dihapus']);
    }
}
