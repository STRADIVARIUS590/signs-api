<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- {{ json_encode(get_defined_vars()) }} --}}

{{-- {{URL::asset($option->image_path)} --}}
    @foreach($categories as $category)
        <img src="{{URL::asset($category->im_path)}}" width="50px" height="50px">

        <p>{{ $category->name }}</p>
        <p>{{ $category->pivot['score'] }}</p >
        <p>{{ $category->pivot['total'] }}</p >
    @endforeach
</body>
</html>