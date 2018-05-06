/**
 * Created by Emerald on 5/2/2018.
 */
function Project(id, title, url, playlists) {
    this.id = id;
    this.title = title;
    this.url = url;
    this.playlists = playlists;
}

function Playlist(id, title, videoclips, message) {
    this.id = id;
    this.title = title;
    this.videoclips = videoclips;
    this.message = message;
}

function Videoclip(id, title, url, message) {
    this.id = id;
    this.title = title;
    this.url = url;
    this.message = message;
}

function Message(id, text, effect, speed, duration, xpos, ypos, fonttype, fontsize, fontcolor) {
    this.id = id;
    this.text = text;
    this.effect = effect;
    this.speed = speed;
    this.duration = duration;
    this.xpos = xpos;
    this.ypos = ypos;
    this.message = message;
    this.fonttype = fonttype;
    this.fontsize = fontsize;
    this.fontcolor = fontcolor;
}