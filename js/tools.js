(() => {
    const filters = document.getElementById('toolFilters');
    const grid = document.getElementById('toolGrid');
    const empty = document.getElementById('toolEmpty');
  
    if (!filters || !grid) return;
  
    const cards = Array.from(grid.querySelectorAll('.tl-card'));
    const chips = Array.from(filters.querySelectorAll('.tl-chip'));
  
    function setActiveChip(active) {
      chips.forEach(c => c.classList.toggle('is-active', c === active));
    }
  
    function applyFilter(filter) {
      let visible = 0;
  
      cards.forEach(card => {
        const cat = (card.getAttribute('data-category') || '').toLowerCase();
        const match = filter === 'all' ? true : cat.split(/\s+/).includes(filter);
        card.hidden = !match;
        if (match) visible++;
      });
  
      if (empty) empty.hidden = visible !== 0;
    }
  
    filters.addEventListener('click', (e) => {
      const btn = e.target.closest('.tl-chip');
      if (!btn) return;
  
      const filter = (btn.getAttribute('data-filter') || 'all').toLowerCase();
      setActiveChip(btn);
      applyFilter(filter);
    });
  
    applyFilter('all');
  })();