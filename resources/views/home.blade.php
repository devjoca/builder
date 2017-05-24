@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Projects</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Server</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->name }}</td>
                                <td>{{ $project->sshHost }}</td>
                                <td><build-btn project-id="{{ $project->id }}"></build-btn></td>
                                <td><a class="btn btn-default" href="{{ route('project.edit', $project->id) }}">Editar</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">SSH Key</div>

                <div class="panel-body">
                    <p>
                    Before you start building your projects don't forge to add this <code>ssh-key</code> to  your
                    <code>authorized_keys</code> file:
                    </p>
                    <pre>{{ $public_key }}</pre>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
