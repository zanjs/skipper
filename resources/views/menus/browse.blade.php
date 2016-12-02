@extends('skipper::master')

@section('page_header')
    <h1 class="page-title">
        <i class="skipper-list-add"></i> {{ $dataType->display_name_plural }}
        <a href="{{ route($dataType->slug.'.create') }}" class="btn btn-success">
            <i class="skipper-plus"></i> 添加新的
        </a>
    </h1>
@stop

@section('page_header_actions')

@stop

@section('content')
    <div class="container-fluid">
        <div class="alert alert-info">
            <strong>如何使用:</strong>
            <p>您可以在网站上任意位置 通过调用 <code>Menu::display('name')</code> 获取每个设置的值 </p>
        </div>
    </div>

    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                            <tr>
                                @foreach($dataType->browseRows as $rows)
                                <th>{{ $rows->display_name }}</th>
                                @endforeach
                                <th class="actions">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($dataTypeContent as $data)
                                <tr>
                                    @foreach($dataType->browseRows as $row)
                                    <td>
                                        @if($row->type == 'image')
                                            <img src="@if( strpos($data->{$row->field}, 'http://') === false && strpos($data->{$row->field}, 'https://') === false){{ Skipper::image( $data->{$row->field} ) }}@else{{ $data->{$row->field} }}@endif" style="width:100px">
                                        @else
                                            {{ $data->{$row->field} }}
                                        @endif
                                    </td>
                                    @endforeach
                                    <td class="no-sort no-click">
                                        <div class="btn-sm btn-danger pull-right delete" data-id="{{ $data->id }}">
                                            <i class="skipper-trash"></i> 删除
                                        </div>
                                        <a href="{{ route('menus.edit', $data->id) }}" class="btn-sm btn-primary pull-right edit">
                                            <i class="skipper-edit"></i> 编辑
                                        </a>
                                        <a href="{{ route('skipper.menu.builder', $data->id) }}" class="btn-sm btn-success pull-right">
                                            <i class="skipper-list"></i> 管理
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">
                        <i class="skipper-trash"></i> 你确定要删除这个 {{ $dataType->display_name_singular }}?
                    </h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('menus.index') }}" id="delete_form" method="POST">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="是的删除 {{ $dataType->display_name_singular }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <!-- DataTables -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({ "order": [] });
        });

        $('td').on('click', '.delete', function (e) {
            id = $(e.target).data('id');

            $('#delete_form')[0].action += '/' + id;

            $('#delete_modal').modal('show');
        });
    </script>
@stop
