@extends('desktop.layout')

@section('page-container')
    <div class="PageWrapper">
        <div class="mui-container">
            <a href="/product-attributes">Back To Attributes</a>
            <form class="mui-form" method="POST">
                @csrf
                <legend>@if($attribute) Edit @else Create @endif Product Attribute</legend>
                <div class="mui-textfield">
                    <input type="text" placeholder="Title" name="name"
                           value="@isset($attribute->name){{$attribute->name}}@endisset"/>
                    <label>Attribute Title</label>
                </div>
                <button type="submit" class="mui-btn mui-btn--primary">Save</button>
                @if($attribute)
                <a class="mui-btn mui-btn--danger" href="/product-attribute/delete/{{$attribute->id}}">
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
