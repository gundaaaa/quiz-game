@extends('layouts.todo')
@section('title','quizゲーム')
<style>
    p{
        font-size:25px;
    }
    </style>
<html>
<body>
    
    <p>クイズ①</p>
    <img src="/icon/quiz_man_batsu.png" alt=" " width="200" height="200"> <input type='button' value='スタート' onclick="location.href='quiz?id=1'"></input>

    <P>クイズ②</P>
    <img src="/icon/quiz_man_maru.png" alt=" " width="200" height="200"><input type='button' value='スタート' onclick="location.href='quiz2?quiz=1'"></input>
   
    @section('footer')
    2021 quizゲーム
    @endsection
</body>

</html>