const minTime = 1000;
const maxTime = 3000;
const randomTime = Math.floor(Math.random() * (maxTime - minTime)) + minTime;

let startTime = 0;
let endTime = 0;
let playTime = 0;
let resultTime = 0;

const htmlSelector = document.querySelector('html');

function addBtn() {
  const newBtn = document.createElement('button');
  newBtn.setAttribute('type', 'button');
  newBtn.classList.add('btn');
  newBtn.innerText = '再玩一次';
  document.querySelector('body').appendChild(newBtn);
  newBtn.addEventListener('click', () => {
    document.location.reload();
    newBtn.setAttribute('display', 'none');
  });
}

function changeColor() {
  document.querySelector('html').classList.add('bgcolor');
  startTime = new Date();
}

setTimeout(changeColor, randomTime);

htmlSelector.addEventListener('click', (e) => {
  endTime = new Date();
  playTime = 1;
  if (startTime > 0) {
    resultTime = (endTime - startTime) / 1000;
    alert(`你的成績是 ${resultTime} 秒`);
    addBtn();
    startTime = -1;
    playTime = 0;
    e.stopPropagation();
  } else if (playTime === 1 && startTime === 0) {
    alert('還沒變色喔! 失敗');
  }
});
