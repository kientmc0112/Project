 
@forelse ($categories as $category)
<form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
    @csrf
    @method('DELETE')
<div class="item-menu">
    <span>
        @for ($i = 0; $i < $level; $i++)
        <i class="fas fa-arrow-right"></i> |
        @endfor
        <i class="fas fa-arrow-right"></i> {{ $category->name }}
    </span>
    <div class="category-fix">
        <a class="btn btn-primary" href="{{ route('admin.categories.edit', $category->id) }}"><i class="fa fa-edit"></i></a>
        {{-- <a href="{{ route('admin.categories.edit', $category->id) }}"><button class="btn btn-primary"><i class="fas fa-edit"></i></button></a> --}}
        {{-- <a class="btn-category btn-danger" href="{{ route('admin.categories.destroy', $category->id) }}"><i class="fas fa-times"></i></i></a> --}}
        <button class="btn btn-danger" type="submit"><i class="fas fa-times"></i></i></button>
    </div>
</div>
</form>
@includeWhen($category->sub->count() ,'admin.partials.categories_rows', ['categories' => $category->sub, 'level' => $level + 1])
@empty
<div class="item-menu"><span>Form Category Empty!!! Pls add data to categories table</span></div> 
@endforelse