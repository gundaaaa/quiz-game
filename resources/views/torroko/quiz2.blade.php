<html>
<title>torroko/quiz2</title>

<h1>クイズに答えてください。問題は全部で5問です。</h1>
<form method="POST" action="result2">
    <input type="hidden" name="quiz" value="<?php echo $id; ?>">
    <table>
        @csrf
        <div>
            <h4>第{{$id}}問 {{$response}}</h4>
        </div>
        <div>
            <input id="check-a" type="radio" name="answer" value="{{$response_left}}" checked>
            <label for="check-a">{{$response_left}}</label>
        </div>
        <div>
            <input id="check-b" type="radio" name="answer" value="<?php echo $response_right; ?>">
            <label for="check-b"><?php echo $response_right; ?></label>
        </div>
        <div>
            <input id="" type="submit" value="決定する">
        </div>
    </table>
</form>

</html>