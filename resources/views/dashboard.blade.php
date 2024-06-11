@extends('layout.layout')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('shared.left-sidebar')
        </div>
        <div class="col-6">
            <!--Success message-->
            @include('shared.success-message')

            <!--Share Ideas-->
            @include('shared.submit-idea')
            <hr>

            <!--Create Ideas Cards-->
            @foreach ($ideas as $idea)
            <div class="mt-3">
                <!--Include Ideas Cards-->
                @include('shared.idea-card')
            </div>
            @endforeach
            <!--Add Pagination bottom Links-->
            <div class="mt-3">
            {{$ideas->links()}}
            </div>
        </div>
        <div class="col-3">
            <!--Search bar-->
            @include('shared.search-bar')
                <!--Follow box-->
                @include('shared.follow-box')
        </div>
    </div>
@endsection
