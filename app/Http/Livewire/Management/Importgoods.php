<?php

namespace App\Http\Livewire\Management;

use Livewire\Component;
use App\Models\ImportgoodsDrink;
use App\Models\ImportgoodsIngredent;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use App\Models\DrinkDetail;
use App\Models\IngredentDetail;

class Importgoods extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('livewire.management.importgoods');
    }
    public function undoDrink($import_id)
    {
        $importGoods = ImportgoodsDrink::where('id', $import_id)->first();
        $drinkDetail = DrinkDetail::where('drink_name', $importGoods->drink->drink_name)
            ->where('date_exp', $importGoods->drink->drinkDetail->date_exp)
            ->first();
        DrinkDetail::where('drink_name', $importGoods->drink->drink_name)
            ->where('date_exp', $importGoods->drink->drinkDetail->date_exp)
            ->update([
                'amount' => $drinkDetail->amount - $importGoods->amount_add,
            ]);
        ImportgoodsDrink::where('id', $import_id)->delete();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Hoàn tác thành công!"
        ]);
    }
    public function undoIngredent($import_id)
    {
        $importGoods = ImportgoodsIngredent::where('id', $import_id)->first();
        $ingredentDetail = IngredentDetail::where('ingredent_name', $importGoods->ingredent->ingredent_name)
            ->where('date_exp', $importGoods->ingredent->ingredentDetail->date_exp)
            ->first();
        IngredentDetail::where('ingredent_name', $importGoods->ingredent->ingredent_name)
            ->where('date_exp', $importGoods->ingredent->ingredentDetail->date_exp)
            ->update([
                'amount' => $ingredentDetail->amount - $importGoods->amount_add,
            ]);
        ImportgoodsIngredent::where('id', $import_id)->delete();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => "Hoàn tác thành công!"
        ]);
    }
}
