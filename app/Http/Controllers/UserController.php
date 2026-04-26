<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Denda;
use App\Models\Peminjaman;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role
        ]);

        return redirect()->route('users.index');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('users.index');
    }
    public function dashboard()
{
    $userId = Auth::id();

    // ambil peminjaman user
    $data = Peminjaman::with('buku')
        ->where('user_id', $userId)
        ->latest()
        ->take(3)
        ->get();

    // total dipinjam
    $total = Peminjaman::where('user_id', $userId)
        ->where('status', 'dipinjam')
        ->count();

    // total telat
    $telat = Peminjaman::where('user_id', $userId)
        ->where('status', 'dipinjam')
        ->where('tanggal_jatuh_tempo', '<', now())
        ->count();

    // 🔥 INI YANG PENTING (DENDA)
    $denda = 0;

$peminjaman = Peminjaman::where('user_id', $userId)
    ->where('status', 'dipinjam')
    ->get();

foreach ($peminjaman as $item) {

    if (!$item->tanggal_jatuh_tempo) continue;

    $jatuh = \Carbon\Carbon::parse($item->tanggal_jatuh_tempo);
    $now = now();

    if ($now->gt($jatuh)) {

        $menit = $jatuh->diffInMinutes($now);

        if ($menit <= 0) {
            $menit = 1;
        }

        $denda += $menit * 1000;
    }
}

    return view('mahasiswa.dashboard', compact(
        'data','total','telat','denda'
    ));
    }
}