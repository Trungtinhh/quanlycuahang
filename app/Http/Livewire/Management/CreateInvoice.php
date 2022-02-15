<?php

namespace App\Http\Livewire\Management;

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Invoice;
use App\Models\Saler;
use App\Models\Buyer;
use App\Models\InvoiceDetail;
use App\Models\Staff;
use App\Models\Statistical;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\WithPagination;

class CreateInvoice extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $searchProduct = '', $invoice, $user_id;
    public $saler_name, $tax_code, $address, $phone, $saler_id;
    public $buyer_name, $address_buyer, $phone_buyer, $relationship, $buyerCreated, $buyer_id, $tax_code_buyer;
    public $saler;
    public $create_saler, $create_buyer;
    public $product_amount = 1;
    public $total = 0, $submoney = 0, $tax = 0;

    protected $messages = [
        'saler_name.required' => 'Tên đơn vị bán không được bỏ trống',
        'address.required' => 'Địa chỉ không được bỏ trống',
        'phone.required' => 'Số điện thoại không được bỏ trống',
        'phone.regex' => 'Số điện thoại không hợp lệ',
        'phone.min' => 'Số điện thoại chỉ 10 chữ số',
        'phone.unique' => 'Số điện thoại đã có',
        'tax_code.required' => 'Mã số thuế không được bỏ trống',

        'buyer_name.required' => 'Tên đơn vị mua không được bỏ trống',
        'tax_code_buyer.required' => 'Mã số thuế không được bỏ trống',
        'address_buyer.required' => 'Địa chỉ không được bỏ trống',
        'phone_buyer.required' => 'Số điện thoại không được bỏ trống',
        'phone_buyer.regex' => 'Số điện thoại không hợp lệ',
        'phone_buyer.min' => 'Số điện thoại chỉ 10 chữ số',
        'phone_buyer.unique' => 'Số điện thoại đã có',
        'relationship.required' => 'Quan hệ không được bỏ trống'
    ];
    public function render()
    {
        return view('livewire.management.create-invoice', [
            'search_product' => ProductDetail::where('product_name', 'like', '%' . $this->searchProduct . '%')
                ->get()->take(10),
            'product_all' => Product::where('delete_status', 0)->orderBy('product_name', 'ASC')->paginate(10),
            'buyer' => Buyer::all(),
            'user' => Staff::all(),
        ]);
    }
    public function mount()
    {
        $temp = Invoice::where('status', 0)->get();
        foreach ($temp as $val) {
            $product =  ProductDetail::where('product_id', $val->product_id)->first();
            ProductDetail::where('product_id', $val->product_id)->update([
                'amount' => $product->amount + $val->product_amount,
            ]);
            if (!empty($val->invoiceDetail->promotion_id)) {
                $product_promotion =  ProductDetail::where('product_id', $product->product->promotion->product_promotion_id)->first();
                ProductDetail::where('product_id', $product->product->promotion->product_promotion_id)->update([
                    'amount' => $product_promotion->amount + $val->invoiceDetail->quantity_promotion,
                ]);
            }
        }
        Invoice::where('status', 0)->delete();

        $this->saler = Saler::first();
        if ($this->saler != null) {
            $this->saler->toArray();
            $this->saler_id = $this->saler['id'];
            $this->saler_name = $this->saler['saler_name'];
            $this->tax_code = $this->saler['tax_code'];
            $this->address = $this->saler['address'];
            $this->phone = $this->saler['phone'];
        }
    }
    public function cancel()
    {
        $temp = Invoice::where('status', 0)->get();
        foreach ($temp as $val) {
            $product =  ProductDetail::where('product_id', $val->product_id)->first();
            ProductDetail::where('product_id', $val->product_id)->update([
                'amount' => $product->amount + $val->product_amount,
            ]);
            if (!empty($val->invoiceDetail->promotion_id)) {
                $product_promotion =  ProductDetail::where('product_id', $product->product->promotion->product_promotion_id)->first();
                ProductDetail::where('product_id', $product->product->promotion->product_promotion_id)->update([
                    'amount' => $product_promotion->amount + $val->invoiceDetail->quantity_promotion,
                ]);
            }
        }
        Invoice::where('status', 0)->delete();
        $this->submoney = 0;
        $this->total = 0;
        $this->tax = 0;
        $this->invoice = [];
    }
    public function resetForm()
    {
        $this->saler_name = '';
        $this->address = '';
        $this->tax_code = '';
        $this->phone = '';
    }
    public function resetFormBuyer()
    {
        $this->buyer_name = '';
        $this->address_buyer = '';
        $this->phone_buyer = '';
        $this->tax_code_buyer = '';
    }
    public function createSaler()
    {
        $this->validate([
            'saler_name' => 'required',
            'tax_code' => 'required',
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ]);
        $this->create_saler = Saler::create([
            'saler_name' => $this->saler_name,
            'tax_code' => $this->tax_code,
            'address' => $this->address,
            'phone' => $this->phone
        ]);
        $this->saler_id = $this->create_saler->getKey();
        $this->saler = Saler::first();
        if ($this->saler != null) {
            $this->saler->toArray();
        }
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Thêm thành công!"
        ]);
        $this->resetValidation();
    }
    public function editSaler($checkSalerID)
    {
        $this->validate([
            'saler_name' => 'required',
            'tax_code' => 'required',
            'address' => 'required',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ]);
        Saler::where('id', $checkSalerID)->update([
            'saler_name' => $this->saler_name,
            'tax_code' => $this->tax_code,
            'address' => $this->address,
            'phone' => $this->phone
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Sửa thành công!"
        ]);
        $this->resetValidation();
    }
    public function selectBuyer()
    {
        if (!empty($this->buyerCreated)) {
            $buyer = Buyer::find($this->buyerCreated);
            $this->buyer_id = $this->buyerCreated;
            $this->buyer_name = $buyer->buyer_name;
            $this->tax_code_buyer = $buyer->tax_code;
            $this->address_buyer = $buyer->address;
            $this->phone_buyer = $buyer->phone;
            $this->relationship = $buyer->relationship;
        }
    }
    public function createBuyer()
    {
        $this->validate([
            'buyer_name' => 'required',
            'tax_code' => 'required',
            'address_buyer' => 'required',
            'phone_buyer' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|unique:buyers,phone',
            'relationship' => 'required'
        ]);
        $this->create_buyer = Buyer::create([
            'buyer_name' => $this->buyer_name,
            'tax_code' => $this->tax_code_buyer,
            'address' => $this->address_buyer,
            'phone' => $this->phone_buyer,
            'relationship' => $this->relationship,
        ]);
        $this->buyer_id = $this->create_buyer->getKey();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Thêm thành công!"
        ]);
    }
    public function addProductToInvoice($productIDSelected)
    {
        if ($this->product_amount > 0) {
            $product_all = ProductDetail::where('product_id', $productIDSelected)->first();
            if ($product_all->amount > 0) {
                if ($this->product_amount <= $product_all->amount) {
                    if ($this->buyer_id != null && $this->saler_id != null && $this->user_id != null) {
                        $check_invoice = Invoice::where('status', 0)->where('product_id', $productIDSelected)->first();
                        if (!Invoice::where('status', 0)->where('product_id', $productIDSelected)->exists()) {
                            $inv = Invoice::create([
                                'saler_id' => $this->saler_id,
                                'buyer_id' => $this->buyer_id,
                                'user_id' => $this->user_id,
                                'product_id' => $productIDSelected,
                                'product_amount' => $this->product_amount,
                                'product_unit' => $product_all->unit,
                                'price_id' => $product_all->price_id,
                                'status' => 0,
                            ]);
                            $invoice = Invoice::where('id', $inv->getKey())->first();
                            $heso_sl = 1;
                            $quantity_promotion = 0;
                            $promotion_id = null;
                            $product_promotion_id = null;
                            if (!empty($invoice->product->promotion->product_id)) {
                                if ($invoice->product_amount >= $invoice->product->promotion->quantity && $invoice->product->promotion->status == 1) {
                                    $product_promotion_id = $invoice->product->promotion->product_promotion_id;
                                    $promotion_id = $invoice->product->promotion->id;
                                    if ($invoice->product_amount / $invoice->product->promotion->quantity != 0) {
                                        $heso_sl = floor($invoice->product_amount / $invoice->product->promotion->quantity);
                                        $quantity_promotion = $invoice->product->promotion->quantity_promotion * $heso_sl;
                                    }
                                }
                            }

                            $staff = Staff::where('id', $this->user_id)->first();
                            InvoiceDetail::create([
                                'invoice_id' => $invoice->getKey(),
                                'user_name' => $staff->staff_name,
                                'product_name' => $invoice->product->product_name,
                                'price_cost' => $invoice->product->productDetail->price->price_cost,
                                'promotion_id' => $promotion_id,
                                'quantity_promotion' => $quantity_promotion,

                            ]);
                            ProductDetail::where('product_id', $productIDSelected)->update([
                                'amount' => $product_all->amount - $this->product_amount,
                            ]);
                            if (!empty($product_promotion_id)) {
                                $product_in_store = ProductDetail::where('product_id', $product_promotion_id)->first();
                                ProductDetail::where('product_id', $product_promotion_id)->update([
                                    'amount' => $product_in_store->amount - $quantity_promotion,
                                ]);
                            }
                            $this->total += $product_all->price->price_cost * $this->product_amount;
                            $this->product_amount = 1;
                        } else {
                            Invoice::where('id', $check_invoice->id)->update([
                                'product_amount' => $check_invoice->product_amount + $this->product_amount
                            ]);
                            $in = Invoice::where('id', $check_invoice->id)->first();
                            $heso_sl = 1;
                            $quantity_promotion = 0;
                            $promotion_id = null;
                            $product_promotion_id = null;
                            if (!empty($in->product->promotion->product_id)) {
                                if ($in->product_amount >= $in->product->promotion->quantity && $in->product->promotion->status == 1) {
                                    $product_promotion_id = $in->product->promotion->product_promotion_id;
                                    $promotion_id = $in->product->promotion->id;
                                    if (floor($in->product_amount / $in->product->promotion->quantity) != 0) {
                                        $heso_sl = floor($in->product_amount / $in->product->promotion->quantity);
                                        $quantity_promotion = $in->product->promotion->quantity_promotion * $heso_sl;
                                        
                                        $temp_quantity = InvoiceDetail::where('invoice_id', $in->id)->first();
                                        $product_in_store = ProductDetail::where('product_id', $product_promotion_id)->first();
                                        ProductDetail::where('product_id', $product_promotion_id)->update([
                                            'amount' => $product_in_store->amount - ($quantity_promotion - $temp_quantity->quantity_promotion),
                                        ]);
                                        InvoiceDetail::where('invoice_id', $in->id)->update([
                                            'promotion_id' => $promotion_id,
                                            'quantity_promotion' => $quantity_promotion,
                                        ]);
                                        
                                    }
                                }
                            }

                            ProductDetail::where('product_id', $productIDSelected)->update([
                                'amount' => $product_all->amount - $this->product_amount,
                            ]);
                            $this->total += $product_all->price->price_cost * $this->product_amount;
                            $this->product_amount = 1;
                        }
                        $this->invoice = Invoice::where('status', 0)->get();
                    } else {
                        $this->dispatchBrowserEvent('alert', [
                            'type' => 'warning',
                            'message' => "Thêm thông tin đơn vị mua, đơn vị bán và người bán trước!"
                        ]);
                    }
                } else {
                    $this->dispatchBrowserEvent('alert', [
                        'type' => 'warning',
                        'message' => "Số lượng không hợp lý!"
                    ]);
                }
            } else {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'warning',
                    'message' => "Sản phẩm đã hết!"
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'warning',
                'message' => "Số lượng không hợp lý!"
            ]);
        }
    }
    public function deleteProductInvoice($productInvoiceID)
    {
        $product_in_invoice = Invoice::where('product_id', $productInvoiceID)->where('status', 0)->first();
        $product =  ProductDetail::where('product_id', $productInvoiceID)->first();
        ProductDetail::where('product_id', $productInvoiceID)->update([
            'amount' => $product->amount + $product_in_invoice->product_amount,
        ]);
        if (!empty($product_in_invoice->invoiceDetail->promotion_id)) {
            $product_promotion =  ProductDetail::where('product_id', $product_in_invoice->product->promotion->product_promotion_id)->first();
            ProductDetail::where('product_id', $product_in_invoice->product->promotion->product_promotion_id)->update([
                'amount' => $product_promotion->amount + $product_in_invoice->invoiceDetail->quantity_promotion,
            ]);
        }
        $this->total -= $product_in_invoice->product_amount * $product_in_invoice->product->productDetail->price->price_cost;
        Invoice::where('product_id', $productInvoiceID)->where('status', 0)->delete();
        $this->invoice = Invoice::where('status', 0)->get();
    }
    public function saveInvoice()
    {
        if (empty($this->submoney)) {
            $this->submoney = 0;
        }
        if (empty($this->tax)) {
            $this->tax = 0;
        }
        if (Invoice::where('status', 0)->exists()) {
            $save_invoice = Invoice::where('status', 0)->get();
            foreach ($save_invoice as $invoice) {
                Invoice::where('id', $invoice->id)->update([
                    'status' => 1,
                    'date_create' => Carbon::now('Asia/Ho_chi_Minh'),
                ]);
                InvoiceDetail::where('invoice_id', $invoice->id)->update([
                    'total' => $this->total - ($this->total * $this->submoney) / 100 + ($this->total * $this->tax) / 100,
                    'submoney' => $this->submoney,
                    'tax' => $this->tax,
                    'date_create' => Carbon::now('Asia/Ho_chi_Minh'),
                ]);
            }
            $this->invoice = Invoice::where('status', 0)->get();
            $this->resetInvoice();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Đã lưu hóa đơn!"
            ]);
        } else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'warning',
                'message' => "Chưa chọn sản phẩm!"
            ]);
        }
    }
    public function resetInvoice()
    {
        $this->total = 0;
        $this->submoney = 0;
        $this->tax = 0;
    }
    public function payInvoice($pay_invoice)
    {
        if ($pay_invoice != -1) {
            if (empty($this->submoney)) {
                $this->submoney = 0;
            }
            if (empty($this->tax)) {
                $this->tax = 0;
            }
            foreach ($pay_invoice as $invoice => $val) {
                Invoice::where('id', $val['id'])->update([
                    'status' => 2,
                    'date_create' => Carbon::now('Asia/Ho_chi_Minh')
                ]);
                InvoiceDetail::where('invoice_id', $val['id'])->update([
                    'total' => $this->total - ($this->total * $this->submoney) / 100 + ($this->total * $this->tax) / 100,
                    'submoney' => $this->submoney,
                    'tax' => $this->tax,
                    'date_create' => Carbon::now('Asia/Ho_chi_Minh'),
                ]);
            }
            if (!Statistical::where('date', Carbon::now('Asia/Ho_chi_Minh')->toDateString())->exists()) {
                Statistical::create([
                    'date' => Carbon::now('Asia/Ho_Chi_Minh')->toDateString(),
                    'turnover' => $this->total - ($this->total * $this->submoney) / 100 + ($this->total * $this->tax) / 100,
                    'total_order' => 1
                ]);
            } else {
                $statistical_update = Statistical::where('date', Carbon::now('Asia/Ho_Chi_Minh')->toDateString())->first();
                Statistical::where('date', Carbon::now('Asia/Ho_Chi_Minh')->toDateString())->update([
                    'turnover' => $statistical_update->turnover + ($this->total - ($this->total * $this->submoney) / 100 + ($this->total * $this->tax) / 100),
                    'total_order' => $statistical_update->total_order += 1
                ]);
            }
            $this->invoice = [];
            $this->resetInvoice();
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Thanh toán thành công!"
            ]);
        } else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'warning',
                'message' => "Chưa chọn sản phẩm!"
            ]);
        }
    }
    public function print()
    {
        $invoice = $this->invoice;
        $total = $this->total;
        $submoney = $this->submoney;
        $tax = $this->tax;
        if ($this->submoney == null) {
            $submoney = 0;
        }
        if ($this->tax == null) {
            $tax = 0;
        }
        $money = $this->total;
        $tax_code = '';
        $address = '';
        $phone = '';
        $date_create = '';
        $buyer_name = '';
        $tax_code_buyer = '';
        $buyer_phone = '';
        $buyer_address = '';
        if ($this->total != 0) {
            foreach ($this->invoice as $in) {
                $tax_code = $in->saler->tax_code;
                $address = $in->saler->address;
                $phone = $in->saler->phone;
                $date_create = Carbon::now('Asia/Ho_Chi_Minh');
                $buyer_name = $in->buyer->buyer_name;
                $tax_code_buyer = $in->buyer->tax_code;
                $buyer_phone = $in->buyer->phone;
                $buyer_address = $in->buyer->address;
            }

            $pdf = PDF::loadView('livewire.management.print-invoice', compact(
                'invoice',
                'total',
                'money',
                'submoney',
                'tax',
                'tax_code',
                'address',
                'phone',
                'date_create',
                'buyer_name',
                'tax_code_buyer',
                'buyer_phone',
                'buyer_address'
            ))
                ->output(); //
            return response()->streamDownload(
                fn () => print($pdf),
                'Hoa_don.pdf'
            );
        }
    }
}
