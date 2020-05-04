const request = new XMLHttpRequest();
const prize = document.querySelector('.prize__name');
const pic = document.querySelector('.pic');
const wrap = document.querySelector('.wrap');
const body = document.querySelector('body');
const btn = document.querySelector('.btn');

btn.onclick = () => {
  request.open('GET', 'https://dvwhnbka7d.execute-api.us-east-1.amazonaws.com/default/lottery');
  request.onload = () => {
    if (request.status >= 200 && request.status < 400) {
      const json = JSON.parse(request.responseText);
      if (json.prize === 'FIRST') {
        btn.classList.add('hidden');
        pic.style.backgroundImage = 'url("./first.png")';
        body.style.background = 'skyblue';
        prize.innerText = '恭喜你中頭獎了！日本東京來回雙人遊！';
      } else if (json.prize === 'SECOND') {
        btn.classList.add('hidden');
        pic.style.backgroundImage = 'url("./second.png")';
        prize.innerText = '二獎！90 吋電視一台！';
      } else if (json.prize === 'THIRD') {
        btn.classList.add('hidden');
        pic.style.backgroundImage = 'url("./third.png")';
        prize.innerText = '恭喜你抽中三獎：知名 YouTuber 簽名握手會入場券一張，喵！';
      } else if (json.prize === 'NONE') {
        btn.classList.add('hidden');
        body.style.background = 'black';
        wrap.style.color = 'white';
        prize.innerText = '銘謝惠顧';
      } else {
        alert('系統不穩定，請再試一次');
      }
    } else {
      alert('系統不穩定，請再試一次');
    }
  };
  request.send();
};
