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

            <!--Display a message if no search results found-->
            @if(count($ideas) > 0)
            <!--Create Ideas Cards-->
            @foreach ($ideas as $idea)
            <div class="mt-3">
                <!--Include Ideas Cards-->
                @include('shared.idea-card')
            </div>
            @endforeach
            @else
               No Results Found.
            @endif
            <!--Add Pagination bottom Links-->
            <div class="mt-3">
            {{$ideas->withQueryString()->links()}}
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
