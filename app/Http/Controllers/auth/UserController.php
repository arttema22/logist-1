<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Profile;
use App\Models\Profits;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function index()
    {
        $Users = User::where('status', 1)->get();
        return view('user.users', ['Users' => $Users]);
    }

    public function create()
    {
        $Roles = Role::all();
        return view('user.users-create', ['Roles' => $Roles]);
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'last-name' => 'required',
            'first-name' => 'required',
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required|not_in:0'
        ]);
        $User = new User();
        $User->name = $request->input('name');
        $User->email = $request->input('email');
        $User->password = $request->input('password');
        $User->role_id = $request->input('role');
        $User->save();

        $Profile = new Profile();
        $Profile->user_id = $User->id;
        $Profile->last_name = $request->input('last-name');
        $Profile->first_name = $request->input('first-name');
        $Profile->sec_name = $request->input('sec-name');
        $Profile->phone = $request->input('phone');
        $Profile->save();

        $Profit = new Profits();
        $Profile->date = Carbon::now()->format('Y-m-d');
        $Profile->created_at = date(now());
        $Profile->updated_at = date(now());
        $Profit->owner_id = Auth::user()->id;
        $Profit->driver_id = $User->id;
        ($request->input('saldo') ? $Profit->saldo_start = $request->input('saldo') : $Profit->saldo_start = 0);
        ($request->input('saldo') ? $Profit->saldo_end = $request->input('saldo') : $Profit->saldo_end = 0);
        $Profit->title = ' ';
        $Profit->comment = 'Начальная загрузка';
        $Profit->save();

        return redirect()->route('user.list')->with('success', 'Создан новый пользователь.');
    }

    public function edit($id)
    {
        $User = User::find($id);
        $Roles = Role::all();
        return view('user.users-edit', ['User' => $User, 'Roles' => $Roles]);
    }

    public function update($id, Request $request)
    {
        $valid = $request->validate([
            'last-name' => 'required',
            'first-name' => 'required',
            'name' => 'required',
            'email' => 'required',
        ]);
        $User = User::find($id);
        $User->name = $request->input('name');
        $User->email = $request->input('email');
        //$User->password = $request->input('password');
        if (Gate::denies('is-driver')) { //текущий пользователь имеет роль водителя
            $User->role_id = $request->input('role');
        }
        $User->save();
        $Profile = Profile::find($id);
        $Profile->last_name = $request->input('last-name');
        $Profile->first_name = $request->input('first-name');
        $Profile->sec_name = $request->input('sec-name');
        $Profile->phone = $request->input('phone');
        $Profile->save();
        if (Gate::allows('is-driver')) { //текущий пользователь имеет роль водителя
            return redirect()->route('home');
        } else {
            return redirect()->route('user.list')->with('success', 'Данные были изменены');
        }
    }

    public function user_delete($id)
    {
        $User = User::find($id);
        $User->status = 0;
        $User->save();
        return redirect()->route('user.users')->with('warning', 'Пользователь был удален');
    }

    public function user_recover($id)
    {
        $User = User::find($id);
        $User->status = 1;
        $User->save();
        return redirect()->route('user.users')->with('success', 'Пользователь был восстановлен');
    }

    public function role()
    {
        $Roles = new Role();
        return view('user.role', ['Roles' => $Roles->all()]);
    }

    public function role_update($id)
    {
        $Role = new Role();
        return view('user.role-update', ['Role' => $Role->find($id)]);
    }

    public function role_update_save($id, Request $request)
    {
        $valid = $request->validate(['title' => 'required|unique:roles,title']);
        $Role = Role::find($id);
        $Role->title = $request->input('title');
        $Role->save();
        return redirect()->route('user.roles')->with('success', 'Название роли изменено');
    }
}
