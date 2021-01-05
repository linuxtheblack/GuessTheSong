<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Aerni\Spotify\Exceptions\SpotifyApiException;
use App\Models\Song;
use Goutte\Client;
use Aerni\Spotify\Facades\SpotifyFacade as Spotify;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class gameController extends Controller
{
    public function index()
    {

        return view('welcome');
//        dd("Todo: add game-master panel");
    }

    public function list($id)
    {
        $playlist = Playlist::find($id);

        $songs = $playlist->songs()->get();

//        dd($songs);
        return $songs;
    }

    /**
     * Loads an spotify playlist
     *
     * @param $id - Spotify playlist ID
     */
    public function loadPlaylist($id = "58gvGBrJ2PrXEe4cWDrDVJ")
    {

        try {
            $spotify = Spotify::playlist($id)->get();
        } catch (SpotifyApiException $e) {
            dd($e->getMessage());
        }

        $playlist = new Playlist();
        $playlist->name = $spotify['name'];
        $playlist->link = $spotify['href'];
        $playlist->save();

        foreach ($spotify['tracks']['items'] as $item) {
            //Init
            $item = $item['track'];

            //Check if url is valid
            if (!$item['preview_url']) {
                $previewUrl = $this->fetchPreview($item['id']);
                $previewUrl = $previewUrl[0];
            } else {
                $previewUrl = $item['preview_url'];
            }

            dump($previewUrl);

            //Download song
            $fileName = Str::random(18) . '.mp3';
            $file = file_get_contents($previewUrl);
            Storage::disk('public')->put('songs/' . $fileName, $file);
            $path = Storage::disk('public')->url('songs/' . $fileName);

            //Save to the database
            $song = new Song();

            $song->name = $item['name'];
            $song->url = $path;
            $song->playlist_id = $playlist->id;
            $song->artist = $item['artists'][0]['name'];
            $song->save();
        }

    }

    /**
     * Fetches preview with a crawler
     * @param $id - Spotify song ID
     */
    private function fetchPreview($id)
    {
        $client = new Client();

        $crawler = $client->request('GET', 'https://open.spotify.com/embed/track/' . $id);
        return $crawler->filter('#resource')->each(function ($node) {
            $json = urldecode($node->text());
            $arr = json_decode($json, true);

            return $arr['preview_url'];
        });
    }
}
