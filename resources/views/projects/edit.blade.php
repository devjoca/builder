@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Project Information</div>

                <div class="panel-body">
                    <div class="form-group">
                        <label for="project_name">Name:</label>
                        <input type="text" class="form-control" name="project_name" value="{{ $project->name }}">
                    </div>
                    <div class="form-group">
                        <label for="ssh_user">SSH User:</label>
                        <input type="text" class="form-control" name="ssh_user" value="{{ $project->sshUser }}">
                    </div>
                    <div class="form-group">
                        <label for="ssh_host">SSH Host:</label>
                        <input type="text" class="form-control" name="ssh_host" value="{{ $project->sshHost }}">
                    </div>
                    <div class="form-group">
                        <label for="deploy_script">Deploy Script:</label>
                        <input type="text" class="form-control" name="deploy_script" value="{{ $project->deployScript }}">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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