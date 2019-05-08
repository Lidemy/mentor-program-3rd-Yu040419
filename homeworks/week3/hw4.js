function isPalindromes(str) {
  if (str.length <= 100) {
    let result = '';
    for (let i = str.length - 1; i >= 0; i -= 1) {
      result += str[i];
    }
    if (str === result) {
      return true;
    }
  } return false;
}

module.exports = isPalindromes;
