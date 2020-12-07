@extends('layouts.app')
@section('content')
    @parent
    <div class="mt-5">
        <form>
            @csrf
            <form-component
                url="{{ route('store') }}"
            ></form-component>
        </form>
    </div>
@endsection
