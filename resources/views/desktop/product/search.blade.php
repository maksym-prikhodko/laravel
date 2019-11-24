<div class="PageWrapper">
    <form class="mui-form" action="/products/search">
        <legend>Search Products</legend>
        <div class="mui-textfield">
            <input type="text" name="sku" placeholder="SKU" value="{{ Request::get('sku') }}">
            <label>SKU</label>
        </div>
        <div class="mui-select">
            <select type="text" name="type">
                <option value="0">--- Select Type ---</option>
                @forelse($types ?: [] as $type)
                    <option value="{{$type->id}}"
                            @if(Request::get('type') == $type->id) selected @endif>
                        {{$type->name}}
                    </option>
                @empty
                @endforelse
            </select>
            <label>Product Type</label>
        </div>
        <h4>Attributes</h4>
        <div class="mui-row">
            @forelse($attributes ?: [] as $attribute)
                <div class="mui-col-md-6">
                    <div class="mui-textfield">
                        <input type="text"
                               name="attributes[{{$attribute->id}}]"
                               placeholder="Enter {{$attribute->name}}"
                               value="{{ Request::get('attributes')[$attribute->id] }}">
                        <label>{{$attribute->name}}</label>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <button type="submit" class="mui-btn mui-btn--raised">Search</button>
    </form>
</div>
