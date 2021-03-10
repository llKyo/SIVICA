<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class UserController extends Controller
{

    public function index()
    {
        return view('mma.users.index')->with('users',\App\User::all());
    }

    public function store(Request $request)
    {
        \App\User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'rol' => $request->rol,
            'password' => bcrypt($request->password),
            'user_id'=>null,
            'url_name' =>''
        ]);

        $user_store = \App\User::where('email', $request->email)->first();
        $action = 'Crea Usuario | Nombre:'.$user_store->name.' | Id: '.$user_store->id.' | Email: '.$user_store->email.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Usuarios']);
        return redirect('/users');
    }

    public function edit($id)
    {
        return view('mma.users.edit')->with('user', \App\User::find($id));
    }

    public function update(Request $request, $id)
    {
        $user = \App\User::find($id);
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->rol = $request->rol;
        if(trim($request->password) != '')
        {
            $user->password = bcrypt($request->password);
        }
        $user->save();
        $action = 'Edita Usuario | Nombre:'.$user->name.' | Id: '.$user->id.' Por -->  Email: '.$request->email.'| Nombre:'.$request->name.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Usuarios']);
        return redirect('/users');
    }

    public function destroy($id)
    {
        $user = \App\User::find($id);
        $action = 'Elimina Usuario | Nombre:'.$user->name.' | Id: '.$user->id.' | Email: '.$user->email.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Usuarios']);
        \App\User::destroy($id);
        return redirect('/users');
    }
}
