<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExamStudentQuestionRequest;
use App\Http\Requests\UpdateExamStudentQuestionRequest;
use App\Models\Exam;
use App\Models\ExamStudentQuestion;

class ExamStudentQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExamStudentQuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ExamStudentQuestion $examStudentQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExamStudentQuestion $examStudentQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExamStudentQuestionRequest $request, ExamStudentQuestion $examStudentQuestion)
    {
        $examStudentQuestion->update([
            'answer' => $request->answer,
            'is_correct' => $request->answer == $examStudentQuestion->question->answer
        ]);
        $exam = Exam::findOrFail($examStudentQuestion->result->exam_id);
        return redirect()->route('exam.show', $exam->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExamStudentQuestion $examStudentQuestion)
    {
        //
    }
}
