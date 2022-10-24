<div class="direct-chat-messages" id="chat-body">
    @foreach($chats as $chat)
        @if($chat->emp_id <> session('emp_id')) 
            <!-- Message to the left -->
            <div class="direct-chat-msg">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">{{ $chat->emp_first_name }}</span>
                    <span class="direct-chat-timestamp float-right">{{ Carbon\Carbon::parse($chat->cht_date_created)->diffForHumans() }}</span>
                </div>
                <img class="direct-chat-img" src="{{ asset(get_avatar($chat->emp_id)) }}" alt="message user image">
                <div class="direct-chat-text">
                    {{ $chat->cht_message }}
                </div>
            </div>
        @else
            <!-- Message to the right -->
            <div class="direct-chat-msg right">
                <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-right">{{ $chat->emp_first_name }}</span>
                    <span class="direct-chat-timestamp float-left">{{ Carbon\Carbon::parse($chat->cht_date_created)->diffForHumans() }}</span>
                </div>
                <img class="direct-chat-img" src="{{ asset(get_avatar($chat->emp_id)) }}" alt="message user image">
                <div class="direct-chat-text">
                    <a style="color:white;" href="{{ action('ChatController@delete',[$chat->cht_id]) }}"><span class="fa fa-trash"></span></a> {{ $chat->cht_message }}
                </div>
            </div>
        @endif
    @endforeach
</div>

<script>
    setInterval(function(){
        var url='{{ URL::route('chat') }}';
        var chatBody=$('#chat-body');
        $.get(url)
            .done(function(r){
                chatBody.replaceWith(r);
            })
            .fail(function(){
            });
    }, 60000);
</script>
        