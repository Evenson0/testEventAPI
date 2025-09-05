export interface EventItem {
  id: number;
  title: string;
  date: string;
  description?: string;
  tags?: string[];
  commentsCount: number;
  /**
   * Index signature to allow additional properties without using `any`.
   */
  [key: string]: unknown;
}

export type FetchState =
  | { status: 'idle' }
  | { status: 'loading' }
  | { status: 'success'; data: EventItem[] }
  | { status: 'empty' }
  | { status: 'error'; error: string };
