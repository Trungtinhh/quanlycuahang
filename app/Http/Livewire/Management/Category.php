<?php

namespace App\Http\Livewire\Management;

use Livewire\Component;
use App\Models\Category as Cate;
use App\Models\Product;
use App\Models\ProductDetail;
use Livewire\WithPagination;

class Category extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $count, $product_id, $category_name, $category_id;
    public $noti;
    protected $rules = [
        'category_name' => 'required',
        'product_id' => 'required'
    ];
    protected $messages = [
        'category_name.required' => 'Tên danh mục không được bỏ trống',
        'product_id.required' => 'Vui lòng chọn sản phẩm cho khu vực',
    ];

    public function render()
    {
        return view('livewire.management.category', [
            'Category' => Cate::orderBy('category_name', 'ASC')->get(),
            'Product' => Product::orderBy('product_name', 'ASC')->get(),
            'ProductDetail' => ProductDetail::orderBy('shipment_number', 'ASC')->paginate(10)
        ]);
    }
    public function mount()
    {
        $this->count = Cate::all()->count();
        $this->category_name = '';
        $this->product_id = [];
        $this->noti = '';
    }
    public function addCategory()
    {
        $this->validate();
        if (empty(Cate::where('category_name', $this->category_name)->first())) {
            $cate = Cate::create([
                'category_name' => $this->category_name
            ]);
            if (!empty($this->product_id) && !in_array(-1, $this->product_id)) {
                foreach ($this->product_id as $id) {
                    Product::where('id', $id)->update([
                        'category_id' => $cate->getKey(),
                    ]);
                }
            }
            $this->mount();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Thêm thành công!"
            ]);
        } else {
            $this->noti = 'Danh mục này đã có';
        }
    }
    public function closeAdd()
    {
        $this->noti = '';
        $this->resetValidation();
    }
    public function deleteCategory($category_id)
    {
        Product::where('category_id', $category_id)->update([
            'category_id' => null
        ]);
        Cate::where('id', $category_id)->delete();
        $this->mount();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã xóa!"
        ]);
    }
    public function addProduct($category_id)
    {
        $this->category_id = $category_id;
        $this->dispatchBrowserEvent('show-add-product');
    }
    public function storeProduct()
    {
        if (!empty($this->product_id)) {
            foreach ($this->product_id as $id) {
                Product::where('id', $id)->update([
                    'category_id' => $this->category_id,
                ]);
            }
            $this->mount();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Thêm thành công!"
            ]);
        } else {
            $this->noti = 'Vui lòng chọn sản phẩm';
        }
    }
    public function detailCategory($category_id)
    {
        $this->category_id = $category_id;
        $this->dispatchBrowserEvent('show-detail-category');
    }
    public function deleteProductInCategory($product_id_in_category)
    {
        Product::where('id', $product_id_in_category)->update([
            'category_id' => null
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã xóa sản phẩm khỏi danh mục!"
        ]);
    }
}
