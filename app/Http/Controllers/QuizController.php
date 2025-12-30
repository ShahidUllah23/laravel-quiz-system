<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Category;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // Show all quizzes
    public function index()
    {
        $quizzes = Quiz::with('category')->latest()->get();
        $categories = Category::all();
        return view('admin.quizzes', compact('quizzes', 'categories'));
    }

    // Store new quiz
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        Quiz::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.quizzes')->with('success', 'Quiz created successfully');
    }

    // Update quiz
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.quizzes')->with('success', 'Quiz updated successfully');
    }

    // Delete quiz
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('admin.quizzes')->with('success', 'Quiz deleted successfully');
    }
}
