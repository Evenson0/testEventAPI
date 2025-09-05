import { debounce } from './utils';
import { fetchEvents } from './api';

/**
 * Attach a debounced search handler to an input and render results.
 *
 * This script assumes the existence of elements with IDs `search` and `results`.
 * It listens for `input` events on the search box, performs a debounced API call,
 * and renders the resulting list of events into the results container.
 */
function setup() {
  const searchInput = document.getElementById('search') as HTMLInputElement | null;
  const resultsContainer = document.getElementById('results') as HTMLDivElement | null;

  async function handleSearch(query: string) {
    if (!resultsContainer) return;
    resultsContainer.textContent = 'Chargement…';
    const state = await fetchEvents(query);
    if (state.status === 'empty') {
      resultsContainer.textContent = 'Aucun événement trouvé.';
      return;
    }
    if (state.status === 'error') {
      resultsContainer.textContent = `Erreur : ${state.error}`;
      return;
    }
    if (state.status === 'success') {
      const fragment = document.createDocumentFragment();
      state.data.forEach((event) => {
        const card = document.createElement('div');
        card.className = 'event-card';
        // Title
        const title = document.createElement('h3');
        title.textContent = event.title;
        card.appendChild(title);
        // Date
        const dateEl = document.createElement('p');
        const date = new Date(event.date);
        dateEl.textContent = date.toLocaleString();
        card.appendChild(dateEl);
        // Description if provided
        if (event.description) {
          const desc = document.createElement('p');
          desc.textContent = event.description;
          card.appendChild(desc);
        }
        fragment.appendChild(card);
      });
      resultsContainer.innerHTML = '';
      resultsContainer.appendChild(fragment);
    }
  }

  if (searchInput) {
    const debounced = debounce((val: string) => {
      handleSearch(val);
    }, 300);
    searchInput.addEventListener('input', (e) => {
      const target = e.target as HTMLInputElement;
      debounced(target.value);
    });
  }
}

// Initialize only when the DOM is ready
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', setup);
} else {
  setup();
}
