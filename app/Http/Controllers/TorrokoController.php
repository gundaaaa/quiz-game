<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TorrokoController extends Controller
{
    public function index(Request $request)
    {
        // 問題をスタートする時間
        $starttime = time(); //秒数をもっと細かく出したい場合はmicrotimeを使う
        $request->session()->put('starttime', $starttime);


        // 指定したデータをセッションから削除する(正解数を一度リセットしている。)
        session()->forget('sucess_cnt');
        session()->forget('sucess_cnt2');
        // 1～10までの中の5個をランダムで取り出して、pluckでIdを取り出している。
        $quiztest = DB::table('quiz_choice')->whereBetween('id', [1, 5])->inrandomOrder()->limit(5)->get()->pluck('id');
        // ここでオブジェクトから配列に入れている。
        $quiztestarray = $quiztest->all();

        $request->session()->put('quizarray', $quiztestarray);


        // ここは2問目の表示
        $quiztest2 = DB::table('quiz_choice')->whereBetween('id', [6, 11])->inrandomOrder()->limit(5)->get()->pluck('id');
        $quiztestarray2 = $quiztest2->all();
        $request->session()->put('quizarray2', $quiztestarray2);

        return view("torroko.index");
    }

    public function quiz(Request $request)
    {
        $array = $request->session()->get('quizarray');
        // countの中に配列が入っていて、array_shiftで減らしているので、中身が0になったら終わり。
        // if (count($array) == 0) {
        //     return redirect('torroko');
        // }
        // $firstarrayには5個要素が合って、最初の一個を取り出して要素が入っている。
        $firstarray = array_shift($array);
        $id = $request->input('id');
        $quiztest = DB::table('quiz_choice')->where('id', $firstarray)->first();


        // 問題の配置を入れ替えている。
        $response = $quiztest->text;
        if (mt_rand(1, 2) == 1) {
            $response_left = ($quiztest->answer);
            $response_right = ($quiztest->miss);
        } else {
            $response_left = ($quiztest->miss);
            $response_right = ($quiztest->answer);
        }

        // DBから取り出した物をviewに渡す為に格納している。
        return view('torroko.quiz', [
            'id' => $id,
            'response' => $response,
            'response_left' => $response_left,
            'response_right' => $response_right,
        ]);
    }

    public function result(Request $request)
    {
        //sessionに保存されている5個をgetで取り出してくる。
        $array = $request->session()->get('quizarray');
        // $firstarrayには5個要素が合って、最初の一個を取り出して要素が入っている。
        $firstarray = array_shift($array);
        // array_shiftで一度取り出した物以外を再度sessionに入れなおす。
        $request->session()->put('quizarray', $array);

        $id = $request->input('id');

        // postで送られてくるnameの名前⇓とpostのvalueには上で表記した$response_leftか$response_rightが入っている。
        $answer = $request->input('answer');
        $quiztest = DB::table('quiz_choice')->where('id', $firstarray)->first();


        //セッションから正解数を取得 sessionはsession()->getでも使える。$request->が無くても使える。
        $sucess_cnt = session()->get('sucess_cnt', 0);

        // 正解のチェックを行う。
        if ($quiztest->answer == $answer) {
            $result = '正解';

            //正解数を1足す（インクリメント）
            $sucess_cnt++;
        } else {
            $result = '不正解';
        }

        //セッションに正数を保存する
        session()->put('sucess_cnt', $sucess_cnt);

        // 最後の問題を答えた時に最終結果に飛ぶようにしている。countで配列の中身が０になったらredirectでquiz_resultに飛ぶ
        if (count($array) == 0) {
            session()->put('result', $result);
            // 最終問題が終了の時間を所得している。
            $endtime = time();
            session()->put('endtime', $endtime);
            return redirect('quiz_result');
        }

        return view('torroko.result', [
            'result' => $result,
            'next' => $id + 1,
            //正解数を渡す
            'sucess_cnt' => $sucess_cnt,
        ]);
    }

    // 最後の問題を答えた時に飛ぶページをここで表示する。
    public function quiz_result()
    {
        $sucess_cnt = session()->get('sucess_cnt');
        $result = session()->get('result');
        $endtime = session()->get('endtime');
        $starttime = session()->get('starttime');

        return view('torroko.quiz_result', [
            'sucess_cnt' => $sucess_cnt,
            'result' => $result,
            'total' => $endtime - $starttime,
        ]);
    }

    // ここからは2問目の表示
    public function quiz2(Request $request)
    {
        $array2 = $request->session()->get('quizarray2');
        $quiztest2 = DB::table('quiz_choice')->where('id', $array2)->first();
        // URLの?=idのURLを取って来ているので('quiz')で囲んでいる。 a href=の所をみる。
        $id = $request->input('quiz');

        // 問題の配置を入れ替えている。
        $response = $quiztest2->text;
        if (mt_rand(1, 2) == 1) {
            $response_left = ($quiztest2->answer);
            $response_right = ($quiztest2->miss);
        } else {
            $response_left = ($quiztest2->miss);
            $response_right = ($quiztest2->answer);
        }

        return view('torroko.quiz2', [
            'id' => $id,
            'response' => $response,
            'response_left' => $response_left,
            'response_right' => $response_right,
        ]);
    }

    public function result2(Request $request)
    {
        $array2 = $request->session()->get('quizarray2');
        $firstarray2 = array_shift($array2);
        // array_shiftで一度取り出した物以外を再度sessionに入れなおす。
        $request->session()->put('quizarray2', $array2);
        // viewのname＝quizのところが大切 input type="hidden" name="quiz" value="<?php echo $id;
        $id = $request->input('quiz');


        // postで送られてくるnameの名前⇓とpostのvalueには上で表記した$response_leftか$response_rightが入っている。
        $answer = $request->input('answer');
        $quiztest = DB::table('quiz_choice')->where('id', $firstarray2)->first();


        //セッションから正解数を取得 sessionはsession()->getでも使える。$request->が無くても使える。
        $sucess_cnt2 = session()->get('sucess_cnt2', 0);

        // 正解のチェックを行う。
        if ($quiztest->answer == $answer) {
            $result = '正解';

            //正解数を1足す（インクリメント）
            $sucess_cnt2++;
        } else {
            $result = '不正解';
        }

        //セッションに正数を保存する
        session()->put('sucess_cnt2', $sucess_cnt2);

        // 最後の問題を答えた時に最終結果に飛ぶようにしている。countで配列の中身が０になったらredirectでquiz_resultに飛ぶ
        if (count($array2) == 0) {
            session()->put('result', $result);
            $endtime2 = time();
            session()->put('endtime', $endtime2);
            return redirect('quiz_result2');
        }


        return view('torroko.result2', [
            'result' => $result,
            'next' => $id + 1,
            //正解数を渡す
            'sucess_cnt' => $sucess_cnt2,
        ]);
    }
    public function quiz_result2()
    {
        $sucess_cnt2 = session()->get('sucess_cnt2');
        $result = session()->get('result');
        $endtime2 = session()->get('endtime');
        $starttime2 = session()->get('starttime');

        return view('torroko.quiz_result2', [
            'result' => $result,
            'sucess_cnt' => $sucess_cnt2,
            'total' => $endtime2 - $starttime2
        ]);
    }
}
