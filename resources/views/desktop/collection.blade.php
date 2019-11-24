@extends('desktop.layout')

@section('page-container')
    @include('desktop.product.search')
    <div class="PageWrapper">
        <div class="mui-row productsWrapper">
            @forelse($products ?: [] as $product)
                <div class="mui-col-md-4">
                    <div class="mui-panel">
                        <div class="mui--text-center">
                            <img class="imageProduct" src="/img/prod.png" height="100" alt="product image"/>
                        </div>
                        <div class="mui--text-headline">Product SKU: {{ $product->sku }}</div>
                        <div class="mui-divider"></div>
                        <div class="mui--text-subhead">Product Type:
                            @if($product->type)
                                {{ $product->type }}
                            @else
                                Product untyped
                            @endif
                        </div>
                        <div>
                            Attributes:
                            <ul class="mui-list--unstyled">
                                @forelse($product->product_atts ?: [] as $name => $val)
                                    <li>{{$name}} : {{$val}}</li>
                                @empty
                                    <li>Product type without attributes</li>
                                @endforelse
                            </ul>
                        </div>
                        <a href="/product/edit/{{$product->id}}">Edit</a>
                    </div>
                </div>
            @empty
                @if($is_search)
                    <div class="mui-col-md-12">
                        <div class="mui-panel mui--text-center">
                            Not Found
                        </div>
                    </div>
                @else
                    <div class="mui-col-md-12">
                        <div class="mui-panel mui--text-center">
                            Please create products <a href="/product/create">here</a>
                        </div>
                    </div>
                @endif
            @endforelse
        </div>
        @isset($products)
            {{ $products->links() }}
        @endisset
    </div>
    <a class="createBtn" href="/product/create">
        <button class="mui-btn mui-btn--large mui-btn--primary mui-btn--fab">
            <svg class="MuiSvgIcon-root jss2097" focusable="false" viewBox="0 0 24 24" aria-hidden="true"
                 role="presentation" tabindex="-1" title="Add">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
            </svg>
        </button>
    </a>
@endSection
