<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Mcqs;
use Illuminate\Http\Request;

class McqsController extends Controller
{
    /**
     * Show all MCQs for a specific Quiz
     */
    public function index($quiz_id)
    {
        $quiz = Quiz::findOrFail($quiz_id);

        // Get all MCQs of this quiz
        $mcqs = $quiz->mcqs()->get(); // better: use relationship

        return view('admin.mcqs', compact('quiz', 'mcqs'));
    }

    /**
     * Store a new MCQ for a quiz
     */
    public function store(Request $request, $quiz_id)
    {
        $request->validate([
            'question' => 'required|string|min:3',
            'option1' => 'required|string|min:1',
            'option2' => 'required|string|min:1',
            'option3' => 'required|string|min:1',
            'option4' => 'required|string|min:1',
            'correct_option' => 'required|in:option1,option2,option3,option4',
        ]);

        // Ensure the quiz exists
        $quiz = Quiz::findOrFail($quiz_id);

        // Create the MCQ
        $quiz->mcqs()->create([
            'question' => $request->question,
            'option1' => $request->option1,
            'option2' => $request->option2,
            'option3' => $request->option3,
            'option4' => $request->option4,
            'correct_option' => $request->correct_option,
        ]);

        return redirect()->route('admin.mcqs.index', $quiz_id)
                         ->with('success', 'MCQ added successfully');
    }

    /**
     * Delete a MCQ
     */
    public function destroy($quiz_id, $mcq_id)
    {
        $mcq = Mcqs::where('quiz_id', $quiz_id)->where('id', $mcq_id)->firstOrFail();
        $mcq->delete();

        return redirect()->route('admin.mcqs.index', $quiz_id)
                         ->with('success', 'MCQ deleted successfully');
    }
}
