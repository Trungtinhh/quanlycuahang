<?php

namespace App\Http\Livewire\Management;

use App\Models\Staff;
use Livewire\Component;
use Livewire\WithPagination;

class Personel extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $per_name, $address, $phone, $position;
    public $statusEdit = false, $perEdit, $per_id;

    protected $messages = [
        'per_name.required' => 'Tên không được bỏ trống',
        'address.required' => 'Địa chỉ không được bỏ trống',
        'phone.required' => 'Số điện thoại không được bỏ trống',
        'phone.regex' => 'Số điện thoại không hợp lệ',
        'phone.min' => 'Số điện thoại chỉ 10 chữ số',
        'phone.unique' => 'Số điện thoại đã có',
        'position.required' => 'Chức vụ không được bỏ trống',
    ];
    public function render()
    {
        return view('livewire.management.personel', [
            'personel' => Staff::paginate(10),
            'count' => Staff::all()->count()
        ]);
    }
    public function resetAll()
    {
        $this->resetValidation();
        $this->per_name = '';
        $this->address = '';
        $this->phone = '';
        $this->position = '';
    }
    public function addPersonel()
    {
        $this->validate([
            'per_name' => 'required',
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|unique:providers,phone',
            'position' => 'required',
        ]);
        Staff::create([
            'staff_name' => $this->per_name,
            'address' => $this->address,
            'phone' => $this->phone,
            'position' => $this->position,
        ]);
        $this->resetAll();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã thêm!"
        ]);
    }
    public function deletePersonel($per_id)
    {
        Staff::where('id', $per_id)->delete();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã xóa!"
        ]);
    }
    public function editPersonel($per_id)
    {
        $this->statusEdit = 'true';
        $this->per_id = $per_id;

        $this->perEdit = Staff::where('id', $per_id)->first();
        $this->per_name = $this->perEdit->staff_name;
        $this->address = $this->perEdit->address;
        $this->phone = $this->perEdit->phone;
        $this->position = $this->perEdit->position;
        $this->dispatchBrowserEvent('show-edit');
    }
    public function storeEditPersonel()
    {
        $this->validate([
            'per_name' => 'required',
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
            'position' => 'required',
        ]);
        Staff::where('id', $this->per_id)->update([
            'staff_name' => $this->per_name,
            'address' => $this->address,
            'phone' => $this->phone,
            'position' => $this->position
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Sửa thành công!"
        ]);
    }
}
