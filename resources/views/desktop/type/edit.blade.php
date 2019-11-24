@extends('desktop.layout')

@section('page-container')
    <div class="PageWrapper">
        <div class="mui-container">
            <a href="/product-types">Back To Types</a>
            <form class="mui-form" method="POST">
                @csrf
                <legend>@if($type) Edit @else Create @endif Product Type</legend>
                <div class="mui-textfield">
                    <input type="text" placeholder="Title" name="name"
                           value="@isset($type->name){{$type->name}}@endisset"/>
                    <label>Type Title</label>
                </div>
                @forelse($attributes ?: [] as $attribute)
                    <div class="mui-checkbox">
                        <label>
                            <input type="checkbox"
                                   name="attribute[]"
                                   value="{{$attribute->id}}"
                                   @if(in_array($attribute->id, $type_attributes)) checked @endif
                            />
                            <span class="capitalize">{{$attribute->name}}</span>
                        </label>
                    </div>

                @empty
                    <div class="mui-textfield">
                        You have no any attributes or type not selected
                    </div>
                @endforelse
                <button type="submit" class="mui-btn mui-btn--primary">Save</button>
                @if($type)
                <a class="mui-btn mui-btn--danger" href="/product-type/delete/{{$type->id}}">
                     Delete
                </a>
                @endif
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
