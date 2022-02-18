<?php

namespace App\Http\Livewire\Management;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductDetail;
use App\Models\Product;
use App\Models\Price;
use Illuminate\Support\Carbon;
use App\Models\Provider;
use App\Models\Category;
use Livewire\WithFileUploads;

class ListProduct extends Component
{
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $new, $count, $sale, $product_edit_id, $product_edit;
    public $statusEdit = false;
    public $product_name, $product_price, $shipment_number, $specifying, $date_exp, $product_category, $provider, $description, $product_image;
    public $provider_name, $phone, $email, $address, $image, $relationship;
    public $category_name;
    public function render()
    {
        return view('livewire.management.list-product', [
            'Product' => ProductDetail::orderBy('product_name', 'ASC')->paginate(10),
            'Pro' => Provider::orderBy('provider_name', 'ASC')->get(),
            'Category' => Category::orderBy('category_name', 'ASC')->get()
        ]);
    }
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
        'shipment_number.required' => 'Số lô  không được bỏ trống',
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
    public function mount()
    {
        $this->new = ProductDetail::all()->count();
        $this->count = Product::where('delete_status', 1)->count();
        $this->sale = Product::where('delete_status', 0)->count();
    }
    public function deleteProduct($product_id)
    {
        Product::where('id', $product_id)->update([
            'delete_status' => 1,
            'category_id' => null
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã đưa sản phẩm vào danh sách không kinh doanh!"
        ]);
        $this->mount();
    }
    public function editProduct($product_edit_id)
    {
        $this->resetValidation();
        $this->statusEdit = true;
        $this->product_edit_id = $product_edit_id;
        $this->product_edit = ProductDetail::where('product_id', $product_edit_id)->first();
        $this->product_name = $this->product_edit->product_name;
        $this->product_price = $this->product_edit->price->price_cost;
        $this->shipment_number = $this->product_edit->shipment_number;
        $this->specifying = $this->product_edit->specifying;
        $this->date_exp = $this->product_edit->date_exp;
        $this->product_category = $this->product_edit->product->category_id;
        $this->provider = $this->product_edit->provider_id;
        $this->description = $this->product_edit->description;
        $this->dispatchBrowserEvent('show-edit-product');
    }
    public function storeEditProduct()
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
        $product = Product::where('id', $this->product_edit_id)->update([
            'product_name' => $this->product_name,
            'category_id' => $this->product_category,
        ]);
        $price = Price::where('price_id', $this->product_edit->price_id)->update([
            'price_cost' => $this->product_price,
        ]);
        ProductDetail::where('product_id', $this->product_edit_id)->update([
            'product_id' => $this->product_edit_id,
            'product_name' => $this->product_name,
            'price_id' =>  $this->product_edit->price_id,
            'provider_id' => $this->provider,
            'specifying' => $this->specifying,
            'shipment_number' => $this->shipment_number,
            'description' => $this->description,
            'date_exp' =>  $this->date_exp,
            'image' => $this->product_image->store('images', 'public'),
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã sửa!"
        ]);
        $this->closeAdd();
        
    }
    public function closeAdd()
    {
        $this->resetValidation();
        $this->product_image = '';
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
    public function listStopSale()
    {
        $this->dispatchBrowserEvent('show-list-stop-sale');
    }
    public function resetSale($product_id)
    {
        Product::where('id', $product_id)->update([
            'delete_status' => 0
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã đưa sản phẩm kinh doanh lại!"
        ]);
    }
}
