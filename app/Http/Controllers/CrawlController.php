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
    public function index()
    {
        $links = $this->_getLinks();
        foreach ($links as $key => $link) {
            $url = 'http://www.xn--t-in-1ua7276b5ha.com'.$link;
            echo $url.'<br>';
            // $url = 'http://www.xn--t-in-1ua7276b5ha.com/d%E1%BA%A5u%20ch%E1%BA%A5m%20ph%E1%BA%A9y';
            $this->_create($url);
        }
    }

    private function _getLinks()
    {
        $client = new Client(['base_uri' => 'http://www.xn--t-in-1ua7276b5ha.com/']);
        $response = $client->get('http://www.xn--t-in-1ua7276b5ha.com/A/');
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
