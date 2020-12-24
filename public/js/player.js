var player = videojs('video') //videojs je globalna funkcija kad ukljucimo vjs skript

var viewLogged = false

player.on('timeupdate', function() {
    var percentagePlayed = Math.ceil(player.currentTime() / player.duration() * 100)

    if (percentagePlayed > 5 && !viewLogged) {
        axios.put('/videos/' + window.CURRENT_VIDEO) //ne mozemo koristiti E6 verziju js-a, zbog Babel-a
        
        viewLogged = true
    }
})