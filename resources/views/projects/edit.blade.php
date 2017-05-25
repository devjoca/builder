@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">Project Information</div>

                <div class="panel-body">
                    <form action="{{ route('project.update', $project->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $project->name }}">
                        </div>
                        <div class="form-group">
                            <label for="sshUser">SSH User:</label>
                            <input type="text" class="form-control" name="sshUser" value="{{ $project->sshUser }}">
                        </div>
                        <div class="form-group">
                            <label for="sshHost">SSH Host:</label>
                            <input type="text" class="form-control" name="sshHost" value="{{ $project->sshHost }}">
                        </div>
                        <div class="form-group">
                            <label for="deployScript">Deploy Script:</label>
                            <input type="text" class="form-control" name="deployScript" value="{{ $project->deployScript }}">
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">Builds</div>

                <div class="panel-body">
                    <table class="table table-striped">
                            <tr>
                                <th> # </th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        @foreach($project->builds as $build)
                            <tr>
                                <td>{{ $build->id }}</td>
                                <td>{{ $build->created_at }}</td>
                                <td><show-log-modal output="{{ nl2br($build->output) }}"></show-log-modal></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="logModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <span id="logBody"></span>
            </div>
        </div>
    </div>
</div>
@endsection