<?php

namespace App\Http\Livewire\Management;

use App\Models\ImportToStoreHouse;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\ProductDetail;
use Livewire\Component;
use App\Models\Statistical as Statis;

use Illuminate\Support\Carbon;

class Statistical extends Component
{
    public $revenue = 0, $order = 0, $importgoods = 0, $expired = 0,
        $importgoodsToStore, $product_expired = [];


    public $product_sale = [], $time_revenue = [], $value_revenue = [], $date_revenue_month = [], $value_revenue_month = [];
    public $month_revenue_year = [], $value_revenue_year = [];
    public $data_product_sale = [], $value_product_sale = []; 
    public function render()
    {
        return view('livewire.management.statistical');
    }
    public function mount()
    {
        $statistical = Statis::where('date', Carbon::now('Asia/Ho_Chi_Minh')->toDateString())->first();
        if (!empty($statistical)) {
            $this->revenue = $statistical->turnover;
            $this->order = $statistical->total_order;
        }

        $this->importgoods = ImportToStoreHouse::where('date_add', Carbon::now('Asia/Ho_Chi_Minh')->toDateString())->count();

        $count_product_expired = ProductDetail::all();
        foreach ($count_product_expired as $count) {
            $date_exp = new Carbon($count->date_exp);
            if ($date_exp->lessThan(Carbon::now('Asia/Ho_Chi_Minh')->toDateString())) {
                $this->expired++;
            }
        }

        $invoice = Invoice::where('status', 2)->get()->groupBy(['date_create']);
        foreach ($invoice as $Invoi => $invoi) {
            $date = new Carbon($Invoi, 'Asia/Ho_Chi_Minh');
            if ($date->toDateString() == (Carbon::now('Asia/Ho_Chi_Minh')->toDateString())) {
                foreach ($invoi as $val) {
                    $money = $val->invoiceDetail->total;
                }
                $this->value_revenue[] = $money;
                $this->time_revenue[] = $date->toTimeString();
            }
        }

        $static = Statis::all();
        $values = 0;
        foreach ($static as $invoi) {
            $check = new Carbon($invoi->date);
            if ($check->month == Carbon::now()->month) {
                $this->value_revenue_month[] = $invoi->turnover;
                $this->date_revenue_month[] = $invoi->date;
            }
        }
        for ($i = 1; $i < 13; $i++) {
            foreach ($static as $invoice) {
                $check_month = new Carbon($invoice->date);
                if ($check->year == Carbon::now()->year) {
                    if ($check_month->month == $i) {
                        $values += $invoice->turnover;
                    }
                }
            }
            $this->value_revenue_year[] = $values;
            $this->month_revenue_year[] = 'Tháng ' . $i;
            $values = 0;
        }

        $this->importgoodsToStore = ImportToStoreHouse::where('date_add', Carbon::now('Asia/Ho_Chi_Minh')->toDateString())->get();

        $product_expired = ProductDetail::all();
        foreach ($product_expired as $valu) {
            $date_exp_product = new Carbon($valu->date_exp);
            if ($date_exp_product->lessThan(Carbon::now('Asia/Ho_Chi_Minh')->toDateString()) && $valu->product->delete_status != 1) {
                $this->product_expired[] = $valu;
            }
        }

        $this->data_product_sale = [];
        $this->value_product_sale = [];
        $product_sales = Invoice::where('status', 2)->get()->groupBy('product_id');
        foreach ($product_sales as $product_sale_id => $product) {
            $product_amount_sale = 0;
            $product_sale_name = '';
            foreach ($product as $val) {
                $day = new Carbon($val->created_at, 'Asia/Ho_Chi_Minh');
                $_30days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30);
                if ($day->greaterThan($_30days)) {
                    $product_amount_sale += $val->product_amount;
                    $product_sale_name = $val->product->product_name;
                }
            }
            if ($product_amount_sale != 0) {
                $this->product_sale[$product_sale_name] = ($product_amount_sale);
            }
        }
        arsort($this->product_sale);
        foreach ($this->product_sale as $product => $vl) {
            $this->data_product_sale[] = $product;
            $this->value_product_sale[] = $vl;
        }
    }
}
