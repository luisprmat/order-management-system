<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Redirector;

class ProductForm extends Component
{
    public Product $product;

    public bool $editing = false;

    public array $categories = [];

    public array $listsForFields = [];

    public function mount(Product $product): void
    {
        $this->product = $product;

        $this->initListsForFields();

        if ($this->product->exists) {
            $this->editing = true;

            $this->categories = $this->product->categories()->pluck('id')->toArray();
        }
    }

    public function save(): RedirectResponse|Redirector
    {
        $this->validate();

        $this->product->save();

        $this->product->categories()->sync($this->categories);

        return redirect()->route('products.index');
    }

    public function render()
    {
        return view('livewire.product-form');
    }

    protected function rules(): array
    {
        return [
            'product.name' => ['required', 'string'],
            'product.description' => ['required'],
            'product.country_id' => ['required', 'integer', 'exists:countries,id'],
            'product.price' => ['required'],
            'categories' => ['required', 'array'],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['countries'] = Country::pluck('name', 'id')->toArray();

        $this->listsForFields['categories'] = Category::active()->pluck('name', 'id')->toArray();
    }
}
