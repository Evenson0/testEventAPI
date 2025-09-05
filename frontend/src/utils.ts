/**
 * Select a subset of an object's properties.
 *
 * @param obj The source object
 * @param keys The list of keys to extract
 * @returns A new object with only the selected keys
 */
export function pick<T, K extends keyof T>(obj: T, keys: K[]): Pick<T, K> {
  const result = {} as Pick<T, K>;
  keys.forEach((key) => {
    if (key in obj) {
      result[key] = obj[key];
    }
  });
  return result;
}

/**
 * Narrow a value to a non-empty string.
 *
 * This is a type guard that returns true only when the input is a string
 * containing non-whitespace characters.
 *
 * @param value An unknown value
 * @returns A boolean indicating whether the value is a non-empty string
 */
export function isNonEmptyString(value: unknown): value is string {
  return typeof value === 'string' && value.trim().length > 0;
}

/**
 * Create a debounced version of a function.
 *
 * The returned function delays invoking `fn` until after `delay` milliseconds have
 * elapsed since the last time it was called. Use this to limit the rate of
 * expensive operations such as API calls triggered by user input.
 *
 * @param fn The target function to debounce
 * @param delay Delay in milliseconds (default: 300 ms)
 * @returns A debounced version of the function
 */
export function debounce<F extends (...args: any[]) => void>(
  fn: F,
  delay = 300
): (...args: Parameters<F>) => void {
  let timer: NodeJS.Timeout | undefined;
  return (...args: Parameters<F>): void => {
    if (timer) {
      clearTimeout(timer);
    }
    timer = setTimeout(() => {
      fn(...args);
    }, delay);
  };
}
