<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $userServices;

    public function __construct(
        UserService $userServices
    ){
        $this->middleware(['auth']);

        $this->userServices = $userServices;
    }

    public function index()
    {
        $users = $this->userServices->list();

        return view('users.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = $this->userServices->roles();
        return view('users.create', [
            'roles' => $roles
        ]);
    }

    public function store(UserRequest $request, $locale)
    {
        $user = $this->userServices->create($request);

        return redirect()->route('administration.users.edit', ['id'=>$user->id])->with('status', 'L\'Usuari s\'ha creat correctament');
    }

    public function edit($locale, $id)
    {
        $user = $this->userServices->read($id);
        $roles = $this->userServices->roles();

        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    public function update(UserRequest $request, $locale, $id)
    {
        $this->userServices->update($request,$id);
        $user = $this->userServices->read($id);

        return redirect()->route('administration.users.edit', ['id'=>$user->id])->with('status', 'L\'Usuari s\'ha actualitzat correctament');
    }

    public function destroy($locale, $id)
    {
        $this->userServices->delete($id);

        return back()->with(['status'=>'Eliminat correctament']);
    }

}
