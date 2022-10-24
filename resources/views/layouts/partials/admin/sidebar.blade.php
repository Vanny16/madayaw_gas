@if(Session::has('emp_uuid'))
<aside class="main-sidebar sidebar-light-primary elevation-4">
    {{-- Logo --}}
    <a href="{{ session('acc_website') }}" target="_blank" class="brand-link">
        <img src="{{ asset('images/accounts/' . session('acc_image')) }}" alt="Organization Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ session('acc_name') }}</span>
    </a>

    {{-- Sidebar  --}}
    <div class="sidebar">
        {{-- Sidebar user panel (optional) --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if(session('emp_image') <> '')
                    <img src="{{ asset('images/employees/' . session('emp_image')) }}" class="img-circle elevation-2" alt="User Image">
                @else
                    <img src="{{ asset('images/employees/default.png') }}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="{{ action('UserController@main') }}" class="d-block"> {{ session('emp_full_name') }}</a>
            </div>
        </div>

        {{-- Sidebar Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
            
                <li class="nav-item">
                    <a href="{{ action('MainController@home') }}" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Home 
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ action('MessageController@main') }}" class="nav-link">
                        <i class="nav-icon fa fa-envelope"></i>
                        <p>Messages</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ action('EventController@main') }}" class="nav-link">
                        <i class="nav-icon fa fa-calendar"></i>
                        <p>Calendar</p>
                    </a>
                </li>
 	
                <li class="nav-item">
                    <a href="{{ action('DownloadController@main') }}" class="nav-link">
                        <i class="nav-icon fa fa-cloud"></i>
                        <p>File Downloads</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>HRMD <i class="right fas fa-angle-left"></i></p>
                    </a>
                
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                            </a>
                        </li> --}}
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendance <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ action('DTRController@timecard') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>My Time Card</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ action('DTRController@timecardAll') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Employee DTR</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Leave Application <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ action('LeaveController@leaverequest') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>File Leave</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ action('LeaveController@history') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Leave History</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ action('LeaveController@leaveprocessing') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Leave Processing</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ action('LeaveController@leaveprocessing') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Leave Credits</p>
                                    </a>
                                </li>
                            </ul>
                        </li> 
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Employees <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ action('EmployeeController@manage') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Employee Management</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Employee Records</p>
                                    </a>
                                </li>
                            </ul>
                        </li> 
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>Accounting <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Payroll <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ action('PayrollController@payslipMain') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Payslip</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ action('PayrollController@processingMain') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Processing</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Reports</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ action('PayrollController@utility') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Utility</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>HRMD <i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Attendance <i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ action('DTRController@timecard') }}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>DTR Logs</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Level 3</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Level 2</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- @if(session('super_admin') == true OR session('validator') == true)
                    <li class="nav-item">
                        <a href="{{ action('ValidationController@validation') }}" class="nav-link">
                            <i class="nav-icon fa fa-star-o"></i>
                            <p>
                                For Validation 
                                @if(countFeedbackForValidation() > 0)
                                    <span class="right badge badge-danger">{{ countFeedbackForValidation() }}</span>
                                @endif
                            </p>
                        </a>
                    </li>
                @endif --}}

                {{-- @if(session('department_head') == true)
                    <li class="nav-header">FEEDBACKS FOR ACTION</li>
                    @foreach(session('user_departments') AS $dep_id)
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-institution"></i>
                                <p>
                                    {{ getDepartmentShortName($dep_id) }}
                                    <i class="right fas fa-angle-left"></i>
                                    @if(countAllTicketForActionbyDept($dep_id) > 0)
                                        <span class="right badge badge-danger">{{ countAllTicketForActionbyDept($dep_id) }}</span>
                                    @endif
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ action('TicketController@action',[$dep_id,'0']) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            New 
                                            @if(countTicketForActionByDept($dep_id) > 0)
                                                <span class="right badge badge-danger">{{ countTicketForActionByDept($dep_id) }}</span>
                                            @endif
                                        </p> 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ action('TicketController@action',[$dep_id,'-1']) }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>
                                            Returned
                                            @if(countTicketReturnedByDept($dep_id) > 0)
                                                <span class="right badge badge-danger">{{ countTicketReturnedByDept($dep_id) }}</span>
                                            @endif
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endforeach
                @endif --}}

                <li class="nav-item">
                    <a href="{{ action('UpdateController@main') }}" class="nav-link">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            System Updates
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
@else
    <script type="text/javascript">
        window.location = "{{ url('/') }}";
    </script>
@endif