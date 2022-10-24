<a href="{{ action('MessageController@compose') }}" class="btn btn-primary btn-block mb-3"><i class="fa fa-paper-plane"></i> Compose</a>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Folders</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body p-0">
        <ul class="nav nav-pills flex-column"> 
            <li class="nav-item active">
                <a href="{{ action('MessageController@main') }}" class="nav-link">
                    <i class="fas fa-inbox"></i> Inbox
                    @if(count_unread_messages(session('emp_id')) > 0)
                        <span class="badge bg-warning float-right">
                            {{ count_unread_messages(session('emp_id')) }}
                        </span>
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ action('MessageController@sent') }}" class="nav-link">
                <i class="far fa-envelope"></i> Sent
                </a>
            </li>
        </ul>
    </div>
</div>