<?php

namespace App\Http\Controllers;

use App\Word;
use App\Meaning;
use App\Author;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class CrawlController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getInputWebsite() {
        return view('admin.crawlers.website_url');
    }

    public function getData(Request $request)
    {
        $request->validate([
            'regex' => 'required',
            'urls' => 'required',
        ]);
        $urls = trim($request->input('urls'));
        $regex = trim($request->input('regex'));
        $checkbox = trim($request->input('checkbox'));
        // convert textarea string into array
        $urls = explode("\n", str_replace("\r", "", $urls));
        $results = array();
        $TotalWordAndMeaningArray = $this->UrlAndRegex($urls, $regex, $checkbox);
        // action case
        $request->session()->forget('status');
        if(isset($checkbox) &&  $checkbox) {
            $request->session()->flash('status', 'success!');
        }
        return view('admin.crawlers.website_url')->with('urls', $request->input('urls'))
                                                    ->with('regex', $request->input('regex'))
                                                    ->with('results', $TotalWordAndMeaningArray); 
    }

    public function UrlAndRegex($urls, $regex, $checkbox) {
        $TotalWordAndMeaningArray = array();
        foreach ($urls as $url) {
            $WordAndMeaningArray = $this->getWordAndMeaning($url, $regex);
            if(isset($checkbox) &&  $checkbox) {
                foreach ($WordAndMeaningArray as $word => $meaning) {
                    $this->createWordMeaningAuthor($word, $meaning, $url);
                }
            }
            $TotalWordAndMeaningArray = $TotalWordAndMeaningArray + $WordAndMeaningArray;
        }
        return $TotalWordAndMeaningArray;
    }
    // get word and meaning array
    public function getWordAndMeaning($url = null, $regex = null) {
        $crawler = file_get_contents($url);
        // $regex = '#<strong>(.+?)</strong>(.+?)</li>#is'; 
        $regex = '#'.$regex.'#is'; 
        preg_match_all($regex, $crawler, $matches);
        $results = $this->_test($matches[1], $matches[2]);
        return $results;
    }

    // convert to result array
    public function _test($a = array(), $b = array())
    {
        $res = array();
        foreach($a as $k => $v){
            $v = remove_text($v);
            $res[$v] = remove_text($b[$k]);
        }
        return $res;
    }

    /*
    * create authors, words, meanings
    */
    public function createWordMeaningAuthor($word = null, $meaning = null, $url) {
        if(!empty($word) && !empty($meaning)) {
            $parse = parse_url($url);
            $domain =  $parse['host'];
            $author_id = $this->_author(trim($domain));
            $core_name  = vi_slug($word);
            $data = Word::row($core_name);
            $dataArray = $data->toArray();
            if(empty($dataArray)) 
            {
                $connection = new Word;
                $connection->word_name = $word;
                $connection->core_name = $core_name;
                $test = $connection->save();
                $this->createMeaning($connection->id, $author_id, $meaning);
            } else {
                $wordArray = $dataArray[0];
                $word_id = $wordArray['id'];
                $this->createMeaning($word_id, $author_id, $meaning);
            } 
        }
    }
    public function index()
    {
        foreach (range('B', 'Z') as $char) {
            $url = "http://www.xn--t-in-1ua7276b5ha.com/".$char."/";
            $links = $this->_getLinks($url);
            foreach ($links as $key => $link) {
                $pos = strpos($link, '?');
                if ($pos === false) {
                    $url = 'http://www.xn--t-in-1ua7276b5ha.com'.$link;
                    echo $url.'<br>';
                    $this->_create($url); 
                }
            }
        } 
        return view('admin/crawls');
    }

    private function _getLinks($url)
    {
        $client = new Client(['base_uri' => 'http://www.xn--t-in-1ua7276b5ha.com/']);
        $response = $client->get($url);
        $body = $response->getBody();
        $remainingBytes = $body->getContents();
        $crawler = new Crawler($remainingBytes);
        $crawler = $crawler->filter('#browseby')->children();
        $array = array();
        foreach ($crawler as $domElement) {
            $domElement = new Crawler($domElement);
            foreach ($domElement->children() as $i => $node) {
               // extract the value
                $array[] =  $node->getAttribute( 'href' );
                // echo $node->getAttribute( 'href' ).'<br>';
            }
        }
        return $array;
    }

    private function _create($url = null)
    {
        $client = new Client(['base_uri' => 'http://www.xn--t-in-1ua7276b5ha.com/']);
        $response = $client->get($url);
        $body = $response->getBody();
        $remainingBytes = $body->getContents();
        $crawler = new Crawler($remainingBytes);
        $data = $crawler->filter('tr td[style="line-height:20px;"]');
        $rows = array();
        foreach ($data as $domElement) {
            $tds = array();
            $domElement = new Crawler($domElement);
            foreach ($domElement->children() as $i => $node) {
               // extract the value
                // echo $node->nodeValue . ' '.$i.'<br>';
                if($i == 1) 
                {
                    $tds['word'] = trim($node->nodeValue);
                }
                if($i == 3)
                {
                    $tds['meaning'] = trim($node->nodeValue);
                }
                if($i == 5)
                {
                    $tds['author'] = str_is('Nguồn:*', trim($node->nodeValue)) ? str_replace_first('Nguồn:', '', trim($node->nodeValue)) : null;
                }
            }
            $rows[] = $tds;
        }
        if(isset($rows) && !empty($rows))
        {
            foreach ($rows as $key => $value) {
                $value['word'] = isset($value['word']) ? $value['word'] : null;
                $value['meaning'] = isset($value['meaning']) ? $value['meaning'] : null;
                $value['author'] = isset($value['author']) ? $value['author'] : null;
                // author id
                $author_id = $this->_author(trim($value['author']));
                $core_name  = vi_slug($value['word']);
                $data = Word::row($core_name);
                $dataArray = $data->toArray();
                if(empty($dataArray)) 
                {
                    $connection = new Word;
                    $connection->word_name = $value['word'];
                    $connection->core_name = $core_name;
                    $test = $connection->save();

                    $CreateMeaning = new Meaning;
                    $CreateMeaning->word_id = $connection->id;
                    $CreateMeaning->author_id = $author_id;
                    $CreateMeaning->meaning_meaning = $value['meaning'];
                    $CreateMeaning->meaning_like = rand(0,30);
                    $CreateMeaning->meaning_dislike = rand(0,30);
                    $CreateMeaning->save();
                } else {
                    $wordArray = $dataArray[0];
                    $word_id = $wordArray['id'];
                    $CreateMeaning = new Meaning;
                    $CreateMeaning->word_id = $word_id;
                    $CreateMeaning->author_id = $author_id;
                    $CreateMeaning->meaning_meaning = $value['meaning'];
                    $CreateMeaning->meaning_like = rand(0,30);
                    $CreateMeaning->meaning_dislike = rand(0,30);
                    $CreateMeaning->save();
                }               
            }
        }
    }

    private function _author($name) {
        $data = Author::search($name);
        $dataArray = $data->toArray();
        if(empty($dataArray))
        {
            $connection = new Author;
            $connection->author_name = $name;
            $connection->save();
            return $connection->id;
        } else {
            $author = $dataArray[0];
            return $author['id'];            
        }
    }

    private function createMeaning($word_id, $author_id, $meaning) {
        $checkMeaning = Meaning::search($word_id, $author_id);
        $MeaningArray = $checkMeaning->toArray();
        if(empty($MeaningArray)) {
            $CreateMeaning = new Meaning;
            $CreateMeaning->word_id = $word_id;
            $CreateMeaning->author_id = $author_id;
            $CreateMeaning->meaning_meaning = $meaning;
            $CreateMeaning->meaning_status = 0;
            $CreateMeaning->meaning_like = rand(0,30);
            $CreateMeaning->meaning_dislike = rand(0,30);
            $CreateMeaning->save();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $value = $request->session()->get('key');
        echo $value;
        $request->session()->put('key', '1234');
        echo $request->session()->get('key');
    }

}
