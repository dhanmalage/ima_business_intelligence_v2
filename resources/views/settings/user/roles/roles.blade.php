@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>User Role Settings <small>All User Roles</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="header-buttons-wrap">
        <a class="btn btn-app" href="/roles/create">
            <i class="fa fa-plus"></i> Add Roles
        </a>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>All User Roles</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        User Roles
                    </p>
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>System ID</th>
                            <th>Role Name</th>
                            <th>Permissions</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{ str_replace(array('[',']','"'),'', $role->permissions()->pluck('name')) }}</td>
                                <td class="table-actions">
                                    <a href="javascipt:void(0);" title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="javascipt:void(0);" title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
