<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use App\Models\Profile;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class ProfileInfo extends Component
{
    use WithFileUploads;
    public $name, $phone, $birthday, $address, $email, $image;
    public $info;
    protected $rules = [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'name' => 'required',
        'phone' => 'required',
        'birthday' => 'required',
        'address' => 'required',
        'email' => 'required',
    ];
    protected $messages = [
        'image.required' => 'Vui lòng chọn ảnh!',
        'image.image' => 'Tệp tải lên không phải hình ảnh!',
        'image.mimes' => 'Định dạng không hỗ trợ!',
        'image.max' => 'Ảnh quá lớn!',
        'name.required' => 'Tên không được bỏ trống!',
        'phone.required' => 'Số điện thoại không được bỏ trống!',
        'birthday.required' => 'Ngày sinh không được bỏ trống!',
        'address.required' => 'Địa chỉ không được bỏ trống!',
        'email.required' => 'Email không được bỏ trống!',
    ];
    public function render()
    {
        return view('livewire.profile.profile-info');
    }
    public function mount()
    {
        $this->info = Profile::where('user_id', Auth::user()->id)->get();
    }
    public function editProfile()
    {
        $this->validate();
        User::findOrFail(Auth::user()->id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'profile_photo_path' => $this->image->store('images', 'public'),
        ]);
        Profile::where('user_id', Auth::user()->id)->update([
            'phone' => $this->phone,
            'birthday' => $this->birthday,
            'address' => $this->address,
            'email' => $this->email,
        ]);
        $this->dispatchBrowserEvent('alert',[
            'type'=>'success',
            'message'=>"Đã sửa!"
        ]);
    }
    public function deleteAccount()
    {
        User::findOrFail(Auth::user()->id)->delete();
        Profile::where('user_id', Auth::user()->id)->delete();
        return redirect()->route('login');
    }
}
