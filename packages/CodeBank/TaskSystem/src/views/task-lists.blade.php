@if(!empty($arrTasksList))
@foreach ($arrTasksList as $objTask)

{{--*/$bollIsCompleted = 0/*--}}
@if($objTask->is_completed)
{{--*/$bollIsCompleted = 1/*--}}
@endif
<div class="row">
    <div class="col-xs-12">
        <div class="borderBottom marBot10" id="task_{{$objTask->id}}">
            <div class="row">
                <div class="text col-xs-9">
                    <button type="button" class="btn-link dropdown-toggle pull-left" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-chevron-down "></i>
                    </button>
                    @if(!$bollIsCompleted)
                    <ul class="dropdown-menu animation-zoom" role="menu" style="text-align: left;" data-id="{{$objTask->id}}">
                        <li><a id="complete_task" href="#">Edit</a></li>
                        <li><a id="complete_task" href="#">Complete</a></li>
                        <li><a id="remove_task" href="#">Remove</a></li>
                    </ul>
                    @endif
                    <span class="text-left task_title">{{$objTask->title}} </span>
                </div>
                <div class="text col-xs-3">

                    <span class="text-right due_date">{{('' != $objTask->due_date) ? date('jS M\' y', strtotime($objTask->due_date)): 'no due date'}}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@else
<div class="row">
    <div class="col-xs-12">
        <span class='text-lg'><center>No Tasks To Display</center></span>
    </div>
</div>
@endif