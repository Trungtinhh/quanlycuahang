<?php

namespace App\Http\Livewire\Management;

use App\Models\Staff;
use App\Models\Wage as ModelsWage;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Wage extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $staff, $wage_basic, $sales_money, $bonus, $deduct, $note, $wage_temp;

    protected $messages = [
        'staff.required' => 'Vui lọng chọn nhân viên',
        'note.required' => 'Ghi chú không được bỏ trống'
    ];

    public function render()
    {
        return view('livewire.management.wage', [
            'wage' => ModelsWage::orderBy('salary_date', 'DESC')->paginate(10),
            'Staff' => Staff::all(),
        ]);
    }
    public function mount()
    {
        $this->staff = null;
        $this->wage_basic = 0;
        $this->sales_money = 0;
        $this->bonus = 0;
        $this->deduct = 0;
        $this->note = null;
        $this->wage_temp = 0;
    }
    public function closeModal()
    {
        $this->resetValidation();
    }
    public function calculatorTemp()
    {
        if (!empty($this->staff)) {
            if(empty($this->wage_basic)){
                $this->wage_basic = 0;
            }
            if(empty($this->sales_money)){
                $this->sales_money = 0;
            }
            if(empty($this->bonus)){
                $this->bonus = 0;
            }
            if(empty($this->deduct)){
                $this->deduct = 0;
            }
            if ($this->wage_basic >= 0 && $this->sales_money >= 0 && $this->bonus >= 0 && $this->deduct >= 0) {
                $this->wage_temp = ($this->wage_basic + $this->bonus) - $this->deduct;
            } else {
                $this->dispatchBrowserEvent('alert', [
                    'type' => 'warning',
                    'message' => "Tiền không được âm và không được để trống!"
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'warning',
                'message' => "Chọn nhân viên để tính lương!"
            ]);
        }
    }
    public function calculatorWage()
    {
        $this->validate([
            'staff' => 'required',
            'note' => 'required',
        ]);
        ModelsWage::create([
            'salary_date' => Carbon::now('Asia/Ho_Chi_Minh')->toDateString(),
            'user_name' => $this->staff,
            'wage_basic' => $this->wage_basic,
            'sales_money' => $this->sales_money,
            'bonus' => $this->bonus,
            'deduct' => $this->deduct,
            'wage' => $this->wage_temp,
            'note' => $this->note,
        ]);
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Đã lưu!"
        ]);
    }
}
