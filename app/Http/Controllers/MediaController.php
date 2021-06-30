<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use JD\Cloudder\Facades\Cloudder;

class MediaController extends Controller
{
    public function media(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'avatar' => 'image|mimes:jpeg,png,jpg|max:1048|required',
            ]);

            $image_name = $request->file('avatar')->getRealPath();
            Cloudder::upload($image_name, null, array(
                "folder" => "laravel_tutorial",  "overwrite" => FALSE,
                "resource_type" => "image", "responsive" => TRUE, "transformation" => array("quality" => "70", "width" => "250", "height" => "250", "crop" => "scale")
            ));

            $public_id = Cloudder::getPublicId();
            $width = 250;
            $height = 250;
            $image_url = Cloudder::show(Cloudder::getPublicId(), ["width" => $width, "height" => $height, "crop" => "scale", "quality" => 70, "secure" => "true"]);

            if ($public_id != null) {
                $image_public_id_exist = User::select('public_id')->where('id', Auth::user()->id)->get();
                Cloudder::delete($image_public_id_exist);
            }
            
            $user = User::find(Auth::user()->id);
            $user->public_id = $public_id;
            $user->avatar_url = $image_url;
            $user->update();
            return back()->with('success_msg', 'Media successfully updated!');
        } else {
            return view('media');
        }
    }
}
