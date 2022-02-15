<?php

namespace App\Http\Livewire\Management;

use Livewire\Component;
use App\Models\ImportToStoreHouse as Import;
use App\Models\ProductDetail;
use Livewire\WithPagination;

class ImportToStoreHouse extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        return view('livewire.management.import-to-store-house', [
            'Import' => Import::orderBy('id', 'DESC')->paginate(10),
        ]);
    }
    public function undoImport($import_id)
    {
        $importGoods = Import::where('id', $import_id)->first();
        $productDetail = ProductDetail::where('product_name', $importGoods->product->product_name)
            ->where('date_exp', $importGoods->product->productDetail->date_exp)
            ->where('shipment_number', $importGoods->product->productDetail->shipment_number)
            ->first();
        if ($productDetail->amount >= $importGoods->amount_add) {
            ProductDetail::where('product_name', $importGoods->product->product_name)
                ->where('date_exp', $importGoods->product->productDetail->date_exp)
                ->where('shipment_number', $importGoods->product->productDetail->shipment_number)
                ->update([
                    'amount' => $productDetail->amount - $importGoods->amount_add,
                ]);
        }else{
            ProductDetail::where('product_name', $importGoods->product->product_name)
                ->where('date_exp', $importGoods->product->productDetail->date_exp)
                ->where('shipment_number', $importGoods->product->productDetail->shipment_number)
                ->update([
                    'amount' => 0,
                ]);
        }

        Import::where('id', $import_id)->delete();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Hoàn tác thành công!"
        ]);
    }
}
