<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;

class CerlingoController extends Controller {

    public function __construct() {

        $this->_apiToken = config('services.cerlingo.token');
        $this->_url = 'http://dev.cerlingo.com/api';
    }

    public function test(Request $request) {

        $list_of_tests['token'] = $this->_apiToken;
        $list_of_tests['language_1'] = $request->from_language;
        $list_of_tests['language_2'] = $request->to_language;
        $list_of_tests['aoe'] = $request->aoe;
        $list_of_tests['test'] = $request->test;

        $redirectUrl = $this->_url . "/test?token=" . $list_of_tests['token'] . "&language_1=" . $list_of_tests['language_1'] . "&language_2=" . $list_of_tests['language_2'] . "&aoe=" . $list_of_tests['aoe'] . "&test_type=" . $list_of_tests['test'];
        $json = json_decode(file_get_contents($redirectUrl), true);

        if (!isset($json['error'])) {



//        if (isset($json['Translation']['Pretest'])) {
//           
//        } else {
            $Translation = $json['Translation']['Translation'];
//        }
        }
        $config_aoes = ['' => 'Subject Area'];
        $config_tests = ['' => 'Test types'];
        $config_from_languages = ['' => 'Source Language'];
        $config_to_languages = ['' => 'Target Language'];
        $composed_all_tests = ['' => 'Test Name'];
        return view('backend.organization.dashboard', compact('Pretest', 'Translation', 'config_from_languages', 'config_to_languages', 'config_aoes', 'config_tests', 'composed_all_tests'));
    }

    public function listOfTests(Request $request) {

        $list_of_tests['token'] = $this->_apiToken;
        $list_of_tests['language_1'] = "English";
        $list_of_tests['language_2'] = "German";
        $redirectUrl = $this->_url . "/list_of_tests?token=" . $list_of_tests['token'] . "&language_1=" . $list_of_tests['language_1'] . "&language_2=" . $list_of_tests['language_2'];
//        $redirectUrl = $this->_url . "/test?token=" . $list_of_tests['token'] . "&language_1=" . $list_of_tests['language_1'] . "&language_2=" . $list_of_tests['language_2'];
//      
        $json = json_decode(file_get_contents($redirectUrl), true);

//        $Translation = $json['Translation']['Translation'];

        $config_aoes = ['' => 'Subject Area'] + $json['aoes'];
        $config_tests = ['' => 'Test types'] + $json['tests_type'];
        $config_from_languages = ['' => 'Source Language'] + $json['from_languages'];
        $config_to_languages = ['' => 'Target Language'] + $json['to_languages'];
        $composed_all_tests = ['' => 'Test Name'] + $json['all_tests'];

        return view('backend.organization.dashboard', compact('Translation', 'config_from_languages', 'config_to_languages', 'config_aoes', 'config_tests', 'composed_all_tests'));
    }

    public function testsResult(Request $request) {

        $list_of_tests['token'] = $this->_apiToken;

        $redirectUrl = $this->_url . "/tests_result?token=" . $list_of_tests['token'];
        $json = json_decode(file_get_contents($redirectUrl), true);
        $test_result = $json['test-result'];
        $config_aoes = ['' => 'Subject Area'];
        $config_tests = ['' => 'Test types'];
        $config_from_languages = ['' => 'Source Language'];
        $config_to_languages = ['' => 'Target Language'];
        $composed_all_tests = ['' => 'Test Name'];

        return view('backend.organization.dashboard', compact('test_result', 'Translation', 'config_from_languages', 'config_to_languages', 'config_aoes', 'config_tests', 'composed_all_tests'));
    }

    public function pretestCheck(Request $request) {

        $info['language_1'] = "language_1";
        $info['language_2'] = "language_2";
        $info['name'] = "name";
        $info['test_type'] = "Translation";
        $info['test_id'] = "id";
        $info['email'] = "test@gmail.com";
        $info['date_started'] = Carbon::now()->format("Y-m-d H:i:s");
        $info['date_passed'] = Carbon::now()->format("Y-m-d H:i:s");

        foreach ($pretest_answers as $pretest_answer) {

            $answers[] = $pretest_answer;
            //Where $pretest_answer is a questions id; 
        }
        $info['answers'] = $answers;
        $redirectUrl = $this->_url . "/pretest_check?token=" . $this->_apiToken;

        $this->curl = curl_init();
        curl_setopt_array(
                $this->curl, [
            CURLOPT_URL => $redirectUrl . '&' . http_build_query($questions),
                ]
        );
        $answer = curl_exec($this->curl);

        return redirect()->to('/home');
    }

    public function pretestGetDone(Request $request) {

        $token = $request->get('token');
        $user_id = $request->get('unique_id');
        $answer = $request->get('answer');
    }

    public function testAnswers(Request $request) {

        $info['name'] = $request->name;
        $info['test_type'] = "Translation";
        $info['test_id'] = 134;
        $info['email'] = $request->email;
        $info['date_started'] = Carbon::now()->format("Y-m-d H:i:s");
        $info['date_passed'] = Carbon::now()->format("Y-m-d H:i:s");
        $test_answers = $request->translated_text;
        foreach ($test_answers as $key => $test_answer) {

            $answers[$key] = $test_answer;
            //Where $key is a questions id; 
            //Where $test_answer is a source text; 
        }

        $info['answers'] = $answers;
        $redirectUrl = $this->_url . "/test_answers?token=" . $this->_apiToken;

        $this->curl = curl_init();
        curl_setopt_array(
                $this->curl, [
            CURLOPT_URL => $redirectUrl . '&' . http_build_query($info),
                ]
        );
        $answer = curl_exec($this->curl);
//        if ($answer == true) {
//            echo "Success";
//        } else {
//            echo "Error";
//        }
//
//
//        return redirect()->to('/home');
    }

    public function testGetDone(Request $request) {

        $token = $request->get('token');
        $user_id = $request->get('unique_id');
        $answer = $request->get('answer');
    }

}
