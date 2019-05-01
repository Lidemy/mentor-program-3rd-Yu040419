function reverse(str) {
  let invertedStr = '';
  for (let i = str.length - 1; i >= 0; i -= 1) {
    invertedStr += str[i];
  }
  console.log(invertedStr);
}

reverse('hello');
