<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas= $user->ideas()->paginate(5);
        return view('user.show',compact('user','ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editing =true;
        $ideas= $user->ideas()->paginate(5);
        return view('user.edit',compact('user','editing','ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validate = request()->validate([
            'name' =>'required|min:3|max:40',
            'bio' =>'nullable|min:1|max:255',
            'image' =>'image'
        ]);
        if(request()->has('image')){
            $imagePath = request()->file('image')->store('profile','public');
            $validate['image'] = $imagePath;

            Storage::disk('public')->delete($user->image ?? '');
        }
        $user->update($validate);
        return redirect()->route('profile');
    }

    public function profile(){
        return $this->show(auth()->user());
    }
}