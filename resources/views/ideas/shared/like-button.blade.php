<div>
    <!-- Check if user logged in -->
    @auth()
        @if(Auth::user()->likesIdea($idea))
            <!-- Unlike button -->
            <form action="{{route('ideas.unlike', $idea->id)}}" method="POST">
                @csrf
            <button type="submit" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                <!--Display likes-->
                </span> {{$idea->likes()->count()}} </button>
            </form>
        @else
            <form action="{{route('ideas.like', $idea->id)}}" method="POST">
                @csrf
            <button type="submit" class="fw-light nav-link fs-6"> <span class="far fa-heart me-1">
                <!--Display likes-->
                </span> {{$idea->likes()->count()}} </button>
            </form>
        @endif
    @endauth
    <!-- When logged out we wtill see the likes button, if clicked - directed to login page -->
    @guest
        <a href="{{route('login')}}" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
            <!--Display likes-->
            </span> {{$idea->likes()->count()}} </a>
    @endguest
</div>
