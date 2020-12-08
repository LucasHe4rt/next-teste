@extends('layouts.app')
@section('content')
    @parent
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <a class="btn btn-success float-right" href="{{ route('create') }}">Novo</a>
                <h4>Contatos</h4>
            </div>
            <div class="card-body">
                <list-component url="{{ route('all') }}"></list-component>
            </div>
        </div>
    </div>
@endsection
