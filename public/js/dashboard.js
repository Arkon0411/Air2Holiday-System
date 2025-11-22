// Dashboard interactivity: navigation, destinations, search, profile toggle
(function () {
  function qs(sel, root = document) { return root.querySelector(sel); }
  function qsa(sel, root = document) { return Array.from(root.querySelectorAll(sel)); }

  // Navigation links (data-action="navigate")
  qsa('[data-action="navigate"]').forEach(a => {
    a.addEventListener('click', function (e) {
      e.preventDefault();
      const href = this.dataset.href;
      if (!href) return;
      window.location.href = href;
    });
  });

  // Destination cards - navigate to flights page with query param
  qsa('.card[data-destination]').forEach(card => {
    card.style.cursor = 'pointer';
    card.addEventListener('click', function () {
      const dest = this.dataset.destination || '';
      const slug = dest.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
      // Try flights page; fallback to current page alert
      const target = '/flights.html?dest=' + encodeURIComponent(slug);
      window.location.href = target;
    });
  });

  // Search functionality
  const searchBtn = qs('#searchBtn');
  const searchInput = qs('#searchInput');
  function doSearch() {
    if (!searchInput) return;
    const q = searchInput.value.trim();
    if (!q) {
      searchInput.focus();
      return;
    }
    // Redirect to flights page with search query
    const href = '/flights.html?search=' + encodeURIComponent(q);
    window.location.href = href;
  }
  if (searchBtn) searchBtn.addEventListener('click', doSearch);
  if (searchInput) searchInput.addEventListener('keydown', function (e) { if (e.key === 'Enter') doSearch(); });

  // Profile dropdown toggle
  const profileBtn = qs('#profileBtn');
  const profileMenu = qs('#profileMenu');
  if (profileBtn && profileMenu) {
    profileBtn.addEventListener('click', function (e) {
      e.stopPropagation();
      profileMenu.style.display = profileMenu.style.display === 'block' ? 'none' : 'block';
    });
    // close on outside click
    document.addEventListener('click', function () {
      if (profileMenu.style.display === 'block') profileMenu.style.display = 'none';
    });
  }

  // Refresh profile image when Livewire notifies of an update
  function refreshProfileImage() {
    if (!profileBtn) return;
    const src = profileBtn.getAttribute('src') || '';
    const base = src.split('?')[0];
    profileBtn.setAttribute('src', base + '?t=' + Date.now());
  }

  // Listen for Livewire event (if Livewire is present)
  if (window.Livewire && typeof Livewire.on === 'function') {
    Livewire.on('profile-photo-updated', function () {
      refreshProfileImage();
    });
  }

  // Also listen for a browser event fallback
  window.addEventListener('profile-photo-updated', function () {
    refreshProfileImage();
  });

})();
