@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <figure class="figure">
                        @if (Auth::user()->avatar_url != NULL)
                            <img class="figure-img img-fluid img-circle profile-avatar" src="{{ URL::to(Auth::user()->getAvatarUrl()) }}" width="200" height="150" alt="profile photo" />
                        @else
                            <img class="figure-img img-fluid img-circle profile-avatar" src="{{ URL::to('images/avatar.png') }}" width="100" height="100" alt="profile photo">
                        @endif
                   <figcaption class="figure-caption text-xs-center">
                       <strong>{{ Auth::user()->name }}</strong>
                   </figcaption>
               </figure>
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
