@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Project Information</div>

                <div class="panel-body">
                    <form action="{{ route('project.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="form-group">
                            <label for="sshUser">SSH User:</label>
                            <input type="text" class="form-control" name="sshUser" value="">
                        </div>
                        <div class="form-group">
                            <label for="sshHost">SSH Host:</label>
                            <input type="text" class="form-control" name="sshHost" value="">
                        </div>
                        <div class="form-group">
                            <label for="deployScript">Deploy Script:</label>
                            <input type="text" class="form-control" name="deployScript" value="">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection