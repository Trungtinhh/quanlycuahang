<?php

namespace App\Http\Livewire\Management;

use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Price;
use App\Models\Provider;
use App\Models\Category;

class AddProduct extends Component
{
    use WithFileUploads;
    public $product_name, $product_price, $shipment_number, $specifying, $date_exp, $product_category, $provider, $description, $product_image;
    public $provider_name, $phone, $email, $address, $image, $relationship;
    public $category_name;

    protected $messages = [
        'provider_name.required' => 'Tên nhà cung cấp không được bỏ trống',
        'phone.required' => 'Số điện thoại không được bỏ trống',
        'phone.regex' => 'Số điện thoại không hợp lệ',
        'phone.min' => 'Số điện thoại chỉ 10 chữ số',
        'phone.unique' => 'Số điện thoại đã có',
        'email.required' => 'Email không được bỏ trống',
        'email.email' => 'Email không hợp lệ',
        'email.unique' => 'Email đã có',
        'address.required' => 'Đại chỉ không được bỏ trống',
        'image.required' => 'Vui lòng chọn ảnh',
        'image.image' => 'Tệp tải lên không phải hình ảnh',
        'image.mimes' => 'Định dạng không hỗ trợ',
        'image.max' => 'Ảnh quá lớn',
        'relationship.required' => 'Quan hệ không được bỏ trống',

        'category_name.required' => 'Tên danh mục không được bỏ trống',
        'category_name.unique' => 'Danh mục đã có sẵn',

        'product_name.required' => 'Tên sản phẩm không được bỏ trống',
        'product_price.required' => 'Giá sản phẩm không được bỏ trống',
        'product_price.min' => 'Giá sản phẩm phải lớn hơn hoặc bằng 0',
        'shipment_number.required' => 'Số lô không được bỏ trống',
        'specifying.required' => 'Quy cách không được bỏ trống',
        'date_exp.required' => 'Hạn sử dụng không được bỏ trống',
        'date_exp.after' => 'Hạn sử dụng không hợp lý',
        'product_category.required' => 'Danh mục sản phẩm không được bỏ trống',
        'provider.required' => 'Nhà cung cấp không được bỏ trống',
        'description.required' => 'Mô tả công dụng sản phẩm không được bỏ trống',
        'product_image.required' => 'Ảnh sản phẩm không được bỏ trống',
        'product_image.image' => 'Tệp tải lên không phải hình ảnh',
        'product_image.mimes' => 'Định dạng không hỗ trợ',
        'product_image.max' => 'Ảnh quá lớn',
    ];
    public function render()
    {
        return view('livewire.management.add-product',[
            'Pro' => Provider::orderBy('provider_name', 'ASC')->get(),
            'Category' => Category::orderBy('category_name', 'ASC')->get()
        ]);
    }
    public function addProduct()
    {
        $this->validate([
            'product_name' => 'required',
            'product_price' => 'required|numeric|min:0',
            'shipment_number' => 'required',
            'specifying' => 'required',
            'date_exp' => 'required|after:' . Carbon::now()->toDateString(),
            'product_category' => 'required',
            'provider' => 'required',
            'description' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if (!ProductDetail::where('product_name', $this->product_name)
                ->where('provider_id', $this->provider)
                ->where('date_exp', $this->date_exp)
                ->exists()) {
                $product = Product::create([
                    'product_name' => $this->product_name,
                    'category_id' => $this->product_category,
                ]);
                $price = Price::create([
                    'price_cost' => $this->product_price,
                ]);
                ProductDetail::create([
                    'product_id' => $product->getKey(),
                    'product_name' => $this->product_name,
                    'price_id' => $price->getKey(),
                    'provider_id' => $this->provider,
                    'description' => $this->description,
                    'shipment_number' => $this->shipment_number,
                    'specifying' => $this->specifying,
                    'date_exp' =>  $this->date_exp,
                    'image' => $this->product_image->store('images', 'public'),
                ]);
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'success',
                    'message' => "Đã thêm!"
                ]);
                $this->closeAdd();
            } else {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'warning',
                    'message' => "Sản phẩm đã tồn tại!"
                ]);
            }
    }
    public function resetForm()
    {
        $this->product_name = '';
        $this->product_price = '';
        $this->date_exp = '';
        $this->specifying = '';
        $this->product_category = '';
        $this->description = '';
        $this->provider = '';
        $this->product_image = '';
    }
    public function closeAdd()
    {
        $this->resetValidation();
        $this->noti = '';
    }
    public function addProvider()
    {
        $this->validate([
            'provider_name' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|unique:providers,phone',
            'email' => 'required|email|unique:providers,email',
            'address' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'relationship' => 'required',
        ]);
        Provider::create([
            'provider_name' => $this->provider_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'image' => $this->image->store('images', 'public'),
            'relationship' => $this->relationship,
        ]);
        $this->closeAdd();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã thêm!"
        ]);
    }
    public function addCategory()
    {
        $this->validate([
            'category_name' => 'required|unique:categorys,category_name'
        ]);
        Category::create([
            'category_name' => $this->category_name,
        ]);
        $this->closeAdd();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã thêm!"
        ]);
    }
}
