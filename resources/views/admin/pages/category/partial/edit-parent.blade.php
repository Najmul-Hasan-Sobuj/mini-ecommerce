<option value="{{ $category->id }}" @selected($category->id == $editingCategory->parent_id)>
    @php echo str_repeat('-', $level) @endphp {{ $category->name }}
</option>

@if ($category->children && count($category->children))
    @foreach ($category->children as $child)
        @include('admin.pages.category.partial.edit-parent', ['category' => $child, 'level' => $level + 1])
    @endforeach
@endif