/**
 * Created by Emerald on 5/2/2018.
 */
function Project(id, title, url, playlists) {
    this.id = id;
    this.title = title;
    this.url = url;
    this.playlists = playlists;
}

function Playlist(id, title, videoclips, message, schedule, activated) {
    this.id = id;
    this.title = title;
    this.videoclips = videoclips;
    this.message = message;
    this.schedule = schedule;
    this.activated = activated;
}

function Schedule(id, start_time, end_time, endlss, days, months) {
    this.id = id;
    this.start_time = start_time;
    this.end_time = end_time;
    this.endlss = endlss;
    this.days = days.slice(0, -1).split(',');
    this.months = months.slice(0, -1).split(',');
}

function Videoclip(id, title, url, message) {
    this.id = id;
    this.title = title;
    this.url = url;
    this.message = message;
}

function Logo(id, url, position, xpos, ypos) {
    this.id = id;
    this.url = url;
    this.position = position;
    this.xpos = xpos;
    this.ypos = ypos;
}

function Message(id, text, effect, speed, duration, xpos, ypos, fonttype, fontsize, fontcolor, backcolor) {
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
    this.backcolor = backcolor;
}