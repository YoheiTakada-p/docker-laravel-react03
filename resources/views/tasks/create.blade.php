@extends('layout')

@section('styles')
@extends('share.flatpicker.styles')
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-md-offset-3 col-md-6">
            <nav class="panel panel-default">
                <div class="panel-heading">Add Task</div>
                <div class="panel-body">
                    @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $message)
                        <p>{{ $message }}</p>
                        @endforeach
                    </div>
                    @endif
                    <form action="{{ route('tasks.create', ['id' => $folder_id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                        </div>
                        <div class="form-group">
                            <label for="due_date">Deadline</label>
                            <input type="text" class="form-control" name="due_date" id="due_date" value="{{ old('due_date') }}" />
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@extends('share.flatpicker.scripts')
@endsection