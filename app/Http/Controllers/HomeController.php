<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\mataPelajaran;
use App\Models\User;
use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $exams = Exam::whereHas('users', function (Builder $query) {
            $query->where('user_id', Auth()->id());
        })->get();
        $user = Auth::user();
        $mapels = mataPelajaran::get();
        $informasi = Informasi::latest()->paginate(1);
        return view('home', compact('exams', 'mapels', 'user','informasi'));
    }
}
