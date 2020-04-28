const btn = document.querySelector('.btn');
const result = document.querySelector('#result');
let firstNum = '';
let secondNum = '';
let operator = '';

function reset() {
  firstNum = '';
  secondNum = '';
  operator = '';
}

btn.addEventListener('click', (e) => {
  if (operator === '' && e.target.classList.contains('num')) {
    result.innerText = '';
    firstNum += e.target.innerText;
    result.innerText = firstNum;
  }
  if (e.target.classList.contains('operator')) {
    operator = e.target.innerText;
  }
  if (operator !== '' && e.target.classList.contains('num')) {
    result.innerText = '';
    secondNum += e.target.innerText;
    result.innerText += secondNum;
  }
  if (e.target.classList.contains('equal') && operator.includes('+') === true) {
    result.innerText = '';
    result.innerText = Number(firstNum) + Number(secondNum);
    reset();
  } else if (e.target.classList.contains('equal') && operator.includes('-') === true) {
    result.innerText = '';
    result.innerText = Number(firstNum) - Number(secondNum);
    reset();
  } else if (e.target.classList.contains('equal') && operator.includes('×') === true) {
    result.innerText = '';
    result.innerText = Number(firstNum) * Number(secondNum);
    reset();
  } else if (e.target.classList.contains('equal') && operator.includes('÷') === true) {
    result.innerText = '';
    result.innerText = Number(firstNum) / Number(secondNum);
    reset();
  }
  if (e.target.classList.contains('ac')) {
    result.innerText = '0';
    reset();
  }
});
