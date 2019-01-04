@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">File upload</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-success">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if(session('data'))
                            <div class="title m-b-md">
                                {{ session('data.name') }}
                            </div>
                        @endif

                        <form action="{{ url('upload') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="exampleInputFile">File input</label>
                                <input type="file" name="upfile" id="exampleInputFile">
                            </div>

                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection