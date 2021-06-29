@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Media Upload') }}</div>

                <div class="card-body">
                    @if(count($errors) > 0)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endforeach
                    @endif

                    @if(session()->has('success_msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->get('success_msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    @endif
                    
                    <form action="{{ url('/upload') }}" class="form mt-4" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="profile-photo">Upload picture</label>
                            <input type="file" class="form-control-file" name="avatar" id="profile-photo" placeholder="" aria-describedby="fileHelpId" required>
                            <small id="fileHelpId" class="form-text text-muted">Upload a picture</small>
                          </div>

                          <button type="submit" class="btn btn-success btn-style">Upload</button>

                        </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

