<?php

/**
 * This is model for working with cerlingo.com API
 */
class CerlingoApiMdl
{
    private $apiToken;
    private $cUrl;
    private $cerlingoList;

    /*
     * Key is language ID on Cerlingo API
     * Value is your local language ID
     * You should fill in the value with your local language IDs. 
     * Otherwise you can leave them as they are but then you will need to send them into the methods already converted into Cerlingo language ID.
     */
    private $availablelangs = array(
        1 => 1, //Abkhazian
        2 => 2, //Afar
        3 => 3, //Afrikaans
        4 => 4, //Albanian
        5 => 5, //Amharic
        6 => 6, //Arabic
        7 => 7, //Armenian
        8 => 8, //Assamese
        9 => 9, //Aymara
        10 => 10, //Azerbaijani
        11 => 11, //Bashkir
        12 => 12, //Basque
        13 => 13, //Bengali
        14 => 14, //Bhutani
        15 => 15, //Bihari
        16 => 16, //Bislama
        17 => 17, //Breton
        18 => 18, //Bulgarian
        19 => 19, //Burmese
        20 => 20, //Belarusian
        21 => 21, //Cambodian
        22 => 22, //Catalan
        23 => 23, //Chinese(simplified)
        24 => 24, //Corsican
        25 => 25, //Croatian
        26 => 26, //Czech
        27 => 27, //Danish
        28 => 28, //Dutch
        29 => 29, //English
        30 => 30, //Esperanto
        31 => 31, //Estonian
        32 => 32, //Faeroese
        33 => 33, //Fiji
        34 => 34, //Finnish
        35 => 35, //French
        36 => 36, //French(Canadian)
        37 => 37, //Frisian
        38 => 38, //Gaelic( Scots Gaelic)
        39 => 39, //Galician
        40 => 40, //Georgian
        41 => 41, //German
        42 => 42, //Greek
        43 => 43, //Greenlandic
        44 => 44, //Guarani
        45 => 45, //Gujarati
        46 => 46, //Hausa
        47 => 47, //Hebrew
        48 => 48, //Hindi
        49 => 49, //Hungarian
        50 => 50, //Icelandic
        51 => 51, //Indonesian
        52 => 52, //Interlingua
        53 => 53, //Interlingue
        54 => 54, //Inupiak
        55 => 55, //Irish
        56 => 56, //Italian
        57 => 57, //Japanese
        58 => 58, //Javanese
        59 => 59, //Kannada
        60 => 60, //Kashmiri
        61 => 61, //Kazakh
        62 => 62, //Kinyarwanda
        63 => 63, //Kirghiz
        64 => 64, //Kirundi
        65 => 65, //Korean
        66 => 66, //Kurdish
        67 => 67, //Laothian
        68 => 68, //Latin
        69 => 69, //Latvian,Lettish
        70 => 70, //Lingala
        71 => 71, //Lithuanian
        72 => 72, //Macedonian
        73 => 73, //Malagasy
        74 => 74, //Malay
        75 => 75, //Malayalam
        76 => 76, //Maltese
        77 => 77, //Maori
        78 => 78, //Marathi
        79 => 79, //Moldavian
        80 => 80, //Mongolian
        81 => 81, //Nauru
        82 => 82, //Nepali
        83 => 83, //Norwegian
        84 => 84, //Occitan
        85 => 85, //Oriya
        86 => 86, //Oromo,Afan
        87 => 87, //Pashto,Pushto
        88 => 88, //Persian
        89 => 89, //Polish
        90 => 90, //Portuguese(Portugal)
        91 => 91, //Portuguese(Brazil)
        92 => 92, //Punjabi
        93 => 93, //Quechua
        94 => 94, //Rhaeto-Romance
        95 => 95, //Romanian
        96 => 96, //Russian
        97 => 97, //Samoan
        98 => 98, //Sangro
        99 => 99, //Sanskrit
        100 => 100, //Serbian
        101 => 101, //Serbo-Croatian
        102 => 102, //Sesotho
        103 => 103, //Setswana
        104 => 104, //Shona
        105 => 105, //Sindhi
        106 => 106, //Singhalese
        107 => 107, //Siswati
        108 => 108, //Slovak
        109 => 109, //Slovenian
        110 => 110, //Somali
        111 => 111, //Spanish
        112 => 112, //Spanish (Latin American)
        113 => 113, //Spanish(Latam)
        114 => 114, //Sudanese
        115 => 115, //Swahili
        116 => 116, //Swedish
        117 => 117, //Tagalog
        118 => 118, //Tajik
        119 => 119, //Tamil
        120 => 120, //Tatar
        121 => 121, //Tegulu
        122 => 122, //Thai
        123 => 123, //Tibetan
        124 => 124, //Tigrinya
        125 => 125, //Tonga
        126 => 126, //Tsonga
        127 => 127, //Turkish
        128 => 128, //Turkmen
        129 => 129, //Twi
        130 => 130, //Ukrainian
        131 => 131, //Urdu
        132 => 132, //Uzbek
        133 => 133, //Vietnamese
        134 => 134, //Volapuk
        135 => 135, //Welsh
        136 => 136, //Wolof
        137 => 137, //Xhosa
        138 => 138, //Yiddish
        139 => 139, //Yoruba
        140 => 140, //Zulu
        141 => 141, //Chinese(traditional)
        142 => 142, //Igbo
    );

    /*
     * Key is language ID on Cerlingo API
     * Value is your local language ID
     */
    private $areasOfExpertise = array(
        1 => 1, //General
        2 => 2, //Legal
        3 => 3, //LifeSciences
        4 => 4, //Religious
        5 => 5, //Technical
        6 => 6, //Financial
        7 => 7, //Politics
    );

    function __construct($key) 
    {
        $this->cUrl = 'http://cerlingo.com/api/';
        $this->apiToken = $key;
    }

    function langConvert($lId)
    {
        return array_search($lId, $this->availablelangs);
    }

    function areasConvert($aoe)
    {
        return array_search($aoe, $this->areasOfExpertise);
    }

    function langDeconvert($lKey)
    {
        return $this->availablelangs[$lKey];
    }

    function areasDeconvert($aKey)
    {
        return $this->areasOfExpertise[$aKey];
    }

    public function getTest($langs, $aoeR = 1) //AoE default is General
    {
        $lang1 = !empty($langs['from']) ? "&language_1=" . $this->langConvert($langs['from']) : "";
        $lang2 = !empty($langs['to']) ? "&language_2=" . $this->langConvert($langs['to']) : "";
        $aoe = !empty($aoeR) ? "&aoe=" . $this->areasConvert($aoeR) : "";
        $testType = $this->areasConvert($aoeR) == 1 ? "&test_type=2" : "&test_type=2";
        $redirectUrl = $this->cUrl . "test?token=" . $this->apiToken . $lang1 . $lang2 . $aoe . $testType;

        $resp = json_decode(file_get_contents($redirectUrl));

        return $resp;
    }

    public function getTestById($tId) // If you know test ID, you can get it by this method.
    {
        $redirectUrl = $this->cUrl . "test?token=" . $this->apiToken . "&test_id=" . $tId;

        $resp = json_decode(file_get_contents($redirectUrl));

        return $resp;
    }

    public function getTestsList() //It returns all the possible tests for account.
    {
        $lang1 = !empty($langs['from']) ? "&language_1=" . $this->langConvert($langs['from']) : "";
        $lang2 = !empty($langs['to']) ? "&language_2=" . $this->langConvert($langs['to']) : "";
        $aoe = !empty($aoe) ? "&aoe=" . $this->areasConvert($aoe) : "";
        $redirectUrl = $this->cUrl . "list_of_tests?token=" . $this->apiToken . $lang1 . $lang2 . $aoe; //&language_1=" . $langs['from'] . "&language_2=" . $langs['to'] . "";

        $json = file_get_contents($redirectUrl);
        $resp = json_decode($json);

        return $resp;
    }

    /*
     *   $data['name'] "Test name" /String
     *   $data['test_id'] Test ID /Int
     *   $data['email']
     *   $data['date_started']
     *   $data['date_passed']
     *   $data['answers'] /Array, where key is question ID and value is answer ID
     */
    public function checkPretest($data)
    {
        $redirectUrl = $this->cUrl . "pretest_check?token=" . $this->apiToken;
        $curl = curl_init();
        $req = $redirectUrl . '&' . http_build_query($data);
        curl_setopt_array(
            $curl, array(
                CURLOPT_URL => $redirectUrl . '&' . http_build_query($data),
                CURLOPT_RETURNTRANSFER => 1,
            )
        );
        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp); //array ('result' => 'passed'). Can by "passed" or "failed"
    }


    /*
     *   $data['name'] "Test name" /String
     *   $data['test_id'] Test ID /Int
     *   $data['test_type'] /String
     *   $data['email']
     *   $data['date_started'] date format: "Y-m-d H:i:s" /String
     *   $data['date_passed'] date format: "Y-m-d H:i:s" /String
     *   $data['answers'] /Array, where key is question ID and value is translated text
     */

    /*
     *It returns Array where "unique_id" is unique identifier of passed test that you will get after the checking of this test with the result of the checking.
    */  
    public function checkTest($data)
    {
        $redirectUrl = $this->cUrl . "test_answers?token=" . $this->apiToken;
        $curl = curl_init();
        $req = $redirectUrl . '&' . http_build_query($data);
        //var_dump($req);
        curl_setopt_array(
            $curl, array(
                CURLOPT_URL => $redirectUrl . '&' . http_build_query($data),
                CURLOPT_RETURNTRANSFER => 1,
            )
        );
        $resp = curl_exec($curl);
        curl_close($curl);
        return json_decode($resp);
    }

    /*
     * 
     */
    public function testResults($get)
    {
        $uniqueId = $get['unique_id']; 
        $result = $get['result']; //Result of test. Can by "passed" or "failed"

        $resp = array(
            'unique_id' => $uniqueId,
            'result' => $result,
        );

        return $resp;
    }
}
