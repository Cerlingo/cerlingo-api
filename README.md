# cerlingo-api
Cerlingo_api

Errors

The Cerlingo API uses the following error codes:

Error Code	Meaning
400	Bad Request – Your request is invalid
401	Unauthorized – Your API key is wrong
402	Payment Required – Your subscription has lapsed
403	Forbidden – The resource requested is hidden for administrators only
404	Not Found – The specified resource could not be found
422	Unprocessable Entity – There was an issue parsing your json
429	Too Many Requests – You are allowed 300 requests per 300 seconds.
500	Internal Server Error – We had a problem with our server. Try again later.
503	Service Unavailable (Time out) – The server is overloaded or down for maintenance.


List of Test

How to make a request to get a list of test

Send your unique token at this url http://dev.cerlingo.com/api/list_of_tests?token="Your token",



Send your detail_of_test at this url  http://dev.cerlingo.com/api/test?token="Your token&language_1="from_language_id"&language_2=to_language_id&aoe="aoe_id"&test_type="test_id",

Example 
 $detail_of_test['token'] = $this->_apiToken;
        $detail_of_test['language_1'] = "from_language_id";
        $detail_of_test['language_2'] ="to_language_id";
        $detail_of_test['aoe'] = "aoe_id";
        $detail_of_test['test'] = "test_id";

        $redirectUrl = $this->_url . "/test?token=" . $detail_of_test['token'] . "&language_1=" . $detail_of_test['language_1'] . "&language_2=" . $detail_of_test['language_2'] . "&aoe=" . $detail_of_test['aoe'] . "&test_type=" . $detail_of_test['test'];



