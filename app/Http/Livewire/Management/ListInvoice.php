<?php

namespace App\Http\Livewire\Management;

use App\Models\InvoiceDetail;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\Statistical;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Livewire\Component;

class ListInvoice extends Component
{
    public function render()
    {
        return view('livewire.management.list-invoice', [
            'Invoice' => Invoice::where('status', 1)->orWhere('status', 2)->orderBy('status', 'ASC')->orderBy('id', 'DESC')->get()->groupBy(['date_create']),
        ]);
    }
    public function payInvoice($pay_invoice)
    {
        if (!empty($pay_invoice)) {
            $turnover = 0;
            $date_invoice = '';
            foreach ($pay_invoice as $invoice => $val) {
                Invoice::where('id', $val['id'])->update([
                    'status' => 2
                ]);
                $inv = Invoice::where('id', $val['id'])->first();
                $turnover = $inv->invoiceDetail->total;
                $date_invoice = new Carbon($inv->date_create);
            }
            if (!Statistical::where('date', $date_invoice->toDateString())->exists()) {
                Statistical::create([
                    'date' => $date_invoice->toDateString(),
                    'turnover' => $turnover,
                    'total_order' => 1
                ]);
            } else {
                $statistical_update = Statistical::where('date', $date_invoice->toDateString())->first();
                Statistical::where('date', $date_invoice->toDateString())->update([
                    'turnover' => $statistical_update->turnover + $turnover,
                    'total_order' => $statistical_update->total_order += 1
                ]);
            }
            $this->dispatchBrowserEvent('alert', [
                'type' => 'success',
                'message' => "Thanh toán thành công!"
            ]);
        }
    }
    public function print($date_create)
    {
        $invoice = Invoice::where('date_create', $date_create)->get();
        $tax_code = '';
        $address = '';
        $phone = '';
        $date_create = '';
        $buyer_name = '';
        $buyer_phone = '';
        $buyer_address = '';
        $total = 0;
        $money = 0;
        foreach ($invoice as $in) {
            $tax_code = $in->saler->tax_code;
            $address = $in->saler->address;
            $phone = $in->saler->phone;
            $date_create = $in->date_create;
            $buyer_name = $in->buyer->buyer_name;
            $buyer_phone = $in->buyer->phone;
            $buyer_address = $in->buyer->address;
            $total += ($in->product_amount * $in->invoiceDetail->price_cost);
            $submoney = $in->invoiceDetail->submoney;
            $tax = $in->invoiceDetail->tax;
            $tax_code_buyer = $in->buyer->tax_code;
            $money += ($in->product_amount * $in->invoiceDetail->price_cost);
        }

        $pdf = PDF::loadView('livewire.management.print-invoice', compact(
            'invoice',
            'total',
            'submoney',
            'money',
            'tax',
            'tax_code_buyer',
            'tax_code',
            'address',
            'phone',
            'date_create',
            'buyer_name',
            'buyer_phone',
            'buyer_address'
        ))
            ->output(); //
        return response()->streamDownload(
            fn () => print($pdf),
            'Hoa_don.pdf'
        );
    }
    public function removeInvoice($date_create_delete)
    {
        Invoice::where('date_create', $date_create_delete)->delete();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã hủy!"
        ]);
    }
}
