@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-white bg-secondary">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="/admin/tournaments/{{ $tournament->id}}" enctype="multipart/form-data">
                         @csrf
                        {{ method_field('PATCH')}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Tournament Name:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $tournament->name }}"  required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>
                            <div class="col-md-6">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input form-control @error('image') is-invalid @enderror" name="image" id="image" >
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label class="custom-file-label" for="image">{{ $tournament->image }}</label>

                                </div>

                       </div>
                       </div>
                        <div class="form-group row">
                            <label for="start_date" class="col-md-4 col-form-label text-md-right">Start Date</label>

                            <div class="col-md-6">
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ $tournament->start_date }}"  autocomplete="start_date" required autofocus>

                                @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="end_date" class="col-md-4 col-form-label text-md-right">End Date</label>

                                <div class="col-md-6">
                                    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ $tournament->end_date }}"  autocomplete="end_date" required autofocus>

                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group row">
                            <label for="venue" class="col-md-4 col-form-label text-md-right">Venue</label>

                            <div class="col-md-6">
                                <input id="venue" type="text" class="form-control @error('venue') is-invalid @enderror" name="venue" value="{{ $tournament->venue }}"  autocomplete="venue" required autofocus>

                                @error('venue')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="state" class="col-md-4 col-form-label text-md-right">State</label>

                            <div class="col-md-6">
                                <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ $tournament->state }}"  autocomplete="state" required autofocus>

                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                                <label for="prizepool" class="col-md-4 col-form-label text-md-right">Prizepool</label>

                                <div class="col-md-6">
                                    <input id="prizepool" type="text" class="form-control @error('prizepool') is-invalid @enderror" name="prizepool" value="{{ $tournament->prizepool }}"  autocomplete="prizepool" required autofocus>

                                    @error('prizepool')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group row">
                                <label for="organizer" class="col-md-4 col-form-label text-md-right">Organizer</label>

                                <div class="col-md-6">
                                    <input id="organizer" type="text" class="form-control @error('organizer') is-invalid @enderror" name="organizer" value="{{ $tournament->organizer }}"  autocomplete="organizer" required autofocus>

                                    @error('organizer')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                                <a href="{{ url()->previous() }}"
                                    class="btn btn-outline-danger text-white"
                                    role="button">Cancel</a>
                            </div>
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
