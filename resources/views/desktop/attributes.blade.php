@extends('desktop.layout')

@section('page-container')
    <div class="PageWrapper">
        <div class="mui-row">
            <table class="mui-table mui-table--bordered">
                <thead>
                <tr>
                    <th>Attribute Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($attributes ?: [] as $attribute)
                    <tr>
                        <td><span class="capitalize">{{$attribute->name}}</span></td>
                        <td>
                            <a class="mui-btn mui-btn--danger" href="/product-attribute/delete/{{$attribute->id}}">
                                Delete
                            </a>
                            <a class="mui-btn mui-btn--primary" href="/product-attribute/edit/{{$attribute->id}}">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2">
                            <div class="mui-panel mui--text-center">
                                Please create product attributes <a href="/product-attribute/create">here</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <a class="createBtn" href="/product-attribute/create">
        <button class="mui-btn mui-btn--large mui-btn--primary mui-btn--fab">
            <svg class="MuiSvgIcon-root jss2097" focusable="false" viewBox="0 0 24 24" aria-hidden="true"
                 role="presentation" tabindex="-1" title="Add">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
            </svg>
        </button>
    </a>
@endSection
