<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::latest()->paginate(10);

        $data = [
            'questions' => $questions
        ];
        return view('question.index', $data);
    }

    function questionList(Request $request) {
        // Page Length
        $pageNumber = ( $request->start / $request->length )+1;
        $pageLength = $request->length;
        $skip       = ($pageNumber-1) * $pageLength;

        // Page Order
        $orderColumnIndex = $request->order[0]['column'] ?? '0';
        $orderBy = $request->order[0]['dir'] ?? 'desc';

        // get data from products table
        $query = \DB::table('questions')->select('*');

        // Search
        $search = $request->search;
        $query = $query->where(function($query) use ($search){
            $query->orWhere('question_code', 'like', "%".$search."%");
            $query->orWhere('question', 'like', "%".$search."%");
            $query->orWhere('difficulty_level', 'like', "%".$search."%");
            $query->orWhere('different_power', 'like', "%".$search."%");
        });

        $orderByName = 'question_code';
        switch($orderColumnIndex){
            case '0':
                $orderByName = 'question_code';
                break;
            case '1':
                $orderByName = 'question';
                break;
            case '2':
                $orderByName = 'difficulty_level';
                break;
            case '3':
                $orderByName = 'different_power';
                break;

        }
        $query = $query->orderBy($orderByName, $orderBy);
        $recordsFiltered = $recordsTotal = $query->count();
        $questions = $query->skip($skip)->take($pageLength)->get();

        return response()->json(["draw" => $request->draw, "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, 'data' => $questions], 200);
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
