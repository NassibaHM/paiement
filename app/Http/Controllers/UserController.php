<?php

namespace App\Http\Controllers;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // public function __construct()
    // {
    // $this->authorizeResource( User::class, 'User');
    // }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $User = User::all();
        $Users = User::count();
        return view('User.index', compact('Users'), ['User' => $User ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validation des données entrées par l'utilisateur
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email', // Ajout de la validation unique pour l'e-mail
                'password' => 'required|min:6',
                'type' => 'required',
            ]);
            $hashedPassword = Hash::make($request->password);

            // Création de l'utilisateur
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $hashedPassword,
                'type' => $request->type,
            ]);

            // Redirection avec un message de succès
            return redirect()->route('User.index')->with('success', 'User created successfully.');
        } catch (QueryException $e) {
            // Si une exception est levée (doublon d'e-mail), rediriger avec un message d'erreur
            return redirect()->back()->withInput()->withErrors(['email' => 'Email already exists.']);
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        return view('User.edit',['User'=>$User]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,User $User)
    {
       
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'type' => 'required',

        ]);
        // user::update($request->post());
        $User->fill($request->post())->save();
        return redirect()->route('User.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::findOrFail($id);

        // $corbeille = new corbeilleUser;
        // $corbeille->name = $User->name;
        // $corbeille->email = $User->email;
        // $corbeille->type = $User->type;
        // $corbeille->save();

        // $User->delete();
        // return redirect()->route('User.index');
        $User->delete();
        return redirect()->route('User.index')->with('success', 'User deleted successfully');
    
    }
}