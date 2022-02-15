<?php

namespace App\Http\Livewire\Management;

use Livewire\Component;
use App\Models\Invoice;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Auth;

class PrintInvoice extends Component
{
    public $invoice;
    public function render()
    {
        return view('livewire.management.print-invoice');
    }
    public function mount(Request $request)
    {
        $this->invoice = Invoice::where('status', 0)->where('user_id', Auth::user()->id)->get();
    }
}
