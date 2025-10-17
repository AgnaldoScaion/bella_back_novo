<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'mensagem' => 'required|string|max:1000',
        ]);
        $feedback = Feedback::create([
            'user_id' => Auth::id(),
            'mensagem' => $request->mensagem,
        ]);
        return response()->json($feedback);
    }

    public function index()
    {
        $feedbacks = Feedback::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json($feedbacks);
    }
}
