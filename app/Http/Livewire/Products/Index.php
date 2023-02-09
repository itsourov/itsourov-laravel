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
    public $products;
    public $cat_id = [];

    public $limitPerPage = 6;
    public $hasMorePages;

    protected $queryString = ['cat_id' => ['compact' => ',']];

    public function render()
    {
        $this->products = Product::Filter(['categories' => $this->cat_id])->with('media')->take($this->limitPerPage)->get();

        $this->categories = cache()->remember('product_categories', 60, function () {
            return Category::where('type', 'productCategory')->withCount('products')->get();
        });


        return view('livewire.products.index');
    }

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }
}
