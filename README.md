
## cerlingo-api
Cerlingo_api


##The Cerlingo API uses the following error codes:

###Error Code	Meaning

Code | Description
--------- | -------
`400`|	Bad Request  – Your request is invalid
`401`	| Unauthorized – Your API key is wrong
`402`	| Payment Required – Your subscription has lapsed
`403`	| Forbidden – The resource requested is hidden for administrators only
`404`	| Not Found – The specified resource could not be found
`422`	| Unprocessable Entity – There was an issue parsing your json
`429`	| Too Many Requests – You are allowed 300 requests per 300 seconds.
`500`	| Internal Server Error – We had a problem with our server. Try again later.
`503`	| Service Unavailable (Time out) – The server is overloaded or down for maintenance.


##List of Test
Send your unique token at this url http://dev.cerlingo.com/api/list_of_tests?token="Your token",


##If you need to get test questions 
Send your detail_of_test at this url  http://dev.cerlingo.com/api/test?token="Your_token&language_1="from_language_id"&language_2=to_language_id&aoe="aoe_id"&test_type="test_id",

##Example 

        $detail_of_test['token'] = 'token';
        $detail_of_test['language_1'] = "from_language_id";
        $detail_of_test['language_2'] ="to_language_id";
        $detail_of_test['aoe'] = "aoe_id";
        $detail_of_test['test'] = "test_id";

        $redirectUrl = $this->_url . "/test?token=" . $detail_of_test['token'] . "&language_1=" . $detail_of_test['language_1'] . "&language_2=" . $detail_of_test['language_2'] . "&aoe=" . $detail_of_test['aoe'] . "&test_type=" . $detail_of_test['test'];


##If you have done test, send your answers at this url 
 http://dev.cerlingo.com/api/test_answers?token="Your_token"
 Example

        $info['name'] = 'name';
        $info['test_type'] = "Translation";
        $info['test_id'] = 134;
        $info['email'] = 'email';
        $info['date_started'] = Carbon::now()->format("Y-m-d H:i:s");
        $info['date_passed'] = Carbon::now()->format("Y-m-d H:i:s");
        $test_answers = 'translated_text';
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

    
##If you have done pre-test, send your answers at this url 
 http://dev.cerlingo.com/api/pretest_check?token="Your_token"
 Example

        $info['language_1'] = 'English';
        $info['language_2'] = 'German';
        $info['name'] ='name';
        $info['test_id'] = 134;
        $info['email'] ='email';
        $info['date_started'] = Carbon::now()->format("Y-m-d H:i:s");
        $info['date_passed'] = Carbon::now()->format("Y-m-d H:i:s");
        $pretest_answers = 'answer_checked';
  
        foreach ($pretest_answers as $pretest_answer) {


            $answers[] = $pretest_answer;
            //Where $pretest_answer is a questions id; 
        }
        $info['answers'] = $answers;
      
        $redirectUrl = $this->_url . "/pretest_check?token=" . $this->_apiToken;

        $this->curl = curl_init();
        curl_setopt_array(
                $this->curl, [
            CURLOPT_URL => $redirectUrl . '&' . http_build_query($info),
                ]
        );
     
        $answer = curl_exec($this->curl);

    
    
    
    
    
