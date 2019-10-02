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
                        {{ now()->englishMonth }} {{ $links['title'] }}
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
                                <i class="fa fa-table"> </i> {{ now()->englishMonth }} Attendance
                            </div>
                            <div class="text-center p-2">
                                    <a class="btn btn-success btn-md adv_cust_mod_btn" data-toggle="modal"
                                    data-href="#responsive" href="#responsive">Take Attendance</a>
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
                                            <th>Week 1</th>
                                            <th>Week 2</th>
                                            <th>Week 3</th>
                                            <th>Week 4</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <input type="hidden" value="{{ $i = 1}}">
                                            @foreach ($values as $value)
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $value->profile->state_code }}</td>
                                                    <td>{{ $value->profile->first_name }}</td>
                                                    <td>{{ $value->profile->last_name }}</td>
                                                    <td><span class="badge badge-{{ isset($value->attendance->last()->week_1) ? "success" : ""}} p-2 col">Present</span></td>
                                                    <td><span class="badge badge-{{ isset($value->attendance->last()->week_2) ? "success" : ""}} p-2 col">Present</span></td>
                                                    <td><span class="badge badge-{{ isset($value->attendance->last()->week_3) ? "success" : ""}} p-2 col">Present</span></td>
                                                    <td><span class="badge badge-{{ isset($value->attendance->last()->week_4) ? "success" : ""}} p-2 col">Present</span></td>
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

        <div class="modal fade in display_none" id="responsive" tabindex="-1" role="dialog" aria-hidden="false">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h4 class="modal-title text-white">Take Attendance</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('attendance.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                    <div class="row">
                                        <div class="col">
                                            <p>
                                                <input id="state_code" name="state_code" type="text" placeholder="Enter State Code (e.g PL18C0984)" class="form-control" required >
                                            </p>
                                            
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                        <p>
                                            <select id="week" name="week" type="text" class="form-control" required>
                                                <option value="*">Select Week</option>
                                                <option value="week_1">Week 1</option>
                                                <option value="week_2">Week 2</option>
                                                <option value="week_3">Week 3</option>
                                                <option value="week_4">Week 4</option>
                                            </select>
                                        </p>
                                        </div>
                                    </div>
                                   
                        
                                    <div class="modal-footer">
                                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                            <button type="submit" class="btn btn-success">Submit</button>
                                        </div>
                                    </form>
                                
                        </div>
                        
                    </div>
                </div>
            </div>
        <!-- /.outer -->
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