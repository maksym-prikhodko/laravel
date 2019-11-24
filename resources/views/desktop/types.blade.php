@extends('desktop.layout')

@section('page-container')
    <div class="PageWrapper">
        <div class="mui-row">
            <table class="mui-table mui-table--bordered">
                <thead>
                <tr>
                    <th>Product Type</th>
                    <th>Type Attributes</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($types ?: [] as $type)
                    <tr>
                        <td><span class="capitalize">{{$type->name}}</span></td>
                        <td>
                            <ul class="mui-list--unstyled">
                                @forelse($type->atts ?: [] as $att)
                                    <li><span class="capitalize">{{$att->name}}</span></li>
                                @empty
                                    Without Attribute
                                @endforelse
                            </ul>
                        </td>
                        <td>
                            <a class="mui-btn mui-btn--danger" href="/product-type/delete/{{$type->id}}">
                                Delete
                            </a>
                            <a class="mui-btn mui-btn--primary" href="/product-type/edit/{{$type->id}}">
                              Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <div class="mui-col-md-12">
                        <div class="mui-panel mui--text-center">
                            Please create product type <a href="/product-type/create">here</a>
                        </div>
                    </div>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <a class="createBtn" href="/product-type/create">
        <button class="mui-btn mui-btn--large mui-btn--primary mui-btn--fab">
            <svg class="MuiSvgIcon-root jss2097" focusable="false" viewBox="0 0 24 24" aria-hidden="true"
                 role="presentation" tabindex="-1" title="Add">
                <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"></path>
            </svg>
        </button>
    </a>
@endSection
