<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        
    </head>
    <body>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>File</th>
            <th>File Details</th>
            <th>Download</th>
            <th>Rename</th>
        </tr>
        @foreach($data as $key => $file)
           <tr>
                <td> {{ $key +1}}</td>
                <td> 
                    @if( json_decode($file->file_details)->extension == 'jpg'|| json_decode($file->file_details)->extension == 'png')
                    <img src="http://10.10.1.66:8000/manager/api/download/{{ $file->file_name_hashcode }}" width="150px" height="150px"/>
                    @else
                        
                    @endif
                </td>
                <td> 
                    <ol>
                        <li><b>Filename</b>
                            <ul>
                                <li>{{ $file->file_name }}</li>
                            </ul>
                        </li>
                        <li><b>Hashcode</b>
                            <ul>
                                <li>{{ $file->file_name_hashcode }}</li>
                            </ul>
                        </li>
                        <li><b>Path</b>
                            <ul>
                                <li>{{ $file->file_path }}</li>
                            </ul>
                        </li>
                    </ol> 
                </td>
                <td> {{ Html::link('downloadFile/'.$file->file_name_hashcode, 'Download') }}</td>
                <td> 
                    {{ Form::open(['url'=>'renameFile', 'method'=>'POST']) }}
                    {{ Form::text('new_Filename') }}
                        {{ Form::hidden('hashCode', $file->file_name_hashcode ) }}
                    {{ Form::submit('Submit') }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>
