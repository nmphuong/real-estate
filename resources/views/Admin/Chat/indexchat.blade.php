

<div class="message-wrapper">
    <ul class="messages">
        
        @foreach($messages as $message)
            @if($message == null)
                <p>NULL</p>
            @else
                <li class="message clearfix">
                    {{--if message from id is equal to auth id then it is sent by logged in user --}}
                    <div class="{{ ($message->from == 1) ? 'sent' : 'received' }}">
                        <p>{{ $message->message }}</p>
                        <p class="date">{{ date('d M y, h:i a', strtotime($message->created_at)) }}</p>
                    </div>
                </li>
            @endif
        @endforeach 
    </ul>
</div>

<div class="input-text">
    <input type="text" name="message" class="submit">
</div>