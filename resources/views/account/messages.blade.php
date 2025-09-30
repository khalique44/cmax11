
@if($messages->count()>0)
  @foreach($messages as $key => $message)
    
    <li class="{!! ($message->is_read > 0) ? 'nactive' : 'active' !!}" title="{!! ($message->is_read > 0) ? '' : __('New Message') !!}">

      <strong>{{ $message->subject }} </strong> 
      @if($message->created_at !== $message->updated_at)
       <i class="fa fa-pencil text-secondary" title="Editted"></i>
      @endif
      <br>
      <span class="label label-default small text-muted text-left">{{ $message->updated_at }}</span>
      <br>

      {!! $message->message !!}
      <br>

      @if($message->attachment)
      <a href="{{ $message->attachment }}" target="_blank" class="label label-success">{{ __("View Attachment") }}</a>
      @endif
    </li>

  @endforeach
@else
<li><h3>{{ __("No messages found.") }}</h3></li>
@endif


