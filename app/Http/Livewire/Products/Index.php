<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $categories;

    public $cat_id = [];



    protected $queryString = ['cat_id' => ['compact' => ',']];




    public function updated()
    {
        $this->resetPage();
    }


    public function render()
    {


        $this->categories = cache()->remember('product_categories', 60, function () {
            return Category::where('type', 'productCategory')->withCount('products')->get();
        });


        return view('livewire.products.index', [
            'products' => Product::Filter(['categories' => $this->cat_id])->with('media')->paginate(6),
        ]);
    }
}
