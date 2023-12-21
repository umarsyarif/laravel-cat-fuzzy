<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Http\Requests\StoreExamRequest;
use App\Http\Requests\UpdateExamRequest;
use App\Models\Exam;
use App\Models\ExamStudent;
use App\Models\Question;
use DateTime;
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
        if (Auth::user()->role == UserRoles::Student){
            return $this->showStudentExam($exam);
        }
        $data = [
            'exam' => $exam,
            'students' => $exam->students()->get()
        ];
        // return $data;
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

    private function showStudentExam($exam)
    {
        $user = Auth::user();
        // start the exam, or get the exam
        $examStudent = ExamStudent::with('questions')->firstOrCreate([
            'student_id' => $user->student->id,
            'exam_id' => $exam->id
        ], [
            'started_at' => now()
        ]);

        // get next question
        $nextQuestion = $examStudent->getNextQuestion();
        $answeredQuestions = $examStudent->questions()->with('question')->get();

        // stopping criteria
        $isTotalQuestionsLimit = $answeredQuestions->count() == $exam->total_question;
        $isLowerOrUpperLimit = is_null($nextQuestion);
        $isTimeUp = date_diff(now(), $examStudent->started_at)->i >= $exam->timer;

        // end the exam
        if ($isTotalQuestionsLimit || $isLowerOrUpperLimit || $isTimeUp){
            $examStudent->update([
                'ended_at' => now(),
                'final_score' => $answeredQuestions->where('is_correct')->sum('question.difficulty_level') / $answeredQuestions->sum('question.difficulty_level') * 100
            ]);
        }
        $data = [
            'exam' => $exam,
            'result' => $examStudent,
            'examStudentQuestion' => $nextQuestion,
            'question' => $nextQuestion?->question,
        ];
        // return $data;
        return view('exam.student-show', $data);
    }
}
