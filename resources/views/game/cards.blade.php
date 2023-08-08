<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- jsDelivr :: Sortable :: Latest (https://www.jsdelivr.com/package/npm/sortablejs) -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
{{-- 
    <p>{{$question}}</p> --}}
        <p>{{$question->text}}</p>      
   <div class="row" id="maintablediv">
        @foreach ($options as $option)
        <div class="card" style="width: 18rem;" data-id="{{$option->id}}" onclick="_select(this)" >
        <img class="card-img-top"  src="{{URL::asset($option->image_path)}}" alt="Card image cap"  >
            <div class="card-body">
                <h3 class="card-title">{{$option->meaning}}</h3>
            </div>
        </div>
    @endforeach
    <div>
</body>
   {{--   <form action="{{('api/v1/questions/validate')}}" method="post">
        @csrf
        <input type="hidden" name="streak_token" value="{{$streak_token}}">
        <input type="text" id='submiting_answer' value="" name="answer">
        <input type="submit">
    </form> --}}
</html>

<script>
    function _select(el){
        let id = (el.getAttribute('data-id'));
        document.getElementById('submiting_answer').value = (id)
    } 
</script>

{{-- @if ($question->answer_type == 'MANY')  --}}
<script>
    // let sorts;
    new Sortable(maintablediv, {
        animation: 150,
        ghostClass: 'text-primary',
        store:{
            set: function(sortable){
                const sorts = sortable.toArray()
                console.log(sorts);
            }
        }
    });

</script>

<script>

//  {{-- @endif --}}