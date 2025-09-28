<?php

namespace App\Http\Controllers\Auth;

use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg, jpeg, png, webp', 'max:2048']
        ]);

        $avatar = $request->file('avatar');

        $user = Auth::user();
        $path = $avatar->store('uploads/avatars', 'public');

        if ($user->image) {
            Storage::disk($user->image->disk)->delete($user->image->path);
            $user->image()->delete();
        }

        $user->image()->create([
            'disk' => 'public',
            'path' => $path,
            'original_name' => $avatar->getClientOriginalname(),
            'mime' => $avatar->getMimeType(),
            'size' => $avatar->getSize(),
            'is_primary' => true,
        ]);

        return back()->with('success', 'Avatar uploaded successfully');
    }

    public function update(Request $request, Image $image)
    {
        $request->validate([
            'avatar' => ['required', 'image', 'mimes:jpg, jpeg, png, pneg, webp', 'max:2048']
        ]);

        $avatar = $request->file('avatar');

        Storage::disk($image->disk)->delete($image->path);

        $path = $avatar->store('uploads/avatars', 'public');

        $image->update([
            'path' => $path,
            'original_name' => $avatar->getClientOriginalname(),
            'mime' => $avatar->getMimeType(),
            'size' => $avatar->getSize(),
        ]);

        return back()->with('success', 'Avatar updated successfully');
    }
}
