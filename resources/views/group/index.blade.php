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
                
            @role('Supervisor')
            <section>
                <div class="card">
                        <div class="card-header">
                                Manage CDS Groups
                            </div>
                    <div class="card-body">
                        
                        <div class="row">
                            @foreach(auth()->user()->groups->chunk(3) as $groups)
                            <div class="col-lg-4 col-sm-6 col-12 m-t-15">
                                @foreach ($groups as $group)
                                <div class="card payment">
                                        <div class="card-header bg-success text-center">
                                            {{ $group->group->name }}
                                        </div>
                                        <form action="{{ route('groups.updateSupervisorGroup') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            {{-- @method('PATCH') --}}
                                            <div class="bg-white">
                                                    <div class="card-body m-t-15">
                                                        <div class="text-center">
                                                            <div class="h5">Total Members </div>
                                                            <div class="h2">{{ $group->group->profile->count() }}</div>
                                                            <hr/>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <p>
                                                                    <input id="group" name="group" type="hidden" required value="{{ $group->id }}" >
                                                                <p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <p>
                                                                    <span>Time [Current: <span class="text-success">{{ $group->time }}</span> ]</span>
                                                                    <select id="time" name="time" class="form-control" required >
                                                                        <option>6 AM</option>
                                                                        <option>7 AM</option>
                                                                        <option>8 AM</option>
                                                                        <option>9 AM</option>
                                                                        <option>10 AM</option>
                                                                        <option>11 AM</option>
                                                                        <option>12 AM</option>
                                                                        <option>1 PM</option>
                                                                        <option>2 PM</option>
                                                                        <option>3 PM</option>
                                                                        <option>4 PM</option>
                                                                        <option>5 PM</option>
                                                                        <option>6 PM</option>
                                                                    </select>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                                <div class="col">
                                                                    <p>
                                                                        <span>Day [Current: <span class="text-success">{{ $group->day }}</span> ]</span>
                                                                        <select id="day" name="day" class="form-control" required >
                                                                            <option>Every Monday</option>
                                                                            <option>Every Tuesday</option>
                                                                            <option>Every Wednesday</option>
                                                                            <option>Every Thursday</option>
                                                                            <option>Every Friday</option>
                                                                            <option>Every Saturday</option>
                                                                            <option>Every Sunday</option>
                                                                        </select>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                    <div class="card-footer bg-white text-center">
                                                        <button class="btn btn-secondary btn-block get_plan_warning" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        
                                    </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div>

                    </div>
                    
                </div>
            </section>
            @endrole
            @role('Admin')
            <section>
            <div class="data_tables">
                <div class="card">
                        <div class="card-header bg-white">
                            <i class="fa fa-table"> </i> All CDS Groups
                        </div>
                        <div class="text-center p-2">
                                <a class="btn btn-success btn-md adv_cust_mod_btn" data-toggle="modal"
                                data-href="#responsive" href="#responsive">Add CDS Group</a>
                        </div> 
                        
                        <div class="card-body">
                            <div class="m-t-15">
                                <table id="example1" class="table display table-stripped table-bordered" >
                                    <thead>
                                        
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            <input type="hidden" value="{{ $i = 1}}">
                                        @foreach ($groups as $group)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $group->name }}</td>
                                                <td>{{ $group->code }}</td>
                                                <td>
                                                    <form action="{{ route('groups.destroy', $group) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-success btn-md adv_cust_mod_btn" data-toggle="modal"
                                data-href="#responsive" href="#responsive{{$group->id}}"><i class="fa fa-edit"></i></a>

                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                    <div class="modal fade in display_none" id="responsive{{$group->id}}" tabindex="-1" role="dialog" aria-hidden="false">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-success">
                                                                    <h4 class="modal-title text-white">Edit Group</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('groups.update', $group) }}" method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                            <div class="row">
                                                                                    <div class="col">
                                                                                        <p>
                                                                                            <input id="name" name="name" type="text" placeholder="Name" class="form-control" required value="{{ $group->name }}" ></p>
                                                                                        <p>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="row">
                                                                                    <div class="col">
                                                                                        <p>
                                                                                            <input id="code" name="code" type="text" placeholder="Code" class="form-control" required value="{{ $group->code }}" ></p>
                                                                                        <p>
                                                                                    </div>
                                                                            
                                                                                </div>
                                                                    
                                                                                <div class="modal-footer">
                                                                                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                                                                                        <button type="submit" class="btn btn-success">Update</button>
                                                                                    </div>
                                                                                </form>
                                                                        
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>

                                                    </td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

<div class="modal fade in display_none" id="responsive" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title text-white">Add CDS Group</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('groups.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <p>
                                    <input id="name" name="name" type="text" placeholder="Name" class="form-control" required >
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p>
                                    <input id="code" name="code" type="text" placeholder="Code" class="form-control" required>
                                </p>
                            </div>
                    
                        </div>
        
                    <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                            <button type="submit" class="btn btn-success">Add CDS Group</button>
                        </div>
                    </form>
                        
                </div>
                
            </div>
        </div>
    </div>

            </section>
            @endrole
        </div>
        <!-- /.inner -->
    </div>
</div>
</div>
    <!-- /.outer -->
    <!-- /.content -->
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