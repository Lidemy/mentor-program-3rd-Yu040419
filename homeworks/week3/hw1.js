function stars(n) {
  const countStars = [];
  for (let i = 1; i <= n; i += 1) {
    countStars.push('*'.repeat(i));
  }
  return countStars;
}

module.exports = stars;
