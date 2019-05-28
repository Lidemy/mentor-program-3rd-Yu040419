const request = require('request');

const topGames = {
  url: 'https://api.twitch.tv/helix/games/top',
  headers: {
    'Client-ID': '2gfwu3ulz87wfkstei13xyjlvoyox4',
  },
};

function callback(error, response, body) {
  if (!error && response.statusCode === 200) {
    const info = JSON.parse(body);
    info.data.forEach((element) => {
      console.log(`${element.id}`, `${element.name}`);
    });
  }
}

request(topGames, callback);
