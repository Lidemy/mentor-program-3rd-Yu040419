function join(str, concatStr) {
  let afterJoin = '';
  for (let i = 0; i < (str.length - 1); i += 1) {
    afterJoin += str[i] + concatStr;
  }
  afterJoin += str[str.length - 1];
  return afterJoin;
}

function repeat(str, times) {
  let timeStr = '';
  for (let i = 1; i <= times; i += 1) {
    timeStr += str;
  }
  return timeStr;
}

console.log(join(['a', 'b', 'c'], ',,,'));
console.log(repeat('yo', 5));
