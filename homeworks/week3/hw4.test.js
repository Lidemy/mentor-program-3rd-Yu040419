const isPalindromes = require('./hw4');

describe('測試hw4', () => {
  it('should return correct answer when str = abcdcba', () => {
    expect(isPalindromes('abcdcba')).toBe(true);
  });
  it('should return correct answer when str = abcba', () => {
    expect(isPalindromes('abcba')).toBe(true);
  });
  it('should return correct answer when str = apple', () => {
    expect(isPalindromes('apple')).toBe(false);
  });
  it('should return correct answer when str = aaaaa', () => {
    expect(isPalindromes('aaaaa')).toBe(true);
  });
  it('should return correct answer when str = applppa', () => {
    expect(isPalindromes('applppa')).toBe(true);
  });
});
