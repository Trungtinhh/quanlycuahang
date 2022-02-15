<?php

namespace App\Http\Livewire\Management;

use App\Models\Buyer;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class ListCustomer extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $customer_name, $tax_code, $phone, $address, $relationship, $customer_edit, $filter, $customerFilter;
    public $statusEditCustomer = false;
    public $statusFilter = false;
    // public $rules = [
    //     'provider_name' => 'required',
    //     'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|unique:providers,phone',
    //     'email' => 'required|email|unique:providers,email',
    //     'address' => 'required',
    //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //     'relationship' => 'required',
    // ];
    protected $messages = [
        'customer_name.required' => 'Tên khách hàng không được bỏ trống',
        'tax_code.required' => 'Mã số thuế không được bỏ trống',
        'phone.required' => 'Số điện thoại không được bỏ trống',
        'phone.regex' => 'Số điện thoại không hợp lệ',
        'phone.min' => 'Số điện thoại chỉ 10 chữ số',
        'phone.unique' => 'Số điện thoại đã có',
        'address.required' => 'Địa chỉ không được bỏ trống',
        'relationship.required' => 'Quan hệ không được bỏ trống',

    ];
    public function render()
    {
        return view('livewire.management.list-customer', ['customer' => Buyer::paginate(10)] );
    }
    public function mount()
    {
        $this->provider_name = '';
        $this->tax_code = '';
        $this->phone = '';
        $this->address = '';
        $this->relationship = '';
        $this->provider_edit = '';
    }
    public function resetAll()
    {
        $this->resetValidation();
        $this->customer_name = '';
        $this->tax_code = '';
        $this->phone = '';
        $this->address = '';
        $this->relationship = '';
        $this->customer_edit = '';
    }
    public function addCustomer()
    {
        $this->validate([
            'customer_name' => 'required',
            'tax_code' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|unique:providers,phone',
            'address' => 'required',
            'relationship' => 'required',
        ]);
        Buyer::create([
            'buyer_name' => $this->customer_name,
            'tax_code' => $this->tax_code,
            'phone' => $this->phone,
            'address' => $this->address,
            'relationship' => $this->relationship,
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã thêm!"
        ]);
    }
    public function editCustomer(Buyer $customer)
    {
        $this->resetValidation();
        $this->statusEditCustomer = true;
        $this->customer_edit = $customer->toArray();
        $this->customer_name = $this->customer_edit['buyer_name'];
        $this->tax_code = $this->customer_edit['tax_code'];
        $this->phone = $this->customer_edit['phone'];
        $this->address = $this->customer_edit['address'];
        $this->relationship = $this->customer_edit['relationship'];
        $this->dispatchBrowserEvent('show-edit');
    }
    public function storeEdit()
    {
        $this->validate([
            'customer_name' => 'required',
            'tax_code' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|unique:providers,phone',
            'address' => 'required',
            'relationship' => 'required',
        ]);
        Buyer::where('id', $this->customer_edit["id"])->update([
            'buyer_name' => $this->customer_name,
            'tax_code' => $this->tax_code,
            'phone' => $this->phone,
            'address' => $this->address,
            'relationship' => $this->relationship,
        ]);
        $this->resetAll();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Sửa thành công!"
        ]);
    }
    public function filter()
    {
        if (!empty($this->filter)) {
            $this->statusFilter = true;
            $this->customerFilter = Buyer::where('relationship', $this->filter)->get();
        }
    }
    public function closeFilter()
    {
        $this->statusFilter = false;
    }
}
