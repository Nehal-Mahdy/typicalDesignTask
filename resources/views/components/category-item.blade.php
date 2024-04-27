
@props(['category'])

    <option class="cat" value="{{$category->id}}">{{$category->category}}
        
        </option>
  
    @foreach ($category->children as $child)
        {{-- <option > --}}

            <x-category-item :category="$child"/>

        {{-- </option> --}}
        
        
  
   @endforeach



