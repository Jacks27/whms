<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BranchUser;


class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    function __construct()

     {
         $this->middleware(['role_or_permission:Super-Admin|role_list|role_create|role_edit|role_delete']);

        //  $this->middleware('permission:role_list|role_create|role_edit|role_delete', ['only' => ['index','store']]);
        //  $this->middleware('permission:role_create', ['only' => ['create','store']]);
        //  $this->middleware('permission:role_edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:role_delete', ['only' => ['destroy']]);
        //  $this->middleware('permission:role_list', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $role= new Role();
        $roles = $role->latest()->paginate(10);
        $sudo = User::with('roles')->get();

        return view('auth.roles.index',  compact('roles', 'sudo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $permissions = Permission::get();

        return view('auth.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate the request before submittinig
        $request->validate([
            'name' => 'required|unique:roles|max:255',
            'permission' => 'required'
        ]);
        $role = Role::create(['name' => $request->name]);
        $permission=$request->permission;

        foreach ($permission as $perm) {

            $role->givePermissionTo($perm);
        }
        if(!$role){
            return redirect()->back()->with('error','Sorry, there was a problem while creating the a role');
        }
        return redirect()->route('role.index')->with('success', 'Success, A new Role has been created');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**BranchUser
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::with('roles')
                ->select('first_name', 'last_name')
                ->where('id', $id)
                ->first();
        $rolenames = Role::all()->pluck('name');

        return view('auth.roles.update', compact('user', 'rolenames'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $role)
    {
        $role=Role::Find($role);
        if($role->delete())
        {
         return back()->with('success','Role Deleted Successfully');
        }
    }

    public function RemoveRole(Request $request)

    {
        if(Auth::check()){
            User::find($request->id)->removeRole($request->role);

            return back()->with('success','Role Deleted Successfully');
        }else{
            return redirect('\login');
        }



    }


}
