<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use App\Models\appointment;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\rolerequest;
use App\Models\User;
use App\Models\notification;


class UserProfileController extends Controller
{
    public function index(Request $request)
    {
        $userprofile = DB::table('user_profiles')
            ->leftJoin('users', 'user_profiles.user_id', '=', 'users.id')
            ->select(
                'user_profiles.id',
                'user_profiles.phno',
                'user_profiles.address',
                'user_profiles.image',
                'user_profiles.blg',
                'user_profiles.county',
                'user_profiles.city',
                'user_profiles.gender',
                'user_profiles.dob',
                'users.name as username',
                'users.email',
                'users.created_at'
            )->where('users.id', $request->user()->id)->get(); // Assuming user_id is the foreign key linking to

            $userAppointments = DB::table('appointments')
            ->select(
                'appointments.id as id',
                'appointments.description as pdescp',
                'appointments.confirmation',
                'appointments.payment_mode',
                'appointments.time',
                'appointments.confirmation',
            )->where('appointments.patient_id', $request->user()->id)->get();
            return view('home')->with('userprofile', $userprofile)->with('userAppointments', $userAppointments);

    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return back();
    }

        public function edit(){
            return view('user.profile');
        }
        public function create(){

            return view('home.index');
        }
        public function store(UserProfileRequest $request){

        $image_path = '';
        $user_profile = $request->user()->id;


        if ($request->hasFile('image')) {
            $image_path = $request->file('image')->store('profile', 'public');
        }
        $userProfile = UserProfile::create([
            'phno' => $request->phno,
            'address' => $request->address,
            'image' => $image_path,
            'user_id' => $user_profile, // Assuming user_id is the foreign key linking to the users table
            'blg' => $request->blg,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'city' => $request->city,
            'county' => $request->county
        ]);

      if (!$user_profile) {

                return redirect()->back()->with('error', 'Sorry, there a problem while creating Your Profile.');
            }
            return redirect()->route('home')->with('success', 'Success, you Profile have been created.');

        }
        public function destroy($id){
            return view('doc.show');
        }
        public function show($id){
            return view('doc.show');
        }
        // assign a role
        public function roleAssign(rolerequest $request)
        {
            if ($request->role) {
                $user = User::find($request->id);
                $user->assignRole($request->role)->save();
                return redirect()->route('doctor.show', $request->id)->with('success', 'Success, your user role has been assigned.');
            } else {
                return redirect()->route('doctor.show', $request->id)->with('error', 'Sorry, there\'s a problem while updating user role.');
            }
        }
        // remove rights
    public function roleRevoke(Request $request){
            if(!empty($request->role)){
                $user=User::find($request->id);

                foreach($request->role as $rol){

                    $user->removeRole($rol)->save();
                }

               return redirect()->route('doctor.show', $request->id)->with('success', 'Success, your user role has been updated.');
            }else{
               return  redirect()->back( 'doctor.show', $request->id)->with('error', 'Please select a role the remove');
            }

        }
    }
