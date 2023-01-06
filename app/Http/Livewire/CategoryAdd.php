<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryAdd extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $button = 'Add', $button_color = 'success', $is_shown = false, $current_category = null, $name_uz, $name_ru, $name_en;


    protected $rules = [
        'name_uz' => 'required|string',
        'name_ru' => 'required|string',
        'name_en' => 'required|string',
    ];

    public function show_inputs()
    {
        $this->is_shown = true;
    }

    public function edit($current_category)
    {
        $this->current_category = $current_category;
        $this->button = 'Update';
        $this->button_color = 'warning';
        $this->name_uz = $current_category['name_uz'];
        $this->name_ru = $current_category['name_ru'];
        $this->name_en = $current_category['name_en'];
        $this->is_shown = true;
    }

    public function delete($current_category)
    {
        $this->current_category = $current_category;
        $this->button = 'Delete';
        $this->button_color = 'danger';
        $this->name_uz = $current_category['name_uz'];
        $this->name_ru = $current_category['name_ru'];
        $this->name_en = $current_category['name_en'];
        $this->is_shown = true;
    }

    public function add()
    {
        if ($this->current_category != null) {
            if ($this->button == 'Delete') {
                Category::find($this->current_category['id'])->delete();
            } else {
                $category = Category::find($this->current_category['id']);
                $category->name_uz = $this->name_uz;
                $category->name_ru = $this->name_ru;
                $category->name_en = $this->name_en;
                $category->save();
            }
        } else {
            $this->validate();
            $category = new Category();
            $category->name_uz = $this->name_uz;
            $category->name_ru = $this->name_ru;
            $category->name_en = $this->name_en;
            $category->save();
        }

        $this->resetVarables();
        $this->is_shown = false;
        return redirect(request()->header('Referer'));
    }

    public function resetVarables()
    {
        $this->name_en = $this->name_uz = $this->name_ru = '';
    }

    public function render()
    {
        return view('livewire.category-add', [
            'categories' => Category::orderBy('updated_at', 'desc')->paginate(20)
        ]);
    }
}
