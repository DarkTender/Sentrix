(() => {
  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

  const searchInput = $("#search");
  const grid = $("#writeupGrid");
  const items = $$(".writeup-item", grid);
  const noResults = $("#noResults");
  const resultCount = $("#resultCount");
  const resetBtn = $("#resetBtn");
  const filterButtons = $$("[data-filter]");

  let activeFilter = "all";
  let searchTerm = "";

  function normalize(s) {
    return (s || "")
      .toString()
      .toLowerCase()
      .normalize("NFD")
      .replace(/\p{Diacritic}/gu, "");
  }

  function matches(item) {
    const category = item.dataset.category || "";
    const tags = item.dataset.tags || "";
    const text = normalize(item.textContent);
    const haystack = `${text} ${normalize(tags)} ${normalize(category)}`;

    const okFilter = activeFilter === "all" ? true : category === activeFilter;
    const okSearch = !searchTerm ? true : haystack.includes(searchTerm);

    return okFilter && okSearch;
  }

  function render() {
    let shown = 0;

    for (const item of items) {
      const show = matches(item);
      item.classList.toggle("d-none", !show);
      if (show) shown++;
    }

    resultCount.textContent = String(shown);
    noResults.classList.toggle("d-none", shown !== 0);
  }

  function setActiveFilter(next) {
    activeFilter = next;

    for (const btn of filterButtons) {
      const isActive = btn.dataset.filter === next;
      btn.classList.toggle("active", isActive);
      btn.setAttribute("aria-pressed", isActive ? "true" : "false");
    }

    render();
  }

  // Events
  searchInput?.addEventListener("input", (e) => {
    searchTerm = normalize(e.target.value);
    render();
  });

  for (const btn of filterButtons) {
    btn.addEventListener("click", () => setActiveFilter(btn.dataset.filter));
  }

  resetBtn?.addEventListener("click", () => {
    if (searchInput) searchInput.value = "";
    searchTerm = "";
    setActiveFilter("all");
  });

  // Init
  setActiveFilter("all");
})();
