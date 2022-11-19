<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\CountryList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UserFormRequest;
use App\Models\UserImage;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // $users = User::all()->where('is_delete','1');      
        $users = User::all()->where('is_delete',1);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $users = User::all()->where('is_active','1')->where('is_delete','1');
        $countries = CountryList::all()->where('is_active','1');
        return view('admin.user.create', compact('users','countries'));
    }

    public function store(UserFormRequest $request)
    {
        $validatedData = $request->validated();

        $user = new User();
        // $userInfo = new UserInfo();


        $user->create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'role_as' => $validatedData['role_as'],
            'password' => Hash::make($validatedData['password']),
            'is_active' => $request->is_active == true ? '1':'0',
            'created_by' => $validatedData['created_by'],
        ]);

        
        $user->userDetails()->create(
            // [
            //     'user_id' => $user->id,
            // ],
            [
                'user_id' => $validatedData[$user->id],
                'phone' => $validatedData['phone'],
                'gender' => $validatedData['gender'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'address' => $validatedData['address'],
                'city' => $validatedData['city'],
                'state' => $validatedData['state'],
                'postal_code' => $validatedData['postal_code'],
                'country' => $validatedData['country'],
                'admin_comment' => $validatedData['admin_comment'],
            ]
        );


        if($request->hasFile('profile_photo') || $request->hasFile('cover_photo')){
            $profilePhotoUploadPath = 'uploads/users/profilePhoto/';
            $coverPhotoUploadPath = 'uploads/users/coverPhoto/';
            
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoExtension = $profilePhoto->getClientOriginalExtension();
            $profilePhotoFilename =  $user->first_name.'-'.time().'.'.$profilePhotoExtension;
            $profilePhoto->move($profilePhotoUploadPath,$profilePhotoFilename);
            
            $coverPhoto = $request->file('cover_photo');
            $coverPhotoExtension = $coverPhoto->getClientOriginalExtension();
            $coverPhotoFilename =  $user->first_name.'-'.time().'.'.$coverPhotoExtension;
            $coverPhoto->move($coverPhotoUploadPath,$coverPhotoFilename);

            $user->userImages()->create(
                [
                    'user_id' => $user->id,
                ],
                [
                    'profile_photo' => $profilePhotoFilename,
                    'cover_photo' => $coverPhotoFilename,
                ]
            );
        }

        return redirect('admin/user')->with('message','Congratulations! User Details Has Been Created Successfully.');
    }

    public function edit(int $user_id)
    {
        $user = User::findOrFail($user_id);
        $countries = CountryList::all()->where('is_active','1');
        return view('admin.user.edit', compact('user','countries'));
    }

    public function update(UserFormRequest $request, int $user_id)
    {
        $validatedData = $request->validated();

        $user = User::findOrFail($user_id);

        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'role_as' => $validatedData['role_as'],
            'is_active' => $request->is_active == true ? '1':'0',
            'created_by' => $validatedData['created_by'],
        ]);

        $user->userDetails()->updateOrCreate(
            [
                'user_id' => $user_id,
            ],
            [
                'phone' => $validatedData['phone'],
                'gender' => $validatedData['gender'],
                'date_of_birth' => $validatedData['date_of_birth'],
                'address' => $validatedData['address'],
                'city' => $validatedData['city'],
                'state' => $validatedData['state'],
                'postal_code' => $validatedData['postal_code'],
                'country' => $validatedData['country'],
                'admin_comment' => $validatedData['admin_comment'],
            ]

        );


        if($request->hasFile('profile_photo') || $request->hasFile('cover_photo')){
            $profilePhotoUploadPath = 'uploads/users/profilePhoto/';
            $coverPhotoUploadPath = 'uploads/users/coverPhoto/';

            // Profile Photo
            // $profilePhotoPath = 'uploads/users/profilePhoto/'.$user->profile_photo;
            // if(File::exists($profilePhotoPath)){
            //     File::delete($profilePhotoPath);
            // }
            $profilePhoto = $request->file('profile_photo');
            $profilePhotoExtension = $profilePhoto->getClientOriginalExtension();
            $profilePhotoFilename =  $user->first_name.'-'.time().'.'.$profilePhotoExtension;
            $profilePhoto->move($profilePhotoUploadPath,$profilePhotoFilename);
            // $finalpProfilePhotoPathName = $profilePhotoUploadPath.$profilePhotoFilename;

            // Cover Photo
            // $coverPhotoPath = 'uploads/users/coverPhoto'.$user->userImages->cover_photo;
            // if(File::exists($coverPhotoPath)){
            //     File::delete($coverPhotoPath);
            // }
            $coverPhoto = $request->file('cover_photo');
            $coverPhotoExtension = $coverPhoto->getClientOriginalExtension();
            $coverPhotoFilename =  $user->first_name.'-'.time().'.'.$coverPhotoExtension;
            $coverPhoto->move($coverPhotoUploadPath,$coverPhotoFilename);
            // $finalpCoverPhotoPathName = $coverPhotoUploadPath.$coverPhotoFilename;

            $user->userImages()->updateOrCreate(
                [
                    'user_id' => $user_id,
                ],
                [
                    'profile_photo' => $profilePhotoFilename,
                    'cover_photo' => $coverPhotoFilename,
                ]
            );
        }

        return redirect('admin/user')->with('message','Congratulations! User Details Has Been Updated Successfully.');
    }

    public function changePassword(int $user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.user.changePassword', compact('user'));
    }
}
