<!DOCTYPE html>
<html>
<head>
	<title>User list - PDF</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<div class="container" style="margin: 10px">
	<form method="POST" action="{{ route('generator')}}">
		{{ csrf_field() }}
		<input type="text" name="url">
		<select name = type>
			<option value="pdf">PDF</option>
			<option value="jpg">JPG</option>
		</select>
		<input type="submit" value="Generator">
	</form>
	<br>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(isset($type))
        @if($type == 'jpg' || $type == 'png' || $type == 'gif' || $type == 'jpeg')
            <img src="{{ asset("uploads/files/imgFile.$type") }}" style="width: 100%; height: auto">
        @elseif($type == 'pdf')
            <embed src="{{ asset('/public/uploads/files/pdfFile.pdf') }}" type="application/pdf" width="100%" height="600px">
        @endif
    @endif
</div>
</body>
</html>