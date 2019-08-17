@foreach ($arrFoldersList as $objFolder)
<li class="list-group-item" id="custom_folder_{{$objFolder->id}}">
    <a data-name='{{$objFolder->name}}' data-id="{{$objFolder->id}}" href="#">
        <span>{{$objFolder->name}}</span>
    </a>
    <button type="button" class="btn-link dropdown-toggle pull-right" data-toggle="dropdown">
        <i class="glyphicon glyphicon-chevron-down"></i>
    </button>
    <ul data-id="{{$objFolder->id}}" class="dropdown-menu dropdown-menu-right align-right animation-zoom" role="menu" style="text-align: left;">
        <li><a id="edit_folder" href="#">Edit</a></li>
        <li><a id="remove_folder" href="#">Remove</a></li>
        <li><a id="archive_folder" href="#">Archive</a></li>

    </ul>
</li>
@endforeach

