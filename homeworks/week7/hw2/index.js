const question = document.querySelectorAll('.must');
const option = document.querySelector('.must1');
const answer = document.querySelectorAll('.answer');
const remind = document.querySelectorAll('.keypoint1');
const optionRemind = document.querySelector('.keypoint2');
const type = document.querySelectorAll('input[name=type]');
const btn = document.querySelector('.btn');
const others = document.querySelector('.others');
const course = [];
let ifSubmit = 0;

function checkInput() {
  ifSubmit = 0;
  for (let i = 0; i < answer.length; i += 1) {
    if (answer[i].value === '') {
      ifSubmit = 1;
      question[i].classList.add('warning');
      answer[i].classList.add('error');
      remind[i].classList.remove('hidden');
    } else {
      question[i].classList.remove('warning');
      answer[i].classList.remove('error');
      remind[i].classList.add('hidden');
    }
  }

  if (!type[0].checked && !type[1].checked) {
    ifSubmit = 1;
    option.classList.add('warning');
    optionRemind.classList.remove('noshow');
  } else {
    option.classList.remove('warning');
    optionRemind.classList.add('noshow');
  }
}

btn.addEventListener('click', () => {
  checkInput();

  for (let i = 0; i < type.length; i += 1) {
    if (type[i].checked === true) {
      course.push(type[i].value);
    }
  }

  if (ifSubmit === 1) {
    alert('有資料沒填到喔');
    course.pop();
  } else {
    console.log(`電子郵件地址：${answer[0].value}`);
    console.log(`暱稱：${answer[1].value}`);
    console.log(`報名類型：${course}`);
    console.log(`現在的職業：${answer[2].value}`);
    console.log(`怎麼知道這個計畫的：${answer[3].value}`);
    console.log(`是否有程式相關背景：${answer[4].value}`);
    console.log(`其他：${others.value}`);
    alert('提交成功');
  }
});

for (let i = 0; i < answer.length; i += 1) {
  answer[i].addEventListener('blur', () => {
    checkInput();
  });
}
for (let i = 0; i < type.length; i += 1) {
  type[i].addEventListener('blur', () => {
    checkInput();
  });
}
