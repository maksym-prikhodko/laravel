@extends('desktop.layout')

@section('page-container')
    <div class="PageWrapper">
        <div class="mui-container">
            <a href="/products">Back To Products</a>
            <form class="mui-form" method="POST">
                @csrf
                <legend>
                    @if($product) Edit @else Create @endif Product
                </legend>
                <div class="mui-textfield">
                    <input type="text" placeholder="SKU" name="sku"
                           value="@isset($product->sku){{$product->sku}}@endisset"/>
                    <label>SKU</label>
                    @if(\Session::has('error') )
                        <div class="MuiButtonBase-root MuiChip-root MuiChip-outlined MuiChip-clickable MuiChip-deletable errorMsg"
                             tabindex="0" role="button">
                            <span class="MuiChip-label">
                                    {!! \Session::get('error') !!}
                            </span>
                            <svg class="MuiSvgIcon-root jss250" focusable="false" viewBox="0 0 24 24" aria-hidden="true"
                                 role="presentation" tabindex="-1" title="Error">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"></path>
                            </svg>
                            <span class="MuiTouchRipple-root"></span>
                        </div>
                    @endif
                </div>
                <div class="mui-select">
                    <select type="text" name="type" required>
                        <option value="">--- Select Type ---</option>
                        @forelse($types ?: [] as $type)
                            @isset($product->productType)
                                @if($product->productType->id === $type->id)
                                    <option value="{{$type->id}}" selected>{{$type->name}}</option>
                                @else
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endif
                            @else
                                <option value="{{$type->id}}">{{$type->name}}</option>
                            @endif
                        @empty
                            <div class="mui-textfield">
                                You have no any product types
                            </div>
                        @endforelse
                    </select>
                    <label>Product Type</label>
                </div>
                @if($attributes)
                    <legend>Attributes</legend>@endif
                @forelse($attributes ?: [] as $attributeName => $attributeValue)
                    <div class="mui-textfield">
                        <input type="text" placeholder="Enter {{$attributeName}}" name="{{$attributeName}}"
                               value="{{$attributeValue}}"/>
                        <label>{{$attributeName}}</label>
                    </div>
                @empty
                    <div class="mui-textfield">
                        You have no any attributes or type not selected
                    </div>
                @endforelse
                <button type="submit" class="mui-btn mui-btn--primary">Save</button>
                @isset($product->id)
                    <a href="/product/delete/{{$product->id}}" class="mui-btn mui-btn--danger">Delete</a>
                @endisset
                @isset($message)

                    @if($message != '' || \Session::has('message') )
                        <div class="MuiButtonBase-root MuiChip-root MuiChip-outlined MuiChip-clickable MuiChip-deletable"
                             tabindex="0" role="button">
                            <span class="MuiChip-label">
                                @if($message == '')
                                    {!! \Session::get('message') !!}
                                @else
                                    {{ $message }}
                                @endif
                            </span>
                            <svg class="MuiSvgIcon-root MuiChip-deleteIcon" focusable="false" viewBox="0 0 24 24"
                                 aria-hidden="true" role="presentation">
                                <path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"></path>
                            </svg>
                            <span class="MuiTouchRipple-root"></span>
                        </div>
                    @endif
                @endisset
            </form>
        </div>
    </div>
@endSection
