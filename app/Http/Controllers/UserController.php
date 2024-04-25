<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\IOFactory;

class UserController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function guest_login()
    {
        return view('guest_login');
    }

    public function check_guest_login(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'faculty' => 'required',
        ]);

        $name = $validatedData['name'];
        $faculty = $validatedData['faculty'];
        if ($faculty === 'Business administration') {
            return redirect()->route('guest.BA');
        } elseif ($faculty === 'Graphics and Digital Design') {
            return redirect()->route('guest.graphics');
        } elseif ($faculty === 'Information technology') {
            return redirect()->route('guest.IT');
        }
    }

    public function BA_index()
    {
        $userFaculty = user::where('faculty', 'Business administration')->first();
        $contributions = Contribution::where('user_id', $userFaculty->id)
            ->where('status', 'accepted')
            ->paginate(2);
        // Chuyển đổi trực tiếp từ tệp Word sang HTML và lưu vào mảng
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/' . $contribution->word_file_path);
            $phpWord = IOFactory::load($wordFilePath);
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlContents[$contribution->id] = $htmlWriter->getContent();
        }

        return view('guest.BA', [
            'contributions' => $contributions,
            'htmlContents' => $htmlContents,
        ]);
    }

    public function graphics_index()
    {
        $userFaculty = user::where('faculty', 'Graphics and Digital Design')->first();
        $contributions = Contribution::where('user_id', $userFaculty->id)
            ->where('status', 'accepted')
            ->paginate(2);
        // Chuyển đổi trực tiếp từ tệp Word sang HTML và lưu vào mảng
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/' . $contribution->word_file_path);
            $phpWord = IOFactory::load($wordFilePath);
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlContents[$contribution->id] = $htmlWriter->getContent();
        }

        return view('guest.graphics', [
            'contributions' => $contributions,
            'htmlContents' => $htmlContents,
        ]);
    }

    public function IT_index()
    {
        $userFaculty = user::where('faculty', 'Information technology')->first();
        $contributions = Contribution::where('user_id', $userFaculty->id)
            ->where('status', 'accepted')
            ->paginate(2);
        // Chuyển đổi trực tiếp từ tệp Word sang HTML và lưu vào mảng
        $htmlContents = [];
        foreach ($contributions as $contribution) {
            $wordFilePath = storage_path('app/public/' . $contribution->word_file_path);
            $phpWord = IOFactory::load($wordFilePath);
            $htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
            $htmlContents[$contribution->id] = $htmlWriter->getContent();
        }

        return view('guest.IT', [
            'contributions' => $contributions,
            'htmlContents' => $htmlContents,
        ]);
    }

    public function check_login()
    {
        request()->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6',
        ]);
        $request = request()->only('email', 'password');

        if (Auth()->attempt($request)) {
            $user = Auth()->user();

            // Kiểm tra vai trò của người dùng và chuyển hướng tương ứng
            if ($user->role === 'Administrator') {
                return redirect()->route('admin.home');
            } elseif ($user->role === 'Student') {
                return redirect()->route('student.home');
            } elseif ($user->role === 'Marketing Coordinator') {
                return redirect()->route('coodinator.home');
            } elseif ($user->role === 'University Marketing Manager') {
                return redirect()->route('manager.home');
            }
        } else {
            return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác. Vui lòng thử lại.');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function check_register()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'role' => 'required|in:Administrator,Student,Marketing Coordinator,University Marketing Manager',
            'faculty' => 'required|in:Business administration,Graphics and Digital Design,Information technology',
        ]);
        $request = request()->only('name', 'email', 'password', 'role', 'faculty');
        $request['password'] = bcrypt(request('password'));
        User::create($request);

        return redirect()->route('login')->with('message', 'Register successfuly!');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function index()
    {
        $users = user::orderby('id', 'DESC')->get();

        return view('admin.user', compact('users'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store()
    {
        request()->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'role' => 'required|in:Administrator,Student,Marketing Coordinator,University Marketing Manager',
                'faculty' => 'required|in:Business administration,Graphics and Digital Design,Information technology',
            ]

        );
        $request = request()->only('name', 'email', 'password', 'role', 'faculty');
        $request['password'] = bcrypt(request('password'));
        User::create($request);

        return redirect()->route('user.index');
    }

    public function edit(User $user)
    {

        return view('admin.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:Administrator,Student,Marketing Coordinator,University Marketing Manager',
            'faculty' => 'required|in:Business administration,Graphics and Digital Design,Information technology',
        ]);
        $user->update($request->only('role', 'faculty'));

        return redirect()->route('user.index');
    }

    public function destroy(user $user)
    {
        $user->delete();

        return redirect()->route('user.index');
    }
}
