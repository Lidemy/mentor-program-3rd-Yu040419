const request = new XMLHttpRequest();
const liveBlock = document.querySelector('#block');

request.open('GET', 'https://api.twitch.tv/kraken/streams/?game=League%20of%20Legends&limit=20');
request.setRequestHeader('Accept', 'application/vnd.twitchtv.v5+json');
request.setRequestHeader('Client-ID', 'tnfxhswpvu8q8qz8gv2s7ao6gyzhht');
request.onload = () => {
  if (request.status >= 200 && request.status < 400) {
    const json = JSON.parse(request.responseText);
    const stream = json.streams;
    for (let i = 0; i < 20; i += 1) {
      const div = document.createElement('div');
      div.classList.add('filter');
      liveBlock.appendChild(div);
      div.innerHTML = `
        <a href="${stream[i].channel.url}" target="_blank"><img src="${stream[i].preview.large}" class="pic"/></a>
        <div class="streams">
          <img class="streams__avatar" src="${stream[i].channel.logo}"/>
          <div class="streams__details">
            <div class="streams__details--status">${stream[i].channel.status}</div>
            <div class="streams__details--host">${stream[i].channel.name}</div>
          </div>
        </div>`;
    }
  } else {
    alert('系統不穩定，請再重整一次');
  }
};

request.send();
