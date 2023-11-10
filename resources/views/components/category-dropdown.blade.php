@props([
    'categories',
    'selectedId' => null,
    'mode' => 'add' // Default mode is 'add'
])

<select name="parent_id" data-placeholder="Select a Parent category..."
    class="form-control form-control-sm select {{ $mode === 'add' ? 'select-parent-category-add' : 'select-parent-category-edit' }}" data-container-css-class="select-sm">
    <option></option>
    @foreach ($categories->whereNull('parent_id') as $category)
        <option value="{{ $category->id }}" @selected($category->id == $selectedId)>
            {{ str_repeat('-', $category->depth) }} {{ $category->name }}
        </option>
    @endforeach
</select>