<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function users_list()
    {
        $users = User::where('status', 'Active')->where('userrole', '!=', 'Admin')->get();
        $team_lead = User::where('status', 'Active')->where('userrole', 'Team Lead')->get();
        $team_mang = User::where('status', 'Active')->where('userrole', 'Manager')->get();
    
        return view('users', compact('users', 'team_lead', 'team_mang'));
    }

    public function add_user()
    {
        return view('add_users');
    }


    public function add_user_query(Request $request)
    {
        $data = $request->all();

        $data['name'] = $request->f_name . ' ' . $request->l_name;
        $data['org_password'] = $request->password;
        $data['password'] = Hash::make($request->password); 

        $data['form_permission'] = json_encode($request->form_permission);
        User::create($data);

        return redirect()->route('users_list')->with('success', 'User added successfully!');
    }

    public function edit_user($id){
        $user = User::where('status', 'Active')->where('userrole', '!=', 'Admin')->where('id', $id)->first();
        $team_lead = User::where('status', 'Active')->where('userrole', 'Team Lead')->get();
        $team_mang = User::where('status', 'Active')->where('userrole', 'Manager')->get();

        return view('add_users', compact('user', 'team_lead', 'team_mang'));
    }

    public function update_user_query(Request $request)
    {
        $data = $request->all();
        $user = User::find($request->user_id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }
        $data['name'] = $request->f_name . ' ' . $request->l_name;

        if (!empty($request->password)) {
            $data['org_password'] = $request->password;
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $data['form_permission'] = json_encode($request->form_permission);

        unset($data['_token'], $data['user_id']);

        $user->update($data);

        return redirect()->route('users_list')->with('success', 'User updated successfully!');
    }


    public function change_password(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer',
        'old_password' => 'required',
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    ]);

    $user = User::findOrFail($request->user_id);

    if (!Hash::check($request->old_password, $user->password)) {
        return redirect()
            ->route('edit_user', $request->user_id)
            ->with('error', 'Old password does not match!');
    }

    $user->password = Hash::make($request->new_password);
    $user->org_password = $request->new_password;
    $user->save();

    return redirect()
        ->route('edit_user', $request->user_id)
        ->with('success', 'Password updated successfully!');
}

}
