<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::latest()->get();

        $data = [
            'questions' => $questions
        ];
        return view('question.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        return view('question.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request)
    {
        try {
            Question::create($request->validated());

            return redirect()->back()->with(['success' => 'Soal baru berhasil ditambahkan']);
        }

        catch (Exception $e) {
            return redirect()->back()->with(['failed' => 'Data telah ada atau tidak sesuai silahkan dicek kembali']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $data = [
            'question' => $question
        ];
        return view('question.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        try {
            $question->update($request->validated());

            return redirect()->back()->with(['success' => 'Data soal berhasil diubah']);
        }

        catch (Exception $e) {
            return redirect()->back()->with(['failed' => 'Data soal tidak berhasil diubah']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        if (!$question) {
            return redirect()->route('question.index')->with(['failed' => 'Soal tidak berhasil dihapus']);
        }

        $question->delete();
        return redirect()->route('question.index')->with(['success' => 'Soal berhasil dihapus']);
    }
}
