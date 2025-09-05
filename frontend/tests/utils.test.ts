import { pick, isNonEmptyString, debounce } from '../src/utils';

describe('pick', () => {
  it('should extract specified keys', () => {
    const obj = { a: 1, b: 2, c: 3 };
    const result = pick(obj, ['a', 'c']);
    expect(result).toEqual({ a: 1, c: 3 });
  });

  it('should ignore keys not present', () => {
    const obj = { a: 1 };
    const result = pick(obj, ['a', 'b'] as any);
    expect(result).toEqual({ a: 1 });
  });
});

describe('isNonEmptyString', () => {
  it('returns true for non-empty strings', () => {
    expect(isNonEmptyString('hello')).toBe(true);
    expect(isNonEmptyString('  ok  ')).toBe(true);
  });

  it('returns false for empty or whitespace-only strings', () => {
    expect(isNonEmptyString('')).toBe(false);
    expect(isNonEmptyString('   ')).toBe(false);
  });

  it('returns false for non-string values', () => {
    expect(isNonEmptyString(null)).toBe(false);
    expect(isNonEmptyString(undefined)).toBe(false);
    expect(isNonEmptyString(123 as any)).toBe(false);
  });
});

describe('debounce', () => {
  jest.useFakeTimers();

  it('should delay execution', () => {
    const fn = jest.fn();
    const debounced = debounce(fn, 200);
    debounced();
    expect(fn).not.toBeCalled();
    jest.advanceTimersByTime(199);
    expect(fn).not.toBeCalled();
    jest.advanceTimersByTime(1);
    expect(fn).toBeCalledTimes(1);
  });

  it('should cancel previous calls within delay', () => {
    const fn = jest.fn();
    const debounced = debounce(fn, 200);
    debounced();
    jest.advanceTimersByTime(100);
    debounced();
    jest.advanceTimersByTime(200);
    expect(fn).toBeCalledTimes(1);
  });
});
