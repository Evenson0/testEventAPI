import axios, { AxiosError, CancelTokenSource } from 'axios';
import type { EventItem, FetchState } from './types';

let cancelSource: CancelTokenSource | null = null;

/**
 * Fetch events from the backend API.
 *
 * This function uses Axios to retrieve a list of events from `/api/events`.
 * It supports cancellation via `AbortController` (translated to Axios using cancel tokens).
 * It returns a `FetchState` discriminated union describing the result.
 *
 * @param query A search query passed to the API as `q`
 * @returns A promise resolving to a FetchState
 */
export async function fetchEvents(query: string): Promise<FetchState> {
  // Cancel any in‑flight request
  if (cancelSource) {
    cancelSource.cancel('Cancelled due to a new request');
  }
  cancelSource = axios.CancelToken.source();
  try {
    const response = await axios.get<EventItem[]>('/api/events', {
      params: { q: query },
      cancelToken: cancelSource.token,
    });
    const data = response.data;
    if (!data || data.length === 0) {
      return { status: 'empty' };
    }
    return { status: 'success', data };
  } catch (error: unknown) {
    const err = error as AxiosError;
    // If the request was cancelled we simply return idle
    if (axios.isCancel(err)) {
      return { status: 'idle' };
    }
    return { status: 'error', error: err.message ?? 'Unknown error' };
  }
}
