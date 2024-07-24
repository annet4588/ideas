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
            @include('ideas.shared.submit-idea')
            <hr>

            <!--Create Ideas Cards-->
            @forelse ($ideas as $idea)
                <div class="mt-3">
                    <!--Include Ideas Cards-->
                    @include('ideas.shared.idea-card')
                </div>
            @empty
            <p class="text-center mt-4">No Results Found.</p>
            @endforelse

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
