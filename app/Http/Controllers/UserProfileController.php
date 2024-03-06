<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserProfileRequest;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\DB;


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

            return view('home')->with('userprofile', $userprofile);
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

            return view('home');
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
        dd("created failed");
                return redirect()->back()->with('error', 'Sorry, there a problem while creating Your Profile.');
            }
            return redirect()->route('home')->with('success', 'Success, you Profile have been created.');

        }
        public function destroy(){
            return view('user.profile');
        }
        public function show(){
            return view('user.profile');
        }
    }
