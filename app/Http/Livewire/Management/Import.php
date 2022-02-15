<?php

namespace App\Http\Livewire\Management;

use App\Models\Category;
use App\Models\ImportToStoreHouse;
use Livewire\Component;
use App\Models\Provider;
use Livewire\WithFileUploads;
use App\Models\Price;
use App\Models\Product;
use App\Models\ProductDetail;


class Import extends Component
{
    use WithFileUploads;
    public $product, $price, $amount_add, $date_add, $date_exp, $provider, $unit, $shipment_number;
    public $provider_name, $phone, $email, $address, $image, $relationship;
    public $product_name, $product_price, $product_image, $product_date_exp, $description, $category_id, $product_shipment_number, $category_name;
    public $noti = '';
    // protected $rules = [
    //     'category' => 'required',
    //     'product_name' => 'required',
    //     'price' => 'required',
    //     'amount_add' => 'required',
    //     'date_add' => 'required',
    //     'date_exp' => 'required|after:date_add',
    //     'provider' => 'required'
    // ];

    protected $messages = [
        'provider.required' => 'Nhà cung cấp không được bỏ trống',
        'product.required' => 'Tên không được bỏ trống',
        'amount_add.required' => 'Số lượng không được bỏ trống',
        'amount_add.min' => 'Số lượng không hợp lệ',
        'unit.required' => 'Đơn vị không được bỉ trống',
        'shipment_number' => 'Số lô không được bỏ trống',
        'date_add.required' => 'Ngày nhập kho không được bỏ trống',
        'date_exp.required' => 'Hạn sử dụng không được bỏ trống',
        'date_exp.after' => 'Hạn sử dụng không hợp lý',

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

        'product_name.required' => 'Tên sản phẩm không được bỏ trống',
        'category_id.required' => 'Danh mục sản phẩm không được bỏ trống',
        'product_price.required' => 'Giá sản phẩm không được bỏ trống',
        'product_shipment_number.required' => 'Số lô không được bỏ trống',
        'product_image.required' => 'Vui lòng chọn ảnh',
        'product_image.image' => 'Tệp tải lên không phải hình ảnh',
        'product_image.mimes' => 'Định dạng không hỗ trợ',
        'product_image.max' => 'Ảnh quá lớn',
        'product_date_exp.required' => 'Chọn hạn sử dụng cho sản phẩm',

        'category_name.required' => 'Tên danh mục không được bỏ trống',
        'category_name.unique' => 'Tên danh mục đã tồn tại',

    ];
    public function render()
    {
        return view('livewire.management.import', [
            'Pro' => Provider::all(),
            'Product' => ProductDetail::where('provider_id', $this->provider)->get()->groupBy('product_name'),
            'Category' => Category::orderBy('category_name', 'ASC')->get(),
        ]);
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
    public function addProduct()
    {
        $this->validate([
            'product_name' => 'required',
            'category_id' => 'required',
            'product_price' => 'required',
            'product_shipment_number' => 'required',
            'product_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_date_exp' => 'required',
        ]);
        if (!ProductDetail::where('product_name', $this->product_name)
            ->where('provider_id', $this->provider)
            ->where('date_exp', $this->product_date_exp)->exists()) {
            $product = Product::create([
                'product_name' => $this->product_name,
                'category_id' => $this->category_id,
            ]);
            $price = Price::create([
                'price_cost' => $this->product_price,
            ]);
            ProductDetail::create([
                'product_id' => $product->getKey(),
                'product_name' => $this->product_name,
                'price_id' => $price->getKey(),
                'shipment_number' => $this->product_shipment_number,
                'provider_id' => $this->provider,
                'description' => $this->description,
                'date_exp' =>  $this->product_date_exp,
                'image' => $this->product_image->store('images', 'public'),
            ]);
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Đã thêm!"
            ]);
            $this->closeAdd();
        } else {
            $this->noti = 'Sản phẩm hiện đã có!';
        }
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
    public function importGoods()
    {
        $this->validate([
            'provider' => 'required',
            'product' => 'required',
            'amount_add' => 'required|numeric|min:1',
            'unit' => 'required',
            'shipment_number' => 'required',
            'date_add' => 'required',
            'date_exp' => 'required|after:date_add',

        ]);
        $product = ProductDetail::where('product_name', $this->product)->first();
        if (!ProductDetail::where('product_name', $this->product)
            ->where('date_exp', $this->date_exp)
            ->where('shipment_number', $this->shipment_number)->exists()) {
            $productNew = Product::create([
                'product_name' => $this->product,
                'category_id' => $product->product->category_id,
            ]);
            $price = Price::create([
                'price_cost' => $product->price->price_cost,
            ]);
            ProductDetail::create([
                'product_id' => $productNew->getKey(),
                'product_name' => $this->product,
                'price_id' => $price->getKey(),
                'provider_id' => $this->provider,
                'amount' => $this->amount_add,
                'unit' => $this->unit,
                'shipment_number' => $this->shipment_number,
                'description' => $product->description,
                'date_add' => $this->date_add,
                'date_exp' =>  $this->date_exp,
                'image' => $product->image
            ]);
            ImportToStoreHouse::create([
                'product_id' => $productNew->getKey(),
                'amount_add' => $this->amount_add,
                'date_add' => $this->date_add
            ]);
            $this->closeAdd();
        } else {
            $productUpdate = ProductDetail::where('product_name', $this->product)->where('date_exp', $this->date_exp)->where('shipment_number', $this->shipment_number)->first();
            ProductDetail::where('product_name', $this->product)->where('date_exp', $this->date_exp)->where('shipment_number', $this->shipment_number)->update([
                'amount' => $productUpdate->amount + $this->amount_add,
                'unit' => $this->unit,
                'shipment_number' => $this->shipment_number,
                'date_add' => $this->date_add,
            ]);
            ImportToStoreHouse::create([
                'product_id' => $productUpdate->product_id,
                'amount_add' => $this->amount_add,
                'date_add' => $this->date_add
            ]);
            $this->closeAdd();
        }
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã thêm vào kho!"
        ]);
    }
}
