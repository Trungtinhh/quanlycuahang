<?php

namespace App\Http\Livewire\Management;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Promotion as Promo;

use Livewire\Component;

class Promotion extends Component
{
    public $product, $product_promotion, $other_product_promotion, $quantity = 0, $quantity_promotion = 0, $quantity_other_promotion = 0;
    public $promotion_id, $promotion_edit, $statusEdit = false;

    protected $messages = [
        'product.required' => 'Trường này không được bỏ trống',
        'quantity.min' => 'Số lượng không hợp lý',
        'quantity_promotion.min' => 'Số lượng không hợp lý',
        'quantity_other_promotion.min' => 'Số lượng không hợp lý',
    ];

    public function render()
    {
        return view('livewire.management.promotion', [
            'Product' => Product::where('delete_status', 0)->get(),
            'Product_promotion' => Product::where('delete_status', 0)->get(),
            'Promotion' => Promo::orderBy('status')->get(),
        ]);
    }
    public function resetAll()
    {
        $this->resetValidation();
        $this->promotion_id = '';
        $this->promotion_edit = '';
        $this->product = '';
        $this->quantity = 0;
        $this->product_promotion = '';
        $this->quantity_promotion = 0;
        $this->other_product_promotion = '';
        $this->quantity_other_promotion = 0;
    }
    public function addPromotion()
    {
        $this->validate([
            'product' => 'required',
            'quantity' => 'min:0',
            'quantity_promotion' => 'min:0',
            'quantity_other_promotion' => 'min:0',
        ]);
        Promo::create([
            'product_id' => $this->product,
            'quantity' => $this->quantity,
            'product_promotion_id' => $this->product_promotion,
            'quantity_promotion' => $this->quantity_promotion,
            'other_product_promotion' => $this->other_product_promotion,
            'quantity_other_promotion' => $this->quantity_other_promotion,
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã thêm!"
        ]);
        $this->resetAll();
    }
    public function deactivate($promotion_id)
    {
        Promo::where('id', $promotion_id)->update([
            'status' => 2
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã hủy!"
        ]);
    }
    public function activate($promotion_id)
    {
        Promo::where('id', $promotion_id)->update([
            'status' => 1
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Kích hoạt thành công!"
        ]);
    }
    public function edit($promotion_id)
    {
        $this->resetAll();
        $this->statusEdit = true;
        $this->promotion_id = $promotion_id;
        $this->promotion_edit = Promo::where('id', $promotion_id)->first();
        $this->product = $this->promotion_edit->product_id;
        $this->quantity = $this->promotion_edit->quantity;
        $this->product_promotion = $this->promotion_edit->product_promotion_id;
        $this->quantity_promotion = $this->promotion_edit->quantity_promotion;
        $this->other_product_promotion = $this->promotion_edit->other_product_promotion;
        $this->quantity_other_promotion = $this->promotion_edit->quantity_other_promotion;
        $this->dispatchBrowserEvent('show-edit');
    }
    public function storeEdit()
    {
        Promo::where('id', $this->promotion_id)->update([
            'product_id' => $this->product,
            'quantity' => $this->quantity,
            'product_promotion_id' => $this->product_promotion,
            'quantity_promotion' => $this->quantity_promotion,
            'other_product_promotion' => $this->other_product_promotion,
            'quantity_other_promotion' => $this->quantity_other_promotion,
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã sửa!"
        ]);
    }
}
