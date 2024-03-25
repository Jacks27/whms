<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\rolerequest;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function edit(string $id)
    {
        $users = User::select('id','first_name','last_name','email')
        ->find($id);
        $roles=$users->roles;
        $rolenames = Role::all()->pluck('name');

        return view('users.update', compact('users','roles', 'rolenames'));
    }
    public function show(string $id)
    {
        $user = User::select('id','first_name','last_name','email')
        ->find($id);
        $roles=$user->roles;
        $rolenames = Role::all()->pluck('name');
        try {
            $docs = DB::table('doctors')
        ->leftJoin('user_profiles', 'doctors.prof_id', '=', 'user_profiles.id')
        ->leftJoin('users', 'user_profiles.user_id', '=', 'users.id')
        ->leftJoin('departments', 'doctors.dep_id', '=', 'departments.id')
        ->select(
            'speciality',
            'experience',
            'qualification',
            'status',
            'doctors.id',
            'user_profiles.id as user_id',
            'user_profiles.phno',
            'user_profiles.address',
            'user_profiles.image',
            'user_profiles.county',
            'user_profiles.city',
            'users.name as username'
        )->get();
        } catch (\Exception $e) {

            dd($e->getMessage());
            Log::error('Error fetching branch user: ' . $e->getMessage());

        }


        return view('users.show', compact('user','roles','rolenames', 'doctors'));
    }


    public function update(Request $request, user $user)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users|max:255',
        ]);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if(!$user->save()){
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while updating User.');
        }else{
            redirect()->route('user.index')->with('success', 'Success, your user has been updated.');
        }


    }
    // create a function for updating the roles;
    public function assignRole(rolerequest $request){

        if($request->roles){
            $user=User::find($request->id);
            $user->assignRole($request->roles)->save();
           return redirect()->route('user.show', $request->id)->with('success', 'Success, your user role has been assigned.');
        }else{
           return  redirect()->back('user.show', $request->id)->with('error', 'Sorry, there\'re a problem while updating user role.');
        }

    }
    public function revokeRole(rolerequest $request){
        if(!empty($request->roles)){
            $user=User::find($request->id);

            foreach($request->roles as $role){
                $user->removeRole($role)->save();
            }

           return redirect()->route('user.show', $request->id)->with('success', 'Success, your user role has been updated.');
        }else{
           return  redirect()->back( 'user.show', $request->id)->with('error', 'Please select a role the remove');
        }

    }
    public function destroy(string $id)
    {
        $user=User::find($request->id);
        if (!$user->delete()) {
            return redirect()->back()->with('error', 'Sorry, there\'re a problem while deleting the user.');
        }
        return redirect()->route('discount.index')->with('success', 'Success, your user has been deleted.');
    }


}
