import 'alpinejs'
import {Howl, Howler} from 'howler';

require('./bootstrap');
const _ = require('lodash');

window.player = function () {
    return {
        counter: 30,
        playing: false,
        gamemaster: false,
        scrambled: false,
        howl: false,
        playlist: [],
        played: [],
        init() {
            axios.get('/list/1')
                .then((response) => {
                    this.playlist = response.data
                    this.scramblePlaylist();

                    this.nextSong();

                    window.setInterval(() => {
                        this.counter = 30 - _.floor(this.howl.seek());
                    }, 100)
                });
        },
        play() {
            if (!this.playing) {
                this.howl.play();
                this.playing = true;
            }
        },
        pause() {
            if (this.playing) {
                this.howl.pause();
                this.playing = false;
            }
        },
        scramblePlaylist() {
            if (this.playlist) {
                this.playlist = _.shuffle(this.playlist);
                this.scrambled = true;
            }
        },
        nextSong() {
            if (this.howl)
                this.howl.unload();

            this.playing = false;

            let src = _.sample(this.playlist);
            console.log(src);

            _.remove(this.playlist, function(song){
                return song['id'] == src['id'];
            });

            this.howl = new Howl({
                src: src['url']
            });

            this.played.push(src);

            return true;
        },
        toggleGamemaster() {
            this.gamemaster = !this.gamemaster;
        }
    }
}

