@extends(('layouts/fixed_menu_header'))
{{-- Page title --}}
@section('title')
    {{ $links['title'] }}
    @parent
@stop

@section('header_styles')
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/select2/css/select2.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/datatables/css/scroller.bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/datatables/css/colReorder.bootstrap.min.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('vendors/datatables/css/dataTables.bootstrap.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/dataTables.bootstrap.css')}}" />
    <!-- end of plugin styles -->
    <!--Page level styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('css/pages/tables.css')}}" />
    <!--End of page level styles-->

@stop
{{-- Page content --}}
@section('content')
    <!-- Content Header (Page header) -->
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-file-o"></i>
                        {{ $links['title'] }}
                    </h4>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                            <a href="index1">
                                <i class="fa ti-file" data-pack="default" data-tags=""></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ $links['title'] }}</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $links['sub_title'] }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-light lter bg-container">
            <div class="row">
                <div class="col">
                    {{ $errors}}
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('failure'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('failure') }}
                        </div>
                    @endif

                    <div class="data_tables">
                        <div class="card">
                            <div class="card-header bg-white">
                                <i class="fa fa-table"> </i> All Members
                            </div>
                            
                            <div class="card-body"> 
                                <div class="m-t-15">
                                        <table id="example1" class="table display table-stripped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>State Code</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>LGA</th>
                                            <th>CDS Group</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <input type="hidden" value="{{ $i = 1}}">
                                            @foreach ($members as $member)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $member->profile->state_code }}</td>
                                                    <td>{{ $member->profile->first_name }}</td>
                                                    <td>{{ $member->profile->last_name }}</td>
                                                    <td>{{ $member->email }}</td>
                                                   
                                                    <td>{{ $member->profile->lga }}</td>
                                                    <td>{{ $member->profile->group->name }}</td>
                                                    <td><span class="col badge badge-{{ $member->status->style }}"> {{$member->status->name }}</span></td>
                                                    <td>
                                                        <form action="{{ route('members.destroy', $member) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')

                                                            {{-- <a href="{{ route("members.edit", $member) }}" class="btn btn-primary"><i class="fa fa-edit"></i></a> --}}
                                                    <a href="{{ route("members.show", $member) }}" class="btn btn-success"><i class="fa fa-eye"></i></a>

                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                        

                                                        {{-- <a href="{{ route("members.destroy", $member) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a> --}}
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
            </div>
        </div>
        <!-- /.inner -->
    </div>

   
@stop



@section('footer_scripts')
    <!--plugin scripts-->
    <script type="text/javascript" src="{{asset('vendors/select2/js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/pluginjs/dataTables.tableTools.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.colReorder.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.buttons.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.responsive.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.rowReorder.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.colVis.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.html5.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/buttons.print.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('vendors/datatables/js/dataTables.scroller.min.js')}}"></script>
    <!-- end of plugin scripts -->
    <!--Page level scripts-->
    <script type="text/javascript" src="{{asset('js/pages/simple_datatables.js')}}"></script>
    <!-- end of global scripts-->
@stop